<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for login ( Personal finance )
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_init();
    }

    public function index()
    {
        if ($this->input->post()) {
            $this->login();
        }
        
    }

    private function _init() {
        $this->load->model('Login_model', 'login');
        $this->load->helper('otp');
        
    }

    /**
     * Customer login ( Yodlee api )
     * 
     * return void
     */
    private function auth_yodlee($api_username, $api_password)
    {
        $this->load->helper('yodlee');
        $this->session->set_userdata("api_username", $api_username);
        $this->session->set_userdata("api_password", $api_password);
        if( ! yodlee_login() ){
            die('yodlee login error.');
        }
    }
    
    
    /**
     * Fucntion to get user login
     * 
     * @param array $data
     * @return array $response
     */
    function login() 
    {
        $data = $this->input->post();
        
        $response = array('success' => FALSE, 'msg' => '');

        if ($this->login->is_email_exists($data['user_login_email'])) {
            
            if ($this->login->is_account_verified($data['user_login_email'])) {
                
                $authdata = $this->login->get_auth_data_by_email($data['user_login_email']);
                
                $hashPassword = hash("sha512", $data['p'] . $authdata->salt);

                if ($hashPassword == $authdata->password) {

                    $this->auth_yodlee(encode($authdata->api_username), encode($authdata->api_password)); // yodlee api.
                    
                    if (makeSession($authdata)) {            
                        $this->login->update_last_login($authdata);
                        #############check remember###############
                        //$remember = $data['remember'];
                        //$cookie_name = "WEALTHFUNDUSER";
                        //setcookie($cookie_name, '', time() - 3600, "/");
                        //if ($remember == '1') {
                            //$cookie_val = base64_encode($data['user_login_email']) . "#####" . base64_encode($data['login_password']);
                            //$cookie_expire = time() + (86400 * 30);
                            //setcookie($cookie_name, $cookie_val, $cookie_expire, "/");
                        //}
                        ##########################################
                        $response = array('success' => TRUE, 'msg' => 'login success');
                    } 
                    else {
                        $response = array('success' => FALSE, 'msg' => 'Session is not created!');
                    }
                } else {
                    $response = array('success' => FALSE, 'msg' => 'Either Email Id or Password is wrong!');
                }
            } else {
                $response = array('success' => FALSE, 'msg' => 'Your Acount is not verified yet !');
            }
        } else {
            $response = array('success' => FALSE, 'msg' => 'Your Acount is not Exist!');
        }

        /** logic used for welcome page redirection */
        $response['welcome'] = !( $authdata->last_login > 0);
        $response['current_page_url'] = $_SERVER['HTTP_REFERER'];

        
        if ($response['success'] == TRUE) {
            //pr($this->session->userdata('wealthfund_session')); die;
            redirect('overview');
        } 
        else {                
            echo json_encode($response);
        }
    }
    
    
    /**
     * Function for validating reset password data
     * 
     * @return boolean
     */
    public function resetPassword()
    {
            $this->render('resetpassword');
    }
    
    
    /**
     * Function to get logout user
     * @param no parameter
     * @access public
     */    
    public function logout() 
    {
        logout();
    }

    
    /**
     * Function for forget password
     * Checking emaild id and send password if emaid Id exist
     */
    public function forget_password() 
    {
        if ($this->input->post()) {
           
            if ($this->login->is_email_exists($this->input->post('forget_user_email')) && $this->login->userResendPassword($this->input->post('forget_user_email'))) {
                $this->data['email'] = encode($this->input->post('forget_user_email'));
                $this->session->set_flashdata('success', 'Your Password reset link has been sent successfully...');
            }
            
        }
        
        $this->render('forgetPasswordComplete');
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
     * @todo seems unused, need to remove.
     */
    public function send_otp_password() {

        $otpStatus = "";
        if ($this->input->post()) {
            $mobile_no = $this->input->post('mobile');
            $otp = generate_resetpassword_otp($mobile_no);
            if ($otp > 0) {
                $otpStatus = 'sent';
            }
        }
        return $otpStatus;
    }
    
    
    /**
     * @todo seems unused, need to remove.
     */
    public function verify_otp_password(){        
        $verifyOtp = $this->input->post('verifyOtp');
        
        $matchOtpStatus = match_resetpassword_otp($verifyOtp); 
        return $matchOtpStatus;

    }
    
    
    public function check_password_existence() {

        $password = $this->input->post('value');
        $emailId = $this->input->post('emailId');
        $status = $this->login->is_password_exists($emailId, $password);
        echo $status;
    }
    

    public function login_token() {
        if (decode($this->input->post('token')) != 'login') {
            echo "Please enter user details correctly .";
            die;
        }
    }
    
    /**
     * resend_password
     */
    public function resend_password()
    {
        $email = decode($this->input->post('user_email'));
        if(!$this->login->is_email_exists($email))
        {
          echo 1;
        }else{
          $this->login->userResendPassword($email);
          echo 2;
        } 
    }
}
