<?php


const flower = TRUE;
include_once("define.php");
include_once(OUTOFROOT . 'config.php');
include_once ("Classes/functions.php");
include_once ("Classes/Sql.php");

$content = $_REQUEST['content'] . ".php";

include_once ("Classes/Prizes.php");

$prizes = new Prizes();
$prizes->list_prizes();

include_once ("Classes/Scheduleclass.php");
$scheduleclass = new Scheduleclass();

$brochure_show = "active show";

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
    <a class="navbar-brand" href="index.php">
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

<div class="container pt100 brochure">
    <div id="dispatchcont">
        <img src="./images/event/hero_print.jpg" class="img-fluid">
            <?php include_once('about_text.php'); ?>
        <div class="break"></div>
        <?php include_once('committee.php'); ?>

            <div class="break"></div>

            <h2 class="mb20 text-center">Schedule Of Events</h2>
            <?php include_once('schedule_text.php'); ?>

            <div class="break"></div>
            <?php include_once('prizes_text.php'); ?>

            <div class="break"></div>
            <?php include_once('classes_text.php'); ?>

            <?php include_once('scarecrow_competition_text.php'); ?>

            <div class="break"></div>
            <h2 class="mb20 text-center">Cake Recipes</h2>
            <?php include_once('dorset_apple_cake_text.php'); ?>

            <div class="break"></div>
            <?php include_once('frosted_courgette_and_lemon_cake_text.php'); ?>

            <div class="break"></div>
            <?php include_once('rules_text.php'); ?>

            <div class="break"></div>
            <?php include_once('sponsors_text.php'); ?>

    </div>
</div>

<?php include_once('footer.php') ?>

<!--register modal-->
<!-- Modal -->
<div class="modal fade modal-event-form" id="ticketsModal" tabindex="-1" role="dialog" aria-labelledby="ticketsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ti-close"></i></span>
                </button>
            </div>
            <form action="index.php" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb10">
                            <input type="text" class="form-control" placeholder="Name" required="">
                        </div>
                        <div class="col-md-12 mb10">
                            <input type="text" class="form-control" placeholder="Email address" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- back to top  -->
<a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="js/plugins/plugins.js"></script>
<script src="js/event.custom.js"></script>
<script src="js/googlemap.js"></script>
<script src="js/printpage.js"></script>

</body>
</html>

