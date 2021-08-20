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


$browser = get_browser();
if (strtolower($browser->browser) == 'safari') {

}
const Update = TRUE;
include_once('./adminarea/JudgeClass.php');
include_once('./adminarea/UsersDetails.php');

    $cup = new JudgeClass();

    // First things first get the users details.
    $print = new UsersDetails();
    $print->printlables();

    $userlist = new UsersDetails();
    $userlist->listusers();

    $usersname = new UsersDetails();

    $error = new JudgeClass();
    $error->warning();

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
                        <a class="nav-link active" data-scroll href="#home">Home</a>
                    </li>
                   <!--
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="#classes">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="rules.php?content=rules_text">Rules</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="downloads/2021_programme.pdf" target="_blank">Printable Programme</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END navbar-->

        <!-- Hero -->
        <div id="home" class="hero-img">
            <img src="images/event/hero_print.jpg" class="img-fluid" >
        </div>
        <!--END hero -->

        <!-- About
        <div id="about">
            <div class="half-image-content bg-faded">
                <div class="content-img bg-parallax pos-left visible-lg-down" data-jarallax='{"speed": 0.2}' style="background:url(images/event/about.jpg)"></div>

                <img src="images/event/about.jpg" class="hidden-lg-up img-fluid hidden-md-down" alt="">

                <div class="container">
                   <div class="row">
                        <div class="col-lg-6 ml-auto    pt10 pb10">
                        <?php //include_once('about_text.php')?>
                            <br>
                            <h5 class="font700">Judging starts in:</h5>
                            <div class="count-down text-white" data-end-date="Aug 14, 2021 11:00:00"></div>
                    </div>
                   </div>
                </div>
            </div>
        </div> -->
        <!--END about-->

        <!-- SCHEDULE of EVENTS
        <div id="schedule" class="pt20 pb20">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 mr-auto ml-auto text-center">
                            <h2 class="text-center mb20">Schedule Of Events</h2>

                        <ul class="nav tabs-schedule nav-tabs list-inline" role="tablist">
                            <li role="presentation" class="nav-item"><a class="nav-link active" href="#01" aria-controls="01" role="tab" data-toggle="tab">Thursday 12th<span>Collection of Show Exhibitor Cards</span></a></li>
                            <li role="presentation" class="nav-item"><a class="nav-link" href="#02" aria-controls="02" role="tab" data-toggle="tab">Friday 13th<span>Entries taken to the Village Hall </span></a></li>
                            <li role="presentation" class="nav-item"><a class="nav-link" href="#03" aria-controls="03" role="tab" data-toggle="tab">Saturday 14th<span>The Flower and Vegetable Show</span></a></li>
                        </ul>
                    </div>
                </div>
               <?php //include_once('schedule_text.php') ?>
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
        </div>-->
        <!-- END SCHEDULE of EVENTS -->


        <!--
        <div class="pt100 pb10 parallax-overlay bg-parallax" data-jarallax='{"speed": 0.4}' style='background-image: url("images/event/bg1.jpg")'>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-cup text-white fa-2x"></i>
                        <h2 class="text-white display-4">13</h2>
                        <p class="text-white-gray h4 font700 text-center">Prizes and Trophies</p>
                    </div>
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-bookmark text-white fa-2x"></i>
                        <h2 class="text-white display-4">63</h2>
                        <p class="text-white-gray h4 font700 text-center">Classes</p>
                    </div>
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-flag text-white fa-2x"></i>
                        <h2 class="text-white display-4">10</h2>
                        <p class="text-white-gray h4 font700 text-center">Sponsors</p>
                    </div>
                    <div class="col-md-6 col-lg-3 mb30 text-center">
                        <i class="ti-user text-white fa-2x"></i>
                        <h2 class="text-white display-4">5</h2>
                        <p class="text-white-gray h4 font700 text-center">Age groups</p>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- End facts-->

        <!--Prizes and Trophies-->
        <div class="pt20 pb70" data-jarallax='{"speed": 0.4}' style='background-color: gray'>
            <div class="container">
                <div class="container pt-2 pb-5">
                    <h2 class="text-white">Results of Cups and Awards </h2>
                     <table class="table table-hover text-white" style="font-size: 1.2em;">
                        <thead>
                        <tr>
                            <th scope="col">CUP/AWARD</th>
                            <th scope="col">TO BE PRESENTED BY</th>
                            <th scope="col">Point Count</th>
                            <th scope="col">Exh. No</th>
                            <th scope="col">WINNER’S NAME</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and include = 1');  ?>
                            <td><b>THE HARRY SEYMOUR CUP</b><br>
                                Best In Show (most overall points)
                            </td>
                            <td>Mr & Mrs Julian Seymour</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                                <?php // Draw check
                                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and include = 1');  ?>
                            <td><b>THE ADRIAN LEVER CUP</b><br>
                                Runner-up Best In Show (second most points)
                            </td>
                            <td>Gen. Sanders</td>
                            <td><?= $winner->secondscore ?> </td>
                            <td><?= $winner->secondkey ?></td>
                            <td><?= $winner->secondscore == "" ? "TBA" : $usersname->usersname($winner->secondkey); ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (1, 2)');  ?>
                            <td><b>THE SIMON MASTER CUP</b><br>
                                Winner of Rose Classes (most points in classes 1 and 2)
                            </td>
                            <td>Georgina Master</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td>65</td>
                            <td>Jo Cumberlege</td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (3)');  ?>
                            <td><b>THE DOUGLAS MORRIS CUP</b><br>
                                Best 5 stems of mixed perennials (Class 3)
                            </td>
                            <td>Gen. Sanders</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (1,2,3,4,5,6,7,8,9,10,11,12)');  ?>
                            <td><b>THE BATTLE TROPHY</b><br>
                                Most points accumulated in flower classes 1 to 12
                            </td>
                            <td>Ben Battle</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                                <?php // Draw check
                                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $cup = new JudgeClass(); ?>
                            <td><b>THE ANTHONY CLAYDON MEMORIAL CUP
                                </b><br>
                                Most outstanding exhibit in vegetable classes 13 to 27
                            </td>
                            <td>Mrs Claydon</td>
                            <td>N/A</td>
                            <td><?= $cup->cupwinner('4') ?></td>
                            <td><?= $cup->cupwinner('4') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('4'));  ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); ?>
                            <td><b>THE 100 YARDS CUP
                                </b><br>
                                Most extraordinary novelty vegetable in classes 29 to 33
                            </td>
                            <td>Gen. Sanders</td>
                            <td>N/A</td>
                            <td><?= $cup->cupwinner('5') ?></td>
                            <td><?= $cup->cupwinner('5') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('5'));  ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (34,35,36,37,38,39,40,41,42,43,44,45,46)');  ?>
                            <td><b>THE CAROLINE HYDE CUP</b><br>
                                Most points accumulated in home produce classes 34 to 46
                            </td>
                            <td>Mr & Mrs Richard Hyde</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                                <?php // Draw check
                                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); ?>
                            <td><b>THE CHARLIE CUMBERLEGE CUP</b><br>
                                The best jam or jelly from classes 34 and 37
                            </td>
                            <td>Jo Cumberlege</td>
                            <td>N/A</td>
                            <td><?= $cup->cupwinner('7') ?></td>
                            <td><?= $cup->cupwinner('7') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('7'));  ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (47)');  ?>
                            <td><b>THE HELEN LEVER CUP</b><br>
                                To the winner of class 47 – child aged 3 to 4
                            </td>
                            <td>Helen Lever</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?></td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (48, 49, 50, 51, 52)');  ?>
                            <td><b>THE VILLAGE HALL SHIELD</b><br>
                                Most points accumulated in classes 48 to 52 – ages  5 to 9
                            </td>
                            <td>Gen. Sanders</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>

                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (53,54,55,56,57)');  ?>
                            <td><b>THE GARDEN CLUB SHIELD</b><br>
                                Most points accumulated in classes 53 to 57 – ages 10 to 14
                            </td>
                            <td>Gen. Sanders</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                                <?php // Draw check
                                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); $winner->winers('and id in (58)');  ?>
                            <td><b>SPECIAL AWARD FOR POSTER DESIGN - £15</b><br>
                                For a child aged from 5 to 14
                            </td>
                            <td>Gen. Sanders</td>
                            <td><?= $winner->firstscore ?> </td>
                            <td><?= $winner->firstkey ?></td>
                            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                                <?php // Draw check
                                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <?php $winner = new JudgeClass(); ?>
                            <td><b>THE HUNTER CUP</b><br>
                                Best photograph as voted for by the public
                            </td>
                            <td>Charlie & Theresa Hunter</td>
                            <td>N/A</td>
                            <td><?= $cup->cupwinner('13') ?></td>
                            <td><?= $cup->cupwinner('13') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('13'));  ?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
            </div>
        </div><!--Prizes and Trophies-->
        <!-- END Prizes and Trophies-->

        <!-- classes -->
        <div class="bg-dark pt20 pb60" id="classes">
            <div class="container pb-5">
               <?php include_once('classes_text.php') ?>
            </div>
        <!-- END classes -->

            <!--Organising Committee-->
            <div id="scarecrows" class="pt20 pb20 bg-faded">
                <div class="container">
                    <h2 class="text-center mb20">Scarecrow Competition</h2>

                    <ul>

                        <li>Winner: Clare Erryn of The Street</li>

                    </ul>

                </div>
            </div>
            <!--End Organising Committee-->

            <!--Organising Committee-->
            <div id="committee" class="pt20 pb20 bg-faded">
                <div class="container">
                    <?php include_once('committee.php') ?>
                </div>
            </div>
            <!--End Organising Committee-->




            <!--
            <div id="scarecrows">
                <div class="half-image-content bg-faded">
                    <div class="content-img bg-parallax pos-left hidden-md-down" data-jarallax='{"speed": 0.2}' style="background:url(images/event/scarecrows.jpg) no-repeat;">
                    </div>
                    <img src="images/event/scarecrows.jpg" class="visible-lg-down hidden-lg-up img-fluid" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 ml-auto  pt10 pb30">
                                <h2 class="text-center mb20">Scarecrow Competition Guidelines</h2>
                                <?php // include_once('scarecrow_competition_text.php')?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
          END facilities-->

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
                            <button type="submit" class="btn btn-primary btn-block"><Enter></Enter></button>
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
