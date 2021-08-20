<?php

// first we define a constant PASSWORD
define('thefooter', TRUE);
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');

// get the settings
include_once(OUTOFROOT. "emailsettings.php");

//SMTP needs accurate times, and the PHP time zone MUST be set
date_default_timezone_set('Etc/UTC');

// load PHP mailer
include_once("../PHPMailer/PHPMailerAutoload.php");

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
//$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = $smtp_host;
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = $smtp_port;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = $smtp_secure;

//Whether to use SMTP authentication
$mail->SMTPAuth = $smtp_auth;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $smtp_username;

//Password to use for SMTP authentication
$mail->Password = $smtp_password;

//Set who the message is to be sent from
$mail->setFrom($from_email, $from_name);

//Set an alternative reply-to addressabweb.emails@gmail.com
$mail->addReplyTo($from_email, $from_name);

//Set who the message is to be sent to
$mail->addAddress($to_email, $to_name);

// take the emails from the testing email text box and send as cc
if ($_POST['send_email'] == "Testing" and $_POST['email_test'] != '') {

    $email_test = trim($_POST['email_test']);
    $email_test = rtrim($email_test, ',');

    $emailarray = explode(',', $email_test);
    foreach ($emailarray as $value) {
        $mail->AddCC($value, $cc_name);
    }
}

//$mail->addAddress($cc_email, $cc_name);
$mail->AddCC("juliatucker@btinternet.com", "Julia Tucker");

//Set the subject line
$mail->Subject = $subject;

//body text ---
ob_start();

include("pm-header.php");
include("pm-template.php"); //execute the file as php
include("pm-footer.php");
$body = ob_get_clean();

$mail->msgHTML($body);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';


//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {

    echo "SENT";
   //echo "Email message sent! $to_email";
}
