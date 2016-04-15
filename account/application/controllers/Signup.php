<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for user signup ( Personal finance )
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Signup extends MY_Controller 
{
    protected $data = array();

    function __construct() 
    {
        parent::__construct();
        $this->init();
    }

    
    private function init()
    {
		$this->load->helper('mail');
        $this->load->model('registration_model');
        $this->load->helper(array('otp','cookie'));
        if(loginCheck()){
            redirect('overview');
        }                
    }
    
    
    /**
     * Render signup page
     * 
     * @return mix
     */
    public function index() 
    {
		//email_send('rakesh.kumar@sparxitsolutions.com', 'aws-smtp-test', 'the quick..');
		//die;
        $this->data = array();
        
        $step = 1;
        $otp  = '';
        
        if ($this->input->post()) {
            
            if ($_SESSION['signup_captcha'] != $this->input->post('captcha_code')) {
                echo 'Incorrect Capcha!';
            }
            else if ( $this->validate_signup_form() == true ) {
                
                $mobile_no = $this->input->post('country_code').$this->input->post('user_mobile');
                $this->session->set_userdata('data_string', serialize($this->input->post()));
                $otp = generate_otp($mobile_no);
                if($otp > 0){
                    echo 'sent';
                }
            }
        }
        else{
            /* get remember me value from cookie for login popup */
            //$cookie_array = $this->get_cookie();
            //$this->data['remember'] = $cookie_array;
            $this->render('signup');
        }
    }
    
    
    /**
     * Read cookie of remember check box
     * 
     * @return string
     */
    private function get_cookie()
    {
          $cookie_name   = "WEALTHFUNDUSER";
          $cookie_detail = get_cookie($cookie_name);
          $return_array=NULL;
          if(trim($cookie_detail))
          {
              $cookie_arr = explode("#####", $cookie_detail);
              if(count($cookie_arr) == '2')
              {
                  $return_array['email'] = base64_decode($cookie_arr['0']);
                  $return_array['password'] = base64_decode($cookie_arr['1']);
              }

          }
          return $return_array;
    }
    
    
    /**
     * Render signup complete page.
     * 
     * @return void
     */
    public function complete()
    {
        $this->data = array();
        $data_string = unserialize($this->session->userdata('data_string'));
        $this->data['otp_matched'] = isset($data_string['otp_matched']) ? $data_string['otp_matched'] : 'no';
        
        if($this->data['otp_matched'] == 'yes'){
            $this->session->unset_userdata('signup_otp');
        }
        
        $this->render('signup-complete');
    }
    
    
    /**
     * Mobile Verification using OTP.
     * 
     * @return mix
     */
    public function verify_mobile()
    {
        $this->data = array();
        
        if ($this->input->post()) {
            $signup_data = unserialize($this->session->userdata('data_string'));
            if(match_otp($this->input->post('otp'))){
                $signup_data['otp'] = $this->input->post('otp');
                $signup_data['otp_matched'] = 'yes';
                $this->session->set_userdata('data_string', serialize($signup_data));
                $last_id = $this->registration_model->add();
                if(intval($last_id) > 0) {
                    $signup_data['inserted_id'] = $last_id;
                    $this->email_signup_verification($last_id);
                    echo 'complete';
                }
            }
            else{
                echo '<label class="error">Activation code is wrong.</label>';
            }
        }
        else if($this->session->userdata('signup_otp')) {
            $this->data['otp_value'] = $this->session->userdata('signup_otp');    
            $this->render('otp-page');
        }
        else{
            show_404();
        }
        
    }

    /**
     * Function for validating registration data
     * @return boolean
     */
    private function validate_signup_form() 
    {
        $this->form_validation->set_rules('user_email', 'Username', 'trim|required|callback_is_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_validate_password');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('passconf', 'Confirm Password is Not matching', 'trim|required|matches[password]');
        $this->form_validation->set_rules('user_mobile', 'Mobile Number', 'trim|required|min_length[10]|max_length[15]|callback_validate_mobile_no');
        $this->form_validation->set_rules('prefix', 'Title', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Email', 'trim|required|min_length[2]|callback_check_alphabets');
        $this->form_validation->set_rules('captcha_code', 'Captcha', 'trim|required|callback_validate_captcha');
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

        return $this->form_validation->run();
    }
    
    
    /**
     * Function to check email id is exist or not 
     * @access public
     * @return Boolean
     */
    public function is_email_exists($value) {
        $this->form_validation->set_message('is_email_exists', "User Already Registered.");
        return $this->registration_model->is_email_exists($value);
    }
    
    
    /**
     * Match signup captcha code .
     * 
     * @param string $value
     * 
     * @return boolean
     */
    public function validate_captcha($value) 
    {
        $this->form_validation->set_message('captcha_code', "Incorrect Captcha Code.");
        if ($_SESSION['signup_captcha'] == $value) {
            return true;
        }
        return false;
    }
    
    
    /**
     * 
     * @param type $username
     * @return boolean
     */
    public function check_alphabets($value) {
        $this->form_validation->set_message('check_alphabets', "Enter valid characters.");
        if (preg_match("/^[a-zA-Z][a-zA-Z0-9\s]+$/", $value)) {
            return true;
        }
        return false;
    }
    
    
    /**
     * 
     * @param type $username
     * @return boolean
     */
    public function validate_password($value) 
    {
        $this->form_validation->set_message('validate_password', "Should contain at least 1-digit, 1-alphabet, 1-symbol @#$&.");
        if (preg_match("/^(?=.*[A-Za-z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{6,}$/", $value)) {
            return true;
        }
        return false;
    }
    
    
    /**
     * 
     * @param type $username
     * @return boolean
     */
    public function validate_mobile_no($value) 
    {
        $this->form_validation->set_message('validate_mobile_no', "Enter a valid mobile number.");
      //  if (preg_match("/^(\+\d{2}|0)?\d{10}$/", $value)) {
        if (preg_match("/^[\s()+-]*([0-9][\s()+-]*){6,20}$/", $value)) {
            return true;
        }
        return false;
    }
    

    /**
     * 
     * @param type $mobile
     * @return boolean
     */
    private function numeric($mobile) {

        $this->form_validation->set_message('numeric', 'The %s field can not be the word "test"');
        if (preg_match('/^[0-9,]+$/', $mobile)) {            
            return false;
        } else {
            return false;
        }
    }

    

    /**
     * Function to send mail
     * @param $signup_id=user_id, $temp_id =template id
     * @access private
     * @return void
     */
    private function email_signup_verification($user_id) 
    {
        $this->load->helper('mail');
        $this->load->model('email_model');
        
        $user_info      = $this->registration_model->read($user_id);
        $mailtempdata   = $this->email_model->get_template('SIGNUP_EMAIL');        
        $signup_data    = unserialize($this->session->userdata('data_string'));
        $veri_link      = site_url('verification/?e=' . encode($user_info->user_email) . '&h=' .encode($user_info->verification_string));
        
        $mailtempdata->body = str_replace("xxxUSERNAMExxx", $user_info->full_name, $mailtempdata->body);
        $mailtempdata->body = str_replace("xxxLINKxxx", '<br/>'.$veri_link, $mailtempdata->body);
        $mailtempdata->body = str_replace("xxxCONFIRMLINKxxx",$veri_link, $mailtempdata->body);
        
        $mailtempdata->body = str_replace("xxxEMAILxxx", $signup_data['user_email'], $mailtempdata->body);
        $mailtempdata->body = str_replace("xxxPASSWDxxx", $signup_data['password'], $mailtempdata->body);
        
        email_send($user_info->user_email, $mailtempdata->subject, $mailtempdata->body);
        
    }
    
    
    /**
     * Send verification link via email to new user.
     * 
     * @return void
     */
    private function send_signup_mail($signup_id, $temp_id, $flag = 1) 
    {        
        die('invalid call');
        /** stop on local pc */
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            return false;
        }

        $orgdata = $this->signup->get_auth_data_by_id($signup_id, $flag);

        $mailtempdata = $this->signup->get_mail_temp_data($temp_id);

        $adminconfig = $this->signup->get_admin_config($temp_id);

        switch ($temp_id) {
            case 11:

                if ($orgdata->userType == 1) {
                    
                } else if ($orgdata->userType == 2) {
                    $veri_link = '<a href="' . base_url('verify_link/signup_people/?e=' . encode($orgdata->email_id) . '&h=' . $orgdata->verification_string) . '&t=' . encode(2) . '" alt="verification_link" title="verification_link">Click Here To verify your account</a>';
                    $mainContent = str_replace("[USER_NAME]", $orgdata->first_name . " " . $orgdata->last_name, $mailtempdata[0]->content);
                }
                $mainContent = str_replace("[VERIFICATION_LINK]", $veri_link, $mainContent);
                break;
        }

        $this->data['org_data'] = $orgdata;
        $this->data['mail_temp_data'] = $mainContent;
        $this->data['admin_config'] = $adminconfig;
        sendmail($this->data);
    }

    
    /**
     * 
     * @param type $password
     * @return boolean
     */
    private function checkSpecialCharsInString($password) {

        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @param type $password
     * @return boolean
     */
    private function checkNumbersInString($password) {

        if (!preg_replace("/[^0-9]/", '', $password)) {
            return false;
        } else {
            return true;
        }
    }

}
