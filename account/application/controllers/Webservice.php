<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->_init();
    }

    public function index() {
        show_404();
    }

    private function _init() {
        $this->load->model('Login_model', 'login');
        $this->load->helper(array('cookie'));
    }

    /**
     * 
     * @param string $str
     * @return type
     */
    public function get_token() {  
        $encodeStr = '';
        $str = $this->input->post('str_name');
        if ($str) {
            $encodeStr = encode($str);
            echo $encodeStr;
        }
    }
    
    public function get_cookie()
    {
          $cookie_name   = "WEALTHFUNDUSER";
          $cookie_detail = get_cookie($cookie_name);
          $return_array=NULL;
          if(trim($cookie_detail))
          {
              $cookie_arr = explode("#####", $cookie_detail);
              if(count($cookie_arr) == '2')
              {
                  $return_array['email'] = base64_decode($cookie_arr['0']);
                  $return_array['password'] = base64_decode($cookie_arr['1']);
              }

          }
         echo json_encode($return_array) ;
    }

}
