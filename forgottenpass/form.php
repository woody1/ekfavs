<?php
// Stop a direct link to this page and any include pages
defined('flower') or die('Not with me my friend');


if ((clean($_POST['nb']) != "cc") or (validate_email($_POST['email']) === false)){ ?>

    <form action="" method="post">

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email"  value="<?= clean($_POST['email'])?>" placeholder="Enter email" >
        </div>

        <input type="hidden" name="nb" value="cc">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php } elseif ((clean($_POST['nb']) == "cc") and (validate_email($_POST['email']) === true)){


    //Define and include what we need
    define('flower', TRUE);
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/Sql.php");

    $confirm = new Sql();
    $confirm->sql = "SELECT * from users WHERE email = '".openssl_encrypt($_POST['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY)."'";
    $confirm->view_sql();
    foreach ($confirm->data_array as $user);

    if ($user['id'] > 0) {

        $udid = md5(uniqid(session_id(), true));

        $newpass = new Sql();
        $newpass->sql = "UPDATE users SET udid = '$udid' WHERE email = '" . openssl_encrypt($_POST['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY) . "'";
        $newpass->update_sql();

        $usid = new Sql();
        $usid->sql = "SELECT usid from users WHERE email = '" . openssl_encrypt($_POST['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY) . "'";
        $usid->view_sql();
        foreach ($usid->data_array as $usid) ;


        include_once('../mail/body-forgotten-pass.php');

        ////==============================================================
        //// send email
        //Send email to
        $to_email = clean($_POST['email']);
        //Title of form
        $title = 'Forgotten Password';
        //Set the subject line
        $subject = "Forgotten Password";
        //
        $usid = $usid['usid'];
        //get the settings and send woooooshhhhh
        include("../mail/sendemail.php");

    }

    ?>

    <p>If there is an email address registered that matches the address entered and you have confirmed your account you will shortly receive an email with details to reset your password.</p>
    <h4>What happens next:</h4>
    <ol class="mb30">
        <li>Click on the link in the email. This will redirect you to a Forgotten Password page, where you can set a new password.</li>
    </ol>

    <p>If you <b>do not</b> receive an email within a few hours, please check your spam folder and see if it is there.  If not ensure that  is whitelisted and <a href="/forgottenpass/"> click here </a> to send the activation code again.</p>
    <p>Should the problem persist pelase email help@ekfavs.co.uk</p>

<?php  } ?>