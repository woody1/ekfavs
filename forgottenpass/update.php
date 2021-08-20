<?php

// Stop a direct link to this page and any include pages
defined('flower') or die('Not with me my friend');

$location = _ROOT;
$location .= "signin/";

?>

<form action="" method="post">

    <?php if ((check_password(clean($_POST['password'])) === FALSE) and (clean($_POST['nb']) == "bb")) {?>
    <div class="form-group alert-danger">
        <label for="password">The password needs to be at least 8 characters.</label>

        <?php }else{?>

        <div class="form-group">
            <label for="password">Please Enter a new Password</label>
            <?php } ?>
            <input type="password" id="password" name="password" class="form-control" data-toggle="password">
        </div>

        <input type="hidden" name="nb" value="bb">
        <button type="submit" class="btn btn-primary">Submit</button>
</form>

    <?php if (clean($udid) and (clean($_POST['password']))){

        //Define and include what we need
    define('flower', TRUE);
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/Sql.php");

    $password = password_hash(clean($_POST['password']), PASSWORD_DEFAULT);

    $newpass = new Sql();
    $newpass->sql = "UPDATE users SET password = '$password' WHERE udid = '$udid'";
    $newpass->update_sql();

        echo "<script>window.location = '$location' ;</script>";

    ?>



    <?php  } ?>