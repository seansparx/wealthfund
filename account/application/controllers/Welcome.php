<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for welcome page.
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Welcome extends MY_Controller {  
    
    function __construct() {
        parent::__construct();
        $this->_init();
    }
    
    
    private function _init()
    {        
        $this->load->model('login_model');
        $result = $this->login_model->checkSession();
        if ($result) {
            redirect('dashboard');
        }else{
        //$this->render('home_page');
            redirect('../');
        }
        
    }
    

    public function index() 
    {        
        $this->data = array();        
    }    
    
}
