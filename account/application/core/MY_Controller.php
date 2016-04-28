<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();
    private $tbl_country_codes = "country";
    private $tbl_country_names = "country_codes";

    public function __construct() {
        parent::__construct();

        $this->load->helper('yodlee');
        $this->load->model('admin/configuration_model');
        //manage_login_yodlee();
    }

    /**
     * Common function for render pages with header & footer.
     * 
     * @return void
     */
    protected function render($page) {

        if ($page == 'signup' || $page == 'email-verification') {

            if ($page == 'signup') {
                $this->data['country_codes'] = $this->getCountryCodes();
            }
            $this->load->view('common/signup_header', $this->data);
            $this->load->view($page, $this->data);
            $this->load->view('common/signup_footer', $this->data);
        } 
        else if ($page == 'resetpassword' || $page == 'forgetPasswordComplete' || $page == 'resetPasswordComplete' || $page == 'signup-complete') {
            if ($this->input->get('e')) {
                $email = $this->input->get('e');
                $this->data['email'] = $email;
            }

            $this->load->view('common/resetpassword_header', $this->data);
            $this->load->view($page, $this->data);
            $this->load->view('common/resetpassword_footer', $this->data);
        } 
        else {

            $this->load->view('common/dashboard_header', $this->data);
            $this->load->view($page, $this->data);
            $this->load->view('common/dashboard_footer', $this->data);
        }
    }

    
       /**
        * @access  protected
        * @param string $view_name 
        * @return NULL
        */
       protected function render_page($view_name)
       {
          
            $this->load->view('admin/Layout/header',  $this->header_data);
            $this->load->view('admin/'.$view_name,  $this->data);
            $this->load->view('admin/Layout/footer',  $this->footer_data);
       }
    
    /**
     * private function to get country codes with country names
     * @return string
     */
    private function getCountryCodes() 
    {
        $countryCodes = array();
        $query = $this->db->select('cnt.countryIsd,dsc.countryName')->from(TBL_COUNTRY . " as cnt")
                ->join(TBL_COUNTRY_CODES . " as dsc", 'dsc.countryId=cnt.id')
                ->order_by('dsc.countryName', 'asc')
                ->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
                $countryCodes[$line->countryIsd] = $line->countryName . " ( " . $line->countryIsd . " )";
            }
        }
        return $countryCodes;
    }

}
