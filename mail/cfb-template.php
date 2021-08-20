<?php

//
// 1. if member status is Candidate Apprentice
// 2. if member status is Apprentice
// 3. if member status is Candidate Guildman


//real
switch ($eventdata['virtual'] ) {
    case "0":

        break;
    case "1":
//virtual

        break;
}

switch ($userdata['status'] ) {
    case "Candidate Apprentice (CA)":
        $pmtype .= "APPRENTICE BINDING";
        $cfb = TRUE;
        break;
    case "Apprentice":
        $pmtype .= "FREEDOM BY SERVITUDE";
        $decfreedom = TRUE;
        break;
    case "Candidate Guildman (CG)":
        $pmtype .= "FREEDOM BY REDEMPTION";
        $decfreedom = TRUE;
        break;
}

// Case gender:

switch ($userdata['gender']) {
    case "Male":
        $heshe = "he";
        $himherself = "himself";
        break;
    case "Female":
        $heshe = "she";
        $himherself = "herself";
        break;
    default:
        $heshe = "they";
        $himherself = "theirself";
        break;
}

    $name =  decrypt($userdata['firstname']) . " ". decrypt($userdata['middlename'])  . "  "   . decrypt($userdata['lastname']);
    $eventdate = date('D jS F Y', strtotime($eventdata['start_date_time']));
    $apprenticemaster = $amfullname;

?>

<style>

    /*  PM Template  */
    .WordSection {

        width: 900px;
        background-color: white;
        padding: 20px;
        margin-right: auto;
        margin-left: auto;
        border: 0 solid;
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
    .WordSection .pb11 {
        padding-bottom: 110px; }
    .WordSection .mt100 {
        margin-top: 100px; }

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
    .WordSection .fullcell {
        vertical-align: top;
        border: solid 0;
        padding: 10px;}
    .WordSection .cellright {
        vertical-align: top;
        border: solid 0;
        padding: 10px;
        text-align: right}
    .WordSection .leftcell {
        vertical-align: top;
        border: solid 0;
        padding: 10px;
        width: 190px; }
    .WordSection .rightcell {
        vertical-align: top;
        border: solid 0;
        padding: 10px; }

</style>

<?php if ($cfb === TRUE) { ?>

<div class="WordSection">
    <h1><img src="https://theguildofmercersscholars.com/images/letterhead.jpg" width="400px"></h1>
    <h2 class="pb3"><img src="https://theguildofmercersscholars.com/images/cfb.jpg" width="400px"></h2>
    <table class="maintable">
    <tr>
        <td class="fullcell" colspan="2">
            <p>Two indentures of the standard form shall be prepared by the Clerk in accordance with the terms agreed between the Master and the guardian of the Apprentice.</p>
        </td>
    </tr>
    <tr>
        <td class="leftcell">
            <p>The Clerk, introducing the Apprentice's Master and the Apprentice:</p>
        </td>
        <td class="rightcell">
            <p><?= $name ?> is presented by Guildman <?= $amfullname_title  ?> that <?= $heshe ?> may be bound Apprentice for a term of four years.
            </p>
        </td>
    </tr>
    <tr>
        <td class="leftcell">
            <p>The Master to the Apprentice:</p>
        </td>
        <td class="rightcell">
            <p><?= $name ?>, do you desire to be bound to Guildman <?= $amfullname_title  ?>, a Citizen and Freeman, for a term of four years?</p>
        </td>
    </tr>

    <tr>
        <td class="leftcell">
            <p>The Apprentice:</p>
        </td>
        <td class="rightcell">
            <p>I do.</p>
        </td>
    </tr>

    <tr>
        <td class="leftcell">
            <p>The Master to the Clerk:</p>
        </td>
        <td class="rightcell">
            <p>Has the consent of a parent been obtained?</p>
        </td>
    </tr>
    <tr>
        <td class="leftcell">
            <p>The Clerk:</p>
        </td>
        <td class="rightcell">
            <p>It has.</p>
        </td>
    </tr>
    <tr>
        <td class="fullcell" colspan="2">
            <p>The Apprentice, the Parent and the Apprentice's Master shall then sign the Guild Binding Book, the Guild Master and Clerk witnessing the signatures.</p>
        </td>
    </tr>
    <tr>
        <td class="leftcell">
            <p>The Clerk:</p>
        </td>
        <td class="rightcell">
            <p>Be it remembered that <?= $name ?> this day put <?= $himherself ?> Apprentice untoward <?= $amfullname_title  ?>, Guildman and Citizen of London, to learn his Art for four years from this date.</p>
        </td>
    </tr>

    <tr>
        <td class="fullcell" colspan="2">
            <p>The Clerk will then introduce the Apprentice to the members of the Court.</p>
        </td>
    </tr>
    <tr>
        <td class="cellright" colspan="2">
            <p><?= $eventdate ?></p>
        </td>
    </tr>
</table>
</div>

<?php } else { ?>

    <div class="WordSection">
        <h1><img src="https://theguildofmercersscholars.com/images/letterhead.jpg" width="400px"></h1>
        <h2><img src="https://theguildofmercersscholars.com/images/decofguildman.jpg" width="400px"></h2>
        <table class="maintable mt100">
            <tr>
                <td class="fullcell" colspan="2">
                    <p class="pb1">I, <?= $name ?>, do solemnly declare:</p>
                    <p class="pb1">That I will be true and faithful to our Sovereign Lady the Queen and to her heirs and successors, Kings and Queens of this realm;</p>
                    <p class="pb1">That I will be obedient to the Master and Wardens of the Guild of Mercers' Scholars in all things lawful and honest;</p>
                    <p class="pb11">That I will obey the ordinances and be mindful at all times of the good name and fame of the Guild.</p>
                    <p class="pb11">Signed ..........................</p>
                </td>
            </tr>

            <tr>
                <td class="leftcell">
                    <p><?= $eventdate ?></p>
                </td>
                <td class="cellright">
                  <p>Date of Freedom:  <?= $eventdate ?></p>
                </td>
            </tr>

        </table>
    </div>

<?php } ?>

<?php if ($decfreedom === TRUE) {?>
<div class="WordSection">
<p class="pb1"><b>Declaration of a Freeman of the City of London</b></p>
<p class="pb11">"I do solemnly swear that I will be good and true to our Sovereign Lady Queen Elizabeth the Second; that I will be obedient to the Mayor of this City; that I will maintain the Franchises and Customs thereof, and will keep this City harmless, in that which in me is; that I will also keep the Queen's Peace in my own person; that I will know no Gatherings nor Conspiracies made against the Queen's Peace, but I will warn the Mayor thereof, or hinder it to my power; and that all these points and articles I will well and truly keep, according to the Laws and Customs of this City, to my power."</p>

<p><i>To be read in the Chamberlain's Court</i></p>
</div>

<?php } ?>