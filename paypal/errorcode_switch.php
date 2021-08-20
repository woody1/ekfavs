<?php
/**
 * Created by IntelliJ IDEA.
 * User: Woody
 * Date: 09/10/2018
 * Time: 15:22
 */

switch ($output['L_ERRORCODE0']) {

    case 10502: // The credit card is expired.
    case 15007: // The transaction was declined by the issuing bank because of an expired credit card. The merchant should attempt another card.
        $error_txt = "Please retry this transaction using an alternative payment method, as this card has expired.";
        $show_card_details = 1;
        break;

    case 10752: // Note: The transaction was declined by the issuing bank, not PayPal. The merchant should attempt another card.
    case 15005: // The transaction was declined by the issuing bank, not PayPal. The merchant should attempt another card.
    case 15006: // This transaction cannot be processed. Please enter a valid credit card number and type. The transaction was declined by the issuing bank, not PayPal. The merchant should attempt another card.
        $error_txt = "Please retry this transaction using an alternative payment method, as the transaction was declined by your bank.";
        $show_card_details = 1;
        break;

    case 10505: // The transaction was refused because the AVS response returned the value of N
    case 10554: // The transaction was declined because of a merchant risk filter for AVS. Specifically, the merchant set the filter to decline a transaction when the AVS returns a no match (AVS = N).
    case 10555: // The transaction was declined because of a merchant risk filter for AVS. Specifically, the merchant set the filter to decline a transaction when the AVS returns a partial match.
    case 10556: // The transaction was declined because of a merchant risk filter for AVS. Specifically, the merchant set the filter to decline transactions when the AVS is unsupported.
        $error_txt = "Please verify the billing address is correct for the card details supplied.";
        $show_card_details = 1;
        $show_billing_address = 1;
        break;

    case 10521: // The credit card entered is invalid.
    case 10527: // CreditCardNumber and/or CreditCardType is invalid.
    case 10571: // This transaction was approved, although the Card Security Code (CSC) had too few, too many, or invalid characters.
    case 10759: // This transaction cannot be processed. Please enter a valid credit card number and type.
    case 10504: // The credit card verification code (CVC) provided is invalid. The CVC is between three and four digits long.
    case 10508: // The expiration date must be a two-digit month and four-digit year.
    case 10535: // Please enter a valid credit card number and type.  // This error can also be returned if you pass an industry standard test credit card number in the Live environment.
    case 15004: // The transaction was declined because the CVV entered does not match the credit card.
    case 10510: // The credit card type entered is not currently supported by PayPal.
        $error_txt = "Please check the credit card details supplied and resubmit.";
        $show_card_details = 1;
        break;

    case 10534: // The credit card entered is currently restricted by PayPal. For more information, contact PayPal.
    case 10537: // The transaction was declined by the country filter managed by the merchant. To accept this transaction, change your risk settings on PayPal.
    case 10547: // None. This is a PayPal internal error.
    case 10564: // There was a problem processing this transaction.
    case 10578: // Unable to make this transaction. It is possible that the amount would exceed the spending limit of the payer.
    case 10606: // Note: Inform the buyer that PayPal is unable to process the payment and redisplay alternative payment methods with which the buyer can pay or ask the buyer to contact
    case 10756: // None. This is a PayPal internal error.
    case 10763: // None. This is a PayPal internal error.
    case 10764: // This transaction cannot be processed at this time. Try again later.
    case 15011: // This credit card was issued from an unsupported country.
    case 99998: // This transaction cannot be processed.
    case 10544: // PayPal declined the transaction. For more information, contact PayPal.
    case 10545: // The transaction was declined by PayPal because of possible fraudulent activity. For more information, contact PayPal.
    case 10626: // Transaction refused due to risk model.
    case 10754: // PayPal declined the transaction. For more information, contact PayPal.
    case 11612: // Could not process your request to accept/deny the transaction.
    case 15001: // The transaction was rejected by PayPal because of excessive failures over a short period of time for this credit card. For more information, contact PayPal.
    case 15002: // PayPal declined the transaction. For more information, contact PayPal.
    case 10538: // Transaction refused due to max amount risk control.
    case 10539: // PayPal declined the transaction. For more information, contact PayPal.
    case 11610: // Payment Pending your review in Fraud Management Filters.
    case 12000: // Transaction is not compliant due to missing or invalid 3-D Secure authentication values.
    case 12001: // Transaction is not compliant due to missing or invalid 3-D Secure authentication values.
        $error_txt = "There was an error during the payment process, please <a href='shop-checkout'>click here </a>and try again. If the problem persists please email <a href='mailto: ". CONTACT_EMAIL ." ?subject=Error during the payment process! REF:". $output['L_ERRORCODE0'] ."')>". CONTACT_EMAIL ." </a>";
        break;

    case 10761: // The transaction was declined because PayPal is currently processing a transaction by the same buyer for the same amount. This error can occur when a buyer submits multiple, identical transactions in quick succession.
        $error_txt = "This order has already been submitted, please email <a href='mailto: ". CONTACT_EMAIL ." ?subject=Error during the payment process! REF:". $output['L_ERRORCODE0'] ."')>". CONTACT_EMAIL ." </a> for further assistance.";
        $show_card_details = 1;
        $show_billing_address = 1;
        $email_error = 1;
        break;

    case 10536: // The merchant entered an invoice ID that is already associated with a transaction by the same merchant. By default, the invoice ID must be unique for all transactions. To change this setting, log into PayPal or contact customer service.
    case 10417: // The transaction was refused as a result of a duplicate invoice ID supplied. Attempt with a new invoice ID.
    case 10546: // IP fraud models failed. The transaction was declined by PayPal because of possible fraudulent activity on the IP address. For more information, contact PayPal.
    case 11607: // Duplicate request for specified Message Submission ID.
    case 11611: // Transaction blocked by your settings in FMF.
    case 11821: // This transaction cannot be processed because it has already been denied by a Fraud Management Filter.
        $error_txt = "There was a problem whilst processing your order. If you are not automatically redirected please <a href='shop-checkout'>click here </a>.";
        echo "<script>window.location.replace('shop-checkout');</script>";
        break;

    // waiting to do something with this
    //case 10574: // Note: DCC zero amount authorization error. This is not an error message. This message is a verification message returned with the acknowledgment status: Ack=SuccessWithWarning

    default:
        $error_txt = "There was an error during the payment process, please <a href='shop-checkout'>click here </a>and try again. If the problem persists please email <a href='mailto: ". CONTACT_EMAIL ." ?subject=Error during the payment process! REF:". $output['L_ERRORCODE0'] ."')>". CONTACT_EMAIL ." </a>";
        break;
}