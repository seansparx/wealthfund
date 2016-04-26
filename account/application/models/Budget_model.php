<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Budget database Class
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 * @dated 30 March 2016
 */
class Budget_model extends CI_Model
{
    private $tbl_budgets        = "user_budgets";
    private $category_types     = "transaction_category_types";
    private $categories         = "transaction_categories";
    private $tbl_transactions   = "account_transactions";
    

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
     * Get List of Expenses Categories.
     * 
     * @return array
     */
    public function get_categories()
    {
        $query = $this->db->select('category_id, category_type_id, category_name')->order_by('category_name', 'asc')->where(array('is_budgetable' => 1 ))->get($this->categories); // category_type_id = 3 for expense.
        return $query->result();
    }
    
    /**
     * get budgets.
     * 
     * @return array
     */
    public function get_budgets($id = null)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $this->db->select('a.*, b.category_name, c.type_name');
        $this->db->from($this->tbl_budgets." AS a");
        $this->db->join($this->categories." AS b", "b.category_id = a.category_id", "left");
        $this->db->join($this->category_types." AS c", "c.type_id = b.category_type_id", "left");
        $this->db->order_by('id', 'asc');
        if(intval($id) > 0) {
            $this->db->where(array("a.id" => $id, "a.user_id" => $user_id));
            $query = $this->db->get();
            return $query->row();
        }
        else{
            $this->db->where(array("a.user_id" => $user_id));
            $query = $this->db->get();
            return $query->result();
        }
    }

    
    /**
     * delete budgets.
     * 
     * @return array
     */
    public function delete_budget($id)
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];        
        $this->db->where(array("id" => $id, "user_id" => $user_id));
        return $this->db->delete($this->tbl_budgets);
    }
    
    
    /**
     * Get budget by user ( used by cron ).
     * 
     * @param int $user_id
     * @return array
     */
    public function get_user_budget($user_id)
    {        
        $this->db->select('a.*, b.category_name, c.type_name');
        $this->db->from($this->tbl_budgets." AS a");
        $this->db->join($this->categories." AS b", "b.category_id = a.category_id", "left");
        $this->db->join($this->category_types." AS c", "c.type_id = b.category_type_id", "left");
        $this->db->where(array("a.user_id" => $user_id));
        $query = $this->db->get();
        return $query->result();
    }
    
    
    /**
     * create new budget.
     * 
     * @return bool
     */
    public function add_budget()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];

        if(intval($user_id) > 0) {
            
            $post_data = $this->input->post();

            if($this->is_exists()) {
                $this->db->where( array("user_id" => $user_id, "category_id" => $post_data['b_category']) );
                return $this->db->update($this->tbl_budgets, array("amount" => $post_data['b_amount']));
            }
            else{
                $entry = array(
                    "user_id"      => $user_id, 
                    "category_id"  => (isset($post_data['b_category']) ? $post_data['b_category'] : ''),
                    "amount"       => (isset($post_data['b_amount']) ? $post_data['b_amount'] : ''),
                    "term"         => 'monthly');
                
                $this->db->insert($this->tbl_budgets, $entry);
                if($this->db->insert_id() > 0) {
                    return true;
                }
            }
        }
        
    }
    
    
    /**
     * Create some budgets by default.
     * 
     * @return bool
     */
    public function add_default_budgets()
    {        
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        
        if($user_id > 0) {
            
            $past_exp = $this->spendings_of_past_months();
            
            $default_cat = array(5, 12, 13, 22);
            foreach ($default_cat as $cat_id) {
                
                $entry = array(
                        "user_id"       => $user_id, 
                        "category_id"   => $cat_id,
                        "amount"        => (isset($past_exp[$cat_id]) ? $past_exp[$cat_id] : 0),
                        "term"          => 'monthly');

                $query = $this->db->get_where($this->tbl_budgets, array("user_id" => $user_id, "category_id" => $cat_id));
                if( ! ($query->num_rows() > 0)){
                    $this->db->insert($this->tbl_budgets, $entry);
                }
                
            }
        }
    }
    
    
    /**
     * Get Spendings of this month.
     * 
     * @return array
     */
    public function spendings_of_month()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $month   = date("Ym");
        
        $this->db->select(array("DATE_FORMAT(b.post_date,'%Y%m') AS mth", "a.category_id", "SUM(b.amount) AS amt"));
        $this->db->from($this->tbl_budgets." AS a");
        $this->db->join($this->tbl_transactions." AS b", "b.category_id = a.category_id AND b.user_id = '".$user_id."'", "left");
        $this->db->where(array("a.user_id" => $user_id));
        $this->db->group_by("mth, a.category_id");
        $this->db->having("mth", $month);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    
    /**
     * Get Spendings of the month by user.
     * 
     * @param int $user_id
     * @return array
     */
    public function spendings_of_month_by_user($user_id)
    {
        $month   = date("Ym");
        
        $this->db->select(array("DATE_FORMAT(b.post_date,'%Y%m') AS mth", "a.category_id", "SUM(b.amount) AS amt"));
        $this->db->from($this->tbl_budgets." AS a");
        $this->db->join($this->tbl_transactions." AS b", "b.category_id = a.category_id AND b.user_id = '".$user_id."'", "left");
        $this->db->where(array("a.user_id" => $user_id));
        $this->db->group_by("mth, a.category_id");
        $this->db->having("mth", $month);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }
    }
    
    
    /**
     * Get Spendings of past months.
     * 
     * @return array
     */
    private function spendings_of_past_months()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $default_cat = array(5, 12, 13, 22);
        
        $this->db->select(array("DATE_FORMAT(a.post_date,'%Y%m') AS mth", "a.category_id", "SUM(a.amount) AS amt"));
        $this->db->from($this->tbl_transactions." AS a");
        $this->db->where(array("a.user_id" => $user_id));
        $this->db->where_in('a.category_id',$default_cat);
        $this->db->group_by("mth, a.category_id");
        $this->db->order_by("mth", "desc");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        
        /** Arrange spendings of previous recent month */
        $past_exp = array();
        if(sizeof($result) > 0) {
            foreach ($result as $past) {
                if( ! $past_exp[$past->category_id]){
                    $past_exp[$past->category_id] = ($past->amt > 0) ? $past->amt : 0;
                }
            }
        }
        return $past_exp;
    }
    
    
    /**
     * Check if entry exists.
     * 
     * @return bool
     */
    private function is_exists()
    {
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $post_data = $this->input->post();
        $query = $this->db->get_where($this->tbl_budgets, array("user_id" => $user_id, "category_id" => $post_data['b_category']));
        if($query->num_rows() > 0){
            return true;
        }
    }    
    
    
    /**
     * Edit budget entry.
     * 
     * @return bool
     */
    public function update_budget()
    {
        $data = $this->input->post();
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        $budget_id = decode($data['budget_id']);
        if($user_id > 0){
            $this->db->where( array('id' => $budget_id, 'user_id' => $user_id) );
            return $this->db->update($this->tbl_budgets, array("amount" => $data['amount']));
        }
    }
    
}
