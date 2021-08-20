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

<script src='../js/jquery-3.3.1.js'></script>

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

    <div >
        <h3><a href="judging-flowers.php">Flowers</a></h3>
        <p>Classes 1 - 12</p>
    </div>
    <div>
        <h3><a href="judging-vegetables.php">Vegetables</a></h3>
        <p>Including Novelty Vegetables</p>
        <p>Classes 13 - 33</p>
    </div>

    <div>
        <h3><a href="judging-home-produce.php">Home Produce</a></h3>
        <p>Classes 34 - 46</p>
    </div>

    <div>
        <h3><a href="judging-children.php">Children's Classes</a></h3>
        <p>Classes 47 - 58</p>
    </div>

    <div>
        <h3><a href="judging-photography.php">Photography and Scarecrow</a></h3>
        <p>Classes 59 - 63</p>
    </div>

    <div>
        <h3><a href="judging-results.php">Results</a></h3>
        <p>All Classes</p>
    </div>


</div>
</body>
</html>

