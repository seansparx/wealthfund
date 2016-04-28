<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** 
 * Class for dashboard
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Configuration extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->_init();
    }

    
    private function _init()
    {
        $this->load->model('admin/configuration_model');
    }
    
    /**
     * Render dashboard page.
     * 
     * @return void
     */
    public function index() 
    {
        if($this->input->post()){
            $this->form_validation->set_rules('SMTP_HOST', 'Smtp Name', 'trim|required');
            $this->form_validation->set_rules('SMTP_PORT', 'Smtp Port', 'trim|required');
            $this->form_validation->set_rules('SMTP_MAIL', 'Smtp Email', 'trim|required');
            $this->form_validation->set_rules('SMTP_PASSWORD','Smtp Password', 'trim|required|min_length[6]|matches[CONF_SMTP_PASSWORD]');
            $this->form_validation->set_rules('CONF_SMTP_PASSWORD','Smtp Confirm Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('CURRENCY_CODE', 'Currency Code', 'trim|required');
            $this->form_validation->set_rules('CURRENCY_SYMBOL', 'Currency Symbol','trim|required');
            
             if ($this->form_validation->run() == TRUE) {
                 
            
            if ($this->configuration_model->savestemconfigdata())
                $this->writeOtherSettings();
                redirect('admin/configuration');
        }
        }
         $this->data = $this->configuration_model->getSystemConfigurations();
        $this->render_page('system_config');
    }
    
     /*
    * Function for writing system information in other system config.php
    * @access public
    * @return void
    */
     public function writeOtherSettings(){
       $content="<?php
        /*
        |--------------------------------------------------------------------------
        | Other system configurations for social API's etc
        |--------------------------------------------------------------------------
        |Define all other custom constants here i.e. Facebook, Twitter etc.
        |
        */";
       foreach ($this->configuration_model->getSystemConfigurations() as $systemName => $systemVal) {
         if($systemName!=='GOOGLE_ANALYTICS')
         $content.="\n\tdefine('".$systemName."','".$systemVal."');";  
         
       }
       
//       $content.="\n\t".'define("COUNTY",  serialize(array(';  
//         $county_arr='';
//       foreach ($this->systemconfig_model->getCountyDetails() as $systemName => $systemVal) {
//           $county_arr.="'$systemVal'".'=>'."'$systemName',";
//       }
//       $content.=trim($county_arr,",").')));';
       
      // echo $content;exit;
       
        $content.="\n?>";
        
        $file= APPPATH.'/config/other_system_config.php';
        if(file_exists($file)){
            unlink($file);
        }
        $handle = fopen($file, 'w');
        fwrite($handle, $content);
        @chmod($file,0777); 
        @fclose($handle);
        return 1;
    }
        
    
}
