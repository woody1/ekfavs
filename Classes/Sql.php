<?php
class Sql {

    public $sql;
    public $id;
    public $db;

    function __construct() {

        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// View SQL
    public function view_sql(){

        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);



    }// end function view_sql()

// Update SQL
    public function update_sql(){

        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't update_sql :( " . mysqli_error($this->dbc));
        mysqli_close($this->dbc);

        //echo $this->sql;

    }// end function update_sql()

//Count Sql
    public function count_sql(){

        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't count sql" . mysqli_error($this->dbc));
        $row = mysqli_fetch_assoc($cart_result);
        $this->total =  $row['total'];

    }// end function count_sql()




}// end viewCart class

