<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for dashboard
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Users extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->_init();
      
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
        $this->data = array();
        $this->data['all_users'] = $this->users_model->getAdminUsers();
        //pr($data); die;
        $this->render_page('manage_users');
    }
    
    
    /**
     * Function for add admin user
     * @access public
     * @return void
     */
    public function add() 
    {
        if($this->input->post()){
            $this->form_validation->set_rules('username', 'User Name', 'trim|required');
            $this->form_validation->set_rules('user_email', 'User Email', 'trim|required|valid_email|is_unique['.TBL_ADMINLOGIN.'.emailId]');
            $this->form_validation->set_rules('new_password', 'User Passwrod', 'trim|required|min_length[6]|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password','Confirm password','trim|required|min_length[6]');
           
             if ($this->form_validation->run() == TRUE) {
                $this->users_model->addUser();
             }
        }
        $this->data = array();
        $this->render_page('add_user');
    }
    
    /**
     * Function for Admin user edit
     * @param id int (user id)
     * @return void
     */
    
    public function editUser($id)
    {
        if($this->input->post()){
            $this->form_validation->set_rules('username', 'User Name', 'trim|required');
           // $this->form_validation->set_rules('user_email', 'User Email', 'trim|required|valid_email|is_unique['.TBL_ADMINLOGIN.'.emailId]');
            $this->form_validation->set_rules('new_password', 'User Passwrod', 'trim|min_length[6]|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password','Confirm password','trim|min_length[6]');
           
             if ($this->form_validation->run() == TRUE) {
                $this->users_model->editUser();
             }
        }
        $this->data = array();
        $this->data['userdetails'] = $this->users_model->userDetails($id);
        $this->render_page('edit_users');
    }
    
    /**
     * Function for Admin permission
     * @param id int (user id)
     * @return void
     */
    
    public function admin_permission($id)
    {
        if($this->input->post()){
            
           if($this->users_model->edit_panel_record())
         {
            $this->session->set_flashdata('success', 'Information has been updated successfully!');
            redirect("admin/users"); 
         }
        }
        $this->data = array();
        $this->data['admin_detail'] = $this->users_model->getrecord($id);
        $this->data['menuOptions']  = $this->users_model->getPermissions($id);
        $this->render_page('manage_permissions');
        
    }
    
    /*
     * Function for delete admin user
     * @access public
     * @param $id user id
     * @return void
     */
    
    public function delete($id){
       
        if(isset($id)){
             
            $this->users_model->deleteUser($id);
        }
        redirect('admin/users');
    }
        
    
}
