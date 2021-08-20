<?php


$smtp_host = "mail72.extendcp.co.uk";
$smtp_port = "587";
$smtp_auth = true;
$smtp_secure = 'Ssl';
$smtp_username = "noreply@theguildofmercersscholars.com";
$smtp_password = "TheWindisStrong@about12kts";
$from_email = "noreply@theguildofmercersscholars.com";
$from_name = "The Guild of Mercers Scholars";
$reply_to = "noreply@theguildofmercersscholars.com";
$reply_name = "Noone";

$to_email = "woody@abweb.co.uk";
$to_name = "woody";

$subject = "TEST";



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require  '../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $smtp_host;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = $smtp_auth;                                   // Enable SMTP authentication
    $mail->Username   = $smtp_username;                     // SMTP username
    $mail->Password   = $smtp_password;                               // SMTP password
    $mail->SMTPSecure = $smtp_secure; //PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $smtp_port;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($to_email, $to_name);     // Add a recipient
    $mail->addReplyTo($reply_to, $reply_name);
    $mail->addBCC('woody@abweb.co.uk');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;

    $email_body = "email-shopper.php";

    ob_start();
    include $email_body; //execute the file as php
    $body = ob_get_clean();
    $mail->msgHTML($body);

    $mail->AltBody = $altbody;

    $mail->send();
    echo 'You will receive a confirmation email shortly.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}