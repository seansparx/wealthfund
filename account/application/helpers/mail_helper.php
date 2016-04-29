<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once __DIR__ . '../../../vendor/autoload.php';

use Aws\Ses\SesClient;

function email_send($to, $subject, $message) 
{
    $from_email = 'noreply@wealthfund.in';
    
    # Region where the sample will be run.
    $region = 'us-east-1';

    # Create the client for Simple Email Service.
    $ses_client = SesClient::factory(array(
                'credentials' => array(
                    'key' => 'AKIAJQCAN6JJ4ZBJ6W4A',
                    'secret' => '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',
                ),
                'region' => $region,
                'version' => 'latest'));

    $result = ses_email($ses_client, $from_email, $to, $subject, $message);
    return $result;
}



function ses_email($ses_client, $source, $to, $subject, $message) 
{
    try {
        $to = array($to);
        $bcc = array();
        $cc = array();

        $destination = array(
            'BccAddresses' => $bcc,
            'CcAddresses' => $cc,
            'ToAddresses' => $to );

        // Setup message body
        $body = array(
            'Html' => array(
                'Charset' => 'UTF-8',
                'Data' => $message,
            )
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
            'Source' => $source
        );

        return $ses_client->sendEmail($request)->toArray();
    } 
    catch (Exception $e) {
        return $e->getMessage();
    }
}

?>
