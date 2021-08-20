<?php

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');
include_once('../Classes/Sql.php');
include_once('../Classes/functions.php');

$id = clean($_POST['id']);
$st = clean($_POST['st']);
$nd = clean($_POST['nd']);
$rd = clean($_POST['rd']);

$setaccount = new Sql();
$setaccount->sql = "update classes set 1st = $st, 2nd = $nd, 3rd = $rd where id = $id";
$setaccount->update_sql();
