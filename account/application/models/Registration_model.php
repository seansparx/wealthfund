<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {

    private $tbl_users = "users";

    function __construct() {
        parent::__construct();
    }

    public function read($id = null) {
        if (intval($id) > 0) {
            $this->db->select('full_name, user_email, password, salt,user_mobile, country_code, verification_string');
            $query = $this->db->get_where($this->tbl_users, array('id' => $id, 'is_deleted' => 'no'));            

            return $query->row();
        } else {
            $this->db->select('full_name, user_email, password, salt, user_mobile, country_code, verification_string');
            $query = $this->db->get_where($this->tbl_users, array('is_deleted' => 'no'));
            
            return $query->result();
        }
    }

    /**
     * 
     * @return int
     */
    public function add() {
        $form_data = unserialize($this->session->userdata('data_string'));
        //pr($form_data);

        $random_salt = random_salt();
        $password = encode_password($form_data['password'], $random_salt);
        $verification_string = verification_string($form_data['password']);

        $data = array(
            "prefix" => (isset($form_data['prefix']) ? $form_data['prefix'] : ''),
            "full_name" => (isset($form_data['full_name']) ? $form_data['full_name'] : ''),
            "user_email" => (isset($form_data['user_email']) ? $form_data['user_email'] : ''),
            "email_verified" => (isset($form_data['email_verified']) ? $form_data['email_verified'] : ''),
            "user_mobile" => (isset($form_data['user_mobile']) ? $form_data['user_mobile'] : ''),
            "country_code" => (isset($form_data['country_code']) ? $form_data['country_code'] : ''),
            "mobile_verified" => (isset($form_data['otp_matched']) ? $form_data['otp_matched'] : ''),
            "password" => (isset($password) ? $password : ''),
            "salt" => (isset($random_salt) ? $random_salt : ''),
            "api_username" => 'sbMemsean.rocky5',
            "api_password" => 'sbMemsean.rocky5#123',
            "verification_string" => (isset($verification_string) ? $verification_string : ''),
            "is_active" => 'no');

        $this->db->insert($this->tbl_users, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
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

        if ($query->num_rows() > 0) {
            return false;
        }
    }

    /**
     * Function to check email existance
     * 
     * @access public
     * 
     * @return bool
     */
    public function activate_user() 
    {
        $emailid = decode($_GET['e']);
        $v_string = decode($_GET['h']);

        $this->db->select('full_name, user_email, verification_string, is_active');
        $this->db->where(array("user_email" => $emailid, "is_deleted" => "no"));
        $query = $this->db->get($this->tbl_users);

        if ($query->num_rows() > 0) {
            $user_info = $query->row();
            if (($user_info->user_email == $emailid) && ($user_info->verification_string == $v_string)) {
                $this->db->where(array("user_email" => $emailid, "verification_string" => $v_string));
                $flag = $this->db->update($this->tbl_users, array("is_active" => "yes", "email_verified" => "yes"));
                return array('flag' => $flag, 'user_info' => $user_info);
            }
        }
    }

}
