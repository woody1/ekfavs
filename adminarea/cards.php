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

    <body>


            <div class="cardcontainer">

<?= $print->list ?>
            </div>




    </body>
</html>
