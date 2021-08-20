<?php

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

define('olivetree', TRUE);
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');


        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        // 4 = Big lots of stuff
        $mail->SMTPDebug = 4;

        //Set the hostname of the mail server
        $mail->Host = $mailHost;

        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 25;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Username to use for SMTP authentication
        $mail->Username = $mailUsername;

        //Password to use for SMTP authentication
        $mail->Password = $mailPassword;

        //Set who the message is to be sent from
        $mail->setFrom($fromAddress, $fromName);

        //Set an alternative reply-to address
        $mail->addReplyTo($fromAddress, $fromName);

        //Set who the message is to be sent to
        $mail->addAddress('woody@abweb.co.uk', '$firstname $lastname');

        //Set the subject line
        $mail->Subject = 'TEST. Order number ' . $checkout->last_id;

        ob_start();
        include '../email-bodyies/email-shopper.php'; //execute the file as php
        $body = ob_get_clean();
        $mail->msgHTML($body);

        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Sent :) ';
        }





















