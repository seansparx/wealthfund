<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for bankaccount page 
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class BankAccounts extends MY_Controller 
{
    function __construct() {
        parent::__construct();
        $this->_init();
    }

    
    private function _init()
    {
        if(! loginCheck()){
            redirect('../');
        } 
        
        $this->load->model('bank_model');        
    }
    
    
    /**
     * Load page list of linked bank accounts.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array();
        
        $this->data['banks']            = $this->html_linked_accounts();
        $this->data['rsession_token']   = $_SESSION['userSessionToken'];
        $this->data['finapp_id']        = $_SESSION['fastlink_finapp_id'];
        $this->data['fastlink2_token']  = $_SESSION['fastlink_token'];
        $this->data['extra_params']     = '';
        
        $this->render('bank_accounts/index');
    }    
    
    /**
     * Generate html of linked accounts.
     * 
     * @return html
     */
    private function html_linked_accounts()
    {
        $tbl_row = '';
        $total_balance = 0;
        $total_saving_balance = 0;
        $currency_code = currency_symbol(); 

        $accounts = get_bank_account(true);
        
        foreach ($accounts as $sites) {
            $accountId          = $sites->account_id;
            $site_account_id    = $sites->site_account_id;
            $accountName        = $sites->account_name;
            $localizedAcctType  = $sites->account_type;
            $accountNumber      = $sites->account_number;
            $lastUpdated        = $sites->last_updated;
            $accountStatus      = $sites->account_status;
            $availableBalance   = $sites->available_balance;
                        
            $tbl_row .= '<tr id="'.encode($site_account_id.":::XXXX:::".$accountId).'">
                            <td>'.$accountName.'</td>
                            <td>'.$localizedAcctType.'</td>
                            <td>'.$accountNumber.'</td>
                            <td align="right">'.$currency_code.number_format($availableBalance, 2).'</td>
                            <td>'.date("d/m/Y", strtotime($lastUpdated)).'</td>
                            <td>'.($accountStatus == 1 ? '<i class="fa fa-check text-navy"></i>' : '<i class="glyphicon glyphicon-warning-sign text-warning"></i>').'</td>
                            <td><a href="javascript:void(0);" id="refresh"><i class="glyphicon glyphicon-repeat text-navy" aria-hidden="true"></i></a></td>
                            <td><a href="javascript:void(0);" id="remove"><i class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></i></a></td>
                        </tr>';
            
            $total_balance += $availableBalance;

            if( ($localizedAcctType == 'savings') || ($localizedAcctType == 'currentAccount') ){
                $total_saving_balance += $availableBalance;
            }

        }
                
                
        if(trim($tbl_row) != ''){
            return (object) array('account_list' => $tbl_row, 'total_balance' => $total_balance, 'total_saving_balance' => $total_saving_balance, 'currency_code' => $currency_code);
        }
        else{
            return (object) array('account_list' => '<tr><td colspan="9">No Record Found</td></tr>', 'total_balance' => $total_balance, 'total_saving_balance' => $total_saving_balance, 'currency_code' => $currency_code);
        }
        
    }
    
    
    /**
     * Refresh linked accounts yodlee.
     * 
     * @param int $itemAccountId
     * 
     * @return void
     */
    public function refresh()
    {
        if(match_token()){
            $ids = explode(":::XXXX:::", decode($this->input->post('acc_id')));
            $SiteAccId = $ids[0];
            site_refresh($SiteAccId);           
            echo update_bank_accounts();
            
        }
    }
    
    
    /**
     * Remove linked accounts from database & yodlee.
     * 
     * @param int $itemAccountId
     * 
     * @return void
     */
    public function remove()
    {
        if(match_token()){ 
            $ids = explode(":::XXXX:::", decode($this->input->post('item_id')));
            $itemAccountId = $ids[1];
            /** remove from database */
            echo $this->bank_model->delete_account($itemAccountId);
        }
    }
    
    
    
}
