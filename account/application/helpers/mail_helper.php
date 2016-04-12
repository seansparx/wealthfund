<?php defined('BASEPATH') OR exit('No direct script access allowed');

function email_send($address, $subject, $message) 
{
    $CI = & get_instance();
    
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'corephp0@gmail.com',
        'smtp_pass' => 'Sparx@09871',
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'wordwrap' => TRUE
    );
    
    $CI->load->library('email', $config);
    
    $CI->email->clear();
    $CI->email->set_newline("\r\n");
    $CI->email->set_mailtype("html");

    $CI->email->to($address);
    $CI->email->cc('sean@sparxitsolutions.com'); //karan1bh@gmail.com
    $CI->email->from('noreply@wealthfund.in');
    $CI->email->subject($subject);
    $CI->email->message($message);
    $CI->email->send();

    //echo $this->email->print_debugger();
}

?>
