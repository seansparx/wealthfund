<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for Overview / Dashboard page
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Overview extends MY_Controller 
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
        
        $this->load->model('login_model');
        $this->load->model('bank_model');
        $this->load->helper('yodlee');        
    }
    
    
    /** 
     * Default function to load dashboard.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array();
        
        $this->data['bank_accounts']    = get_bank_account();        
        $this->data['cash_balance']     = $this->bank_model->get_cash_balance();        
                                          
        /** Fastlink parameters */
        $this->data['rsession_token']   = $_SESSION['userSessionToken'];
        $this->data['finapp_id']        = $_SESSION['fastlink_finapp_id'];
        $this->data['fastlink2_token']  = $_SESSION['fastlink_token'];
        $this->data['extra_params']     = '';
        
        $this->render('overview/index');
    }
    
    
    /**
     * Add Gold investment account.
     * 
     * @return void
     */
    public function add_gold()
    {
        if(match_token()){
            echo $this->bank_model->add_golds();
        }
    }
    
    
    /**
     * Add fixed deposit accounts.
     * 
     * @return void
     */
    public function add_fd()
    {
        if(match_token()){
            echo $this->bank_model->add_fixed_deposit();
        }
    }
    
    
    /**
     * Add insurance account.
     * 
     * @return void
     */
    public function add_insurance()
    {
        if(match_token()){
            echo $this->bank_model->add_insurance();
        }
    }
    
    
    /**
     * Configure/Link more accounts.
     * 
     * @return void
     */
    public function configure_more()
    {
        if(match_token()){
            echo $this->bank_model->add_property();
        }
    }
    
    
    /**
     * Refresh all linked accounts yodlee.
     * 
     * @return void
     */
    public function refresh()
    {
        if(match_token()){            
            echo refresh_all_accounts();            
        }
    }
    
    
    /** 
     * Get json data for dashboad graph 
     * 
     * @return json
     */
    public function graph_data()
    {
        if($this->input->get('action') == 'net_income') {
            
            $income_expense  = array();
            $graph_data = array();
                                    
            foreach ($this->bank_model->get_incomes() as $income) {
                $income_expense[$income->mnth.' '.$income->yr]['income'] = number_format($income->total_amount, 2).' '.$expense->currency;
            }
            
            foreach ($this->bank_model->get_expenses() as $expense) {
                $income_expense[$expense->mnth.' '.$expense->yr]['expense'] = number_format(($expense->total_amount * -1), 2).' '.$expense->currency;
            }
                        
            foreach ($income_expense as $month => $data) {
                $graph_data[] = array('y' => $month,'a' => $data['income'], 'b' => $data['expense']);
            }
            
            echo json_encode($graph_data);
            
        }
        
        if($this->input->get('action') == 'expense') {
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
    
    private function random_color_part() 
    {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    
    private function random_color() 
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
    
    
}
