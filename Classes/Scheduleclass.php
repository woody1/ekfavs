<?php
class Scheduleclass {

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

    public function usersname($id){

        $sql = "SELECT * from users WHERE id = '$id'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql() :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->name = ucfirst(decrypt($row['firstname'])) . "  " . ucfirst(decrypt($row['lastname']));

        }// end while

        return  $this->name;

        mysqli_close($this->dbc);

    }// end function view_sql()

    public function list_class($class, $sub_class){
        //echo $this->sql;
        $cart_result = @mysqli_query($this->dbc, "SELECT * FROM classes where class = '$class' and sub_class = '$sub_class'") or die("Error with prizes list :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            if ($row['1st'] != 0) {$st = "<li class='text-white'>First: ".  Scheduleclass::usersname($row['1st'])  ."</li>";}else{$st = "";}
            if ($row['2nd'] != 0) {$nd = "<li class='text-white'>Second: ". Scheduleclass::usersname($row['2nd'])  ."</li>";}else{$nd = "";}
            if ($row['3rd'] != 0) {$rd = "<li class='text-white'>Third: ".  Scheduleclass::usersname($row['3rd'])  ."</li>";}else{$rd = "";}

            echo "<p class='text-white'>Class ".$row['id'].": &nbsp; ".$row['description']."  ".$row['link']."  </p>
                    <ul>
                        $st
                            $nd
                        $rd
                    </ul>
            ";
        }// end while
       // mysqli_close($this->dbc);
    }// end function view_sql()

}// end viewCart class

