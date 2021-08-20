<?php

$location .= "/signin/signout.php";

if (!isset($_SESSION['signin'])  or $_SESSION['timer'] < time()){
    header("Location: $location");
    exit;
}else{
    $_SESSION['timer'] = time() + 3600;
}
