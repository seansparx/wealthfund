<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '../../../twilio/Services/Twilio.php';

/**
 * function to create new otp.
 * 
 * @param $mobile_no
 * 
 * @return number;
 */
function generate_otp($mobile_no) 
{
    $CI = & get_instance();
    $string = '0123456789';
    $string_shuffled = str_shuffle($string);
    $otp = substr($string_shuffled, 1, 6);
    $CI->session->set_userdata('signup_otp', $otp);
    $otp_response = send_otp($mobile_no, $otp);
    if($otp_response['success'] == true && trim($otp_response['msg_id']) != ''){
        return $otp;
    }
}


/**
 * function to match OTP.
 * 
 * @param $value otp
 * 
 * @return string bool;
 */
function match_otp($value) 
{
    $CI = & get_instance();
    return ($CI->session->userdata('signup_otp') == $value);
}


/**
 * function to send OTP on mobile.
 * 
 * @param $value otp
 * 
 * @return string bool;
 */
function send_otp($mobile, $text) 
{
    if (strlen($mobile) == 10) {
     //   $mobile = '+91'.$mobile;
    }

    // set your AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACd144550cbf5cb59a889336da4a1b0a6b";
    $AuthToken = "0a121a43803d10203da7761c2b012a3d";
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
                'Body' => 'Activation Code for Wealthfund is : '.$text.', Please use the code to complete signup. Pls do not share this with anyone.',
            ));

            // store a confirmation message on the screen
            $msgid = $message->sid;
            return array('success' => true, "msg_id" => $msgid);
        }
    } catch (Services_Twilio_RestException $e) {
         echo $e->getMessage();
    }
}

?>
