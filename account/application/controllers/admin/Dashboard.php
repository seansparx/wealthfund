<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for dashboard
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Dashboard extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $result = $this->login_model->checkSession();
        if (!$result) {
            redirect('admin/login');
        }
        $this->load->helper('cookie');
        
    }

    
    private function _init()
    {
       
    }
    
    /**
     * Render dashboard page.
     * 
     * @return void
     */
    public function index() 
    {
      // pr($this->session->all_userdata()); die;  
        $this->data = array();
        $this->render_page('dashboard');
    }
    
  
    
}
