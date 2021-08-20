<?php session_start();

// Cookies: // Kicks you out.
    include_once ("cookie.php");

    const flower = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/functions.php");
    include_once ("../Classes/Sql.php");
    const Update = TRUE;
    include_once ("ViewUsers.php");
    include_once ("Update.php");

// Add password:
    if($_POST['pw'] == 'nw') {
        $addpass = new Update();
        $addpass->udid = $_SESSION['signin'];
        $addpass->new_password = clean($_POST['password']);
        $addpass->add_password();
    }


//Add Scarecrow
if(($_POST['button'] == "addscare") and ($_POST['sc'] == "add")) {
    //Add a new user
    $addsc = new Update();
    $addsc->udid = $_POST['udid'];
    $addsc->scarecrow_name = $_POST['scarecrow_name'];
    $addsc->home_name_number = $_POST['home_name_number'];
    $addsc->home_street = $_POST['home_street'];
    $addsc->home_postcode = $_POST['home_postcode'];
    $addsc->add_scarecrow();
}

// First things first get the users details.
    $users = new ViewUsers();
    $users->udid = $_SESSION['signin'];
    $users->Userdetail();
    foreach ($users->data_array as $userdata);

    if(($_POST['button'] == "adduser") and ($_POST['nu'] == "add")) {
        //Add a new user
        $adduser = new Update();
        $adduser->household = $userdata['id'];
        $adduser->firstname = encrypt($_POST['firstname']);
        $adduser->lastname = encrypt($_POST['lastname']);
        $adduser->age = $_POST['age'];
        $adduser->add_user();
    }


// Get  Add Scarecrow details
    $users = new ViewUsers();
    $users->household = $userdata['household'];
    $users->users_contact();
    foreach ($users->data_array as $contact);

// List all members of the house hold.
    $listusers = new ViewUsers();
    $listusers->household = $userdata['id'];
    $listusers->userlist();

    if($userdata['password'] == "") {$form = 'nopass';}else{
        $form = clean($_POST['button']);
    }

// Get the data from invoice table
    $invoice = new ViewUsers();
    $invoice->household = $userdata['id'];;
    $invoice->invoice();
    foreach ($invoice->data_array as $invoicedata);

    // Calculate how much is owed:
    $owed = $listusers->total_cost - $invoicedata['total_amount'];



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= PAGE_TITLE ?></title>
        <!-- Plugins CSS -->
        <link href="../css/plugins/plugins.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">

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
                        <a class="nav-link active" data-scroll href="../index.php#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="./index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="./index.php#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="./index.php#committee">Committee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="./index.php#classes">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-scroll href="./index.php#sponsors">Sponsors</a>
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
                <h3>East Knoyle Flower and Vegetable Show</h3>
            </div>

          <h4>Hi <?= decrypt($userdata['firstname']) ?></h4>

            <?php

            switch ($form) {
                case "nopass":
                    include_once('form_password.php');
                    break;
                case "new":
                    include_once('form_newuser.php');
                    break;
                case "scarecrow":
                    include_once('scarecrow.php');
                    break;
                default:
                     include_once('form_main.php');
            }

            ?>

        </div>
        <hr class="mb50">

        <?php include_once('../footer.php')?>

        <!--back to top  -->
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="../js/plugins/plugins.js"></script>
        <script src="../js/event.custom.js"></script>
        <script src="../js/googlemap.js"></script>
        <script src="../js/printpage.js"></script>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script src="../js/paypal-checkout.js"></script>

        <!--google map-->
        <script async src="https://maps.googleapis.com/maps/api/js?key=<?= $apikey ?>&callback=initMap"></script>

    </body>
</html>
