<?php

//// Set perams

// Environments
$ipnSimulator = TRUE; // Are you using ipnSimulator True or False
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

if (strcmp($res, "VERIFIED") == 0) {

    // First take the custom field and split into shop id and delivery_method - BOOM!
    $custom = explode("~", $_POST['custom']);

    // now assign posted variables to local variables
    $shop_id			= $custom[0];
    $txn_type           = $_POST['txn_type']; // This is a test -
    $first_name         = $_POST['first_name'];
    $last_name          = $_POST['last_name'];
    $address_name	    = $_POST['address_name'];
    $address_street	    = $_POST['address_street'];
    $address_street2    = $_POST['address_street2'];
    $address_city	    = $_POST['address_city'];
    $address_state	    = $_POST['address_state'];
    $postcode	        = $_POST['address_zip'];
    $address_country	= $_POST['address_country'];
    $residence_country	= $_POST['residence_country'];
    $payment_status     = $_POST['payment_status'];
    $mc_gross           = $_POST['mc_gross'];
    $mc_currency     	= $_POST['mc_currency'];
    $txn_id 			= $_POST['txn_id'];
    $receiver_email 	= $_POST['receiver_email'];
    $payer_email 		= $_POST['payer_email'];
    $receiver_id		= $_POST['receiver_id'];
    $pay_key            = $_POST['pay_key'];
    $paymentId          = $_POST['paymentId'];

    // Calculate VAT amt

    if ($shop_id == ''){ exit; }


    include_once('../Classes/Sql.php');
    $checktxn_id = new Sql();
    $checktxn_id->sql = "Select * from invoice where transaction_id = '$txn_id'";
    $checktxn_id->view_sql();


    //do a check to see if all is OK.
    if (($receiver_email != PAYPAL_EMAIL) or ($payment_status != "Completed") or ($mc_currency != $currency) or ($checktxn_id->num_rows  > 0 ) or ($txn_type == "paypal_here")) {

        // check whether the payment_status is Completed
        if ($payment_status != "Completed"){
            $subject 	= "Payment Status Error on $txn_id";
            $txt		= "We had a Payment Status Error.  Email = $payer_email - Payment Status = $payment_status ";
        }//end not completed

        // check that receiver_email is your Primary PayPal email
        if ($receiver_email != PAYPAL_EMAIL) {
            $subject 	= "Spoof email Error on $txn_id";
            $txt		= "We had a Spoof Email Error.' PAYPAL_EMAIL '  Email = $payer_email - Receiver Email = $receiver_email - and PAYPAL_EMAIL = ". PAYPAL_EMAIL ."Payment Status = $payment_status ";
        }//end spoof email error

        // check that payment_currency are correct
        if ($mc_currency != $currency){
            // send wrong currency error
            $subject 	= "Wrong Currency Error on $txn_id";
            $txt		= "We had a Wrong Currency Error.  Email = $payer_email - Payment Status = $payment_status";
        }// end wrong currency error

        // check that txn_id has not been previously
        if ($checktxn_id->num_rows  > 0 ) {
            $subject = "Same Tx id  $txn_id";
            $txt = "Same Tx Id   Email = $payer_email - Number of rows = $checktxn_id->num_rows /  Payment Status = $payment_status / shipping = $shipping";
        }

        // check that amt is right -
        if ($TotalItemsOrdered != $sums) {

            $subject = "The sums dont add up  $txn_id";
            $txt = "There is a problem with the sums ".$item['TotalItemsOrdered']." ($mc_gross - $shipping)  Sum = $sums / 
            
           mc_gross = $chk_mc_gross
           TotalItemsOrdered = $chk_Ordered
           shipping = $chk_shipping
           sums = $sums
           
             Email = $payer_email - Payment Currency  = $payment_currency - Payment Status = $payment_status";
            $process = "no";
        }

        // check that amt is right -
        if ($txn_type == "paypal_here") {

            $subject = "Pay Pal here transaction";
            $txt = "PayPal here 
            
           mc_gross = $chk_mc_gross
           TotalItemsOrdered = $chk_Ordered
           shipping = $chk_shipping
           sums = $sums
           
             Email = $payer_email - Payment Currency  = $payment_currency - Payment Status = $payment_status";
            $process = "no";
        }

        $to = $email_to;
        $headers = "From: $email_from" . "\r\n";
        mail($to, $subject, $txt, $headers);

    } else {


        // process the notification


        // 1. Add details of user, billing address and delivery address to invoice table

        define('checkout', TRUE);
        include_once('Checkout.php');

        $checkout = new Checkout();
        $checkout->shop_id = $shop_id;
        $checkout->firstname = $first_name;
        $checkout->lastname = $last_name;
        $checkout->email = $payer_email;
        $checkout->street = $street;
        $checkout->street2 = $street2;
        $checkout->city = $city;
        $checkout->state = $state;
        $checkout->postcode = $zip;
        $checkout->country = $residence_country;
        $checkout->shiptoname = $address_name;
        $checkout->shiptostreet = $address_street;
        $checkout->shiptostreet2 = $shiptostreet2;
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


        // 5. Send email to user with confirmation
        // Map the variables for the email - fing paypay inconfuckingsistencies
        $firstname       = $first_name;
        $lastname        = $last_name;
        $shiptoname      = $address_name;
        $street          = "Paypal retains the Invoice Address";
        $shiptostreet    = $address_street;
        $shiptostreet2   = $address_street2;
        $shiptocity      = $address_city;
        $shiptostate     = $address_state;
        $shiptozip       = $postcode;
        $shiptocountry   = $address_country;
        $email           = $payer_email;
        $itemamt         = $item['TotalItemsOrdered'];
        $shippingamt     = $shipping;
        $total_amount    = $mc_gross;


        // get the list of items sold
        $product_list = new Checkout();
        $product_list->invoice_id = $invoice_id;
        $product_list->cart_list_emails();

///EMAIL\\\
        // TO
        $to_email = "$email";
        $to_name = "$firstname $lastname";

        // Subject
        $subject = 'East Knoyle Flower and Vegetable Show' . $checkout->last_id;

        // Page for the email body
        $email_body = "../mail/email-shopper.php";

        include_once('../mail/sendemail.php');

// 6. Send email to orders@otc with confirmation



        include_once("../mail/body-already-account.php");



        ////==============================================================
        //// send email
        //Send email to
        $to_email = clean($_POST['email']);
        //Title of form
        $title = 'Create Update Account';
        //Set the subject line
        $subject = "Confirmation Code";
        // The USID if the same as the udid.
        $usid = $udid;

        include("../mail/sendemail.php");

///EMAIL\\\
        // TO
        /*
        $to_email = "";
        $to_name = "Orders";


        // Page for the email body
        $email_body = "../email/email-shopper.php";

        include_once('../email/email.php');
        */

        // 6. Send back up email to orders@otc with confirmation via mail.

        $subject = "Order Confirmation from Paypal $valid";
        $txt = "$first_name $last_name has just placed and order via paypal / TX ID = $txn_id / Invoice = ".$checkout->last_id."  /  Shop ID = $shop_id / Payment $payment_status = receiver_email = $receiver_email -MEMO = $memo / Pay Key = $pay_key / paymentId = $paymentId";

        $headers = "From: $email_from" . "\r\n";
        mail($email_to, $subject, $txt, $headers);

    }


} else if (strcmp ($res, "INVALID") == 0) {
    // IPN invalid, log for manual investigation
    echo "The response from IPN was: <b>" .$res ."</b> :( ";

    $subject = "My subject ->= $valid";
    $txt = "There is a problem with $company_name is INVALID = $res - Aghhhh :( ";
    $headers = "From: $email_from" . "\r\n";

    mail($email_to,$subject,$txt,$headers);
}