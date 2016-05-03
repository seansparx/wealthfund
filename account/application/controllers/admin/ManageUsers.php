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
    
    /*
     * Render Edit users page
     * 
     * @access public
     * @param int ($id user id)
     * @return void
     */
    
    public function edit($id)
    {
        
        if($this->input->post()){
                $this->form_validation->set_rules('full_name', 'User Full Name', 'trim|required');
                $this->form_validation->set_rules('user_email', 'User Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('mobile', 'User Mobile', 'trim|min_length[10]');
       
           
             if ($this->form_validation->run() == TRUE) {
                $this->account_model->editWebsiteUser();
             }
            
        }
        $this->data = array();
        $this->data['users_details'] = $this->account_model->website_users($id);
        
        $this->render_page('edit_website_users');
    }
    
    public function delete($id)
    {
        $this->account_model->delete_website_users($id);
    }
    
    
    
    
}
