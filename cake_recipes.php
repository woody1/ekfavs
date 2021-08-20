<?php


const flower = TRUE;
include_once("define.php");
include_once(OUTOFROOT . 'config.php');
include_once ("Classes/functions.php");
include_once ("Classes/Sql.php");

include_once ("Classes/Prizes.php");

$prizes = new Prizes();
$prizes->list_prizes();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <?php include_once('ga.php') ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>East Knoyle Flower & Vegetable Show</title>
    <!-- Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-offset="58" data-target="#navbarevent">
<!--/preloader-->
<div id="preloader">
    <div id="preloader-inner"></div>
</div>
<!--/preloader-->

<!-- NAV -->
<nav class="navbar navbar-expand-lg navbar-light bg-faded navbar-sticky navbar-transparent">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarevent" aria-controls="navbarevent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img src="images/" alt="" class="logo-first">
    </a>

    <div class="collapse navbar-collapse" id="navbarevent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-scroll href="index.php#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-scroll href="index.php#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-scroll href="index.php#schedule">Schedule</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-scroll href="index.php#committee">Committee</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-scroll href="index.php#classes">Classes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-scroll href="index.php#sponsors">Sponsors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-scroll href="rules.php?content=rules_text">Rules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-primary" href="#" onclick="printDiv('dispatchcont')"><i class="fa fa-print"></i>Print </a>
            </li>
        </ul>
    </div>
</nav>
<!-- END navbar-->


<div class="container pt100 pb100">
    <div id="dispatchcont">
        <?php
        $type = $_REQUEST['type'] . "_text.php";
        include_once($type)
        ?>
    </div>
</div>

<?php include_once('footer.php') ?>
<!--register modal-->

<!-- back to top  -->
<a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="js/plugins/plugins.js"></script>
<script src="js/event.custom.js"></script>
<script src="js/googlemap.js"></script>
<script src="js/printpage.js"></script>



</body>
</html>

