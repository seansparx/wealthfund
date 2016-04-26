<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("session");
    }

    
    /*************** Start function getMenuDetail() to get menu details **************/

    function getMenuDetail() {
        $this->db->where("adminLevelId", $this->session->userdata(SITE_SESSION_NAME.'USERLEVELID'));
        $query = $this->db->get(TBL_ADMINPERMISSION);
        if ($query->num_rows() > 0) {
            $adminPermissionArr = array();
            foreach ($query->result() as $line) {
                array_push($adminPermissionArr, $line->menuid);
            }
            return $adminPermissionArr;
        } else {
            return 0;
        }
    }
    
    /*************** End function getMenuDetail() ****************/
    
    function main_menu(){        
        
        $adminMenuID = $this->getMenuDetail();
        $cond = array(
            'parentId' => '0',
            'status' => '1',
        );
        $this->db->order_by("menuId");
        $this->db->where($cond);
        $this->db->where_in('menuId', $adminMenuID);
        $query = $this->db->get(TBL_MENU);
        $i = 1;
        $cururl = $this->uri->segment(1,'');
        $currentPage=$cururl;
        $parentMenu=  $this->general_model->fetchValue(TBL_MENU,"parentId","menuUrl LIKE '%".$currentPage."%'");
        $output ='';
        foreach ($query->result() as $rowMenu) {
            if($rowMenu->menuId == $parentMenu){
                $class="active";
            }else{
                $class="";
            }
            if($rowMenu->menu_type != '1'){
                $url = explode('.',$rowMenu->menuUrl);
                $output .= '<li class="'.$class.'"><a  href="'.site_url($url[0]).'" class="'.$rowMenu->menuClass.'"><i></i>'.$rowMenu->menuName.'</a></li>';
            }else{
                $url = explode('.',$rowMenu->menuUrl);
                $output .= '<li class="dropdown dd-1 '.$class.'"><a href="'.site_url($url[0]).'" data-toggle="dropdown" class="'.$rowMenu->menuClass.'"><i></i>'.$rowMenu->menuName.'<span class="caret"></span></a>';
                 $cond = array(
            'status' => '1',
        );
       $this->db->where($cond);
               // $this->db->where_in('parentId', $rowMenu->menuId);
       
                 $this->db->where(array('parentId'=>$rowMenu->menuId));//change made by 430
                 $this->db->where_in('menuId', $adminMenuID);// 
                $this->db->order_by('sort_order','desc');
                $query1 = $this->db->get(TBL_MENU);
                if($this->db->count_all_results()){
                    $output .= '<ul class="dropdown-menu pull-left">';
                    foreach ($query1->result() as $rowMenu1) {
                        $url1 = explode('.',$rowMenu1->menuUrl);
                        $output .= '<li ><a  href="'.site_url($url1[0]).'">'.$rowMenu1->menuName.'</a></li>';
                    }
                    $output .= '</ul>';
                }else{
                    $output .= '</li>';
                }                
            }            
        }
        return $output;
    }
    
}
?>