<?php defined('BASEPATH') OR exit('No direct script access allowed');

function email_send($address, $subject, $message) 
{
    $CI = & get_instance();
    $CI->load->library('email');
    
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'info.seanrock@gmail.com',
        'smtp_pass' => '#ab123456',
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'wordwrap' => TRUE
    );
    
    $CI->email->initialize($config);
    
    $CI->email->clear();
    $CI->email->set_newline("\r\n");
    $CI->email->set_mailtype("html");

    $CI->email->to($address);
    $CI->email->cc('sean@sparxitsolutions.com'); //karan1bh@gmail.com
    $CI->email->from('noreply@wealthfund.in');
    $CI->email->subject($subject);
    $CI->email->message($message);
    //echo $CI->email->send();

    echo $CI->email->print_debugger();
}

?>
