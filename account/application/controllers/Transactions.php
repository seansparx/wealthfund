<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for Transaction page ( Personal finance )
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Transactions extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->_init();
    }

    
    /**
     * Initialize / Load
     * 
     * @return void
     */
    private function _init()
    {        
        if(! loginCheck()){
            redirect('../');
        } 
        $this->load->helper('yodlee');
        $this->load->model('bank_model');
        $this->load->model('budget_model');        
    }    
    
    
    /**
     * Load transaction page.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array();
        
        /** Auto create some budgets by system */
        $this->budget_model->add_default_budgets();
        
        $this->data['bank_accounts']    = get_bank_account();
        $this->data['account_balance']  = get_account_balance();
        $this->data['transactions']     = get_transactions(true);
        $this->data['categories']       = get_categories();
        $this->data['budget_category']  = $this->budget_model->get_categories();
        $this->data['budgets']          = $this->budget_model->get_budgets();
        $this->data['spend_of_month']   = $this->budget_model->spendings_of_month();
        
        /** Fast link parameters */
        $this->data['rsession_token']   = $_SESSION['userSessionToken'];
        $this->data['finapp_id']        = $_SESSION['fastlink_finapp_id'];
        $this->data['fastlink2_token']  = $_SESSION['fastlink_token'];
        $this->data['extra_params']     = '';
        
        $this->render('transactions/index');
    }
    
    
    /**
     * Filter Transactions
     * 
     * @return mix
     */
    public function filter()
    {
        if($this->input->post('action')){
            switch($this->input->post('action')){
                case 'by_account' : echo json_encode($this->filter_by_account());
                    break;
            }
        }
    }
    
    
    /**
     * Add new transaction entries.
     * 
     * @return bool
     */
    public function add_entry()
    {
        if(match_token()){

            if(! $this->input->post('t_date')) {
                $msg = 't_date';
            }
            else if(! $this->input->post('t_description')) {
                $msg = 't_description';
            }
            else if(! $this->input->post('t_category')) {
                $msg = 't_category';
            }
            else if(! $this->input->post('t_amount')) {
                $msg = 't_amount';
            }
            else{
                $msg         = $this->bank_model->add_transaction_entry();
                $transaction = $this->bank_model->get_transactions();
            }
            
            $success = (intval($msg) == 1) ? true : false;
            
            echo json_encode(array('success' => $success, 'message' => $msg, 'transaction' => $transaction, 'currency' => currency_symbol()));

        }
    }
    
    
    /**
     * Update transaction entries.
     * 
     * @return bool
     */
    public function update_entry()
    {
        if(match_token()){
            echo $this->bank_model->update_transaction_entry();
        }
    }
      
    
    /**
     * Get budget entries.
     * 
     * @return bool
     */
    public function get_entry()
    {
        if(match_token()) {
            $id = $this->input->get('t_id');
            $entry = $this->bank_model->get_transaction_entry($id);
            echo json_encode($entry);
        }
    }
    
    
    /**
     * Get budget entries.
     * 
     * @return bool
     */
    public function get_budget()
    {
        if(match_token()) {
            $id = decode($this->input->get('budget_id'));
            $entry = $this->budget_model->get_budgets($id);
            echo json_encode($entry);
        }
    }
    
    
    /**
     * Set new budget.
     * 
     * @return bool
     */
    public function create_budget()
    {
        if(match_token()){
            echo $this->budget_model->add_budget();
        }
    }
    
    
    /**
     * Edit budget.
     * 
     * @return bool
     */
    public function update_budget()
    {
        if(match_token()){
            echo $this->budget_model->update_budget();
        }
    }
    
    
    /**
     * Get suggestions for edit transaction.
     * 
     * @return json
     */
    public function get_descriptions()
    {
        if(match_token()){
            
            $transactions = get_transactions(true);            
            $autocomplete = array();
            
            if(count($transactions) > 0){
                
                foreach ($transactions as $entry) {
                    if( !in_array($entry->description, $autocomplete)) {
                        $autocomplete[] = $entry->description;                    
                    }
                }

            }
            echo json_encode($autocomplete);
        }
    }
    
    
    
    /**
     * Filter Transaction by account
     * 
     * @return array
     */
    private function filter_by_account()
    {
        $account_id = decode($this->input->post('id')); 
        
        if($account_id == 'all') {
            $balance     = $this->bank_model->get_account_balance();
            $transaction = $this->bank_model->get_transactions();
        }
        else{
            $balance     = $this->bank_model->get_account_balance($account_id);
            $transaction = $this->bank_model->get_transactions($account_id);
        }
        
        return array('transaction' => $transaction, 'site_container' => $balance->site_container, 'available_credit' => $balance->available_credit, 'total_credit' => $balance->total_credit, 'balance_amt' => number_format($balance->balance_amt, 2), 'currency' => currency_symbol());
    }
    
    
    /** 
     * Get json data for dashboad graph 
     * 
     * @return json
     */
    public function graph_data()
    {
        if(match_token()) {
            if($this->input->get('action') == 'spending') {
                $graph_data = array();
                $spendings = $this->bank_model->get_expenses_by_category();
                if(count($spendings) > 0) {
                    $c = 1;
                    foreach ($spendings as $expense) {
                        if($c == 1){
                            $color = "#f8ac59";
                        }
                        else if($c == 2){
                            $color = "#1ab394";
                        }
                        else if($c == 3){
                            $color = "#676a6c";
                        }
                        else{
                            $color = "#".$this->random_color();
                        }
                        
                        $c++;
                        
                        $graph_data[] = array( 
                            'value'     => round($expense->total_amount),
                            'color'     => $color,
                            'label'     => $expense->category_name);
                    }

                    echo json_encode(array('success' => true, 'graph_data' => $graph_data));
                }
                else{
                    $msg = 'Sorry, there are no transactions that match your selections.To fix this, please change your filters above.';
                    echo json_encode(array('success' => false, 'message' => $msg));
                }
            }
        }
    }
    
    
    private function random_color_part() 
    {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    
    private function random_color() 
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
    
}
