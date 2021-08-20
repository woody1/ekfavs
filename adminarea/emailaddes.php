<?php

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');
include_once('../Classes/Sql.php');
include_once('../Classes/functions.php');
const Update = TRUE;
include_once('UsersDetails.php');

$showemails = new UsersDetails();
$showemails->emailsadds();






