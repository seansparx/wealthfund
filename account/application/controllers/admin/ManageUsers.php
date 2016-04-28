<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for dashboard
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class ManageUsers extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->_init();
    }

    
    private function _init()
    {
        $this->load->model('admin/account_model');
    }
    
    /**
     * Render dashboard page.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array();
        $this->data['wf_users'] = $this->account_model->get_users();
        $this->render_page('website_users');
    }
    
    
    /**
     * Render dashboard page.
     * 
     * @return void
     */
    public function add() 
    {
        $this->data = array();
        $this->render_page('add_user');
    }        
    
}
