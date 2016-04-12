<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for forgot password ( Personal finance )
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class ResetPassword extends MY_Controller {

    protected $data = array();

    function __construct() {
        parent::__construct();
        $this->_init();
    }

    
    private function _init() {
        $this->load->model('Login_model', 'login');
        $this->load->model('ResetPassword_model', 'reset');
    }

    
    /**
     * Function to reset user password.
     * 
     * @return boolean
     */
    public function resetpassword() {

        if ($this->input->post()) {

            $email = $this->input->post('user_email');
            $Finalemail = decode($this->input->post('user_email'));

            $this->session->set_userdata('data_string', serialize($this->input->post()));

            if ($this->validate_resetpassword_form() == true) {
                $last_id = $this->reset->saveResetPassword();
                if (intval($last_id) > 0) {
                    $this->session->set_flashdata('success', 'Password has been reset successfully !!!');
                    $this->render('resetPasswordComplete');
                    return false;
                }
            }
        }
        $this->render('resetpassword');
    }

    
    /**
     * Function for validating reset password data
     * @return boolean
     */
    private function validate_resetpassword_form() {

        $this->form_validation->set_rules('password', 'Password', 'required|callback_validate_password');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('passconf', 'Confirm Password is Not matching', 'trim|matches[password]');

        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

        return $this->form_validation->run();
    }

    
    /**
     * 
     * @param type $password
     * @return boolean
     */
    public function validate_password($value) {
        $this->form_validation->set_message('validate_password', "Should contain at least 1-digit, 1-alphabet, 1-symbol @#$&.");
        if (preg_match("/^(?=.*[A-Za-z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{6,}$/", $value)) {
            return true;
        }
        return false;
    }

}
