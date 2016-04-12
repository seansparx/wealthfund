<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model 
{
    private $tbl_templates = "mail_templates";
    
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Function to get email templates
     * 
     * @access public
     * 
     * @return array
     */
    public function get_template($templ_code) 
    {
        if (trim($templ_code) != '') {
            $where = array("code" => $templ_code);
            $query = $this->db->get_where($this->tbl_templates, $where);
        }

        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }
    
}
