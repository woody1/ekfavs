<?php session_start();

// Cookies: // Kicks you out.
    include_once ("cookie.php");

    const flower = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/functions.php");
    const Update = TRUE;
    include_once ("ViewUsers.php");

// First things first get the users details.
    $users = new ViewUsers();
    $users->household = $_POST['memberid'];
    $users->users_contact();
    foreach ($users->data_array as $contact);


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
        <h3>Scarecrow Competition</h3>
    </div>
    <?php include_once('../scarecrow_competition_text.php')?>
    <form id="contact" action="index.php" method="post">
        <div class="form-group col-md-8">
            <label for="scarecrow_name"></label>
            <input type="text" class="form-control" id="scarecrow_name" name="scarecrow_name"  placeholder="Scarecrow's Name" required value="<?= $contact['scarecrow_name'] ?>">

            <label for="lastname"></label>
            <p>Location of your scarecrow</p>
            <input type="text" class="form-control" id="" name="home_name_number"  placeholder="House Number or Name" required value="<?= $contact['home_name_number'] ?>">
            <label for="lastname"></label>
            <input type="text" class="form-control" id="" name="home_street"  placeholder="Street" required value="<?= $contact['home_street'] ?>">
            <label for="lastname"></label>
            <input type="text" class="form-control" id="" name="home_postcode"  placeholder="Postcode" required value="<?= $contact['home_postcode'] ?>">


        </div>

        <div class="form-group col-md-8 mt20">
            <input type="hidden" name="sc" value="add">
            <input type='hidden' name='udid' value='<?= $_POST['memberid'] ?>'>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
           <button class="btn btn-primary" id="submitButton" data-badge="inline" name="button" value="addscare">Enter</button>
        </div>
    </form>

</div>

<!--back to top  -->
<a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="../js/plugins/plugins.js"></script>
<script src="../js/event.custom.js"></script>


</body>
</html>
