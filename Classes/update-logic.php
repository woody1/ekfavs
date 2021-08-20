<?php

// Stop a direct link to this page and any include pages
defined('woho') or die('Not with me my friend :D');

// TODO https://stackoverflow.com/questions/11821195/use-of-initialization-vector-in-openssl-encrypt

$_POST['email'] = openssl_encrypt(strtolower($_POST['email']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
$_POST['firstname'] = openssl_encrypt($_POST['firstname'], ENCRYPTION_METHOD, ENCRYPTION_KEY);
$_POST['middlename'] = openssl_encrypt($_POST['middlename'], ENCRYPTION_METHOD, ENCRYPTION_KEY);
$_POST['lastname'] = openssl_encrypt($_POST['lastname'], ENCRYPTION_METHOD, ENCRYPTION_KEY);
if($_POST['permissions'])  $_POST['permissions'] = array_sum($_POST['permissions']);
if($_POST['role'])  $_POST['role'] = array_sum($_POST['role']);

include_once("CRUDusers.php");
$update = new Users();
$update->post = $_POST;//type

if ($edit == "update"){
    $update->id = $_POST['id'];
    $update->update_user();

}elseif ($edit == "DELETE"){

    $update->delete_user();
    echo "<script>window.location = 'users-list';</script>";
}

