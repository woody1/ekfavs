<?php
class Classes {

    public $sql;
    public $id;
    public $db;

    function __construct() {

        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }


// List Prizes Home page

    public function list_class($class, $sub_class, $clases){
        $cart_result = @mysqli_query($this->dbc, "SELECT * FROM classes where class = '$class' and sub_class = '$sub_class'") or die("Error with prizes list :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);


        while ($row = mysqli_fetch_assoc($cart_result)) {

            if (in_array($row['id'], unserialize($clases))) {
                $checked = "checked";
            } else {  $checked = ""; }

            echo "<label class='checkmeout'>Class ".$row['id'].": &nbsp; ".$row['description']."<input type='checkbox' name='class[]' value='".$row['id']."' $checked><span class='checkmark'></span></label>";

        }// end while
       // mysqli_close($this->dbc);
    }// end function view_sql()

}// end viewCart class

