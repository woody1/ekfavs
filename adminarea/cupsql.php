<?php

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');
include_once('../Classes/Sql.php');
include_once('../Classes/functions.php');

$id = clean($_POST['id']);
$st = clean($_POST['st']);

$setaccount = new Sql();
$setaccount->sql = "update prizes set winner = $st where id = $id";
$setaccount->update_sql();
