<?php defined('BASEPATH') OR exit('No direct script access allowed');

require "twilio/Services/Twilio.php";

/** 
 * Class for cron jobs
 * 
 * @package wealthfund.in
 * @author Sean <sean@sparxitsolutions.com>
 */
class Crons extends CI_Controller 
{
    protected $data = array();

    function __construct() 
    {
        parent::__construct();
        $this->init();
    }

    
    private function init()
    {
        $this->load->helper('yodlee');
        $this->load->helper('mail');
        $this->load->model('registration_model');
        $this->load->model('budget_model');
    }
    
    
    /**
     * @return mix
     */
    public function index() 
    {
        echo 'welcome to crons';
    }
    
    
    /**
     * @return mix
     */
    public function budget_notification() 
    {
        $users = $this->registration_model->read();
        $cn = 0;
        
        foreach ($users as $user) {
            $budgets        = $this->budget_model->get_user_budget($user->id);
            $spend_of_month = $this->budget_model->spendings_of_month_by_user($user->id);
            
            /** Arrange spendings of this month */
            if(sizeof($spend_of_month) > 0) {
                foreach ($spend_of_month as $spend) {
                    $spent[$spend->category_id] = $spend->amt;
                }
            }
            
            $full_name   = $user->full_name;
            $user_email  = $user->user_email;
            $user_mobile = $user->country_code.$user->user_mobile;
            $limit       = 90;
            
            if(sizeof($budgets) > 0) {
                foreach ($budgets as $budget) {
                    $amount   = $budget->amount;
                    $cat_type = ucwords($budget->type_name);
                    $cat_name = ucwords($budget->category_name);
                    $hv_spent = isset($spent[$budget->category_id]) ? $spent[$budget->category_id] : 0;
                    $spent_percent = ceil(($hv_spent * 100) / $amount);
                    if($spent_percent >= $limit) {
                        $text = 'Hi '.$full_name.', This month you have spent '.number_format($hv_spent, 2).' INR on '.$cat_name.' of your budget amount '.number_format($amount, 2).' INR - Wealthfund';
                        $this->send_sms($user_mobile, $text);
                        email_send($user_email, 'Budget Reminder', $text);
                        email_send('sean@sparxitsolutions.com', 'Budget Reminder', $text.'<br/>'.json_encode($budget));
                        $cn++;
                    }
                }
            }
        }
        
        echo $cn.' notifications sent.';
        
    }
    
    
    
   /**
    * function to send message on mobile.
    * 
    * @param string $mobile
    * @param string $text
    * 
    * @return mix;
    */
   private function send_sms($mobile, $text) 
   {
       // set your AccountSid and AuthToken from www.twilio.com/user/account
       $AccountSid = TWILIO_ACCOUNT_SID;
       $AuthToken = TWILIO_AUTH_TOKEN;
       //twilio_use_certificate
       $client = new Services_Twilio($AccountSid, $AuthToken);

       $msgid = '';
       $html = '';
       try {
           if (strlen($mobile) > 10){
               // create twilio sms api call
               $message = $client->account->messages->create(array(
                   'From' => "+12027914604",
                   'To' => $mobile,
                   'Body' => $text
               ));

               // store a confirmation message on the screen
               return $message->sid;
           }
       } catch (Services_Twilio_RestException $e) {
            echo $e->getMessage();
       }
   }

}
