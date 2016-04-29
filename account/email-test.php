<!DOCTYPE html>
<html>
<body>
<?php

# Path to your PHP autoload.  If you are using a phar installation, this is the
# path to your aws.phar file.
require_once __DIR__ . '/vendor/autoload.php';

use Aws\Ses\SesClient;

$source_email = 'corephp0@gmail.com';

# Region where the sample will be run.
$region = 'us-east-1';

# Create the client for Simple Email Service.
$ses_client = SesClient::factory(array(
	'credentials' => array(
        'key' => 'AKIAJQCAN6JJ4ZBJ6W4A',
        'secret' => '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',
    ),
    'region' => $region,
    'version' => 'latest',
));

function send_email($ses_client, $source, $destination, $subject, $message) {
try {
  $bcc = $destination['bcc'] ? explode(',', $destination['bcc']) : array();
  $cc = $destination['cc'] ? explode(',', $destination['cc']) : array();
  $to = $destination['to'] ? explode(',', $destination['to']) : array();
  
  // Setup destination
  $destination = array(
	'BccAddresses' => $bcc,
	'CcAddresses' => $cc,
	'ToAddresses' => $to,
  );
  
  // Setup message body
  $body = array(
	'Text' => array(
		'Charset' => 'UTF-8',
		'Data' => $message,
	),
    /*'Html' => array(
		'Charset' => 'UTF-8',
		'Data' => $message,
    ),*/
  );
  
  # Create the send mail request.
  $request = array(
        'Destination' => $destination,
        'Message' => array(
			'Body' => $body,
			'Subject' => array(
				'Charset' => 'UTF-8',
				'Data' => $subject,
			),
        ),
        'Source' => $source,
  );
  
  # Output the request.
  echo '<PRE>';
  echo "Request body:\n";
  echo json_encode($request, JSON_PRETTY_PRINT);
  echo '</PRE>';
  
  return $ses_client->sendEmail($request)->toArray();
}catch(Exception $e)
{
	return $e->getMessage();
}
}   

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  # If the request method is GET, return the form which will allow the user to
  # specify source email and destination.
  echo "Sending Your Email with Amazon SES.<br><form action=\"email-test.php\" method=\"POST\">Destination: <input name=\"destination[to]\" type=\"text\" value=\"\"/><br>Cc: <input name=\"destination[cc]\" type=\"text\" value=\"\"/><br>Bcc: <input name=\"destination[bcc]\" type=\"text\" value=\"\"/><br>Subject: <input name=\"subject\" type=\"text\" value=\"\"/><br>Message: <textarea name=\"message\" cols=\"40\" rows=\"5\"></textarea><br>Source: <input name=\"source\" type=\"text\" value=\"{$source_email}\"/> (<a href=\"http://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-email-api.html\"> Using the Amazon SES API to Send Email</a>)<br><input type=\"submit\" value=\"Send Email\" /></form>";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # If the request method is POST, send an email using the posted data.
  $result = send_email($ses_client, $_POST['source'], $_POST['destination'], $_POST['subject'], $_POST['message']);
  
  # Output the result.
  echo '<PRE>';
  echo "Email has been sent:\n";
  echo json_encode($result, JSON_PRETTY_PRINT);
  echo '</PRE>';
}
?>
</body>
</html>
