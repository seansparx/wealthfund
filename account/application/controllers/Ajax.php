<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for AJAX 
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->_init();
    }

    public function index() {
        show_404();
    }

    private function _init() {
        $this->load->model('Login_model', 'login');
    }

    
    /**
     * Check if email already exists.
     * 
     * @return bool
     */
    public function unique_email() {
        $this->form_validation->set_rules('value', 'Email address', 'is_unique[wf_users.user_email]');
        echo $this->form_validation->run();
    }

    
    /**
     * Resend OTP to mobile number.
     * 
     * @return string
     */
    public function resend_otp() {
        if (decode($this->input->post('token')) == 'otp') {
            $this->load->helper('otp');

            $data_string = unserialize($this->session->userdata('data_string'));
            $mobile_no = $data_string['user_mobile'];

            if (generate_otp($mobile_no) > 0) {
                echo 'sent';
            } else {
                echo 'Error : SMS Failed.';
            }
        }
    }

    
    /**
     * Function to check password exists or not
     * 
     * @return bool
     */
    public function unique_password() {

        $this->form_validation->set_rules('password', 'Password', 'callback_check_password_existence');
        echo $this->form_validation->run();
    }

    
    /**
     * Check password existence.
     * 
     * @return string
     */
    public function check_password_existence() 
    {
        $password = $this->input->post('value');
        $emailId = $this->input->post('emailId');
        
        if ($this->login->is_account_verified($emailId)) {
            $msg = $this->login->is_password_exists($emailId, $password);
            if(!$msg){
                $msg = "Invalid email address/login id & password !";                
            }
            echo json_encode(array('success' => true, "msg" => $msg ));
        }
        else{
            $msg = "Your email address is not verified !";
            echo json_encode(array('success' => false, "msg" => $msg ));
        }
        
    }

    
    /**
     * Check mobile number exists or not.
     * 
     * @return bool
     */
    public function checkMobileExistence() {
        $this->form_validation->set_rules('value', 'User Mobile', 'callback_is_mobile_exists_or_not');
        $verStatus = $this->form_validation->run();
        return $verStatus;
    }
    
    
    /**
     * Check mobile number exists or not.
     * 
     * @return bool
     */
    public function is_mobile_exists_or_not($mobile){
        $status = $this->login->is_mobile_exists($mobile);
        
        echo $status; //die;
    }
    
    
    /**
     * Check mobile number verified or not.
     * 
     * @return bool
     */
    public function registered_mobile_verification(){
        $this->form_validation->set_rules('value', 'User Email', 'callback_is_mobile_verified');
        $verStatus = $this->form_validation->run();
        return $verStatus;
    }
    
    
    /**
     * Check mobile number verified or not.
     * 
     * @return bool
     */
    public function is_mobile_verified($mobile) {
        $status = $this->login->is_mobile_verified($mobile);
        echo $status;
    }
    
    
    /**
     * Function to check password exists or not
     * 
     * @return bool
     */
    public function registered_email_verification() {

        $this->form_validation->set_rules('value', 'User Email', 'callback_is_email_verified');
        $verStatus = $this->form_validation->run();
        return $verStatus;
    }
    

    /** 
     * Function to check A Account is verified or not 
     * 
     * @param string $email
     * 
     * @return Boolean
     */
    public function is_email_verified($emailId) {
        $status = $this->login->is_email_verified($emailId);
        echo $status;
    }

    
    /**
     * Function to check login token
     * 
     * @return bool
     */
    public function login_token() 
    {
        if (decode($this->input->post('token')) != 'login') {
            echo "Please enter user details correctly .";
            die;
        }
    }
    
    
    /**
     * Auto Logout using ajax
     * 
     * @return void
     */
    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        session_unset();
    }

}
