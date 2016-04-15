<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model
{
    private $tbl_accounts     = "linked_accounts";
    private $tbl_transactions = "account_transactions";
    private $category_types   = "transaction_category_types";
    private $categories       = "transaction_categories";
    

    function __construct() 
    {
        parent::__construct();
        $this->_init();
    }

    
    private function _init()
    {
        /* code here */
    }
    
    /**
     * Get cash balance.
     * 
     * @return mix
     */
    public function get_cash_balance()
    {
        $income  = $this->get_cash_income();
        $expense = $this->get_cash_expense();
        if($expense > $income) {
            return ($expense - $income);
        }
        else{
            return ($income - $expense);
        }
    }
    
    
    private function get_cash_income()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $this->db->select(array("SUM(amount) AS income"));
        $query = $this->db->get_where($this->tbl_transactions, array('user_id' => $user_id, 'transaction_type' => 'credit', 'container_type' => 'cash'));
        $income = $query->row()->income;
        return $income ? $income : 0;
    }
    
    
    private function get_cash_expense()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $this->db->select(array("SUM(amount) AS expense"));
        $query = $this->db->get_where($this->tbl_transactions, array('user_id' => $user_id, 'transaction_type' => 'debit', 'container_type' => 'cash'));
        $expense = $query->row()->expense;
        return $expense ? $expense : 0;
    }
    
    
    /**
     * Get all incomes.
     * 
     * @return array
     */
    public function get_incomes()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        $this->db->select(array('DATE_FORMAT(post_date,"%b") AS mnth', 'YEAR(post_date) AS yr', 'SUM(amount) AS total_amount', 'currency'));        
        $this->db->where(array('user_id' => $user_id, 'transaction_type' => 'credit'));
        $this->db->group_by('mnth','yr');
        $this->db->order_by('post_date', 'asc');
        $query = $this->db->get($this->tbl_transactions);
        return $query->result();
    }
    
    
    /**
     * Get all spendings.
     * 
     * @return array
     */
    public function get_expenses()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        $this->db->select(array('DATE_FORMAT(post_date,"%b") AS mnth', 'YEAR(post_date) AS yr', 'SUM(amount) AS total_amount', 'currency'));        
        $this->db->where(array('user_id' => $user_id, 'transaction_type' => 'debit'));
        $this->db->group_by('mnth','yr');
        $this->db->order_by('post_date', 'asc');
        $query = $this->db->get($this->tbl_transactions);
        return $query->result();
    }
    
    
    /**
     * Get all expenses ( category wise ).
     * 
     * @return array
     */
    public function get_expenses_by_category()
    {
        $account_id = $this->input->get('acc_id') ? $this->input->get('acc_id') : '';
        $duration   = $this->input->get('duration') ? $this->input->get('duration') : '';
        
        $end_date = date("Ymd");
        
        switch($duration) {
            case '7'        : $start_date = date("Ymd", strtotime("-7 days")); break;
            
            case '14'       : $start_date = date("Ymd", strtotime("-14 days")); break;
            
            case 'this'     : $start_date = date("Ym").'01'; break;
            
            case 'last'     : $start_date = date("Ym", strtotime("-1 month")).'01'; break;
            
            case 'last3'    : $start_date = date("Ymd", strtotime("-3 month")); break;
            
            case 'last6'    : $start_date = date("Ymd", strtotime("-6 month")); break;
            
            case 'last12'   : $start_date = date("Ymd", strtotime("-12 month")); break;
            case 'thisyear' : $start_date = date("Y").'0101'; break;
            
            case 'lastyear' : $start_date = date("Y", strtotime("-1 year")).'0101'; 
                              $end_date = date("Y").'1231'; break;
        }
        
        
        
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        if($account_id){
            $where = array('user_id' => $user_id, 'transaction_type' => 'debit', 'item_account_id' => $account_id);
        }
        else{
            $where = array('user_id' => $user_id, 'transaction_type' => 'debit');
        }
        
        $this->db->select(array('post_date','category_name','category_type_id', 'SUM(amount) AS total_amount', 'currency'));
        $this->db->group_by('category_id');
        $this->db->order_by('total_amount', 'desc');
        
        if(isset($start_date) && $start_date > 0){
            $this->db->where('post_date >=', $start_date);
            $this->db->where('post_date <=', $end_date);
        }
        // Get Only 6 categories by default.
        if( ! $account_id){
            $this->db->limit(6);
        }
        
        $query = $this->db->get_where($this->tbl_transactions, $where);
        return $query->result();
    }
    
    
    /**
     * Get all linked accounts of user.
     * 
     * @return array
     */
    public function get_linked_accounts()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $query = $this->db->get_where($this->tbl_accounts, array('user_id' => $user_id));
        return $query->result();
    }
    
    
    /**
     * Save yodlee linked account in database.
     * 
     * @return bool
     */
    public function save_linked_accounts($accounts)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        if(intval($user_id) > 0) {
            if( $this->is_linked($accounts['account_id']) ) {
                $this->db->where( array('account_id' => $accounts['account_id'], 'user_id' => $user_id) );
                return $this->db->update($this->tbl_accounts, $accounts);
            }
            else{
                return $this->db->insert($this->tbl_accounts, $accounts);
            }
        }
        
    }
    
    
    /**
     * Add property by users ( Home, Vehicle etc ).
     * 
     * @return int
     */
    public function add_property()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];

        if(intval($user_id) > 0) {
            $post_data = $this->input->post();
            $property = array(
                "user_id"      => $user_id, 
                "account_id"   => 'P'.time(), 
                "account_name" => (isset($post_data['property_name']) ? $post_data['property_name'] : ''),
                "account_type" => "property",
                "site_name"    => (isset($post_data['property_type']) ? $post_data['property_type'] : ''),
                "site_container" => "property",
                "available_balance" => (isset($post_data['property_amt']) ? $post_data['property_amt'] : ''),
                "currency"      => 'INR',
                "residence_type" => (isset($post_data['residence_type']) ? $post_data['residence_type'] : ''),
                "model_no"      => (isset($post_data['model_name']) ? $post_data['model_name'] : ''),
                "street_address" => (isset($post_data['street_addr']) ? $post_data['street_addr'] : ''),
                "apartment_name" => (isset($post_data['apartment']) ? $post_data['apartment'] : ''),
                "zipcode" => (isset($post_data['zipcode']) ? $post_data['zipcode'] : ''),
                "last_updated"   => date("Y-m-d H:i:s"),
                "account_status" => 1);

            $this->db->insert($this->tbl_accounts, $property);
            if($this->db->insert_id() > 0) {
                return true;
            }
        }
        
    }
    
    
    /**
     * Add golds by users.
     * 
     * @return int
     */
    public function add_golds()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];

        if(intval($user_id) > 0) {
            $post_data = $this->input->post();
            
            $gold = array(
                "user_id"      => $user_id, 
                "account_id"   => 'P'.time(), 
                "account_name" => (isset($post_data['gold_name']) ? $post_data['gold_name'] : ''),
                "account_type" => "gold",
                "site_name"    => (isset($post_data['investment_type']) ? $post_data['investment_type'] : ''),
                "site_container" => "gold",
                "available_balance" => (isset($post_data['gold_amt']) ? $post_data['gold_amt'] : ''),
                "currency"      => 'INR',
                "last_updated"   => date("Y-m-d H:i:s"),
                "account_status" => 1);

            $this->db->insert($this->tbl_accounts, $gold);
            if($this->db->insert_id() > 0) {
                return true;
            }
        }
        
    }
    
    
    /**
     * Add fixed deposit accounts by users.
     * 
     * @return int
     */
    public function add_fixed_deposit()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];

        if(intval($user_id) > 0) {
            $post_data = $this->input->post();
            
            $fd = array(
                "user_id"      => $user_id, 
                "account_id"   => 'P'.time(), 
                "account_name" => (isset($post_data['bank_name']) ? $post_data['bank_name'] : ''),
                "account_type" => "fd",
                "site_name"    => (isset($post_data['investment_type']) ? $post_data['investment_type'] : ''),
                "site_container" => "fd",
                "available_balance" => (isset($post_data['fd_amount']) ? $post_data['fd_amount'] : ''),
                "currency"      => 'INR',
                "last_updated"   => date("Y-m-d H:i:s"),
                "account_status" => 1);

            $this->db->insert($this->tbl_accounts, $fd);
            if($this->db->insert_id() > 0) {
                return true;
            }
        }
        
    }
    
    
    /**
     * Add insurance accounts by users.
     * 
     * @return int
     */
    public function add_insurance()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];

        if(intval($user_id) > 0) {
            $post_data = $this->input->post();
            
            $insurance = array(
                "user_id"      => $user_id, 
                "account_id"   => 'P'.time(), 
                "account_name" => (isset($post_data['policy_name']) ? $post_data['policy_name'] : ''),
                "account_type" => "insurance",
                "site_name"    => (isset($post_data['insurance_type']) ? $post_data['insurance_type'] : ''),
                "site_container" => "insurance",
                "available_balance" => (isset($post_data['coverage_amt']) ? $post_data['coverage_amt'] : ''),
                "currency"      => 'INR',
                "last_updated"   => date("Y-m-d H:i:s"),
                "account_status" => 1);

            $this->db->insert($this->tbl_accounts, $insurance);
            if($this->db->insert_id() > 0) {
                return true;
            }
        }
        
    }
    
    
    /**
     * Check if account already linked.
     * 
     * @return bool
     */
    private function is_linked($account_id)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $query = $this->db->get_where($this->tbl_accounts, array('account_id' => $account_id, 'user_id' => $user_id));
        return ($query->num_rows() > 0) ? true : false ;
    }
    
    
    /**
     * Remove account already linked.
     * 
     * @return bool
     */
    public function delete_account($account_id)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $this->db->delete($this->tbl_accounts, array('account_id' => $account_id, 'user_id' => $user_id));
        
        /** remove from yodlee */
        if(substr($account_id, 0, 1) != 'P') { // 'P' used for Private id.
            remove_bank_item($account_id);
        }
        
        return true;
    }
    
    /**
     * Get User Transactions.
     * 
     * @param int $account_id [ Optional ]
     * 
     * @return array
     */
    public function get_transactions($account_id = null)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        $this->db->select(array('id','post_date','description','category_name','category_id', 'category_type_id','amount', 'currency'));
        if($account_id){
            $this->db->where('item_account_id', $account_id);
        }
        
        $query   = $this->db->order_by('post_date,id', 'desc')->get_where($this->tbl_transactions, array('user_id' => $user_id));
        return $query->result();
    }
    
    /**
     * Get total balance of linked account.
     * 
     * @param int $account_id
     * 
     * @return double
     */
    public function get_account_balance($account_id = null)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        if($account_id){
            $this->db->select(array('available_balance AS balance_amt', 'site_container', 'available_credit', 'total_credit'));
            $query = $this->db->get_where($this->tbl_accounts, array('user_id' => $user_id, 'account_id' => $account_id));
        }
        else{
            $this->db->select(array('SUM(available_balance) AS balance_amt'));
            $query = $this->db->get_where($this->tbl_accounts, array('user_id' => $user_id));
        }
        
        return $query->row();
    }
    
    
    private function is_transaction_exists($transaction_id)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $query = $this->db->get_where($this->tbl_transactions, array('transaction_id' => $transaction_id, 'user_id' => $user_id));
        return ($query->num_rows() > 0) ? true : false ;
    }
    
    
    public function save_transactions($data)
    {
        if( ! $this->is_transaction_exists($data['transaction_id']) ) {
            $this->db->insert($this->tbl_transactions, $data);
            return $this->db->insert_id();
        }
    }
    
    
    /**
     * Add new transaction entry.
     * 
     * @return bool
     */
    public function add_transaction_entry()
    {
        $data = $this->input->post();
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        if($user_id > 0) {
            
            $category  = $this->get_category($data['t_category']);
            $tags = isset($data['t_tags']) ? implode(",", $data['t_tags']) : '';
            
            $entry = array(
                "user_id"           => $user_id, 
                "post_date"         => (isset($data['t_date']) ? date('Y-m-d H:i:s', strtotime(str_replace("/", "-", $data['t_date']))) : date('Y-m-d H:i:s') ), 
                "description"       => (isset($data['t_description']) ? $data['t_description'] : ''), 
                "category_id"       => $category->category_id, 
                "category_type_id"  => $category->category_type_id, 
                "category_name"     => $category->category_name,
                "container_type"    => (isset($data['t_entry_type']) ? $data['t_entry_type'] : ''),
                "entry_type"        => (isset($data['t_entry_type']) ? $data['t_entry_type'] : ''),
                "atm_auto_deduct"   => (isset($data['t_auto_atm']) ? $data['t_auto_atm'] : ''),
                "notes"             => (isset($data['t_notes']) ? $data['t_notes'] : ''),
                "transaction_type"  => (isset($data['t_cat_type']) ? $data['t_cat_type'] : ''),
                "check_number"      => (isset($data['t_chk_no']) ? $data['t_chk_no'] : ''),
                "tags"              => $tags,
                "currency"          => 'INR',
                "amount"            => (isset($data['t_amount']) ? $data['t_amount'] : '') );
        
            return $this->db->insert($this->tbl_transactions, $entry); 
            
        }
    }
    
    
    
    /**
     * Edit transaction entry.
     * 
     * @return bool
     */
    public function update_transaction_entry()
    {
        $data = $this->input->post();

        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];

        if($user_id > 0) {
            $old_entry = $this->get_transaction_entry($data['edit_id']);
            $category  = $this->get_category($data['edit_category']);
            
            /*<pre>stdClass Object
            (
                [id] => 9
                [category_id] => 5
                [category_name] => Clothing/Shoes
                [category_type_id] => 3
                [is_budgetable] => 1
                [localized_cat_name] => Clothing/Shoes
                [category_level_id] => 3
                [ut] => 2016-03-18 16:58:49
            )
            </pre>*/
            //$category = explode("::::", $data['edit_category']);
            
            $tags = isset($data['t_tags']) ? implode(",", $data['t_tags']) : '';
            
            $update = array( 
                "description"   => $data['edit_description'], 
                "tags"              => $tags,
                "notes"             => (isset($data['t_notes']) ? $data['t_notes'] : ''),
                "category_id"   => $category->category_id, 
                "category_type_id"   => $category->category_type_id, 
                "category_name" => $category->category_name);

            if( date('Y-m-d', strtotime(str_replace("/", "-", $data['edit_date']))) !=  date('Y-m-d', strtotime($old_entry->post_date)) ){
                $update['post_date'] = date('Y-m-d H:i:s', strtotime(str_replace("/", "-", $data['edit_date'])));
            }

            $this->db->where( array('id' => $data['edit_id'], 'user_id' => $user_id) );
            return $this->db->update($this->tbl_transactions, $update);
        }
    }
    
    
    /**
     * Get a single transaction entry
     * 
     * @return array
     */
    public function get_transaction_entry($entry_id)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $query = $this->db->get_where($this->tbl_transactions, array('id' => $entry_id, 'user_id' => $user_id));
        return $query->row();
    }
    
    
    /**
     * Add Transaction Category types.
     * 
     * @return array
     */
    public function save_category_types($data)
    {
        $this->db->insert($this->category_types, $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * Add Transaction Categories.
     * 
     * @return array
     */
    public function save_categories($data)
    {
        $this->db->insert($this->categories, $data);
        return $this->db->insert_id();
    }
    
    
    /**
     * Get Transaction Category.
     * 
     * @return array
     */
    public function get_category($id)
    {
        $qry = $this->db->get_where($this->categories, array("category_id" => $id));
        return $qry->row();
    }
    
    
    /**
     * Get List of Transaction Categories.
     * 
     * @return array
     */
    public function get_transaction_categories()
    {
        $query = $this->db->select('category_id, category_type_id, category_name')->order_by('category_name', 'asc')->get($this->categories);
        return $query->result();
    }

}
