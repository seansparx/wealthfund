<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome Class
 * @author Rajesh Yadav 
 * @version 3.0.3
 * @dated 07/12/2015
 */
class Login extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        
    }

    /**
     * Function for admin user login 
     * @access public
     * 
     */
    public function index() {
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('userName', 'login ID', 'trim|required|min_length[4]|max_length[20]');
            $this->form_validation->set_rules('userPassword', 'userPassword', 'trim|required|min_length[6]|max_length[20]');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == TRUE) {
               
                $result = $this->login_model->adminLogin();
               
               //pr($result);die;
                if ($result) {
                   
                        redirect('admin/dashboard');
                   
                } else {
                  //  echo "welcome"; die;
                    redirect('admin/login');
                }
            }
        }
        
        $cookie_array = $this->get_cookie();
        $data['remember'] = $cookie_array;
        $this->load->view('admin/login', $data);
    }

    /**
     * Get cookie detail if exist
     * @access private
     * @return Array 
     */
    private function get_cookie() {
        $cookie_name = PREFIX . "ADMNUSR";
        $cookie_detail = get_cookie($cookie_name);
        $return_array = NULL;
        if (trim($cookie_detail)) {
            $cookie_arr = explode("#####", $cookie_detail);
            if (count($cookie_arr) == '2') {
                $return_array['userName'] = base64_decode($cookie_arr['0']);
                $return_array['userPassword'] = base64_decode($cookie_arr['1']);
            }
        }
        return $return_array;
    }

    /*     * ************* Start function logout() to logout from admin ************** */

    public function logout() {
      // print_r($this->session->all_userdata()); die;
        $this->session->sess_destroy();
       //$this->session->unset_userdata('wealthfund_ADMINID');
      //  print_r($this->session->all_userdata());die;
        redirect('admin/login');
    }

    /*     * ************* End function logout() ************** */

    /**
     *  Forgot 
     * @access public
     */
    /*     * ************* Start function lostpassword() to load lost password view page ************** */

    public function forgot() {

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                if ($this->login_model->isExistsAdminEmailId($_POST['email']) && $this->login_model->adminResendPassword($_POST)) {
                    $this->session->set_flashdata('success', 'Your Password has been send successfully to your email Id.');
                } else {
                    $this->session->set_flashdata('errordata', 'Email Id does not exist!');
                }
                redirect('welcome/forgot');
            }
        }
        $this->load->view('forgot', $value = array());
    }

    /*     * ************* End function lostpassword() ************** */
//End of class    
}
