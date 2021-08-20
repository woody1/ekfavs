<?php session_start();

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');
include_once(OUTOFROOT . 'emailsettings.php');


//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('../ga.php') ?>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= PAGE_TITLE ?></title>
        <!-- Plugins CSS -->
        <link href="../css/plugins/plugins.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">

    </head>

    <body>


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
                   <a class="nav-link active" data-scroll href="/">Home</a>
               </li>

               <li class="nav-item">
                   <a class="nav-link" data-scroll href="../index.php#schedule">Schedule</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" data-scroll href="../index.php##classes">Classes</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" data-scroll href="rules.php?content=rules_text">Rules</a>
               </li>

               <li class="nav-item">
                   <a class="nav-link" data-scroll href="downloads/2021_programme.pdf" target="_blank">Printable Programme</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" data-scroll href="/signin/">Sign In</a>
               </li>

           </ul>
       </div>
   </nav>
   <!-- END navbar-->
        <!-- start form -->

        <div class="page-titles title-gray pt30 pb20">
            <div class="container">
                <div class="row">
                    <div class=" col-md-12 mt-5">
                        <h3>Create a new household</h3>
                        <p>Use this form for both the Flower & Vegetable Show and the Scarecrow Competition.</p>
                    </div>
                </div>
            </div>
        </div><!--page title end-->
        <div class="container mb40">
            <div class="row">
                <div class="col-md-12 mb40">

                    <?php

                    include_once("../Classes/functions.php");

                    if ($_POST['nb'] == "cc") {

                        if (validate_name(clean($_POST['firstname'])) === FALSE) {$send = 'no';}else{$send = 'yes';}
                        if (validate_name(clean($_POST['lastname'])) === FALSE) {$send = 'no';}else{$send = 'yes';}

                    }



                    if (($_POST['nb'] != "cc") or ($send == 'no')) {

                        include_once("form.php");


                    } elseif (($_POST['nb'] == "cc") and $send == 'yes') {

                        define('Create', TRUE);
                        include_once("Create.php");
                        $udid = md5(uniqid(session_id(), true));
                        $create_no = sprintf("%06d", mt_rand(1, 999999));

                        $create = new Create();
                        $create->firstname = openssl_encrypt(clean($_POST['firstname']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
                        $create->lastname = openssl_encrypt(clean($_POST['lastname']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
                        $create->email = $_POST['email'];
                        $create->create_no = $create_no;
                        $create->udid = $udid;
                        $create->ip_address = $_SERVER['REMOTE_ADDR'];
                        $create->status = $_POST['status'];

                        $create->insert_user();

                        if ($create->entry_added == 'NO') {

                            include_once("../mail/body-already-account.php");

                        }elseif ($create->entry_added == 'YES') {

                            include_once("../mail/body-confirm-account.php");

                        }


                        ////==============================================================
                        //// send email
                        //Send email to
                        $to_email = clean($_POST['email']);
                        //Title of form
                        $title = 'Create Update Account';
                        //Set the subject line
                        $subject = "Confirmation Code";
                        // The USID if the same as the udid.
                        $usid = $udid;

                        include("../mail/sendemail.php");

                        ?>
                        <h4>Please enter the Confirmation Code that has just been emailed to you:</h4>

                    <form id="contact" action="../signin/confirm.php" method="post">
                        <div class="form-group col-md-8">
                            <label for="lastname"></label>
                            <input class="form-control" id="create_no" name="create_no" required placeholder="Confirmation Code">
                        </div>

                        <div class="form-group col-md-8 mt20">
                            <input type="hidden" name="nb" value="cc">
                            <input type="hidden" name="create" value="new">
                            <input type="hidden" name="email" value="<?= $_POST['email'] ?>">
                            <button class="btn btn-primary" id="submitButton" data-badge="inline" >Submit</button>
                        </div>
                    </form>

                <h5>Not received an email:</h5>

                <ol class="mb20">
                    <li>Wait a few minutes.</li>
                    <li>Check your spam folder/junk email.</li>
                    <li>If you are still having problems email - <a href="mailto:help@ekfavs.co.uk?subject=Problem%20with%20Confirming%20Account&body=Can%20you%20please%20resend%20Confirmation%20details%20to%20my%20email%20address.">help@ekfavs.co.uk</a></li>

                </ol>

                    <?php  } ?>
                </div>
            </div>
        </div>

            <hr class="mb50">

      <?php include_once('../footer.php')?>

        <script type="text/javascript">

            $("#password").password('toggle');

        </script>


        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="../js/plugins/plugins.js"></script>
        <script src="../js/event.custom.js"></script>
        <script src="../js/googlemap.js"></script>
        <script src="../js/printpage.js"></script>


    </body>
</html>
