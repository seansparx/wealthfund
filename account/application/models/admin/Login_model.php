<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

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
     * Function to check email existance
     * 
     * @access public
     * 
     * @return bool
     */
    public function is_email_exists($emailid) {
        $this->db->where("user_email", $emailid);
        $query = $this->db->get($this->tbl_users);

        if ($query->num_rows() < 1) {
            return false;
        }
        return true;
    }

    public function is_mobile_exists($mobile) {
        $this->db->where("user_mobile", $mobile);
        $query = $this->db->get($this->tbl_users);
        if ($query->num_rows() < 1) {
            return false;
        }
        return true;
    }

    /*     * ************* Start function userResendPassword() to resend user password ************** */

    public function userResendPassword($emailId) {

        $this->db->where("user_email", $emailId);
        $query = $this->db->get($this->tbl_users);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
                $uid = $line->id;                
                $salt = random_salt();               
                
                $user_info = $this->registration_model->read($uid);
                $mailtempdata = $this->email_model->get_template('RESET_PASSWORD_LINK');
                $signup_data = unserialize($this->session->userdata('data_string'));            
                    
				$veri_link = site_url('login/resetPassword/?e=' . encode($user_info->user_email) . '&h=' . encode($user_info->verification_string));
                $mailtempdata->body = str_replace("xxxRESETPASSWORDLINKxxx", $veri_link, $mailtempdata->body);
                
                $mailtempdata->body = str_replace("xxxUSERNAMExxx", $user_info->full_name, $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxLINKxxx", site_url(), $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxIMAGELINKxxx", site_url(), $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxEMAILxxx", $emailId, $mailtempdata->body);
                $mailtempdata->body = str_replace("xxxPASSWDxxx", "", $mailtempdata->body);
                email_send($user_info->user_email, $mailtempdata->subject, $mailtempdata->body);
                
            }
        }
        return true;
    }

    /*     * ************* End function userResendPassword() ************** */
    /*     * ************* Start function encrypt_password() to encrypt user password ************** */

    function encrypt_password($plain) {
        $password = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= $this->tep_rand();
        }
        $salt = substr(md5($password), 0, 2);
        $password = md5($salt . $plain) . ':' . $salt;
        return $password;
    }

    /*     * ************* Start function tep_rand() generate random number series ************** */

    function tep_rand($min = null, $max = null) {
        static $seeded;
        if (!$seeded) {
            mt_srand((double) microtime() * 1000000);
            $seeded = true;
        }
    }

    private function random_password() {

        $alphabets = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $numbers = '1234567890';
        $specialChars = '@#$';//&';
        $randSpecialChars = $specialChars[rand(0, strlen($specialChars) - 1)];
        $randNumbers = $numbers[rand(0, strlen($numbers) - 1)];
        $password = substr($alphabets, 1, 6) . str_shuffle($randSpecialChars) . str_shuffle($randNumbers);
        return $password;
    }

    /*     * ************* End function tep_rand() ************** */

    /**
     * Function to check password existance
     * 
     * @access public
     * 
     * @return bool
     */
    public function is_password_exists($emailId, $oldPassword) {

        $authdata = $this->get_auth_data_by_email($emailId);
        $password = hash("sha512", $oldPassword . $authdata->salt);
        $this->db->where("password", $password);
        $query = $this->db->get($this->tbl_users);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** Update last login time of user.
     * 
     * @access public
     * @param string $type
     * @param int $id
     * @return bool
     */
    public function update_last_login($user) {
        $this->db->where('id', $user->id);
        return $this->db->update($this->tbl_users, array('last_login' => date('Y-m-d H:i:s')));
    }

    /**
     * @access private
     * @param type $emailId
     * @return boolean
     */
    private function getUserSalt($emailId) {
        $this->db->where('user_email', $emailId);
        $query = $this->db->get($this->tbl_users)->row();
        if ($query) {
            return $query->salt;
        } else {
            return false;
        }
    }

    /*
     * Function to get record by email id
     * 
     * @param $email_id
     * 
     *  return array
     */

    public function get_auth_data_by_email($email_id) {
        $resultdata = "";
        $where = array("user_email" => $email_id);
        $query = $this->db->get_where($this->tbl_users, $where);
        if ($query->num_rows() > 0) {
            $resultdata = $query->row();
        }
        return $resultdata;
    }

    /* Function to check A Account is verified or not 
     * @param $email Email Id
     * 
     *  @return Boolean
     */

    public function is_account_verified($emailId) {
        $retF = FALSE;
        $this->db->select('*');
        $query = $this->db->get_where($this->tbl_users, array('user_email' => trim($emailId), 'email_verified' => 'yes'));
        if ($query->num_rows() > 0) {
            $retF = TRUE;
        }
        return $retF;
    }

    /* Function to check A Account is verified or not 
     * @param $email Email Id
     * 
     *  @return Boolean
     */

    public function is_email_verified($emailId) {
        $retF = FALSE;
        $this->db->select('*');
        $query = $this->db->get_where($this->tbl_users, array('user_email' => trim($emailId), 'email_verified' => 'yes'));

        if ($query->num_rows() > 0) {
            $retF = TRUE;
        }
        return $retF;
    }

    /* Function to check A Account is verified or not 
     * @param $email Email Id
     * 
     *  @return Boolean
     */

    public function is_mobile_verified($mobile) {
        $retF = FALSE;
        $this->db->select('*');
        $query = $this->db->get_where($this->tbl_users, array('user_mobile' => trim($mobile), 'mobile_verified' => 'yes'));

        if ($query->num_rows() > 0) {
            $retF = TRUE;
        }
        return $retF;
    }

    /*     * *************function to check session ************* */

    function checkSession() {
        if (!$this->session->userdata['wf_admin_session']['admin_user_id']) {
            $this->session->set_flashdata('flashdata', 'OOPS! your session has been expired!');
            return false;
        }
        return true;
    }

}
