<?php

$payment_due = $totals['payment_due'];

if ($payment_due > 0) { $paymenttxt =  "The sum of &#163; $payment_due to Guild's bank account has been confirmed.";
}else{
    $paymenttxt = "";
}

$emailbody = "

<p>Dear ". $to_firstname .",</p> 
<p>You have ". $totals['number_head'] ." place". ($totals['number_head'] == 1 ? '' : s ) ." booked for '". $event['event_title'] ."'.</p> 
 <p>". $paymenttxt ."</p>

    <p>Booking Reference: <b>". $update['payment_ref'] ."</b>
        <br><b>Important:</b> Please include this booking reference number  and all correspondence.</p>



";

