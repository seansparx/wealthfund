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
              
    }
    
    /**
     * Render dashboard page.
     * 
     * @return void
     */
    public function index() 
    {
        $this->data = array();
        $this->render_page('system_config');
    }
        
    
}
