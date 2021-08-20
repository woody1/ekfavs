<?php session_start();

include_once("../entry_form/cookie.php");
$household = $_POST['household'];

    const flower = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/functions.php");
    include_once ("../Classes/Sql.php");
    const Update = TRUE;
    include_once("UsersDetails.php");
    include_once ("../entry_form/ViewUsers.php");
    include_once ("../entry_form/Update.php");
    const Payment = TRUE;
    include_once ("Payment.php");
    include_once("UsersDetails.php");
    include_once("secure.php");


    // Add a new household or exit
    if($_POST['nh'] == "add"){

        define("Create", TRUE);
        include_once('CRUD.php');

        $udid = md5(uniqid(session_id(), true));
        $create_no = sprintf("%06d", mt_rand(1, 999999));

        $create = new CRUD();
        $create->firstname = openssl_encrypt(clean($_POST['firstname']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
        $create->lastname = openssl_encrypt(clean($_POST['lastname']), ENCRYPTION_METHOD, ENCRYPTION_KEY);
        $create->email = $_POST['email'];
        $create->age = $_POST['age'];
        $create->create_no = $create_no;
        $create->udid = $udid;
        $create->ip_address = $_SERVER['REMOTE_ADDR'];
        $create->status = $_POST['status'];
        $create->updated_by = $_SESSION['signin'];
        $create->insert_user();
        $household = $create->new_id;
    }

// Update members
    if($_POST['ac'] == "ud") {
        include_once("../entry_form/Update.php");
        $clases = new Update();
        $clases->memberid = $_POST['memberid'];
        $clases->clases = serialize($_POST['class']);
        $clases->update_clases();
    }

// Add a new member to the hosue hold
    if(($_POST['button'] == "adduser") and ($_POST['nm'] == "add")) {
        //Add a new user
        $adduser = new Update();
        $adduser->household = $_POST['household'];
        $adduser->firstname = encrypt($_POST['firstname']);
        $adduser->lastname = encrypt($_POST['lastname']);
        $adduser->age = $_POST['age'];
        $adduser->add_user();
    }

if ($household == "") {

    header("Location: tables.php");
    exit;
}

// Add payment
    if($_POST['payment'] == "pay") {
        $payement = new Payment();
        $payement->household = $household;
        $payement->total_amount = $_POST['total_amount'];
        $payement->sold_medium = "Cash " . $_POST['button'];
        $payement->dispatched_by = $_SESSION['signin'];
        $payement->add_to_invoice();
    }
//Add Scarecrow
    if(($_POST['button'] == "addscare") and ($_POST['sc'] == "add")) {

        include_once("../entry_form/Update.php");

        //Add a new user
        $addsc = new Update();
        $addsc->udid = $_POST['udid'];
        $addsc->scarecrow_name = $_POST['scarecrow_name'];
        $addsc->home_name_number = $_POST['home_name_number'];
        $addsc->home_street = $_POST['home_street'];
        $addsc->home_postcode = $_POST['home_postcode'];
        $addsc->add_scarecrow();
    }

// Add Scarecrow details
    $users = new ViewUsers();
    $users->household = $household;
    $users->users_contact();
    foreach ($users->data_array as $contact);

// List all members of the house hold.
    $listusers = new ViewUsers();
    $listusers->household = $household;
    $listusers->userlist();

// List all payments made .
    $payed = new Payment();
    $payed->household = $household;
    $payed->sums();
    $total_paid =  number_format($payed->total_amount, 2, '.', '');

// Lsit what is due
    $due = new Payment();
    $due->household = $household;
    $due->householddue();
    $amount_due =  number_format($due->total_due, 2, '.', '');

    $listpayments = new Payment();
    $listpayments->household = $household;
    $listpayments->listpayments();


    $scarecrow = new SQL();
    $scarecrow->sql = "SELECT scarecrow from users WHERE id = '$household'";
    $scarecrow->view_sql();
    foreach ($scarecrow->data_array as $scarecrows);

// Work out totals

    $amount_owed = number_format(($amount_due - $total_paid), 2, '.', '');

// Buttons

if($amount_owed > 0) {$paybutton = "<button class=\"btn btn-outline-primary mt-2\" name=\"button\" value=\"payment\">Take Payment</button>";

}elseif ($amount_owed < 0){
    $paybutton = "<button class=\"btn btn-outline-danger mt-2\" name=\"button\" value=\"refund\">Refund</button>";

}else {

    $paid = TRUE;

}

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

        <div class="container pt100 pb-5">
            <div id="dispatchcont">
                <h3></h3>
            </div>

            <div class="mb-5"></div>

            <h3>Household: <?= $household ?></h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Classes Entered</th>
                    <th scope="col">Update</th>
                </tr>
                </thead>

                <tbody>
                <?= $listusers->list ?>

                <?php if($scarecrows['scarecrow'] == 1 ){?>

                    <tr>
                        <td>
                            <p><b>Scarecrow</b></p>

                        </td>
                        <td colspan="2">
                            <b>Scarecrow's Name:</b> <?= $contact['scarecrow_name']?>
                            <br><b>Location:</b> <?= $contact['home_name_number']?>  <?= $contact['home_street']?> <?= $contact['home_postcode']?>
                            <br><b>Number:</b> <?= $contact['id']?>
                        </td>

                        <td><form id='contact' action='scarecrow.php' method='post'>
                                <input type='hidden' name='household' value='<?= $household ?>'>
                                <button class='btn btn-outline-info'  name='button' value='scarecrow'>Edit</button>
                            </form></td>
                    </tr>

                <?php } ?>

                <tr>
                    <th colspan="2" >
                        <form id="contact" action="new_member.php" method="post">
                            <input type="hidden" name="household" value="<?= $household  ?>">
                            <button class="btn btn-outline-primary" name="button" value="new"> Add a new household member</button>
                        </form>
                    </th>
                    <td colspan="2">
                        <?php if($scarecrows['scarecrow'] != 1 ){?>
                            <form id='contact' action='scarecrow.php' method='post'>
                                <input type='hidden' name='household' value='<?= $household  ?>'>
                                <button class='btn btn-outline-info'  name='button' value='scarecrow'><i class="fa fa-male"></i> Enter your scarecrow</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>

                </tbody>
            </table>

            <div class="mb-5">

                <h3>Payment:</h3>
                <p>Total Due on all classes: £<?= $amount_due ?></p>
                <p>Total Paid to date: £<?= $total_paid  ?></p>
                <ul> <?= $listpayments->list  ?></ul>
                <p>Total owed: £<?= $amount_owed ?></p>


                <?php if($paid === TRUE){ ?>

                    <h4>No Payment Due</h4>

                <?php }else{ ?>
                <h4>Take Payment or Refund</h4>
                <form id="contact" action="" method="post">
                    <input type="number" step="0.01" class="form-control col-lg-3 col-sm-12" id="total_amount" name="total_amount"  placeholder="Amount" required value="<?= $amount_owed ?>">
                    <input type="hidden" name="household" value="<?= $household  ?>">
                    <input type="hidden" name="payment" value="pay">
                    <?= $paybutton ?>
                </form>
                <?php } ?>

            </div>

          <a href="index.php">    <button class="btn btn-outline-info" name="button" value="">Done</button></a>
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
