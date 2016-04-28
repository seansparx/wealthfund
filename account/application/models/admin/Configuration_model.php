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
    
    
    /**
     * Function to fetch admin menu.
     * 
     * @access public
     * 
     * @return array
     */
    public function read_menu() {
        $query = $this->db->order_by('sort_order')->get_where(TBL_ADMIN_MENU, array('status' => '1', 'parentId' => 0, 'menuName!=' => 'Dashboard'));
        return $parentMenu = $query->result();
    }
    
    
    /**
     * Function to  get permitted menu to admins .
     * 
     * @access public
     * @param int $Admin Level Id 
     * @return boolean 
     */
    function checkMenuPermission($menuId) 
    {
        $query = $this->db->get_where(TBL_ADMINPERMISSION, array('menuid' => $menuId, 'adminLevelId' => $this->session->userdata(SITE_SESSION_NAME.'USERLEVELID')));
        return count($query->result());
    }
    
    
    /**
     * Function to fetch admin sub menu.
     * 
     * @access public
     * 
     * @param int $menu_id
     * @return array
     */
    public function read_sub_menu($parentId) {
        $query = $this->db->get_where(TBL_ADMIN_MENU, array('status' => '1', 'parentId' => $parentId));
        return $query->result();
    }

}
