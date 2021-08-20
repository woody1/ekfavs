<?php

defined('Update') or header( 'Location: /404');

class ViewUsers
{

    public $udid;
    public $household;
    public $memberid;

    function __construct()
    {
        $this->dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// View SQL
    public function Userdetail(){

        $sql = "SELECT * from users WHERE udid = '$this->udid'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);

    }// end function view_sql()


    public function invoice(){

        $sql = "SELECT * from invoice WHERE users_id = '$this->household'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);

    }// end function view_sql()

    public function users_contact(){

        $sql = "SELECT * from users_contact WHERE household  = '$this->household'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);

    }// end function view_sql()

    public function memberdetail(){

        $sql = "SELECT * from users WHERE id = '$this->memberid'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);

    }// end function view_sql()

    public function userlist(){

        $sql = "SELECT * from users WHERE household = '$this->household'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
            while ($row = mysqli_fetch_assoc($cart_result)) {

                //Show age as adult if 16 +
                if($row['age'] == '16'){$age = 'Adult';} else {$age = $row['age'];}

                //
                foreach(unserialize($row['clases']) as $x => $val) {$allclases .= "Class $val, ";}

                $total_class = count(unserialize($row['clases']));

                if($age == "Adult") {$cost = floor(($total_class / 10) + .9) *2; } else {$cost = "0";};

                $showcost = $cost? "£$cost" : "Free";

                if($total_class > 0 and $row['clases'] != ""){
                    $tdclass = $allclases;
                }else{
                    $tdclass = "No classes selected for " . decrypt($row['firstname']);
                    $showcost = "";
                    $cost = 0;
                }

                $this->list .= " 
                <tr>
                <td> 
                  <p> 
                 <form id='update".$row['id']."' action='addclasses.php' method='post'>
                        <input type='hidden' name='memberid' value='".$row['id']."'>
                  <b>  <a href=\"javascript:{}\" onclick=\"document.getElementById('update".$row['id']."').submit(); return false;\"> 
                     " . decrypt($row['firstname']) . "  " . decrypt($row['lastname']) . "  <i class='fa fa-pencil'></i></a></b>
                </form>
             Exhibitor number: ".$row['id']."</p>
                
               </td>
                <td>$age</td>
                <td>". rtrim($tdclass, ",") ." <br>$showcost</td>
                <td> 
                    <form id='contact' action='addclasses.php' method='post'>
                        <input type='hidden' name='memberid' value='".$row['id']."'>
                        <button class='btn btn-outline-info' name='button' value='classes'>Edit and add classes</button>
                    </form>
                  
      
                </td>
            </tr>
                ";
                //Calculate the total number of classes:
                $household_total = $total_class + $household_total;
                $this->household_total = $household_total;

                //Calculate the total cost :
                $total_cost = $cost + $total_cost;
                $this->total_cost = $total_cost;
                $allclases = "";

            }// end while
        mysqli_close($this->dbc);
    }// end function view_sql()
}// end viewCart class

