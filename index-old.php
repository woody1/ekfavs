<?php

const flower = TRUE;
include_once("define.php");
include_once(OUTOFROOT . 'config.php');
include_once ("Classes/functions.php");
include_once ("Classes/Sql.php");

include_once ("Classes/Prizes.php");
$prizes = new Prizes();
$prizes->list_prizes();

include_once ("Classes/Scheduleclass.php");
$scheduleclass = new Scheduleclass();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
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
                        <a class="nav-link active" data-scroll href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#committee">Committee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#classes">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#sponsors">Sponsors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="rules.php?content=rules_text">Rules</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="downloads/2021_programme.pdf" target="_blank">Printable Programme</a>
                    </li>


                </ul>
            </div>
        </nav>
        <!-- END navbar-->

        <!-- Hero -->
        <div id="home" class="fullscreen-hero bg-overlay bg-parallax" data-jarallax='{"speed": 0.4}'>
            <!-- <div class="hero-content">
                <div class="hero-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 text-center mr-auto ml-auto">
                                <div class="social-buttons">
                                   <a data-scroll href="#pricing" class="btn btn-lg btn-primary btn-rounded mr-3">Booking Open</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!--END hero -->

        <!-- About-->
        <div id="about">
            <div class="half-image-content bg-faded">
                <div class="content-img bg-parallax pos-left hidden-md-down" data-jarallax='{"speed": 0.2}' style="background:url(images/event/about.jpg) no-repeat;">
                </div>
                <img src="images/event/about.jpg" class="visible-lg-down hidden-lg-up img-fluid" alt="">
                <div class="container">
                   <div class="row">
                        <div class="col-lg-6 ml-auto    pt10 pb10">
                        <?php include_once('about_text.php')?>
                            <br>
                            <h5 class="font700">Judging starts in:</h5>
                            <div class="count-down text-white" data-end-date="Aug 14, 2021 11:00:00"></div>
                    </div>
                   </div>
                </div>
            </div><!--half image section-->
        </div>
        <!--END about-->

        <!-- SCHEDULE of EVENTS -->
        <div id="schedule" class="pt20 pb20">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 mr-auto ml-auto text-center">
                            <h2 class="text-center mb20">Schedule Of Events</h2>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-schedule nav-tabs list-inline" role="tablist">
                            <li role="presentation" class="nav-item"><a class="nav-link active" href="#01" aria-controls="01" role="tab" data-toggle="tab">Thursday 12th<span>Collection of Show Exhibitor Cards</span></a></li>
                            <li role="presentation" class="nav-item"><a class="nav-link" href="#02" aria-controls="02" role="tab" data-toggle="tab">Friday 13th<span>Entries taken to the Village Hall </span></a></li>
                            <li role="presentation" class="nav-item"><a class="nav-link" href="#03" aria-controls="03" role="tab" data-toggle="tab">Saturday 14th<span>The Flower and Vegetable Show</span></a></li>
                        </ul>
                    </div>
                </div>
               <?php include_once('schedule_text.php') ?>
                <div class="row">
                    <div class="col-sm-8 mr-auto ml-auto text-center">
                        <div class="center-title mb60">
                            <hr>
                            <h3>Important Note:</h3>
                            <p> Every exhibit must be accompanied by an official Show Exhibitor Card provided by the Show Stewards. Each card will indicate the exhibitor’s individual number and class number. Exhibitors are responsible for placing their card by their exhibit with their number uppermost.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END SCHEDULE of EVENTS -->

        <!--Organising Committee-->
        <div id="committee" class="pt20 pb20 bg-faded">
            <div class="container">
                <?php include_once('committee.php') ?>
            </div>
        </div>
        <!--End Organising Committee-->

        <!--facts-->
        <div class="pt100 pb10 parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("images/event/bg1.jpg")'>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-cup text-white fa-2x"></i>
                        <h2 class="text-white display-4">13</h2>
                        <p class="text-white-gray h4 font700 text-center">Prizes and Trophies</p>
                    </div><!--/.col-->
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-bookmark text-white fa-2x"></i>
                        <h2 class="text-white display-4">63</h2>
                        <p class="text-white-gray h4 font700 text-center">Classes</p>
                    </div><!--/.col-->
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-flag text-white fa-2x"></i>
                        <h2 class="text-white display-4">10</h2>
                        <p class="text-white-gray h4 font700 text-center">Sponsors</p>
                    </div><!--/.col-->
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-user text-white fa-2x"></i>
                        <h2 class="text-white display-4">5</h2>
                        <p class="text-white-gray h4 font700 text-center">Age groups</p>
                    </div><!--/.col-->
                </div>
            </div>
        </div><!--facts-->
        <!-- End facts-->

        <!--Prizes and Trophies-->
        <div class="pt20 pb70" data-jarallax='{"speed": 0.4}' style='background-color: gray'>
            <div class="container">
                <?php include_once('prizes_text.php') ?>
            </div>
        </div><!--Prizes and Trophies-->
        <!-- END Prizes and Trophies-->

        <!-- classes -->
        <div class="bg-dark pt20 pb60" id="classes">
            <div class="container pb-5">
               <?php include_once('classes_text.php') ?>
            </div>
        <!-- END classes -->

        <!--scarecrows-->
        <div id="scarecrows">
            <div class="half-image-content bg-faded">
                <div class="content-img bg-parallax pos-left hidden-md-down" data-jarallax='{"speed": 0.2}' style="background:url(images/event/scarecrows.jpg) no-repeat;">
                </div>
                <img src="images/event/scarecrows.jpg" class="visible-lg-down hidden-lg-up img-fluid" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 ml-auto  pt10 pb30">
                            <?php include_once('scarecrow_competition_text.php')?>
                            <h4>SCARECROW ENTRY FORM available on 1st August</h4>
                        </div>
                    </div>
                </div>
            </div><!--half image section-->
        </div>
        <!--END facilities-->

        <!--sponsors-->

            <div id="sponsors" class="pt20 pb20 bg-faded">
                <div class="container">
                    <?php include_once('sponsors_text.php') ?>
                </div>
            </div>


        <!--Map-->
        <div id="map" style="width: 100%;height: 350px;"></div>
        <!--END Map-->

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
        <!--back to top  -->
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="js/plugins/plugins.js"></script>
        <script src="js/event.custom.js"></script>
        <script src="js/googlemap.js"></script>
            <script src="js/printpage.js"></script>

        <!--google map-->
        <script async src="https://maps.googleapis.com/maps/api/js?key=<?= $apikey ?>&callback=initMap"></script>

    </body>
</html>
