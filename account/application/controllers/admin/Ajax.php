<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for dashboard
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Ajax extends CI_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->_init();      
    }

    
    private function _init()
    {
        $this->load->model('admin/users_model');
    }
        
    
    /**
     * Check email exists or not.
     * 
     * @access public
     * @return void
     */
    public function is_email_exists()
    {
        $email = $this->input->post('value');
        echo ! $this->users_model->is_email_exists($email);
    }        
    
}
