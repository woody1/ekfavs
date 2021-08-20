<?php

//// Set perams

// Environments
$ipnSimulator = FALSE; // Are you using ipnSimulator True or False
//SET sandbox in oor config file.
$sandbox = FALSE;

const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');

// Set Environments
if ($sandbox === TRUE) {
    $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');

} elseif ($sandbox === FALSE){
    $ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
}

// ipnSimulator perams -
if ($ipnSimulator === TRUE) {
    $currency = "USD";
} elseif ($ipnSimulator === FALSE) {
    $currency = "GBP";
}


// read the post from PayPal system and add 'cmd'
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

//  POST IPN data back to PayPal to validate

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

if ( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);

// The IPN is verified, process it:

//// Set perams


const flower = TRUE;
include_once("../define.php");
include_once(OUTOFROOT . 'config.php');

if (strcmp ($res, "VERIFIED") == 0) {
    $pay_key = "VERIFIED";


    // First take the custom field and split into shop id and delivery_method - BOOM!
    $custom = explode("~", $_POST['custom']);

    // now assign posted variables to local variables
    $shop_id = $custom[0];
    $txn_type = $_POST['txn_type']; // This is a test -
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address_name = $_POST['address_name'];
    $address_street = $_POST['address_street'];
    $address_street2 = $_POST['address_street2'];
    $address_city = $_POST['address_city'];
    $address_state = $_POST['address_state'];
    $postcode = $_POST['address_zip'];
    $address_country = $_POST['address_country'];
    $residence_country = $_POST['residence_country'];
    $payment_status = $_POST['payment_status'];
    $mc_gross = $_POST['mc_gross'];
    $mc_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $receiver_id = $_POST['receiver_id'];
    $paymentId = $_POST['paymentId'];

// Checks -
    // Check to see if we have a shop_id
    if ($shop_id == '') {
        exit;
    }

    // Check to see if the transaction_id has been used before:
    include_once('../Classes/Sql.php');
    $checktxn_id = new Sql();
    $checktxn_id->sql = "Select * from invoice where transaction_id = '$txn_id'";
    $checktxn_id->view_sql();

    if ($checktxn_id->num_rows > 0) {
        $subject = "Same Tx id  $txn_id";
        $trans_error = TRUE;
        $txt .= "trans_error -- ";
    }

    if ($payment_status != "Completed") { //Completed
        $payment_status_error = TRUE;
        $txt .= "payment_status_error -- ";
    }

    if ($receiver_email != PAYPAL_EMAIL) {
        $receiver_email_error = TRUE;
        $txt .= "receiver_email_error -- ";
    }

    if ($mc_currency != $currency) {
        $mc_currency_error = TRUE;
        $txt .= "mc_currency_error -- ";
    }

    $erros = array($trans_error, $payment_status_error, $receiver_email_error, $mc_currency_error);

    $txt .= "You have" . count(array_filter($erros)) . "ERRORS " . fmod($mc_gross / 2);
    $txt .= PAYPAL_EMAIL . " $mc_gross == Same Tx Id   Email = $payer_email   Payment Status = $payment_status / shipping = $shipping";


// Email the errors

    if (count(array_filter($erros)) > 0) {
        $to = "woody@abweb.co.uk";
        $headers = "From: woody@abweb.co.uk" . "\r\n";
        mail($to, "ERROR", $txt, $headers);

    } elseif (count(array_filter($erros)) == 0) {

        // 1. Add details of user, billing address and delivery address to invoice table

        define('checkout', TRUE);
        include_once('Checkout.php');

        $checkout = new Checkout();
        $checkout->shop_id = $shop_id;
        $checkout->firstname = $first_name;
        $checkout->lastname = $last_name;
        $checkout->email = $payer_email;
        $checkout->users_id = $shop_id;
        $checkout->street = $street;
        $checkout->street2 = $street2;
        $checkout->city = $city;
        $checkout->state = $state;
        $checkout->postcode = $zip;
        $checkout->country = $residence_country;
        $checkout->shiptoname = $address_name;
        $checkout->shiptostreet = $address_street;
        $checkout->dateadded = date("Y-m-d H:i:s");
        $checkout->transaction_id = $txn_id;
        $checkout->ack = $payment_status;
        $checkout->invnum = $pay_key;
        $checkout->sold_medium = "Website - Paypal";
        $checkout->payment_date = date("Y-m-d H:i:s");
        $checkout->itemamt = $item['TotalItemsOrdered'];
        $checkout->total_amount = $mc_gross;

        $checkout->add_to_invoice();
        $invoice_id = $checkout->last_id;

        // process the notification
        $txt = "$mc_gross Email = $payer_email   Payment Status = $payment_status $invoice_id";

        $to = "andrew.wood@aswood.com";
        $headers = "From: woody@abweb.co.uk" . "\r\n";
        mail($to, "EKFAVS Success", $txt, $headers);


    }// end of error check

}else if (strcmp ($res,"INVALID") === 0 )   {

    $pay_key = "INVALID";
    $to = "woody@abweb.co.uk";
    $headers = "From: woody@abweb.co.uk" . "\r\n";
    mail($to, "ERROR", "(strcmp ($res,INVALID) - ". $_POST['txn_id'], $headers);

}else{

    $to = "woody@abweb.co.uk";
    $headers = "From: woody@abweb.co.uk" . "\r\n";
    mail($to, "ERROR", "PAYPAL ERROR WITH EKFAVES - ". $_POST['txn_id'], $headers);

}