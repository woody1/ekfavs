<?php

defined('checkout') or header( 'Location: /404');

class Checkout {

    Public $shop_id;
    Public $firstname;
    Public $lastname;
    Public $email;
    Public $phone_number;
    Public $users_id;
    Public $street;
    Public $street2;
    Public $city;
    Public $state;
    Public $region;
    Public $postcode;
    Public $country;
    Public $dateadded;
    Public $transaction_id;
    Public $ack;
    Public $ipn;
    Public $invnum;
    Public $sold_medium;
    Public $trade;
    Public $payment_date;
    Public $itemamt;
    Public $total_amount;
    Public $invoice_id;

    function __construct() {
        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Please refresh the page " . mysqli_error($this->dbc));
    }

    public function add_to_invoice(){


        $sql =  "INSERT INTO `invoice` 
(`shop_id`, `firstname`, `lastname`, `email`, `phone_number`, `users_id`, `street`, `street2`, `city`, `state`, `region`, `postcode`, `country`,  `dateadded`, `transaction_id`, `ack`, `invnum`, `sold_medium`, `payment_date`, `itemamt`, `total_amount`) 
VALUES 
( 
'". mysqli_real_escape_string($this->dbc, $this->shop_id) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->firstname) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->lastname) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->email) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->phone_number) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->users_id) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->street) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->street2) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->city) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->state) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->region) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->postcode) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->country) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->dateadded) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->transaction_id) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->ack) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->invnum) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->sold_medium) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->payment_date) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->itemamt) ."' ,
'". mysqli_real_escape_string($this->dbc, $this->total_amount) ."')";


        $cart_result = @mysqli_query($this->dbc, $sql) or die("add_to_invoice()" . mysqli_error($this->dbc));
        $this->last_id = mysqli_insert_id($this->dbc);

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }// end function view_sql()

    public function update_ipn(){

        $sql = "UPDATE invoice SET `ipn` = '". $this->ipn  ."' WHERE invnum  = '". $this->invnum  ."'";

        mysqli_query($this->dbc, $sql) or die(mysqli_error($this->dbc));
        mysqli_close($this->dbc);
    }



    public function cart_list_emails()
    {
        $query = "SELECT * FROM `stock_sold` WHERE  invoice_id  = '$this->invoice_id'";

        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't list_articles :(");
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {


            $this->product_list .= "
            <tr>
                <td>".$row['product_name']."</td>
                <td>".$row['qty']."</td>
                <td>".$row['total_amount'] ."</td>
            </tr>
            ";

        }
    }

}// End Class\
