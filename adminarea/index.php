<?php session_start();

include_once("../entry_form/cookie.php");

    const flower = TRUE;
    include_once("../define.php");
    include_once(OUTOFROOT . 'config.php');
    include_once ("../Classes/functions.php");
    include_once ("../Classes/Sql.php");
    const Update = TRUE;
    include_once("UsersDetails.php");
    include_once("secure.php");



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

        <?php include_once("nav.php") ?>

        <div class="container pt100">
            <div id="dispatchcont">
                <h3></h3>
            </div>

            <table id="exhibitors" class="table table-hover table-striped pb-3 pt-2" style="width:100%">
                <thead>
                <tr class="thead-light">
                    <th width="150" class="align-text-top">Exhibitor Name</th>
                    <th class="align-text-top">Exhibitor Number</th>
                    <th class="align-text-top">Exhibitor Classes</th>
                    <th class="align-text-top">Household Payment</th>
                    <th class="align-text-top">Household</th>
                    <th class="align-text-top">Edit</th>
                </tr>
                </thead>
                <tbody>
                    <?= $userlist->list ?>
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>


            <form id="contact" action="newuser.php" method="post">
                <button class="btn btn-outline-primary" name="button" value="new">Add a new household/Exhibitor</button>
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
