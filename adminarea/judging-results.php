<?php session_start();

include_once("../entry_form/cookie.php");

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');
include_once("../Classes/functions.php");
include_once("../Classes/Sql.php");
const Update = TRUE;
include_once("UsersDetails.php");
include_once("secure.php");
include_once('../Classes/functions.php');
include_once('JudgeClass.php');

    $cup = new JudgeClass();

    // First things first get the users details.
    $print = new UsersDetails();
    $print->printlables();

    $userlist = new UsersDetails();
    $userlist->listusers();

    $usersname = new UsersDetails();

    $error = new JudgeClass();
    $error->warning();



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

<div class="container pt100 pb-5">

    <h2>Results Page</h2>
<?php if ($error->num_rows > 0 ) {echo "<p class=\"badge-danger p-2 m-2 col-md-6\"> <b>There are ". $error->num_rows ." classes without a 1st place entered.</b></p>"; } ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">CUP/AWARD</th>
            <th scope="col">TO BE PRESENTED BY</th>
            <th scope="col">Point Count</th>
            <th scope="col">Exh. No</th>
            <th scope="col">WINNER’S NAME</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and include = 1');  ?>
            <td><b>THE HARRY SEYMOUR CUP</b><br>
                Best In Show (most overall points)
            </td>
            <td>Mr & Mrs Julian Seymour</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and include = 1');  ?>
            <td><b>THE ADRIAN LEVER CUP</b><br>
                Runner-up Best In Show (second most points)
            </td>
            <td>Gen. Sanders</td>
            <td><?= $winner->secondscore ?> </td>
            <td><?= $winner->secondkey ?></td>
            <td><?= $winner->secondscore == "" ? "TBA" : $usersname->usersname($winner->secondkey); ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (1, 2)');  ?>
            <td><b>THE SIMON MASTER CUP</b><br>
                Winner of Rose Classes (most points in classes 1 and 2)
            </td>
            <td>Georgina Master</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (3)');  ?>
            <td><b>THE DOUGLAS MORRIS CUP</b><br>
                Best 5 stems of mixed perennials (Class 3)
            </td>
            <td>Gen. Sanders</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (1,2,3,4,5,6,7,8,9,10,11,12)');  ?>
            <td><b>THE BATTLE TROPHY</b><br>
                Most points accumulated in flower classes 1 to 12
            </td>
            <td>Ben Battle</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $cup = new JudgeClass(); ?>
            <td><b>THE ANTHONY CLAYDON MEMORIAL CUP
                </b><br>
                Most outstanding exhibit in vegetable classes 13 to 27
            </td>
            <td>Mrs Claydon</td>
            <td>N/A</td>
            <td><?= $cup->cupwinner('4') ?></td>
            <td><?= $cup->cupwinner('4') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('4'));  ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); ?>
            <td><b>THE 100 YARDS CUP
                </b><br>
                Most extraordinary novelty vegetable in classes 29 to 33
            </td>
            <td>Gen. Sanders</td>
            <td>N/A</td>
            <td><?= $cup->cupwinner('5') ?></td>
            <td><?= $cup->cupwinner('5') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('5'));  ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (34,35,36,37,38,39,40,41,42,43,44,45,46)');  ?>
            <td><b>THE CAROLINE HYDE CUP</b><br>
                Most points accumulated in home produce classes 34 to 46
            </td>
            <td>Mr & Mrs Richard Hyde</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); ?>
            <td><b>THE CHARLIE CUMBERLEGE CUP</b><br>
                The best jam or jelly from classes 34 and 37
            </td>
            <td>Jo Cumberlege</td>
            <td>N/A</td>
            <td><?= $cup->cupwinner('7') ?></td>
            <td><?= $cup->cupwinner('7') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('7'));  ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (47)');  ?>
            <td><b>THE HELEN LEVER CUP</b><br>
                To the winner of class 47 – child aged 3 to 4
            </td>
            <td>Helen Lever</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?></td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (48, 49, 50, 51, 52)');  ?>
            <td><b>THE VILLAGE HALL SHIELD</b><br>
                Most points accumulated in classes 48 to 52 – ages  5 to 9
            </td>
            <td>Gen. Sanders</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (53,54,55,56,57)');  ?>
            <td><b>THE GARDEN CLUB SHIELD</b><br>
                Most points accumulated in classes 53 to 57 – ages 10 to 14
            </td>
            <td>Gen. Sanders</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); $winner->winers('and id in (58)');  ?>
            <td><b>SPECIAL AWARD FOR POSTER DESIGN - £15</b><br>
                For a child aged from 5 to 14
            </td>
            <td>Gen. Sanders</td>
            <td><?= $winner->firstscore ?> </td>
            <td><?= $winner->firstkey ?></td>
            <td><?= $winner->firstscore == "" ? "TBA" : $usersname->usersname($winner->firstkey); ?>
                <?php // Draw check
                if (($winner->secondscore == $winner->firstscore) and ($winner->secondscore > 0)) {echo " <i class='alert-warning'><br> DRAW with " . $usersname->usersname($winner->secondkey) . " (". $winner->secondkey . ")</i>";}
                ?>
            </td>
        </tr>

        <tr>
            <?php $winner = new JudgeClass(); ?>
            <td><b>THE HUNTER CUP</b><br>
                Best photograph as voted for by the public
            </td>
            <td>Charlie & Theresa Hunter</td>
            <td>N/A</td>
            <td><?= $cup->cupwinner('13') ?></td>
            <td><?= $cup->cupwinner('13') == 0  ? "TBA" : $usersname->usersname($cup->cupwinner('13'));  ?>
            </td>
        </tr>


        <tr>
            <?php $winner = new JudgeClass(); ?>
            <td><b>THE SCARECROW SHIELD</b><br>
                Best scarecrow as voted for by the public
            </td>
            <td>Gen. Sanders</td>
            <td>SC = <?= $cup->cupwinner('14') ?></td>
            <td><?php
                $scarecrow1 = new JudgeClass();
                $scwinner = $scarecrow1->scarecrow($cup->cupwinner('14'));
                echo $scwinner;
                ?></td>
            <td><?=  $scwinner == 0  ? "TBA" : $usersname->usersname($scwinner);  ?>
            </td>
        </tr>

        </tbody>
    </table>

    <hr>

    <a href="judging.php"> <button class="btn btn-outline-primary pt-3 ">Done</button></a>

    </div>
</body>
</html>

