<?php

// First things first get the users details.
    $users = new UsersDetails();
    $users->udid = $_SESSION['signin'];
    $users->Userdetail();
    foreach ($users->data_array as $userdata);

    if($userdata['role'] != 1){

        $location .= "/signin/signout.php";
        header("Location: $location");
        exit;
    }
