<?php
$emailbody = "

<p>Dear ". $to_firstname .",</p> 
<p>You have ". $totals['number_head'] ." place". ($totals['number_head'] == 1 ? '' : s ) ." reserved for '". $event['event_title'] ."'.</p>
 <p>Please transfer the sum of &#163;". $totals['payment_due'] ." to Guild's bank account:</p>

    <p><b>Bank details:</b></p>
    <p><?= _BANK_NAME ?></p>
    <p>Account Name: Guild of Mercers' Scholars </p>
    <p>Sort Code: ".  _BANK_SORTCODE ." </p>
    <p>Account number: ". _BANK_ACCOUNT ."</p>
    <p>Booking Reference: <b>". $update['payment_ref'] ."</b>
        <br><b>Important:</b> Please include this booking reference number in the bank transfer and all correspondence. Your booking will not be confirmed until payment has been received.</p>



";

