<?php session_start();

    const flower = TRUE;
    const signin = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once(OUTOFROOT . 'emailsettings.php');
    include_once ("../Classes/functions.php");

$location = _ROOT;
$location .= "entry_form/";

if (isset($_SESSION['signin'])  or $_SESSION['timer'] > time()) {
  header("Location: $location");
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <?php include_once('ga.php') ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= PAGE_TITLE ?></title>
    <!-- Plugins CSS -->
    <link href="<?= _ROOT ?>css/plugins/plugins.css" rel="stylesheet">
    <link href="<?= _ROOT ?>css/style.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->

</head>

<body>


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
                <a class="nav-link" data-scroll href="../rules.php?content=rules_text">Rules</a>
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


<!-- start form -->

<div class="page-titles title-gray pt30 pb20">
    <div class="container">
        <div class="row">
            <div class=" col-md-6 mt-5">
                <h3>Sign In</h3>
            </div>
        </div>
    </div>
</div><!--page title end-->
<div class="container mb40">
    <div class="row">
        <div class="col-md-12 mb40">

            <?php


            if ((clean($_POST['nb']) != "cc") or (validate_email($_POST['email']) === false)){ ?>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"  value="<?= clean($_POST['email'])?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Password</label>
                        <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp"  utocomplete="off" required>
                    </div>

                    <input type="hidden" name="nb" value="cc">
                    <input type="hidden" name="signon" value="new">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <div class="form-group pt40">
                   <b> <a href="<?= _ROOT ?>createaccount">Not got an account? Click here</a></b>
                </div>

            <?php } elseif ((clean($_POST['nb']) == "cc") and (validate_email($_POST['email']) === true)){

                //Define and include what we need

                include_once("Signin.php");
                include_once ("../Classes/Sql.php");

                //Check to see if the password matches the email or vicy verky
                $signin = new Signin();
                $signin->password = clean($_POST['password']);
                $signin->email = openssl_encrypt(strtolower($_POST['email']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
                $signin->password();
                $signinid = $signin->id;


                if ($signin->failed_attempts_time > date('Y-m-d H:m:s')) {$time_limit = "exceeded";};

                //If it matches happy days
                if(($signin->verified === TRUE) and ($time_limit != "exceeded")) {

                    $udid = md5(uniqid(session_id(), true));

                    $setaccount = new Sql();
                    $setaccount->sql = "UPDATE users SET ip_address = '".$_SERVER['REMOTE_ADDR']."', failed_attempts = 0, udid = '$udid', last_sign_in = NOW() WHERE id = '$signinid'";
                    $setaccount->update_sql();

                    $_SESSION['signin'] = $udid;
                    $_SESSION['timer'] = time() + 3600;
                    $_SESSION['failcount'] = 0;


                    echo "<script>window.location = '/adminarea/';</script>";



                    // If not :(  or time exceeded -
                } elseif (($signin->verified === FALSE) or (!$signinid) or ($time_limit == "exceeded")) {

                    if (validate_email($_POST['email']) === true) {
                        $email = openssl_encrypt($_POST['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY);
                    } else {
                        $email = "";
                    }

                    $setaccount = new Sql();
                    $setaccount->sql = "UPDATE users SET ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', failed_attempts = failed_attempts + 1, last_sign_in = NOW() WHERE email = '$email'";
                    $setaccount->update_sql();

                    if (4 - $signin->failed_attempts == 0) {

                        $setexpire = new Sql();
                        $setexpire->sql = "UPDATE users SET failed_attempts_time = NOW() + INTERVAL 30 MINUTE, failed_attempts = '0'  WHERE email = '$email'";
                        $setexpire->update_sql();

                    }

                    //Logoc for $attempts_left
                    if ($time_limit == "exceeded") {
                        $attempts_left = "You have been timed out for 30 minutes.";
                        $button_disabled = "disabled";

                    } elseif ($time_limit != "exceeded") {

                        $_SESSION['failcount'] ++;
                        $failed_attempts = $signin->failed_attempts + -1;

                        if ((5 - $failed_attempts  == 1) or (5 - $_SESSION['failcount'] == 1)) {
                            $attempts_left = "You only have ONE ATTEMPT left before you are locked out for 30 minutes.";

                        } elseif ((5 - $failed_attempts == 0) or (5 - $_SESSION['failcount'] <= 0)) {
                            $button_disabled = "disabled";
                            $attempts_left = "You have been locked out for 30 minutes";

                        } else {

                            $number_left = (5 - max($failed_attempts, $_SESSION['failcount']));

                            $attempts_left = "You have $number_left attempts left before you are locked out for 30 minutes.";
                        }
                    }


                    ?>

                    <form action="" method="post">

                        <p class="alert-warning"> There is a problem with your Email Address or Password. If you have forgotten your password <a href="../forgottenpass">click here to reset it.</a>  <br>
                            <?= $attempts_left ?>
                        </p>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"  value="<?= clean($_POST['email'])?>" placeholder="Enter email" >
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp"  utocomplete="off" required>
                        </div>

                        <input type="hidden" name="nb" value="cc">
                        <button <?= $button_disabled ?> class="btn btn-primary">Submit</button>
                    </form>

                    <?php }


            }else{

                echo "There is an error. Please  <a href='/signin/'>click here</a>";
            }

            ?>

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
