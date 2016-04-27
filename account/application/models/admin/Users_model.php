<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {


    function __construct() {
        //echo 'fadf'; die;
        parent::__construct();
        $this->load->library("session");
      
    }
    
    public function getAdminUsers()
    {
        //echo "rajfd"; die;
       $query =  $this->db->select('*')->from(TBL_ADMINLOGIN)->where('is_deleted !=',NULL)->get();
       if($query->num_rows()>0){
           return $query->result();
       }
       return NULL;
        
    }
    
    public function geteditMenurecord($id) {
       
         $c= 0;
        $result = $this->getdataResult($id);
        $i = 0;
        $j = 0;
        $con = array('parentId' => '0',
                     'status'   => '1'
        );
        $this->db->where($con);
        $this->db->order_by("menuId", "ASC");
        $query = $this->db->get(TBL_MENU);
        //echo $this->db->last_query(); die;
        $resulttbl='';
        foreach ($query->result() as $rowMenu) {
            $con1 = array('parentId' => $rowMenu->menuId,
                'status'        => '1',
                'parentId !='   => '0'
            );
            $this->db->where($con1);
            $query1 = $this->db->get(TBL_MENU);
            //echo $this->db->last_query(); die;
            $countSubMenu = $query1->num_rows();
            if ($countSubMenu == 0) {
                
                $insertMenue1 = $rowMenu->menuId;
                $resulttbl   .= '	<tr><td>';
                if ($this->fetchValue(TBL_ADMINPERMISSION, "menuid", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $insertMenue1 . "'") > '0') {
                    
                    $checked  = 'TRUE';
                } else {
                    $checked = '';
                }
                
                $data = array(
                    'name'      => 'menuCheck[]',
                    'id'        => 'menuCheck',
                    'value'     => $insertMenue1,
                    'onclick'   => 'checkAllSingle(' . $rowMenu->menuId . ',' . $rowMenu->menu_type . ')',
                    'checked'   => $checked
                );
                $resulttbl .= form_checkbox($data);
                $resulttbl .= '&nbsp;&nbsp;<b>' . $menuName = $rowMenu->menuName . '</b></td>
							                <td align="center" >';
                
                if ($rowMenu->menu_type == 1) {
                    $resulttbl .= '-';
                } else {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "add_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $insertMenue1 . "'") == '1') {
                        $addchecked = 'TRUE';
                    } else {
                        $addchecked = '';
                    }
                    $adddata = array(
                        'name'      => 'menuCheck_' . $insertMenue1 . '_add',
                        'id'        => 'menuCheck_' . $insertMenue1 . '_add',
                        'value'     => '1',
                        'checked'   => $addchecked
                    );
                    $resulttbl .= form_checkbox($adddata);
                }
                $resulttbl .= '</td><td align="center" >';
                if ($rowMenu->menu_type == 1) {
                    $resulttbl .= '-';
                } else {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "edit_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $insertMenue1 . "'") == '1') {
                        $editchecked = 'TRUE';
                    } else {
                        $editchecked = '';
                    }
                    $editdata = array(
                        'name'      => 'menuCheck_' . $insertMenue1 . '_edit',
                        'id'        => 'menuCheck_' . $insertMenue1 . '_edit',
                        'value'     => '1',
                        'checked'   => $editchecked
                    );
                    $resulttbl .= form_checkbox($editdata);
                }
                $resulttbl .= '</td><td align="center" >';
                if ($rowMenu->menu_type == 1) {
                    $resulttbl .= '-';
                } else {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "delete_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $insertMenue1 . "'") == '1') {
                        $delchecked = 'TRUE';
                    } else {
                        $delchecked = '';
                    }
                    $deldata = array(
                        'name'      => 'menuCheck_' . $insertMenue1 . '_del',
                        'id'        => 'menuCheck_' . $insertMenue1 . '_del',
                        'value'     => '1',
                        'checked'   => $delchecked
                    );
                    $resulttbl .= form_checkbox($deldata);
                }
                $resulttbl .= '</td></tr>';
               
            } else { 
               $divName = "divId" . $rowMenu->menuId;
                $resulttbl .= '<tr><td >';
                if ($this->fetchValue(TBL_ADMINPERMISSION, "menuid", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowMenu->menuId . "'") > '0') {
                    $checked1 = 'TRUE';
                } else {
                    $checked1 = '';
                }
                $data1 = array(
                    'name'      => 'menuCheck[]',
                    'id'        => 'menuCheckA' . $rowMenu->menuId,
                    'value'     => $rowMenu->menuId,
                    'onclick'   => 'checkAll(' . $countSubMenu . ',' . $i . ',' . $rowMenu->menuId . ',' . $rowMenu->menu_type . ')',
                    'checked'   => $checked1
                );
                $resulttbl .= form_checkbox($data1);
                $resulttbl .= "&nbsp;&nbsp;<b>" . $rowMenu->menuName . "</b><br />";
                $resulttbl .= '</td><td align="center" >';
                if ($rowMenu->menu_type == 1) {
                    $resulttbl .= '-';
                } else {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "add_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowMenu->menuId . "'") == '1') {
                        $checked1add = 'TRUE';
                    } else {
                        $checked1add = '';
                    }
                    $dataadd = array(
                        'name'      => 'menuCheck_' . $rowMenu->menuId . '_add',
                        'id'        => 'menuCheck_' . $rowMenu->menuId . '_add',
                        'value'     => '1',
                        'checked'   => $checked1add
                    );
                    $resulttbl .= form_checkbox($dataadd);
                }
                $resulttbl .= '</td><td align="center" >';
                if ($rowMenu->menu_type == 1) {
                    $resulttbl .= '-';
                } else {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "edit_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowMenu->menuId . "'") == '1') {
                        $checked1edit = 'TRUE';
                    } else {
                        $checked1edit = '';
                    }
                    $data_edit = array(
                        'name'      => 'menuCheck_' . $rowMenu->menuId . '_edit',
                        'id'        => 'menuCheck_' . $rowMenu->menuId . '_edit',
                        'value'     => '1',
                        'checked'   => $checked1edit
                    );
                    $resulttbl .= form_checkbox($data_edit);
                }
                $resulttbl .= '</td><td align="center" >';
                if ($rowMenu->menu_type == 1) {
                    $resulttbl .= '-';
                } else {
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "delete_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowMenu->menuId . "'") == '1') {
                        $checked1del = 'TRUE';
                    } else {
                        $checked1del = '';
                    }
                    $data_del = array(
                        'name'      => 'menuCheck_' . $rowMenu->menuId . '_del',
                        'id'        => 'menuCheck_' . $rowMenu->menuId . '_del',
                        'value'     => '1',
                        'checked'   => $checked1del
                    );
                    $resulttbl  .= form_checkbox($data_del);
                }
                $resulttbl      .= '</td></tr>';
            //    echo '<pre>';                print_r($query1->result());exit;
              
               //echo count($query1->result());exit;
               $rest=$query1->result();
                foreach ($rest as $rowSubMenu) {
                    $insertMenue    = $rowSubMenu->menuId;
                    $resulttbl     .= '<tr><td >&nbsp;&nbsp;';
                    if ($this->fetchValue(TBL_ADMINPERMISSION, "menuid", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowSubMenu->menuId . "'") > 0) {                 
                        $checked2   = 'TRUE';
                    } else {
                        $checked2   = '';
                    }
                    
                    $data2 = array(
                        'name'      => 'menuCheck[]',
                        'id'        => 'menuCheckB' . $i,
                        'value'     => $insertMenue,
                        'onclick'   => 'checkMenu(' . $i . ',' . $rowSubMenu->menu_type . ')',
                        'checked'   => $checked2
                    );
                 
                    $resulttbl .= form_checkbox($data2);
                    $resulttbl .= "&nbsp;&nbsp;" . $rowSubMenu->menuName . "<br/>";
                    $resulttbl .= '</td><td align="center" >';
                    if ($rowSubMenu->menu_type == 1) {
                        $resulttbl .= '-';
                    } else {
                        if ($this->fetchValue(TBL_ADMINPERMISSION, "add_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowSubMenu->menuId . "'") == '1') {
                            $checked2add = 'TRUE';
                        } else {
                            $checked2add = '';
                        }
                        $data_add = array(
                            'name'      => 'menuCheck_' . $rowSubMenu->menuId . '_add',
                            'id'        => 'menuCheckB' . $i . '_add',
                            'class'     => 'single_chk',
                            'value'     => '1',
                            'checked'   => $checked2add
                        );
                        $resulttbl .= form_checkbox($data_add);
                    }
                    $resulttbl .= '</td><td align="center" >';
                    if ($rowSubMenu->menu_type == 1) {
                        $resulttbl .= '-';
                    } else {
                        if ($this->fetchValue(TBL_ADMINPERMISSION, "edit_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowSubMenu->menuId . "'") == '1') {
                            $checked2edit = 'TRUE';
                        } else {
                            $checked2edit = '';
                        }
                        $data_edit = array(
                            'name'      => 'menuCheck_' . $rowSubMenu->menuId . '_edit',
                            'id'        => 'menuCheckB' . $i . '_edit',
                            'class'     => 'single_chk',
                            'value'     => '1',
                            'checked'   => $checked2edit
                        );
                        $resulttbl .= form_checkbox($data_edit);
                    }
                    $resulttbl .= '</td><td align="center" >';
                    if ($rowSubMenu->menu_type == 1) {
                        $resulttbl .= '-';
                    } else {
                        if ($this->fetchValue(TBL_ADMINPERMISSION, "delete_record", "adminLevelId = '" . $result->adminLevelId . "' and menuid = '" . $rowSubMenu->menuId . "'") == '1') {
                            $checked2del = 'TRUE';
                        } else {
                            $checked2del = '';
                        }
                        $data__del = array(
                            'name'      => 'menuCheck_' . $rowSubMenu->menuId . '_del',
                            'class'     => 'single_chk',
                            'id'        => 'menuCheckB' . $i . '_del',
                            'value'     => '1',
                            'checked'   => $checked2del
                        );
                        $resulttbl .= form_checkbox($data__del);
                    }
                    $resulttbl .= '</td></tr>';

                    $i++;
                }

                $j++;
            }
        }
        return $resulttbl;
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
    
    
 public function fetchValue($table, $field, $where) {
        $this->db->select($field);
        $this->db->where($where);
        $query  = $this->db->get($table);
        $row    = $query->row_array();
        if($row)
        return $row[$field];      
        return 0;
    }

}
?>