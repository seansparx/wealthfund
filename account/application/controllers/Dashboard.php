<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for dashboard
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Dashboard extends MY_Controller 
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
        $this->load->helper('yodlee');        
    }
    
    /**
     * Render dashboard page.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array();
        $result = $this->login_model->checkSession();
        if ($result) {
            
            $this->data['bank_accounts'] = get_bank_account();
            
            $this->data['rsession_token']   = $_SESSION['userSessionToken'];
            $this->data['finapp_id']        = $_SESSION['fastlink_finapp_id'];
            $this->data['fastlink2_token']  = $_SESSION['fastlink_token'];
            $this->data['extra_params']     = '';

            $this->render('dashboard/fastlink');
        }
    }
    
    
    /**
     * Get List of popular sites from yodlee.
     * 
     * @return mix
     */
    public function get_popular_banks()
    {
        if($this->input->post('token')){
            if(decode($this->input->post('token')) == ACCESS_TOKEN){
                echo $this->html_popular_banks();
            }
        }
    }
    
    
    /**
     * Search sites on yodlee.
     * 
     * @return mix
     */
    public function search_sites()
    {
        if($this->input->post('token')){
            
            if(decode($this->input->post('token')) == ACCESS_TOKEN){
                echo $this->html_search_banks();
            }
        }
    }
    
    
    /**
     * Add new bank account on yodlee.
     * 
     * @return mix
     */
    public function link_accounts()
    {
        if($this->input->post('token')){
            if(decode($this->input->post('token')) == ACCESS_TOKEN){
                echo link_bank_account();
            }
        }
    }
    
    
    /**
     * Generate html of popular banks.
     * 
     * @return html
     */
    private function html_popular_banks()
    {
        $popular_banks = get_popular_banks();
        
        $HTML = '';
        if (sizeof($popular_banks) > 0) {
            foreach ($popular_banks as $body) {
                $_SESSION['loginForms'][$body->siteId] = $body->loginForms;
                $HTML .= '<li><a href="javascript:void(0);"><img id="'.encode($body->siteId).'" title="'.$body->defaultDisplayName.'" src="'.base_url('assets/img/Chase.png').'" alt="chase" />'.  substr($body->defaultDisplayName, 0, 25).'</a></li>';
            }
        } 
        else {
            $HTML = '<li>Not Found</li>';
        }
        
        return $HTML;
    }
    
    
    /**
     * Generate html of searched banks.
     * 
     * @return html
     */
    private function html_search_banks()
    {
        $search_banks = search_sites();
        
        $HTML = '<div class="col-xs-12 col-sm-6 col-md-12"><ul class="bank-listing-wrap list-unstyled clearfix">';
        if (sizeof($search_banks) > 0) {
            foreach ($search_banks as $body) {
                $_SESSION['loginForms'][$body->siteId] = $body->loginForms;
                $HTML .= '<li><a id="'.encode($body->siteId).'" title="'.$body->defaultDisplayName.'" href="javascript:void(0);">'.$body->defaultDisplayName.'</a></li>';
            }
        } 
        else {
            $HTML = '<li>No Result Found</li>';
        }
        
        $HTML .= '</ul></div>';
        
        return $HTML;
    }
    
    
}
