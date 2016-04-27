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
     * Function for Admin permission
     * @param id int (user id)
     * @return void
     */
    
    public function admin_permission($id)
    {
        $this->data = array();
        $this->data['menuOptions']  = $this->users_model->getPermissions($id);
        $this->render_page('manage_permissions');
        
    }
        
    
}
