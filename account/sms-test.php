<?php
require "twilio/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "ACd144550cbf5cb59a889336da4a1b0a6b";
$AuthToken = "0a121a43803d10203da7761c2b012a3d";
 //twilio_use_certificate
$client = new Services_Twilio($AccountSid, $AuthToken);
 

$msgid = '';
$html = '';

try {
	if(isset($_POST['Send']) && count($_POST) > 0)
	{
		// find message detail from post data
		$To = $_POST['To'];
		$Body = $_POST['Msg'];
		
		// create twilio sms api call
		$message = $client->account->messages->create(array( 
			'From' => "+12027914604",
			'To' => $To,  
			'Body' => $Body,   
		));
		 
		// store a confirmation message on the screen
		$msgid = "<em>Sent message : {$message->sid}</em>";
	}
} catch (Services_Twilio_RestException $e) {
    echo $e->getMessage();
}

$html .= '<!DOCTYPE html>';
$html .= '<html>';
$html .= '<head>';
$html .= '<title>Twilio SMS</title>';
$html .= '</head>';
$html .= '<body>';
$html .= $msgid;
$html .= '<h2>Twilio SMS Example</h2>';
$html .= '<form name="send-sms" action="' . $_SERVER['PHP_SELF'] . '" method="post" role="form">';
$html .= '<label for="To">Enter phone number of receiver : </label><input type="text" id="To" name="To" placeholder="+919910124603" value="+919910124603">';
$html .= '<br>';
$html .= '<label for="Msg">Enter text message here : </label><textarea id="Msg" name="Msg" placeholder="hey bro!">hey Bro!</textarea>';
$html .= '<br><br>';
$html .= '<input type="submit" name="Send" value="Send Message">';
$html .= '</form>';
$html .= '</body>';
$html .= '</html>';

echo $html;