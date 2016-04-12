<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for email verification .
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Verification extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->init();
    }

    private function init()
    {
        $this->load->model('registration_model');
        $this->load->helper('otp');
    }
    
    
    /**
     * Verify user email address.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array('verified'=> false);
        $email = decode($_GET['e']);
        if( filter_var($email, FILTER_VALIDATE_EMAIL) != FALSE ){
            $response = $this->registration_model->activate_user();
            
            if($response['flag']){
                $this->email_account_verified($response['user_info']);
            }
            else{
                die('Link is Invalid or Expired.');
            }
        }
    }
    
    
    /**
     * Function to confirmation email.
     * @access private
     * @return void
     */
    private function email_account_verified($user_info) 
    {
        $this->load->helper('mail');
        $this->load->model('email_model');

        $mailtempdata   = $this->email_model->get_template('EMAIL_VERIFY_COMPLETE');        
        $mailtempdata->body = str_replace("xxxUSERNAMExxx", $user_info->full_name, $mailtempdata->body);
        $mailtempdata->body = str_replace("xxxLINKxxx", site_url(), $mailtempdata->body);
        email_send($user_info->user_email, $mailtempdata->subject, $mailtempdata->body);
        $this->data = array('email_verified'=> 'yes');
        $this->render('email-verification');
    }
    
}
