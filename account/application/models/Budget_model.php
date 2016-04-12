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
                    "user_id"       => $user_id, 
                    "category_id"   => (isset($post_data['b_category']) ? $post_data['b_category'] : ''),
                    "amount"        => (isset($post_data['b_amount']) ? $post_data['b_amount'] : ''),
                    "term"          => 'monthly');
                
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
        /*SELECT DATE_FORMAT(b.post_date,'%Y%m') AS mth, a.category_id, SUM(b.amount) FROM wf_user_budgets AS a 
LEFT JOIN wf_account_transactions AS b ON(b.category_id = a.category_id) WHERE a.user_id = 1 GROUP BY a.category_id, mth ORDER BY mth,a.category_id;*/
        $user_id = $this->session->userdata(SITE_SESSION_NAME."session")['wealthfund_user_id'];
        if($user_id > 0) {
            $default_cat = array(5, 12, 13, 22);
            foreach ($default_cat as $cat_id) {
                
                $entry = array(
                        "user_id"       => $user_id, 
                        "category_id"   => $cat_id,
                        "amount"        => 0,
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
        $this->db->join($this->tbl_transactions." AS b", "b.category_id = a.category_id", "left");
        $this->db->where(array("b.user_id" => $user_id));
        $this->db->group_by("mth, a.category_id");
        $this->db->having("mth", $month);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }
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
