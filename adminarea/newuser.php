<?php session_start();

    const flower = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/functions.php");
    include_once ("../Classes/Sql.php");
    const Update = TRUE;
    include_once("UsersDetails.php");
    include_once ("Update.php");

    // Cookies: // Kicks you out.
    include_once ("cookie.php");

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


    </head>

    <body data-spy="scroll" data-offset="58" data-target="#navbarevent">
        <!--
        <div id="preloader">
            <div id="preloader-inner"></div>
        </div>
  -->

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
                        <a class="nav-link active" data-scroll href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="index.php">List Exhibitors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="cards.php ">Exhibitor Cards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="../rules.php?content=rules_text">Rules</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END navbar-->

        <div class="container pt100">
            <div id="dispatchcont">
                <h3></h3>
            </div>


            <p>This form creates a new household / a new exhibitor.</p>

            <p>You can add more members to this household add classes in the next screen</p>

            <form id="contact" action="household.php" method="post">
                <div class="form-group col-md-8">
                    <label for="firstname"></label>
                    <input type="text" class="form-control" id="firstname" name="firstname"  placeholder="First Name" required>
                    <label for="lastname"></label>
                    <input type="text" class="form-control" id="lastname" name="lastname"  placeholder="Last Name" required>
                    <label for="age"></label>
                    <select name="age" id="age" class="form-control col-sm-12 col-lg-4 col-md-6" required>
                        <option value="">Age</option>
                        <?= $ageoption ?>
                        <option value="16">Adult</option>
                    </select>
                    <label for="email"></label>
                    <input type="text" class="form-control" id="email" name="email"  placeholder="Email, if they have one.">
                </div>

                <div class="form-group col-md-8 mt20">
                    <input type="hidden" name="nh" value="add">
                    <a href="index.php" class="btn btn-secondary" id="submitButton" data-badge="inline" name="button" value="">Cancel</a>
                    <button class="btn btn-primary" id="submitButton" data-badge="inline" name="button" value="adduser">Add</button>
                </div>
            </form>
        </div>

<div class="mb-5"></div>

        <!--back to top  -->
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->

        <script src="../js/event.custom.js"></script>
        <script src="../js/googlemap.js"></script>
        <script src="../js/printpage.js"></script>


        <!--google map-->
        <script async src="https://maps.googleapis.com/maps/api/js?key=<?= $apikey ?>&callback=initMap"></script>

    </body>
</html>
