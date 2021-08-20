<?php session_start();

define('thefooter', TRUE);
include_once ("../Classes/functions.php");
include_once ("../Classes/Sql.php");
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GMS</title>
    <!-- Plugins CSS -->
    <link href="<?= _ROOT ?>css/plugins/plugins.css" rel="stylesheet">
    <link href="<?= _ROOT ?>css/style.css" rel="stylesheet">
</head>

<body>
<div id="preloader">
    <div id="preloader-inner"></div>
</div><!--/preloader-->

    <?php
    $addtonav = " navbar-transparent bg-faded nav-sticky-top";
    include_once('../nav.php');
    ?>

<!-- start form -->


<div class="page-titles title-gray pt30 pb20">
    <div class="container">
        <div class="row">
            <div class=" col-md-6">
                <h3>Resend activation code</h3>
            </div>
        </div>
    </div>
</div><!--page title end-->
<div class="container mb40">
    <div class="row">
        <div class="col-md-12 mb40">

            <?php include_once("form.php"); ?>

        </div>
    </div>
</div>

<hr class="mb50">


<?php include_once('../footer.php')?>


<!--back to top-->
<a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="<?= _ROOT ?>js/plugins/plugins.js"></script>
<script src="<?= _ROOT ?>js/assan.custom.js"></script>
</body>
</html>

