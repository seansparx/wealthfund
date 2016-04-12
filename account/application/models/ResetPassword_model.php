<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword_model extends CI_Model {

    private $tbl_users = "users";

    function __construct() {
        parent::__construct();
        $this->_init();
    }

    private function _init() {
        $this->load->helper('mail');
        $this->load->model('email_model');
        $this->load->model('registration_model');
    }

    /**
     * Function to save reset password
     * 
     * @access public
     * 
     * @return bool
     */
    public function saveResetPassword() {

        $form_data = unserialize($this->session->userdata('data_string'));

        $userEmail = $form_data['user_email'];
        $FinalUserEmail = decode($form_data['user_email']);
        $random_salt = random_salt();
        $password = encode_password($form_data['password'], $random_salt);
        $verification_string = verification_string($form_data['password']);

        $data = array(
            "password" => (isset($password) ? $password : ''),
            "verification_string" => (isset($verification_string) ? $verification_string : ''),
            "salt" => (isset($random_salt) ? $random_salt : '')
        );

        $this->db->where('user_email', $FinalUserEmail);
        $this->db->update($this->tbl_users, $data);
        $this->userResendPassword($FinalUserEmail, $form_data['password']);
        return true;
    }

    /*     * ************* Start function userResendPassword() to resend user password ************** */

    public function userResendPassword($emailId, $Password) {

        $this->db->where("user_email", $emailId);
        $query = $this->db->get($this->tbl_users);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
                $uid = $line->id;

                $user_info = $this->registration_model->read($uid);
                $mailtempdata = $this->email_model->get_template('FORGET_PASSWORD');
                $signup_data = unserialize($this->session->userdata('data_string'));

                $veri_link = site_url('login/resetPassword/?e=' . encode($user_info->user_email) . '&h=' . encode($user_info->verification_string));
                $mailtempdata->body = str_replace("xxxRESETPASSWORDLINKxxx", $veri_link, $mailtempdata->body);

                $mailtempdata->body = str_replace("xxxUSERNAMExxx", $user_info->full_name, $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxLINKxxx", site_url(), $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxIMAGELINKxxx", site_url(), $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxEMAILxxx", $emailId, $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxPASSWDxxx", $Password, $mailtempdata->body);
                email_send($user_info->user_email, $mailtempdata->subject, $mailtempdata->body);
            }
        }
        return true;
    }

    /*     * ************* End function userResendPassword() ************** */
}
