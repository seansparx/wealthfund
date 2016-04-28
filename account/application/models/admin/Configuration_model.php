<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model {

    private $tbl_users = "users";

    function __construct() {
        parent::__construct();
        $this->load->library("session");
        
        $this->_init();
    }

    private function _init() {
       
    }
    
    
public function savestemconfigdata() {
    //pr($this->input->post()); die;
       $post = $this->input->post();
        $query = $this->db->get(TBL_SYSTEMCONFIG);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
              // if ($line->systemName == 'SITE_NAME') {
                    $this->db->where('systemName', $line->systemName);
                    $postarray = array('systemVal' => addslashes($post[$line->systemName]));
                    $this->db->update(TBL_SYSTEMCONFIG, $postarray);
        }

        $this->session->set_flashdata('success', 'Data has been successfully updated!');
        return true;
    }
    

}

  /*
     * Function for getting system configuration information
     * @access public
     * @param $fieldname (string)
     * @return string
     */

    function getsystemconfigdata($fieldname) {
        $this->db->where('systemName', $fieldname);
        $query = $this->db->get(TBL_SYSTEMCONFIG);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                return stripslashes($value->systemVal);
            }
        }
    }


/*
     * Function for getting system configuration information
     * @access public
     * @param $fieldname (string)
     * @return string
     */

    public function getSystemConfigurations() {
        $result = '';
        $query = $this->db->get(TBL_SYSTEMCONFIG);
        foreach ($query->result() as $value) {
            $result[$value->systemName] = stripslashes($value->systemVal);
        }
        return $result;
    }

}
