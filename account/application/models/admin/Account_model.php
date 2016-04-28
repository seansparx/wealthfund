<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();      
    }
    
    
    public function get_users()
    {
       $query =  $this->db->select('*')->from(TBL_USERS)->where('is_deleted', 'no')->get();
       if($query->num_rows() > 0) {
           return $query->result();
       }
    }

}
?>
