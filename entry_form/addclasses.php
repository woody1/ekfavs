<?php session_start();

    if(!$_POST['memberid']) {
        header('Location: ../entry_form/');
        exit; }

    const flower = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/functions.php");
    include_once ("../Classes/Sql.php");
    const Update = TRUE;
    include_once ("ViewUsers.php");
    include_once ("Update.php");
    include_once ("Classes.php");
    $scheduleclass = new Classes();

    // Cookies: // Kicks you out.
    include_once ("cookie.php");

    // Update clases:
    if($_POST['nb'] == 'ud') {
        $clases = new Update();
        $clases->memberid = $_POST['memberid'];
        $clases->clases = serialize($_POST['class']);
        $clases->update_clases();

        header('Location: ../entry_form/');
        exit;
    }

    if($_POST['button'] == 'cancel') {

        header('Location: ../entry_form/');
        exit;
    }


// Update clases:
if($_POST['nb'] == 'age') {
    $clases = new Update();
    $clases->memberid = $_POST['memberid'];
    $clases->post = $_POST;
    $clases->post['firstname'] = encrypt($_POST['firstname']);
    $clases->post['lastname'] = encrypt($_POST['lastname']);
    $clases->update_user();

}

    // First things first get the users details.
    $member = new ViewUsers();
    $member->memberid = $_POST['memberid'];
    $member->memberdetail();
    foreach ($member->data_array as $memberdata);


    // List all members of the house hold.
    $listusers = new ViewUsers();
    $listusers->household = $userdata['id'];
    $listusers->userlist();

    if($userdata['password'] == "") {$form = 'nopass';}else{

        $form = clean($_POST['button']);
    }


/*
foreach($_POST['class'] as $x => $val) {
    clases "$x = $val<br>";
}

print_r($_POST['class']);

if (in_array("59", $_POST['class'])) {
    echo "Got Irix";
}

var_dump(count($_POST['class']));
*/
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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

        <div class="container pt100 pb100">
            <div id="dispatchcont">
                <h3>East Knoyle Flower and Vegetable Show</h3>
            </div>

          <h4>Details for <?= decrypt($memberdata['firstname']) ?> <?= decrypt($memberdata['lastname']) ?></h4>

            <i>Click the name or age to edit:</i>
            <form id="contact" class="form-row" action="" method="post">
                <?php  if ((validate_name(clean($_POST['firstname'])) === FALSE) and ($_POST['nb'] == 'cc')) {  ?>
                <div class="form-group alert-danger col-md-6">
                    <label for="firstname">Please check as First Name can only be letters.</label>
                    <?php }else{ ?>
                    <div class="form-group col-md-5">
                        <label for="firstname"></label>
                        <?php }  ?>
                        <input class="form-control" id="firstname" name="firstname" required placeholder="First name" value="<?= decrypt($memberdata['firstname']) ?>" onchange="this.form.submit()">
                    </div>

                    <?php  if ((validate_name(clean($_POST['lastname'])) === FALSE) and ($_POST['nb'] == 'cc')){  ?>
                    <div class="form-group alert-danger col-md-6">
                        <label for="lastname">Please check as Last Name can only be letters.</label>
                        <?php $send = 'no';}else{ ?>
                        <div class="form-group col-md-5">
                            <label for="lastname"></label>
                            <?php }  ?>
                            <input class="form-control" id="lastname" name="lastname" placeholder="Last name" required value="<?= decrypt($memberdata['lastname']) ?>" onchange="this.form.submit()">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="age" ></label>
                            <select name="age" id="age" class="form-control" required placeholder="Age" onchange="this.form.submit()">
                                <option value="<?= $memberdata['age']?>"><?php if($memberdata['age'] == '16'){echo 'Adult';} else {echo $memberdata['age'];} ?> </option>
                                <?= $ageoption ?>
                                <option value="16">Adult</option>
                            </select>
                        </div>

                        <input type="hidden" name="nb" value="age">
                        <input type="hidden" name="memberid" value="<?= $_POST['memberid'] ?>">

                </form>



            <form id="classes" action="" method="post">
        <h3 class="mt-5">Select the classes for <?= decrypt($memberdata['firstname']) ?> to enter:</h3>

        <?php if ($memberdata['age'] >= 15){ ?>
        <h3 class="text-dark">Flowers</h3>
        <?php $scheduleclass->list_class('Flowers', '', $memberdata['clases']); ?>

        <h3 class="text-dark">Vegetables</h3>
        <?php $scheduleclass->list_class('Vegetables', '', $memberdata['clases']); ?>

        <h3 class="text-dark">Novelty Vegetables</h3>
        <?php $scheduleclass->list_class('Novelty Vegetables', '', $memberdata['clases']); ?>

        <h3 class="text-dark">Home Produce</h3>
        <p class="text-dark highlight">For Home Produce classes all ingredients must be listed either on the jar or on a separate piece of paper with the exception of Classes 44 & 45.</p>
        <?php $scheduleclass->list_class('Home Produce', '', $memberdata['clases']); ?>
        <?php } else { // if Children's Classes?>

        <h3 class="text-dark">Children's Classes</h3>
        <p class="text-dark highlight">For all children’s classes, the exhibitor’s age must be clearly stated on all exhibits.</p>

        <?php }  ?>

        <?php if ($memberdata['age'] >= 3 and $memberdata['age'] <= 4){  ?>
        <p class="text-dark bold">Ages 3 to 4</p>
        <?php $scheduleclass->list_class('Childrens Classes', 'Ages 3 to 4', $memberdata['clases']); } ?>

        <?php if ($memberdata['age'] >= 5 and $memberdata['age'] <= 9 ){  ?>
        <p class="text-dark bold">Ages 5 to 9</p>
        <?php $scheduleclass->list_class('Childrens Classes', 'Ages 5 to 9', $memberdata['clases']); } ?>

        <?php if ($memberdata['age'] >= 10 and $memberdata['age'] <= 14 ){  ?>
        <p class="text-dark bold">Ages 10 to 14</p>
        <?php $scheduleclass->list_class('Childrens Classes', 'Ages 10 to 14', $memberdata['clases']); } ?>

        <?php if ($memberdata['age'] >= 5 and $memberdata['age'] <= 14 ){  ?>
        <div class="special-award">
            <h3 class="text-dark">Special Award</h3>
            <p class="text-dark bold">Ages 5 to 14</p>
            <?php
            $scheduleclass->list_class('Special Award', 'Ages 5 - 14', $memberdata['clases']); ?>
        </div>
        <?php } ?>

        <div class="break"></div>
        <h3 class="text-dark mt-4"> Photographic Classes – Sponsored by the Clouds Partnership.</h3>

                <?php if ($memberdata['age'] <= 15){ ?>
        <p class="text-dark bold">Children Under 15</p>
        <?php $scheduleclass->list_class('Photographic Classes', 'Children Under 15', $memberdata['clases']); ?>
        <?php } ?>

        <?php if ($memberdata['age'] >= 16){ ?>
        <p class="text-dark bold">Adults</p>
        <?php $scheduleclass->list_class('Photographic Classes', 'Adults', $memberdata['clases']); ?>

        <?php } ?>

        <div class="special-award">
            <p class="text-dark"><span class="bold">Note:</span> If you are unable to print a photo from your smartphone or tablet, please email your image to Martin Smith on <u>martinsmith2009@live.co.uk</u> and he will print off your photograph/s for you and ensure they are displayed at the Show. All digital entries must reach Martin by Monday 9th August and should be clearly marked with your name and the category/ies you are entering.</p>
        </div>



                <div class="form-group col-md-8 mt20">
                    <input type="hidden" name="nb" value="ud">
                    <input type="hidden" name="memberid" value="<?= $_POST['memberid'] ?>">

                    <button class="btn btn-primary" id="submitButton" data-badge="inline" name="button" value="adduser">Update <?= decrypt($memberdata['firstname'])?>'s entries</button>

                    <button class="btn btn-secondary" id="submitButton" data-badge="inline" name="button" value="cancel">Cancel</button>

                </div>

            </form>

        </div>





        <?php include_once('../footer.php') ?>
        <!--back to top  -->
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="../js/plugins/plugins.js"></script>
        <script src="../js/event.custom.js"></script>
        <script src="../js/googlemap.js"></script>
            <script src="../js/printpage.js"></script>

        <!--google map-->
        <script async src="https://maps.googleapis.com/maps/api/js?key=<?= $apikey ?>&callback=initMap"></script>

    </body>
</html>
