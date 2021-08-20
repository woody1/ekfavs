<?php

//
// 1. if member status is Candidate Apprentice
// 2. if member status is Apprentice
// 3. if member status is Candidate Guildman


//real
switch ($eventdata['virtual'] ) {
    case "0":
        $ceremony1_real = ". in the Chamberlain's Court.";
        $ceremony2 = "Guild Declaration in the Alderman's Court or a Meeting Room at Guildhall.";
        break;
    case "1":
//virtual
        $ceremony1_real = "<br><b>Conducted by the Clerk to the Chamberlain's Court</b>";
        $ceremony2 = "Guild Declaration<br><b>Led by the Guild Master and Clerk</b>";
        $virtual = TRUE;
        $pmtype = "VIRTUAL ";
        break;
}

switch ($userdata['status'] ) {
    case "Candidate Apprentice (CA)":
        $pmtype .= "APPRENTICE BINDING";
        $ceremony1 =  "Apprentice Binding, accompanied by one parent or guardian, Apprentice Master and Honorary Clerk" . $ceremony1_real;
        $apprentice_master = TRUE;
        break;
    case "Apprentice":
        $pmtype .= "FREEDOM BY SERVITUDE";
        $ceremony1 =  "Freedom of the City of London by Servitude, in the Chamberlain's Court" . $ceremony1_real;
        $apprentice_master = TRUE;
        $apprentice = TRUE;
        break;
    case "Candidate Guildman (CG)":
        $pmtype .= "FREEDOM BY REDEMPTION";
        $ceremony1 =  "Freedom of the City of London by Redemption, in the Chamberlain's Court" . $ceremony1_real;
        break;
}

    $name =  decrypt($userdata['firstname']) . " "  . decrypt($userdata['middlename']) ." " .decrypt($userdata['lastname']);
    $eventdate = date('D jS F Y', strtotime($eventdata['start_date_time']));
    $apprenticemaster = $amfullname;
    $apprenticeessay = $userdata['apprentice_essay'];
    $ceremonydetails = htmlspecialchars_decode(unserialize($eventdata['event_details']));

?>

<style>

    /*  PM Template  */
    .WordSection {

        width: 900px;
        background-color: white;
        padding: 20px;
        margin-right: auto;
        margin-left: auto;
        border: 1px solid;
        box-shadow: 5px 10px 18px #888888;
        margin-top: 30px;

         }
    .WordSection p, .WordSection li.MsoNormal, .WordSection div.MsoNormal {
        margin: 0cm;
        font-size: 12.0pt;
        font-family: "Times New Roman",serif; }
    .WordSection p {
        margin: 0cm;
        font-size: 12.0pt;
        font-family: "Times New Roman",serif; }
    .WordSection p.center {
        text-align: center; }
    .WordSection .pb1 {
        padding-bottom: 10px; }
    .WordSection .pb2 {
        padding-bottom: 20px; }
    .WordSection .pb3 {
        padding-bottom: 30px; }
    .WordSection h1 {
        mso-style-link: "Heading 1 Char";
        margin: 0cm;
        text-indent: 0cm;
        page-break-after: avoid;
        font-size: 24.0pt;
        font-family: "Times New Roman",serif;
        font-weight: bold;
        text-align: center;
        padding-bottom: 20px;
        color: red;
        text-shadow: 2px 2px 5px grey; }
    .WordSection h2 {
        margin: 0cm;
        text-indent: 0cm;
        page-break-after: avoid;
        font-size: 16.0pt;
        font-family: "Times New Roman",serif;
        font-weight: bold;
        text-align: center;
        padding-bottom: 20px;
        color: black; }
    .WordSection h3 {
        margin: 0cm;
        text-indent: 0cm;
        page-break-after: avoid;
        font-size: 12.0pt;
        font-family: "Times New Roman",serif;
        font-weight: bold;
        text-align: center;
        padding-bottom: 20px;
        color: black; }
    .WordSection .maintable {
        border-collapse: collapse;
        border: none;
        width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .WordSection .leftcell {
        vertical-align: top;
        border: solid 1px;
        padding: 10px;
        width: 140px; }
    .WordSection .rightcell {
        vertical-align: top;
        border: solid 1px;
        padding: 10px; }

</style>

<div class="WordSection">

    <h1><img src="https://theguildofmercersscholars.com/images/letterhead.jpg" width="400px"></h1>
    <p class="center">From the Honorary Assistant Clerk-Membership</p>
    <p class="center pb1">Julia Tucker, 4 Hinton Farm Mews, Christchurch, Dorset, BH23 4FU</p>
    <p class="center pb2" >Date:<?= date("d/m/Y") ?></p>
    <h2>POUR MEMOIRE</h2>
    <h3><?= $pmtype ?></h3>



<table class="maintable">
    <tr>
        <td class="leftcell">
            <p>Name:</p>
        </td>
        <td class="rightcell">
            <p><?= $name ?></p>
        </td>
    </tr>
    <tr>
        <td class="leftcell">
            <p>Date:</p>
        </td>
        <td class="rightcell">
            <p><?= $eventdate ?></p>
        </td>
    </tr>
<?php if($apprentice_master === TRUE) { ?>
    <tr>
        <td class="leftcell">
            <p>Apprentice Master:</p>
        </td>
        <td class="rightcell">
            <p><?= $apprenticemaster ?></p>
        </td>
    </tr>
<?php } ?>

<?php

if ($apprentice === TRUE){ ?>

    <tr>
        <td class="leftcell">
            <p>Apprentice Essay:</p>
        </td>
        <td class="rightcell">
            <p><?= $apprenticeessay ?></p>
        </td>
    </tr>

<?php } ?>

    <tr>
        <td class="leftcell">
            <p>Ceremony 1:</p>
        </td>
        <td class="rightcell">
            <p><?= $ceremony1 ?></p>
        </td>
    </tr>

    <tr>
        <td class="leftcell">
            <p>Ceremony 2:</p>
        </td>
        <td class="rightcell">
            <p><?= $ceremony2 ?></p>
        </td>
    </tr>

    <tr>
        <td class="leftcell">
            <p>Ceremony details:</p>
        </td>
        <td class="rightcell">
            <p><?=  $ceremonydetails ?></p>
        </td>
    </tr>


    <?php if ($virtual !== TRUE) { ?>
    <tr>
        <td class="leftcell">
            <p>Other information:</p>
        </td>
        <td class="rightcell">
            <p>Access to the Chamberlain's Court is from Aldermanbury, at the rear of Guildhall. Cameras are permitted and there will be a photo-opportunity at the end of the ceremony in the Chamberlain's Court.   Guests are most welcome to witness the proceedings but the Honorary Assistant Clerk-Membership requires their full names in advance, please.</p>
        </td>
    </tr>
<?php } ?>

    <tr>
        <td class="leftcell">
            <p>Documents:</p>
        </td>
        <td class="rightcell">
            <p>A copy of the text you will be required to read before the Court is attached for your information.</p>
        </td>
    </tr>

    <tr>
        <td class="leftcell">
            <p>Dress Code:</p>
        </td>
        <td class="rightcell">
            <p>Smart; jacket and  tie for gentlemen.</p>
        </td>
    </tr>

 <?php if ($virtual !== TRUE) { ?>
    <tr>
        <td class="leftcell">
            <p>Telephones:</p>
        </td>
        <td class="rightcell">
            <p class="pb1">Chamberlain's Court: 020 7332 1008</p>
            <p>Emergencies:</p>
            <p>Mr Biagio Fraulo JP: 07910 335259</p>
            <p>Ms Julia Tucker: 07376 259204</p>
        </td>
    </tr>

    <tr>
        <td class="leftcell">
            <p>Travel:</p>
        </td>
        <td class="rightcell">
            <p>Mansion House, Bank, Moorgate and St. Paul's are the nearest underground stations.</p>
        </td>
    </tr>

    <?php if ($apprentice === TRUE){ ?>

    <tr>
        <td class="leftcell">
            <p><b>Important:</b></p>
        </td>
        <td class="rightcell">
            <p><b>NB: Please bring your original Indenture document with you</b></p>
        </td>
    </tr>

    <?php }
 } ?>

</table>

</div>




