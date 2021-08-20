<?php

defined('Payment') or header( 'Location: /404');

class Payment
{

    public $user_id;
    public $household;
    public $memberid;
    public $total_amount;
    public $sold_medium;
    public $dispatched_by;

    function __construct()
    {
        $this->dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// View SQL
    public function sums(){

        $sql = "SELECT sum(total_amount) as total_amount from invoice WHERE users_id = '$this->household'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->total_amount = $row['total_amount'];

        }// end while
        mysqli_close($this->dbc);
    }// end function view_sql()


    public function householddue(){
        $sql = "SELECT * from users WHERE household = '$this->household'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);

        while ($row = mysqli_fetch_assoc($cart_result)) {
            //Show age as adult if 16 +
            if($row['age'] == '16'){$age = 'Adult';} else {$age = $row['age'];}
            foreach(unserialize($row['clases']) as $x => $val) {$allclases .= "Class $val, ";}
            $total_class = count(unserialize($row['clases']));
            if($age == "Adult") {$cost = floor(($total_class / 10) + .9) *2; } else {$cost = "0";};
            $total_cost = $cost + $total_cost;
        }
        $this->total_due =  $total_cost;
        mysqli_close($this->dbc);
    }



    public function listpayments(){

        $sql = "SELECT * from invoice WHERE users_id = '$this->household'";

        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {


            $payment_date = date( 'jS F Y', strtotime( $row['payment_date']));
            $payment_time = date( 'H:i', strtotime( $row['payment_date']));
            $total_amount =  number_format($row['total_amount'], 2, '.', '');

            $this->list .= "
            
            <li>". $row['sold_medium'] . "  of  £$total_amount on $payment_date at $payment_time</li>
            
            
            ";

        }// end while
        mysqli_close($this->dbc);

    }

    public function add_to_invoice(){


        $sql =  "INSERT INTO `invoice` 
        (`users_id`, `sold_medium`, `payment_date`,  `total_amount`, `dispatched_by`) 
        VALUES 
    ( 
   
    '". mysqli_real_escape_string($this->dbc, $this->household) ."' ,
    '". mysqli_real_escape_string($this->dbc, $this->sold_medium) ."' ,
    NOW(),
    '". mysqli_real_escape_string($this->dbc, $this->total_amount) ."' ,
    '". mysqli_real_escape_string($this->dbc, $this->user_id) ."')";


        $cart_result = @mysqli_query($this->dbc, $sql) or die("add_to_invoice()" . mysqli_error($this->dbc));
        $this->last_id = mysqli_insert_id($this->dbc);

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }// end function view_sql()



}// end viewCart class

