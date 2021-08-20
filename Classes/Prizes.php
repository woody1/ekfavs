<?php
class Prizes {

    public $sql;
    public $id;
    public $db;

    function __construct() {

        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// View Prizes
    public function view_prizes(){
        //echo $this->sql;
        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);
    }// end function view_sql()

// List Prizes Home page

    public function list_prizes(){
        //echo $this->sql;
        $cart_result = @mysqli_query($this->dbc, 'SELECT * FROM prizes') or die("Error with prizes list :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->list .= "<b>".$row['title']." </b>
            <br> ". ucfirst($row['description'])." ".$row['donated_by']." <br><br>";

        }// end while
        mysqli_close($this->dbc);
    }// end function view_sql()

}// end viewCart class

