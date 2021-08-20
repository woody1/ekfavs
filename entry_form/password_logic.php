<?php
// Stop a direct link to this page and any include pages
defined('thefooter') or header( 'Location: /404');
define('Update', TRUE);



include_once ("Update.php");

$password = new Update();
$password->current_password = clean($_POST['current_password']);
$password->new_password = clean($_POST['new_password']);
$password->udid = $_SESSION['signin'];
$password->update_password();

