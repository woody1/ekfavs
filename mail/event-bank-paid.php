<?php
$emailbody = "

<p>Dear ". $to_firstname .",</p> 

<p>Thank you for your payment which we have now received.</p>
<p>You have ". $booked['number_head'] ." place". ($booked['number_head'] == 1 ? '' : s ) ." booked for '". $booked['event_title'] ."'.</p>


    <p>In the event that you subsequently need to cancel your booking, please note the following:</p>
            <ul>
                <li>Cancellations made before ". date('D dS M Y', strtotime($booked['refund_cutoff'])) .", a 90% reimbursement can be sought.</li>
                <li>Cancellations made on or after ". date('D dS M Y', strtotime($booked['refund_cutoff'])) ." you are responsible for the full fee paid and no refund can be sought.</li>
            </ul>
 </p>

";

