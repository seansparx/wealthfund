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
    
    /*
     * Function for getting website users details
     * 
     * @access public
     * @param $id (user id)
     * @return array
     */
    
    public function website_users($id)
    {
        $query = $this->db->select('*')->from(TBL_USERS)->where('id', $id)->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return NULL;
    }
    
    /*
     * Function for update user information
     * @access public
     * @param int($id)
     * @return void
     */
    
    public function editWebsiteUser()
    {
        $data = array(
            'full_name'=> $this->input->post('full_name'),
            'user_email' => $this->input->post('user_email'),
            'user_mobile' => $this->input->post('mobile')
            
        );
        
        
        $this->db->where('id', $this->input->post('users_id'))->update(TBL_USERS, $data);
       
            $this->session->set_flashdata('success', 'Information has been updated successfully!');
            redirect("admin/manageUsers");
       
    }
    
    public function delete_website_users($id)
    {
            $data = array('is_deleted'=> 'yes' );
            $this->db->where('id', $id)->update(TBL_USERS, $data);
            $this->session->set_flashdata('success', 'User has been deleted successfully!');
            redirect("admin/manageUsers");
    }
    
    

}
?>
