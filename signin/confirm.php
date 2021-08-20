<?php session_start();

    const flower = TRUE;
    const signin = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once(OUTOFROOT . 'emailsettings.php');
    include_once ("../Classes/functions.php");

if ((clean($_POST['nb']) == "cc") and (validate_email($_POST['email']) === true)) {

    //Define and include what we need

    include_once("Signin.php");
    include_once("../Classes/Sql.php");

//Check to see if the password matches the email or vicy verky
    $signin = new Signin();
    $signin->create_no = clean($_POST['create_no']);
    $signin->email = openssl_encrypt(strtolower($_POST['email']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
    $signin->create_no();
    $signinid = $signin->id;


    if ($signin->failed_attempts_time > date('Y-m-d H:m:s')) {
        $time_limit = "exceeded";
    };

//If it matches happy days
    if (($signin->verified === TRUE) and ($time_limit != "exceeded")) {

        $udid = md5(uniqid(session_id(), true));

        $setaccount = new Sql();
        $setaccount->sql = "UPDATE users SET ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', failed_attempts = 0, udid = '$udid', last_sign_in = NOW(), account_confirmed = NOW() WHERE id = '$signinid'";
        $setaccount->update_sql();

        $_SESSION['signin'] = $udid;
        $_SESSION['timer'] = time() + 3600;
        $_SESSION['failcount'] = 0;

        // If the sign in is from the sign in page or createaccount page go to updateuser page or go back to the page the user sined in from.
        header("Location: ../signin/");

    } else { ?>
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
        <div id="preloader">
            <div id="preloader-inner"></div>
        </div>


        <!-- start form -->

        <div class="page-titles title-gray pt30 pb20">
            <div class="container">
                <div class="row">
                    <div class=" col-md-8">
                        <h3>There seems to be a problem with the Confirmation Code</h3>
                    </div>
                </div>
            </div>
        </div><!--page title end-->
        <div class="container mb40">
            <div class="row">
                <div class="col-md-12 mb40">

        <h4>Please try again with the Confirmation Code sent earlier:</h4>

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

        <h5>Still having problems:</h5>

        <ol class="mb20">
            <li>If you are still having problems email - <a href="mailto:help@ekfavs.co.uk?subject=Problem%20with%20Confirming%20Account&body=Can%20you%20please%20resend%20Confirmation%20details%20to%20my%20email%20address.">help@ekfavs.co.uk</a></li>

        </ol>


        </div>
        </div>
        </div>

    <hr class="mb50">

    <?php include_once('../footer.php')?>




    <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="../js/plugins/plugins.js"></script>
    <script src="../js/event.custom.js"></script>
    <script src="../js/googlemap.js"></script>
    <script src="../js/printpage.js"></script>


</body>
    </html>


<?php  }

} else {

    header("Location: /");

}
?>