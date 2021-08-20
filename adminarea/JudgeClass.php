<?php
class JudgeClass {

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

            echo "
<form id='".$row['id']."' class='judgeme' action=''>
            <tr>
                
               <th>Class ".$row['id']." ".$row['sub_class']."</th>
                <th><input type='number' name='st' value='".$row['1st']."' class='judgeme'></th>
                <th><input type='number' name='nd' value='".$row['2nd']."' class='judgeme'></th>
                <th><input type='number' name='rd' value='".$row['3rd']."' class='judgeme'></th>
                <th><input hidden name='id' value='".$row['id']."'>
               <input type='submit' value='Add'></th>
      
            </tr>
                  </form>
            ";

        }// end while
       // mysqli_close($this->dbc);
    }// end function view_sql()

    public function list_prizes($prizeid){
        $cart_result = @mysqli_query($this->dbc, "SELECT * FROM prizes where id = '$prizeid'") or die("Error with prizes list :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->id = $row['id'];
            $this->title  = $row['title'];
            $this->description  = $row['description'];
            $this->donated_by = $row['donated_by'];
            $this->winner = $row['winner'];
        }
    }

    public function calculate1($where){
        $sql = "SELECT 1st, COUNT(*) as exh FROM classes where 1st != 0 $where GROUP BY 1st ORDER BY exh";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Error with prizes list 1 :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->first[$row['1st']] = $row['exh'] * 4;
        }
        return $this->first;
    }

    public function calculate2($where){
        $sql = "SELECT 2nd, COUNT(*) as exh FROM classes where 2nd != 0 $where GROUP BY 2nd ORDER BY exh";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Error with prizes list 2 :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->second[$row['2nd']] = $row['exh'] * 3;
        }
        return $this->second;
    }

    public function calculate3($where){
        $sql = "SELECT 3rd, COUNT(*) as exh FROM classes where 3rd != 0 $where GROUP BY 3rd ORDER BY exh";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Error with prizes list 3 :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->third[$row['3rd']] = $row['exh'] * 2;
        }
        return $this->third;
    }

    public function winers($where){

        $all = [JudgeClass::calculate1($where), JudgeClass::calculate2($where), JudgeClass::calculate3($where)];
        $result = [];
        array_walk_recursive($all, function($v, $k) use (&$result) {
            if (!isset($result[$k])) {
                $result[$k] = $v;
            } else {
                $result[$k] += $v;
            }
        });

        //Get the max value fo rteh result:
        $maxval = max($result);
        $this->winner = array_search($maxval, $result);
        // Sort $result in order so we can get second.
        asort($result);
        // Then get the First place - First pick the last but one key - value
        $first = array_slice($result, -1, 1, true);
        //With that run a loop to get the key and score
        foreach($first as $nmkey => $score)
        {
            $this->firstkey = $nmkey;
            $this->firstscore = $score;
        }
        // Then get the second one
        $second = array_slice($result, -2, 1, true);
        foreach($second as $nmkey => $score)
        {
            $this->secondkey = $nmkey;
            $this->secondscore = $score;
        }
    }

    // This function gest the winner of a cup when eneered into the  prizes table.
    public function cupwinner($id){
        $sql = "SELECT winner FROM  prizes where id = '$id'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Error with prizes cup winner :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            $winner = $row['winner'];

        }
        return $winner;
    }

    public function scarecrow($id){
        $sql = "SELECT household FROM users_contact where id = '$id'";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Error with prizes cup winner :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $winner = $row['household'];
        }
        return $winner;
    }

    public function warning(){
        $sql = "SELECT * FROM classes where 1st = 0";
        $cart_result = @mysqli_query($this->dbc, $sql) or die("Error with prizes cup winner :( " . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);

    }

}// end viewCart class

