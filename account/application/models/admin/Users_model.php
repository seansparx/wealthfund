<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


    function __construct() {
        //echo 'fadf'; die;
        parent::__construct();
        $this->load->library("session");
      
    }
    
    public function getAdminUsers()
    {
        //echo "rajfd"; die;
       $query =  $this->db->select('*')->from(TBL_ADMINLOGIN)->where('is_deleted','0')->get();
       if($query->num_rows()>0){
           return $query->result();
       }
       return NULL;
        
    }
    
    
    /**
     * Function to change permission.
     * access public 
     * return bool
     */
    public function edit_panel_record() {
        $user_id = $this->input->post('adminLevelId');
       // echo $user_id; die;
        $user_level_id = $this->get_level_id($user_id);
        //pr($user_level_id); die;
        $user_level_id->adminLevelId;
        //echo $user_id
        $postarray = $this->input->post();
        //pr($postarray); die;
        $menuid = $this->get_menu_id();
        //pr($menuid); die;


        $this->db->where('adminLevelId', $user_level_id->adminLevelId);
        $this->db->delete(TBL_ADMINPERMISSION);

        if (isset($postarray['main_menu'])) {

            foreach ($postarray['main_menu'] as $main_menu) {


                $data = array(
                    'adminLevelId' => $user_level_id->adminLevelId,
                    'menuid' => $main_menu,
                    'add_record' => '1',
                    'edit_record' => '1',
                    'delete_record' => '1'
                );

                $this->db->insert(TBL_ADMINPERMISSION, $data);
            }
        }

        if (isset($postarray['menuCheck'])) {
            foreach ($postarray['menuCheck'] as $post_id) {

                $add = 'menuCheck_' . $post_id . '_add';
                $edit = 'menuCheck_' . $post_id . '_edit';
                $del = 'menuCheck_' . $post_id . '_del';

                $data = array(
                    'adminLevelId' => $user_level_id->adminLevelId,
                    'menuid' => $post_id,
                    'add_record' => (isset($postarray[$add]) ? '1' : '0'),
                    'edit_record' => (isset($postarray[$edit]) ? '1' : '0'),
                    'delete_record' => (isset($postarray[$del]) ? '1' : '0')
                );

                $this->db->insert(TBL_ADMINPERMISSION, $data);
            }
        }

        return true;
    }
    
     /**
     * Function to get menu id from  adminpermission.
     * access public 
     * return array
     */
    public function get_menu_id() {

        $get_menu_id = array();
        $query = $this->db->get(TBL_ADMINPERMISSION);
        $i = 0;
        foreach ($query->result() as $row) {
            $get_menu_id[$i] = $row->menuid;
            $i++;
        }
        return $get_menu_id;
    }
    
    
    /**
     * @todo seems too lengthy, need to short this method.
     */
    public function getPermissions($id) {
        $con = array('parentId' => '0', 'status' => '1');
        $this->db->where($con);
        $this->db->order_by("menuId", "ASC");

        $query = $this->db->get(TBL_ADMIN_MENU);

        /* create html for menus */
        $resulttbl = $this->main_menus($id, $query->result(), true);

        return $resulttbl;
    }
    
    
    private function main_menus($id, $result, $editable = false) 
    {
        $menu_html = '';

        foreach ($result as $rowMenu) {

            $adminuserid = $id;
            $user_level_id = $this->get_level_id($adminuserid);
            
            if ($id) {
                $main_menu_status = ($this->get_menu_status($rowMenu->menuId, $user_level_id->adminLevelId)) ? 'checked' : '';
            } else {
                $main_menu_status = '';
            }

            $query = $this->db->get_where(TBL_ADMIN_MENU, array(
                'parentId' => $rowMenu->menuId,
                'status' => '1',
                'parentId !=' => '0'
            ));

            $countSubMenu = $query->num_rows();

            if ($countSubMenu > 0) {
                if ($id) {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "menuid", "adminLevelId = '" . $user_level_id->adminLevelId . "' and menuid = '" . $rowMenu->menuId . "'") > '0') {
                        $checked1 = 'TRUE';
                    } else {
                        $checked1 = '';
                    }
                } else {
                    $checked1 = '';
                }

                $menu_html .= '<tr><td colspan="4" class="main">';
                $menu_html .= "<b class=\"main-menu\">&nbsp;&nbsp;";
                $menu_html .= ($editable) ? "<input type=\"checkbox\" class=\"main_menu\" name=\"main_menu[]\" value=\"" . $rowMenu->menuId . "\" id=\"mainSelect" . $rowMenu->menuId . "\" " . $main_menu_status . " onchange=\"checkMain(this, " . $rowMenu->menuId . ");\" >&nbsp;&nbsp;" : '';//  data-can-change=\"" . ($this->get_menu_status($rowMenu->menuId, getSessionData('USERLEVELID')) ? 1 : 0 ) . "\"
                $menu_html .= $rowMenu->menuName . "(" . $countSubMenu . ")</b>";
                $menu_html .= '</td></tr>';

                /* create sub-menus */
                $menu_html .= $this->sub_menus($id, $query->result(), $editable);
            }
        }

        return $menu_html;
    }
    
    
    /**
     * Create html for sub menus.
     * 
     * @access private
     * 
     * @param array $rest
     * @return html
     */
    private function sub_menus($id, $rest, $editable) 
    {
        $HTML = '';
        if ($id) {
            $result = $this->getdataResult($id);
        } else {
            $result = '';
        }

        foreach ($rest as $rowSubMenu) {
            if ($id) {
                if ($this->fetchValue(TBL_ADMINPERMISSION, "menuid", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowSubMenu->menuId . "'") > 0) {
                    $checked2 = 'TRUE';
                } else {
                    $checked2 = '';
                }
            } else {
                $checked2 = '';
            }

            $data2 = array(
                'name' => 'menuCheck[]',
                'id' => 'menuCheckB' . $rowSubMenu->menuId,
                'class' => 'sub_menu' . $rowSubMenu->parentId,
                'value' => $rowSubMenu->menuId,
                'onchange' => 'checkMenu(' . $rowSubMenu->menuId . ',' . $rowSubMenu->menu_type . ')',
                'checked' => $checked2
            );


            $HTML .= '<tr><td>&nbsp;&nbsp;';
            $HTML .= ($editable) ? form_checkbox($data2) . $rowSubMenu->menuName : $rowSubMenu->menuName;
            $HTML .= '</td><td align="center" >';
            $HTML .= $this->can_add($id, $rowSubMenu, $result, $editable);
            $HTML .= '</td><td align="center" >';
            $HTML .= $this->can_edit($id, $rowSubMenu, $result, $editable);
            $HTML .= '</td><td align="center" >';
            $HTML .= $this->can_delete($id, $rowSubMenu, $result, $editable);
            $HTML .= '</td></tr>';
        }
        return $HTML;
    }
    
     /***************** Start function getrecord() to get admin login details *****************/
    
    public function getrecord($id) {
        $result = array();
        $this->db->where('id', $id);
        $query = $this->db->get(TBL_ADMINLOGIN);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $result = $value;
            }
        }
        return $result;
    }
    
        /**
     * To store Assign Menu detail
     * @access public
     *  
     */
    
    public function edit_panel_recordss() {
        $post         = $this->input->post();
        $adminLevelId = $this->input->post('adminLevelId');
        $this->db->where('adminLevelId', $adminLevelId);
        $this->db->delete(TBL_ADMINPERMISSION);
        if (count($post['menuCheck']) > 0) {
            foreach ($post['menuCheck'] as $key => $value) {
                $add    = "menuCheck_" . $value . "_add";
                $edit   = "menuCheck_" . $value . "_edit";
                $del    = "menuCheck_" . $value . "_del";
                $data2  = array(
                    'adminLevelId'  => $adminLevelId,
                    'menuid'        => $value,
                    'add_record'    => @$post[$add],
                    'edit_record'   => @$post[$edit],
                    'delete_record' => @$post[$del],
                );
                $this->db->insert(TBL_ADMINPERMISSION, $data2);
            }
        }
         
        return TRUE;
    }
    
    /**
     * Check if user allowed to add records.
     * 
     * @access private
     * 
     * @param object $row
     * @param object $result
     * @param bool $editable
     * @return string
     */
    private function can_add($id, $row, $result, $editable) {
        $chk_attr = array(
            'name' => 'menuCheck_' . $row->menuId . '_add',
            'id' => 'menuCheck_' . $row->menuId . '_add',
            'value' => '1',
            'checked' => false);
        if ($id) {
            if ($this->fetchValue(TBL_ADMINPERMISSION, "add_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $row->menuId . "'") == '1') {

                if ($editable == true) {
                    $chk_attr['checked'] = true;
                    return form_checkbox($chk_attr);
                }

                return '<span class="label label-success">Yes</span>';
            } else {

                if ($editable == true) {
                    $chk_attr['checked'] = false;
                    return form_checkbox($chk_attr);
                }

                return '<span class="label label-important">No</span>';
            }
        } else {
            if ($editable == true) {
                $chk_attr['checked'] = false;
                return form_checkbox($chk_attr);
            }
        }
    }

    /**
     * Check if user allowed to edit records.
     * 
     * @access private
     * 
     * @param object $row
     * @param object $result
     * @param bool $editable
     * @return string
     */
    private function can_edit($id, $row, $result, $editable) {
        $chk_attr = array(
            'name' => 'menuCheck_' . $row->menuId . '_edit',
            'id' => 'menuCheck_' . $row->menuId . '_edit',
            'value' => '1',
            'checked' => false);
        if ($id) {
            if ($this->fetchValue(TBL_ADMINPERMISSION, "edit_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $row->menuId . "'") == '1') {

                if ($editable == true) {
                    $chk_attr['checked'] = true;
                    return form_checkbox($chk_attr);
                }

                return '<span class="label label-success">Yes</span>';
            } else {

                if ($editable == true) {
                    $chk_attr['checked'] = false;
                    return form_checkbox($chk_attr);
                }
                return '<span class="label label-important">No</span>';
            }
        } else {
            if ($editable == true) {
                $chk_attr['checked'] = false;
                return form_checkbox($chk_attr);
            }
        }
    }

    /**
     * Check if user allowed to delete records.
     * 
     * @access private
     * 
     * @param object $row
     * @param object $result
     * @param bool $editable
     * @return string
     */
    private function can_delete($id, $row, $result, $editable) {
        $chk_attr = array(
            'name' => 'menuCheck_' . $row->menuId . '_del',
            'id' => 'menuCheck_' . $row->menuId . '_del',
            'value' => '1',
            'checked' => false);
        if ($id) {
            if ($this->fetchValue(TBL_ADMINPERMISSION, "delete_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $row->menuId . "'") == '1') {

                if ($editable == true) {
                    $chk_attr['checked'] = true;
                    return form_checkbox($chk_attr);
                }

                return '<span class="label label-success">Yes</span>';
            } else {

                if ($editable == true) {
                    $chk_attr['checked'] = false;
                    return form_checkbox($chk_attr);
                }

                return '<span class="label label-important">No</span>';
            }
        } else {
            if ($editable == true) {
                $chk_attr['checked'] = false;
                return form_checkbox($chk_attr);
            }
        }
    }
    
    
    /**
     * @todo need to fix alignment.
     */
    private function fetchValue($table, $field, $where) {
        $this->db->select($field);
        $this->db->where($where);
        $query = $this->db->get($table);
        $row = $query->row_array();
        if ($row)
            return $row[$field];
        else
            return 0;
    }
    
    
    /**
     * Function to get user level id.
     * 
     * @access private 
     * @return array
     */
    private function get_level_id($user_id) {
        $this->db->select('adminLevelId');
        $this->db->from(TBL_ADMINLOGIN);
        $this->db->where(array('id' => $user_id));
        $query = $this->db->get();
        return $query->row();
    }
    
    
    /**
     * Function to check existing status for menu id from permission table.
     * 
     * @access private 
     * @return bool
     */
    private function get_menu_status($id, $levelid) {
        $this->db->select('menuid');
        $this->db->from(TBL_ADMINPERMISSION);
        $this->db->where(array('menuid' => $id, 'adminLevelId' => $levelid));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {

            return false;
        }
    }
    
    
    public function getdataResult($id) {
        $this->db->where('id', $id);
        $query = $this->db->get(TBL_ADMINLOGIN);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                return $value;
            }
        }
    }
    
    public function addUser()
    {
        $post = $this->input->post();
        $password       = $this->encrypt_password($post['password']);
        $hash           = md5($post['username'] . ":" . $password);
        $filename1      = (isset($filename)!=NULL)? $filename:'logo.png';
        $data1 = array(
            'username'      => $post['username'],
            'password'      => $password,
            'emailId'       => $post['user_email'],
            'hash'          => $hash,
            //'adminLevelId'  => $inserted_id,
            'addDate'       => date('Y-m-d H:i:s'),
            'addedBy'       => '-1',
            'status'        => '1'
        );
        $this->db->insert(TBL_ADMINLOGIN, $data1);
        $last_inserted_id = $this->db->insert_id();
        $data = array('adminLevelId'=>$last_inserted_id);
        $this->db->where('id',$last_inserted_id)->update(TBL_ADMINLOGIN, $data);
        $this->session->set_flashdata('success', 'Information has been added successfully!');
        redirect("admin/users");
    }
    
    /*
     * Function for get admin user details
     * @access public
     * @param int $id
     * @return array
     */
    
 public function userDetails($id)
 {
     $query = $this->db->select('*')->from(TBL_ADMINLOGIN)->where(array('id'=>$id, 'is_deleted'=>'0'))->get();
     //echo $this->db->last_query(); die;
     if($query->num_rows()>0){
         return $query->result();
     }
     return NULL;
 }
 
 /*
 * Function for Edit Admin user details
 * @access public
 * @param $post array
 * @param $filename string
 * return void
 */
public function editUser()
{
        $post = $this->input->post();
        $password       = $this->encrypt_password($post['password']);
        $hash           = md5($post['username'] . ":" . $password);
        $data = array(
            'username'     => $post['username'],
            'password'  => $password,
           //'userImage' => $filename1,
            'hash'      => $hash
        );
        $this->db->where('id', $post['user_id'])->update(TBL_ADMINLOGIN, $data);
        $this->session->set_flashdata('success', 'Information has been updated successfully!');
        redirect("admin/users"); 
   
    
}

/*
 * Function for delete admin user
 * @access public
 * @param $id user id
 * @return void
 */

public function deleteUser($id)
{
    $data = array(
        'is_deleted'=>'1'
    );
    //pr($data); die;
    $this->db->where('id',$id)->update(TBL_ADMINLOGIN, $data);
    $this->session->set_flashdata('success','User has been deleted successfully');
    redirect('admin/users');
}
    /*
 * Function for Encrypt user password
 * @access private
 * @param $plain (User password)
 * @return string
 */
 private function encrypt_password($plain) {
        $password   = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= $this->tep_rand();
        }
        $salt       = substr(md5($password), 0, 2);
        $password   = md5($salt . $plain) . ':' . $salt;
        return $password;
    }
    /*
 * Function for random result
 * @access private
 * @param $min (minimum length)
 * @param $max (maximum length)
 * @return string
 */    
private function tep_rand($min = null, $max = null) {
        static $seeded;
        if (!$seeded) {
            mt_srand((double) microtime() * 1000000);
            $seeded = true;
        }
    }
   
}
?>
