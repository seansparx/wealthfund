<?php defined('BASEPATH') OR exit('No direct script access allowed');

require "yodlee/src/yodlee.php";

/**
 * Get Transaction categories from yodlee
 * 
 * @return bool;
 */
function get_categories($yodlee = false)
{
    $CI = & get_instance();
    $CI->load->model('bank_model');
    
    if($yodlee) {
        $obj = new YodleeAggregation();
        $categories = $obj->getUserTransactionCategories();

        foreach($categories as $cat){
            $db_data = array(
                            'category_id'       => (isset($cat->categoryId) ? $cat->categoryId : ''), 
                            'category_name'     => (isset($cat->categoryName) ? $cat->categoryName : ''), 
                            'category_type_id'  => (isset($cat->transactionCategoryTypeId) ? $cat->transactionCategoryTypeId : ''), 
                            'is_budgetable'     => (isset($cat->isBudgetable) ? $cat->isBudgetable : ''), 
                            'localized_cat_name' => (isset($cat->localizedCategoryName) ? $cat->localizedCategoryName : ''), 
                            'category_level_id' => (isset($cat->categoryLevelId) ? $cat->categoryLevelId : '') );

            $CI->bank_model->save_categories($db_data);
        }
    }
    
    return $CI->bank_model->get_transaction_categories();
}


/**
 * Get Transaction category types from yodlee
 * 
 * @return bool;
 */
function get_category_types()
{
    $CI = & get_instance();
    $CI->load->model('bank_model');
    
    $obj = new YodleeAggregation();
    $cat_types = $obj->getTransactionCategoryTypes();
    
    //pr($cat_types);
    
    foreach($cat_types as $type){
        $db_data = array(
                        'type_id'             => (isset($type->typeId) ? $type->typeId : ''), 
                        'type_name'           => (isset($type->typeName) ? $type->typeName : ''), 
                        'localized_type_name' => (isset($type->localizedTypeName) ? $type->localizedTypeName : '') );

        $CI->bank_model->save_category_types($db_data);
    }
}


/**
 * Get login ( yodlee api ).
 * 
 * @return bool;
 */
function yodlee_login() 
{
    $obj = new YodleeAggregation();
    return $obj->login();
}


/**
 * Manage login session of user ( yodlee api ).
 * 
 * @return bool;
 */
function manage_login_yodlee()
{
    if(isset($_SESSION['login_response']['Body']->userContext->conversationCredentials->sessionToken)) {
        
        $obj = new YodleeAggregation();    
        $resp = $obj->getUserInfo();
        $sessionToken1 = $resp['Body']->userContext->conversationCredentials->sessionToken;
        $sessionToken2 = $_SESSION['login_response']['Body']->userContext->conversationCredentials->sessionToken;

        if(trim($sessionToken2)!='' && $sessionToken1 != $sessionToken2) {
            $obj->login();
        }    
    }
    
}


/**
 * Get login ( yodlee api ).
 * 
 * @param int $SiteAccId
 * 
 * @return void;
 */
function site_refresh($SiteAccId) 
{
    $obj = new YodleeAggregation();
    return $obj->startSiteRefresh($SiteAccId);
}

/**
 * Get list of popular sites ( yodlee api ).
 * 
 * @return array;
 */
function get_popular_banks()
{
    $obj = new YodleeAggregation();
    return $obj->getPopularSites();
}


/**
 * Search sites ( yodlee api ).
 * 
 * @return array;
 */
function search_sites()
{
    $CI = & get_instance();
    $keyword = $CI->input->post('search');
    
    if(trim($keyword) != ''){
        $obj = new YodleeAggregation();
        return $obj->searchSites($keyword);
    }
    else{
        echo "Enter keyword";
    }
}

/**
 * Add new bank account ( yodlee api ).
 * 
 * @return bool;
 */
function link_bank_account()
{
    $CI = & get_instance();
    $site_id  = decode($CI->input->post('site_id'));
    $login_id = $CI->input->post('login');
    $password = $CI->input->post('passwd');

    if((trim($site_id) != '') && (trim($login_id) != '') && (trim($password) != '')){
        $obj = new YodleeAggregation();
        $response = $obj->addSiteAccount($site_id, $login_id, $password);
        
        if($response['Body']->siteAccountId > 0){
            return true;
        }
    }
}


/**
 * Get list of linked bank accounts ( yodlee api ).
 * 
 * @param bool $db_table
 * 
 * @return array
 */
function get_bank_account($db_table = false)
{
    $CI = & get_instance();

    if(($db_table == true) || ($CI->session->userdata('linked_account_refreshed') == 'yes')) {
        $CI->load->model('bank_model');
        $response = $CI->bank_model->get_linked_accounts();
    }
    else{
        $obj = new YodleeAggregation();
        $response = $obj->getAllSiteAccounts();

        if($response == 415){
            //logout();
        }

        $response = save_linked_accounts($response);
        
        /** Get user transaction also from Yodlee */
        get_transactions();
                
    }
    
    return $response;
    
}



/**
 * Update list of linked bank accounts ( wealthfund database ).
 * 
 * @return void
 */
function update_bank_accounts()
{
    $obj = new YodleeAggregation();
    $response = $obj->getAllSiteAccounts();

    if($response != 415){
        $acc_list = save_linked_accounts($response);
        return count($acc_list);
    }
}



/**
 * Refresh all linked accounts ( yodlee ).
 * 
 * return json
 */
function refresh_all_accounts()
{
    $obj = new YodleeAggregation();
    $response = $obj->getAllSiteAccounts();

    if ($response != 415) {
        
        $site_accounts = array();

        foreach ($response as $sites) {
            
            foreach ($sites as $site) {
                
                $site_AccId = $site->memSiteAccId;

                if (!in_array($site_AccId, $site_accounts)) {
                    $site_accounts[] = $site_AccId;
                }
            }
        }
        
        foreach ($site_accounts as $site_AccId) {
            site_refresh($site_AccId);
        }
        
        $updated_response = $obj->getAllSiteAccounts();
        $rs = save_linked_accounts($updated_response);
        echo json_encode($rs);
    }
}


/**
 * Update database linked accounts.
 * 
 * return bool
 */
function save_linked_accounts($response)
{    
    $CI = & get_instance();
    $CI->load->model('bank_model');
    
    $site_accounts = array();
        
    foreach ($response as $sites) {
                
        foreach ($sites as $site){

            $site_id    = $site->contentServiceInfo->siteId;
            $site_name  = $site->contentServiceInfo->siteDisplayName;
            $site_container  = $site->contentServiceInfo->containerInfo->containerName;
            $site_AccId = $site->memSiteAccId;
            
            if( !in_array($site_AccId, $site_accounts)) {
                $site_accounts[] = $site_AccId;
            }

            if(isset($site->itemId) && isset($site->itemData->accounts)){

                foreach ($site->itemData->accounts as $accounts){

                    if(isset($accounts->insurancePolicys) && (count($accounts->insurancePolicys) > 0)){
                        $accountId          = $accounts->insurancePolicys[0]->itemAccountId;
                        $accountName        = $accounts->insurancePolicys[0]->accountName;
                        $localizedAcctType  = 'Insurance';
                        $accountNumber      = $accounts->insurancePolicys[0]->accountNumber;
                        $accountHolder      = $accounts->insurancePolicys[0]->accountHolder;
                        $lastUpdated        = strtotime($accounts->insurancePolicys[0]->lastPaymentDate);
                        $accountStatus      = $accounts->insurancePolicys[0]->itemAccountStatusId;
                    }
                    else if(isset($accounts->rewardsBalances) && (count($accounts->rewardsBalances) > 0)){
                        $accountId          = $accounts->itemAccountId;
                        $accountName        = $accounts->accountDisplayName->defaultNormalAccountName;
                        $localizedAcctType  = 'Miles';
                        $accountNumber      = '-';
                        $accountHolder      = '';
                        $lastUpdated        = $accounts->lastUpdated;
                        $accountStatus      = $accounts->itemAccountStatusId;
                    }
                    else if(isset($accounts->loans) && (count($accounts->loans) > 0)){
                        $accountId          = $accounts->loans[0]->itemAccountId;
                        $accountName        = $accounts->loans[0]->accountName;
                        $localizedAcctType  = 'Loans';
                        $accountNumber      = $accounts->loans[0]->accountNumber;
                        $accountHolder      = $accounts->loans[0]->accountHolder;
                        $lastUpdated        = $accounts->loans[0]->lastUpdated;
                        $accountStatus      = $accounts->loans[0]->itemAccountStatusId;
                    }
                    else{
                        $accountId          = $accounts->itemAccountId;
                        $accountName        = $accounts->accountName;
                        $localizedAcctType  = $accounts->localizedAcctType;
                        $accountNumber      = $accounts->accountNumber;
                        $accountHolder      = $accounts->accountHolder;
                        $lastUpdated        = $accounts->lastUpdated;
                        $accountStatus      = $accounts->itemAccountStatusId;
                    }

                    if(isset($accounts->localizedAcctType)){

                        $availableBalance= 0;
                        $availableCredit = 0;
                        $totalCredit     = 0;

                        switch($accounts->localizedAcctType){

                            case 'currentAccount' : $availableBalance = $accounts->availableBalance->amount;  break;

                            case 'savings'      : $availableBalance = $accounts->availableBalance->amount;  break;

                            case 'fixedDeposit' : $availableBalance = $accounts->availableBalance->amount;  break;

                            case 'credit'       : $availableBalance = $accounts->availableCredit->amount;   break;

                            case 'unknown'      :
                                                    if(isset($accounts->runningBalance->amount)){
                                                        $availableBalance = $accounts->runningBalance->amount;
                                                        $availableCredit  = $accounts->availableCredit->amount;
                                                        $totalCredit      = $accounts->totalCreditLine->amount;
                                                    }
                                                    if(isset($accounts->totalAccountBalance->amount)){
                                                        $availableBalance = $accounts->totalAccountBalance->amount;
                                                    }
                                                    if(isset($accounts->totalBalance->amount)){
                                                        $availableBalance = $accounts->totalBalance->amount;
                                                    }
                                                    break;

                            default             : $availableBalance = 0;
                        }

                    }

                    $db_data = array(
                                    'user_id'           => $CI->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'], 
                                    'account_id'        => (isset($accountId) ? $accountId : ''), 
                                    'site_id'           => (isset($site_id) ? $site_id : ''), 
                                    'site_account_id'   => (isset($site_AccId) ? $site_AccId : ''), 
                                    'site_name'         => (isset($site_name) ? $site_name : ''), 
                                    'site_container'    => (isset($site_container) ? $site_container : ''), 
                                    'account_name'      => (isset($accountName) ? $accountName : ''),
                                    'account_type'      => (isset($localizedAcctType) ? $localizedAcctType : ''),
                                    'account_number'    => (isset($accountNumber) ? $accountNumber : ''),
                                    'account_holder'    => (isset($accountHolder) ? $accountHolder : ''),
                                    'available_balance' => (isset($availableBalance) ? $availableBalance : ''),
                                    'available_credit'  => (isset($availableCredit) ? $availableCredit : ''),
                                    'total_credit'      => (isset($totalCredit) ? $totalCredit : ''),
                                    'account_status'    => (isset($accountStatus) ? $accountStatus : ''),
                                    'last_updated'      => (isset($lastUpdated) ? date("Y-m-d H:i:s", $lastUpdated) : '' ) );

                    $CI->bank_model->save_linked_accounts($db_data);
                }
            }
        }
    }
            
    $CI->session->set_userdata('linked_account_refreshed', 'yes');
    
    return $CI->bank_model->get_linked_accounts();
        
}


/**
 * Get transactions ( yodlee api ).
 * 
 * @return array;
 */
function get_account_balance()
{
    $CI = & get_instance();
    $CI->load->model('bank_model');
    $amount = $CI->bank_model->get_account_balance();
    return currency_symbol().number_format($amount->balance_amt, 2);
}



/**
 * Get transactions ( yodlee api ).
 * 
 * @return array;
 */
function get_transactions($from_db = false)
{
    $CI = & get_instance();

    /** Get from database if search Identifier is set */    
    if( ($from_db == true) || trim($CI->session->userdata('transactions')['searchIdentifier']) != '') {
        $CI->load->model('bank_model');
        return $CI->bank_model->get_transactions();
    }
    
    /** Get from Yodlee API */
    else{
        return save_account_transactions();
    }
}


/**
 * Save Transactions into database.
 * 
 * return bool
 */
function save_account_transactions()
{
    $CI = & get_instance();
    $CI->load->model('bank_model');
    
    $obj = new YodleeAggregation();
        
    $response = $obj->searchTransactions();
    
    foreach ($response as $entry) {
        
            $user_id            = $CI->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
            $transaction_id     = (isset($entry->viewKey->transactionId) ? $entry->viewKey->transactionId : '');
            $transaction_type   = (isset($entry->transactionType) ? $entry->transactionType : '');
            $description        = (isset($entry->description->description) ? $entry->description->description : '');
            $amount             = (isset($entry->amount->amount) ? $entry->amount->amount : '');
            $account_balance    = (isset($entry->account->accountBalance->amount) ? $entry->account->accountBalance->amount : '');
            $currency           = (isset($entry->account->accountBalance->currencyCode) ? $entry->account->accountBalance->currencyCode : '');
            $account_number     = (isset($entry->account->accountNumber) ? $entry->account->accountNumber : '');
            $transaction_type_id = (isset($entry->transactionTypeId) ? $entry->transactionTypeId : '');
            $item_account_id    = (isset($entry->account->itemAccountId) ? $entry->account->itemAccountId : '');
            $site_name          = (isset($entry->account->siteName) ? $entry->account->siteName : '');
            $account_name       = (isset($entry->account->accountDisplayName->defaultNormalAccountName) ? $entry->account->accountDisplayName->defaultNormalAccountName : '');
            $category_id        = (isset($entry->category->categoryId) ? $entry->category->categoryId : '');
            $category_type_id   = (isset($entry->category->categoryTypeId) ? $entry->category->categoryTypeId : '');
            $category_level_id  = (isset($entry->category->categoryLevelId) ? $entry->category->categoryLevelId : '');
            $category_name      = (isset($entry->category->categoryName) ? $entry->category->categoryName : '');
            $container_type     = (isset($entry->viewKey->containerType) ? $entry->viewKey->containerType : '');
            $check_number       = (isset($entry->checkNumber->checkNumber) ? $entry->checkNumber->checkNumber : '');
            $transaction_date   = (isset($entry->transactionDate) ? $entry->transactionDate : '');
            $is_taxable         = (isset($entry->isTaxable) ? $entry->isTaxable : '');
            $is_medical         = (isset($entry->isMedical) ? $entry->isMedical : '');
            $is_business        = (isset($entry->isBusiness) ? $entry->isBusiness : '');
            $is_reimbursable    = (isset($entry->isReimbursable) ? $entry->isReimbursable : '');
            $is_personal        = (isset($entry->isPersonal) ? $entry->isPersonal : '');
            $item_account_status_id = (isset($entry->account->itemAccountStatusId) ? $entry->account->itemAccountStatusId : '');
            $row_number         = (isset($entry->viewKey->rowNumber) ? $entry->viewKey->rowNumber : '');
            $posting_order      = (isset($entry->transactionPostingOrder) ? $entry->transactionPostingOrder : '');
            $post_date          = (isset($entry->postDate) ? date('Y-m-d H:i:s', strtotime($entry->postDate)) : '');
            $status             = (isset($entry->status->description) ? $entry->status->description : '');

            $db_data = array(
                            'user_id'           => $user_id,
                            'transaction_id'    => $transaction_id,
                            'transaction_type'  => $transaction_type,
                            'description'       => $description,
                            'amount'            => $amount,
                            'account_balance'   => $account_balance,
                            'currency'          => $currency,
                            'account_number'    => $account_number,
                            'transaction_type_id' => $transaction_type_id,
                            'item_account_id'   => $item_account_id,
                            'site_name'         => $site_name,
                            'account_name'      => $account_name,
                            'category_id'       => $category_id,
                            'category_type_id'  => $category_type_id,
                            'category_level_id' => $category_level_id,
                            'category_name'     => $category_name,
                            'container_type'    => $container_type,
                            'check_number'      => $check_number,
                            'transaction_date'  => $transaction_date,
                            'is_taxable'        => $is_taxable,
                            'is_medical'        => $is_medical,
                            'is_business'       => $is_business,
                            'is_reimbursable'   => $is_reimbursable,
                            'is_personal'       => $is_personal,
                            'item_account_status_id' => $item_account_status_id,
                            'row_number'        => $row_number,
                            'posting_order'     => $posting_order,
                            'post_date'         => $post_date,
                            'status'            => $status );

            $CI->bank_model->save_transactions($db_data);
    }
    
    $result = $CI->bank_model->get_transactions();
    return $result;
}


/**
 * Remove Item accounts ( yodlee api ).
 * 
 * @return mix
 */
function remove_bank_item($itemAccountId)
{
    $CI = & get_instance();
    $obj = new YodleeAggregation();
    $response = $obj->removeItemAccount($itemAccountId);
    
    if($response == 415){
        return 'session_expired';
    }
}


function getItemSummariesWithoutItemData()
{
    $CI = & get_instance();
    $obj = new YodleeAggregation();
    $response = $obj->getItemSummariesWithoutItemData();
    
    if($response == 415){
        return 'session_expired';
    }
    
    return $response;
}


/**
 * Get list of linked bank accounts ( yodlee api ).
 * 
 * @return array
 */
function fastlink2_token()
{
    $CI = & get_instance();
    $obj = new YodleeAggregation();
    $response = $obj->getFastlink2Token();
    
    if($response == 415){
        return 'session_expired';
    }
    
    return $response;
}


/** 
 * Authenticate and login yodlee api.
 * 
 * @return string
 */
function getCobSessionToken($cob_service_url, $userName, $cobPassword) 
{
//    $cob_service_url = BASE_SERVICE_URL . 'authenticate/coblogin';

    //print 'service call:' . $cob_service_url . '<br>';
    $curl_post_data = array(
        "cobrandLogin" => $userName,
        "cobrandPassword" => $cobPassword
    );

    // Call the HTTP URL
    $curl = curl_init($cob_service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($curl_post_data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $curl_response = curl_exec($curl);

    $base_jsonobj = json_decode($curl_response);

    $cob_conv_creds = $base_jsonobj->{'cobrandConversationCredentials'};
    $cob_session_value = $cob_conv_creds->{'sessionToken'};
    //print "<br/><br/> cobrand session <br/>" . $cob_session_value;

    curl_close($curl);

    return $cob_session_value;
}


/**
 * Authenticate and login yodlee user.
 * 
 * @return string
 */
function getUserSessionToken($user_service_url, $cobSessionToken, $login, $password) 
{
//    $cob_service_url = BASE_SERVICE_URL . 'authenticate/login';

    $curl_post_data = array(
        "login" => $login,
        "password" => $password,
        "cobSessionToken" => $cobSessionToken
    );

    // Call the HTTP URL
    $curl = curl_init($user_service_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($curl_post_data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);

    $base_jsonobj = json_decode($curl_response);
    $user_context = $base_jsonobj->{'userContext'};
    $usr_conv_creds = $user_context->{'conversationCredentials'};
    $usr_session_value = $usr_conv_creds->{'sessionToken'};

    curl_close($curl);

    return $usr_session_value;
}


/**
 * Get fastlink access token for use with popup
 * 
 * @return string
 */
function getFastlink2Token($token_service_url, $cobSessionToken, $userSessionToken, $finappId) 
{
//    $cob_service_url = BASE_SERVICE_URL . 'jsonsdk/OAuthAccessTokenManagementService/getOAuthAccessToken';

    $curl_post_data = array(
        "cobSessionToken" => $cobSessionToken,
        "rsession" => $userSessionToken,
        "finAppId" => $finappId
    );

    // Call the HTTP URL
    $curl = curl_init($token_service_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($curl_post_data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);

//    $error_no = curl_errno($curl);

    curl_close($curl);

    $base_jsonobj = json_decode($curl_response);
    $info_obj = $base_jsonobj->{'finappAuthenticationInfos'};
    $token = $info_obj[0]->{'token'};

    return $token;
//    return $curl_response;
//    return $error_no;

}


/**
 * Get Transaction Category Type.
 * 
 * @param int
 * 
 * @return string
 */
function category_type($cat_type_id)
{
    $cats = array('1' => 'Uncategorize', '2' => 'Income', '3' => 'Expense', '4' => 'Transfer', '5' => 'Deferred Compensation');
    return $cats[$cat_type_id];
}


/**
 * Common function to dispaly currency code.
 * 
 * @return mix
 */
function currency_symbol()
{
    return '&#x20B9; ';
    
    $currency_code = $_SESSION['currency_code'];
    if($currency_code == 'USD'){
        return '$';
    }
    else{
        return $currency_code;
    }
}

?>
