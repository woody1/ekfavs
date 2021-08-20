<?php session_start();

include_once("../entry_form/cookie.php");

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');
include_once("../Classes/functions.php");
include_once("../Classes/Sql.php");
const Update = TRUE;
include_once("UsersDetails.php");
include_once("secure.php");
include_once('../Classes/functions.php');
include_once('JudgeClass.php');

$cup = new JudgeClass();

// First things first get the users details.
$print = new UsersDetails();
$print->printlables();

$userlist = new UsersDetails();
$userlist->listusers();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= PAGE_TITLE ?></title>
    <link rel="stylesheet" type="text/css" href="DataTables/jquery.dataTables.css">
    <link href="../css/plugins/plugins.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../js/datatables.js"></script>
    <script type="text/javascript" src="DataTables/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {
            $('.judgeme').submit(function (event) {
                event.preventDefault();
                const theForm = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'judgesql.php',
                    data: $(theForm).serialize(), // serializes the form's elements.
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.cup').submit(function (event) {
                event.preventDefault();
                const theForm = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'cupsql.php',
                    data: $(theForm).serialize(), // serializes the form's elements.
                });
            });
        });
    </script>



    <style>

        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            margin: 0;
            width: 50px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>

</head>
<body data-spy="scroll" data-offset="58" data-target="#navbarevent">
<!--
<div id="preloader">
    <div id="preloader-inner"></div>
</div>
-->

<?php include_once("nav.php") ?>

<div class="container pt100">

    <div class="text-center">
        <h2>JUDGING FORM</h2>

        <h3 class="text-uppercase">Home Produce</h3>
    </div>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Class</th>
        <th scope="col">First</th>
        <th scope="col">Second</th>
        <th scope="col">Third</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $scheduleclass = new JudgeClass();
    $scheduleclass->list_class('Home Produce', '',''); ?>

    </tbody>
</table>

    <hr>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col"><h3>Charlie Cumberlege Cup</h3></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <form id='p7' class='cup' action=''>
            <tr>
                <th>Please identify the exhibit you judge the most outstanding jam or jelly (classes 34 & 37)</th>
                <th><input type='number' name='st' value='<?php $cup->list_prizes('7'); echo $cup->winner; ?>' class='judgeme'></th>
                <th><input hidden name='id' value='7'><input type='submit' value='Add'></th>
            </tr>
        </form>
        </tbody>
    </table>

        <a href="judging.php"> <button class="btn btn-outline-primary">Done</button></a>

    </div>
</body>
</html>

