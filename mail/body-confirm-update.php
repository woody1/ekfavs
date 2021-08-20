<?php
$emailbody = "

<p>Dear $firstname </p>
<h2>Corrected link for your Guild of Mercers' Scholars Account</h2>

<p>Please click the updated link below to confirm your email address, set a password and manage your preferences.</p>
<p>Once signed in you can complete all of your details.</p>
<p>We will always try to send only items that are of relevance to you. In order to do this it is important that you select your preferences on your account management page. </p>


<h2><a href='" . _URL . "confirmaccount/?id=" . $udid . "'>Click  here to complete the activation process </a></h2>

";