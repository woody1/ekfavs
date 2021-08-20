<?php

defined('Update') or header( 'Location: /404');

class UsersDetails
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
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql() :(" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;
        }// end while
        mysqli_close($this->dbc);

    }// end function view_sql()

    public function usersname($id){

        $sql = "SELECT * from users WHERE id = '$id'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql() :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->name = decrypt($row['firstname']) . "  " . decrypt($row['lastname']);

        }// end while

        return  $this->name;

        mysqli_close($this->dbc);

    }// end function view_sql()

    public function emailsadds(){

        $sql = "SELECT * from users WHERE email = ''";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->data_array[] = $row;

            echo decrypt($row['email']) . ", ";

        }// end while
        mysqli_close($this->dbc);

    }// end function view_sql()


    public function household($household){

        $sql = "SELECT * from users WHERE household = '$household'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);

        while ($row = mysqli_fetch_assoc($cart_result)) {

            //Show age as adult if 16 +
            if($row['age'] == '16'){$age = 'Adult';} else {$age = $row['age'];}

            foreach(unserialize($row['clases']) as $x => $val) {$allclases .= "Class $val, ";}
            $total_class = count(unserialize($row['clases']));

            if($age == "Adult") {$cost = floor(($total_class / 10) + .9) *2; } else {$cost = "0";};

            $total_cost = $cost + $total_cost;

           // echo $cost;

        }

        $sql = "SELECT sum(total_amount) as total_amount from invoice WHERE users_id = '$household'";
        $result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql()" . mysqli_error($this->dbc));
        $res = mysqli_fetch_assoc($result);

        return $total_cost - $res['total_amount'];

        mysqli_close($this->dbc);

    }


    public function listusers(){

        $sql = "SELECT * from users";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql() printlables" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);

        while ($row = mysqli_fetch_assoc($cart_result)) {

            //Show age as adult if 16 +
            if($row['age'] == '16'){$age = 'Adult';} else {$age = $row['age'];}

            foreach(unserialize($row['clases']) as $x => $val) {$allclases .= "Class $val, ";}
            $total_class = count(unserialize($row['clases']));

            if($age == "Adult") {$cost = floor(($total_class / 10) + .9) *2; } else {$cost = "0";};

            if($total_class > 0 and $row['clases'] != ""){
                $tdclass = $allclases;
            }else{
                $tdclass = "No classes selected for " . decrypt($row['firstname']);
                $showcost = "";
                $cost = 0;
            }

            $amount_due = UsersDetails::household($row['household']);

            if ($row['id'] == $row['household']) {

                if ($amount_due <= 0) { $paid = "Paid"; } else { $paid = "£". number_format((float)abs($amount_due))." Due"; }

            } else { $paid = "-";}


            $this->list .= " 
            <tr>
                    <td><p><b>" . decrypt($row['firstname']) . "  " . decrypt($row['lastname']) . "</b></p></td>
                    <td class='text-dark'> " . $row['id'] . "</td>
                    <td>". rtrim($tdclass, ",") ." <br>$showcost</td>
                    <td>$paid</td>
                    <td>" . $row['household'] . "</td>
                    <td>
                    <form id='contact' action='household.php' method='post'>
                        <input type='hidden' name='household' value='".$row['household']."'>
                        <button class='btn btn-outline-primary' name='button' value='classes'>Edit</button>
                </form>
                
                    
</td>
                </tr>
        ";

            $allclases = "";
        }



        mysqli_close($this->dbc);
    }

    public function printlables(){

        $i = 0;

        $sql = "SELECT * from users";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't ViewSql page view_sql() printlables" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
            while ($row = mysqli_fetch_assoc($cart_result)) {

                $userid =  $row['id'];

                // Run the foreach on the clases.
                foreach(unserialize($row['clases']) as $x => $val) {$allclases .= "'$val',";}
                $allclases = rtrim($allclases, ",");

                if ($allclases != "") {
                    //Now get the details for each user and each class:
                    $sqlcard = "SELECT * FROM classes WHERE id IN($allclases)";

                    $card_result = @mysqli_query($this->dbc, $sqlcard) or die("Couldn't ViewSql page view_sql() classes" . mysqli_error($this->dbc));
                    $this->num_rows = mysqli_num_rows($card_result);


                    while ($row = mysqli_fetch_assoc($card_result)) {

                        $description =   $row['description'];

                        $i++;
                        $break = ($i/18);
                        $line =  ($i/3);
                        if($line  === intval($line)) {$ightline = ''; }else {$ightline = 'exhcardright';}

                            $this->list .= "
                   
                                <div class='exhcard $ightline'>
                                   <div class='toptext'>
                                      East Knoyle<br>Flower and Vegetable Show
                                   </div>
                                  
                                    <div class='classdiv'>
                                        <b>Class: 
                                            " . $row['id'] . " </b> 
                                    </div>
                                    <div class='exhibitordiv'>
                        
                                      <b>Exhibitor ID: $userid</b>
                                    </div>
                                </div>
                                 ";



                        if($break  === intval($break)) {
                            $this->list .= "
                           
                            </div>
                         <div class='break'></div>
                             <div class='cardcontainer'>
                            ";
                        }
                    }
                    $allclases = "";
                }
            }// end while

        mysqli_close($this->dbc);

    }// end function view_sql()

}// end viewCart class

