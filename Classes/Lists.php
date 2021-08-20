<?php
/**
 * Created by IntelliJ IDEA.
 * User: Woody
 * Date: 21/08/2017
 * Time: 15:52
 */
// List of ews and advice
// Sums of news and advice

class Lists
{

    public $query;
    public $search;
    Public $thiscourt;

    function __construct() {
        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// This function is adding articles into the db
    public function getme_lists(){

        include_once("roles/RolesList.php");

        $query = "SELECT users.id, firstname, lastname,  email, email_confirmed, role, status, dbs_status, freedom_date FROM `users` join `users_court` on users.id = users_court.user_id ";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't ViewSql users lists:(");
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

        if($row['role'] > 0 ) {
            $rolenames = new RolesList();
            $rolenames->type = "roles";
            $rolenames->selected_items = $row['role'];
            $rolenames->getme_details();
            $rolenames  = $rolenames->names;
        } else {

            $rolenames = '';

        }
            if($row['email_confirmed'] == 1 ){$email_confirmed = "primary";}else{$email_confirmed = "danger";}
            if($row["role"] == 3 ){$role = "Admin";}else{$role = "User";}
            if($row['dbs_status'] != "") {$dbs_status = " <br> DBS = ". $row['dbs_status'];}else{$dbs_status = ""; }
            if($row['freedom_date'] == "0000-00-00") {$freedom_date = "Not Known"; } else {$freedom_date = date("d-m-Y", strtotime($row['freedom_date']));}
            $this->list .=  "
        <tr>
           
            <td>" . openssl_decrypt($row['firstname'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . openssl_decrypt($row['lastname'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td><a href='mailto:" . openssl_decrypt($row['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."' class='text-$email_confirmed'>" . openssl_decrypt($row['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</a></td>
            <td>$freedom_date</td>
            <td>" . $row['status'] ." $dbs_status</td>
             <td>" . str_replace('~', '<br>', $rolenames) ."</td>
            
             <td>
                <form method='post' action='users-details.php'>
                    <input type='hidden' name='user_id' value='" .$row["id"] ."'>
                           <input type='hidden' name='nb' value='cc'>
                         <button class='btn btn-icon btn-outline-primary mr-2 mb5' name='button' value='article'>
                             <i class='icon-eye'></i>
                         </button>
                </form>
            </td>       
            
            <td>
                <form method='post' action='users-full-edit.php'>
                    <input type='hidden' name='user_id' value='" .$row["id"] ."'>
                           <input type='hidden' name='nb' value='cc'>
                         <button class='btn btn-icon btn-success mr-2 mb5' name='button' value='article'>
                             <i class='icon-pencil2'></i>
                         </button>
                </form>
            </td>       
        </tr>
        ";
        }// end while
        mysqli_close($this->dbc);
    }//  getme_lists()


    // This function is adding articles into the db
    public function am_lists(){
        $query = "SELECT * FROM `users` where STATUS = 'Apprentice Master'";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't ViewSql userd lists:(");
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            if($row['email_confirmed'] == 1 ){$email_confirmed = "Yes";}else{$email_confirmed = "No";}
            if($row["role"] == 3 ){$role = "Admin";}else{$role = "User";}

            $this->list .=  "
        <tr>
            <td>" .$row["id"] ."</td>
            <td>" . openssl_decrypt($row['firstname'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . openssl_decrypt($row['lastname'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . openssl_decrypt($row['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . $row['dbs_status']  . "</td>
            <td>" .  $row['dbs_issue_date'] ."</td>
            
            
            
            <td>
                <form method='post' action='users-edit.php'>
                    <input type='hidden' name='id' value='" .$row["id"] ."'>
                           <input type='hidden' name='nb' value='cc'>
                         <button class='btn btn-icon btn-success mr-2 mb5' name='button' value='article'>
                             <i class='icon-pencil2'></i>
                         </button>
                </form>
            </td>       
        </tr>
        ";
        }// end while
        mysqli_close($this->dbc);
    }//  getme_lists()


    ///
    ///
    ///

    // This function is adding articles into the db
    public function details_search(){

    //    $cart_result = @mysqli_query($this->dbc, $this->query) or die("Couldn't ViewSql userd lists:(");
      //  $this->num_rows = mysqli_num_rows($cart_result);
        //while ($row = mysqli_fetch_assoc($cart_result)) {


            $sql = "
SELECT `users_court`.*, 
(MATCH (occupation) AGAINST ('".$this->search."' IN BOOLEAN MODE) * 3) + 
(MATCH (qualifying_school) AGAINST ('".$this->search."' IN BOOLEAN MODE) * 2) + 
(MATCH (liveries) AGAINST ('".$this->search."' IN BOOLEAN MODE) ) AS totalScore  
FROM `users_court` WHERE MATCH (occupation, qualifying_school, liveries) AGAINST ('".$this->search."' IN BOOLEAN MODE) ORDER BY totalScore DESC LIMIT 0,100
";


            $cart_result = @mysqli_query($this->dbc, $sql) or die("Error " . mysqli_error($this->dbc));
            $this->num_rows = mysqli_num_rows($cart_result);


            while ($row = mysqli_fetch_assoc($cart_result)) {



            $this->list .=  "
        <tr>
            <td>" .$row["id"] ."</td>
            <td>" . openssl_decrypt($row['firstname'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . openssl_decrypt($row['lastname'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . openssl_decrypt($row['email'], ENCRYPTION_METHOD, ENCRYPTION_KEY) ."</td>
            <td>" . $row['dbs_status']  . "</td>
            <td>" .  $row['dbs_issue_date'] ."</td>
            
            
            
            <td>
                <form method='post' action='users-edit.php'>
                    <input type='hidden' name='id' value='" .$row["id"] ."'>
                           <input type='hidden' name='nb' value='cc'>
                         <button class='btn btn-icon btn-success mr-2 mb5' name='button' value='article'>
                             <i class='icon-pencil2'></i>
                         </button>
                </form>
            </td>       
        </tr>
        ";
        }// end while
        mysqli_close($this->dbc);
    }//  getme_lists()


// This function is adding articles into the db
    public function count_lists(){
        $cart_result = @mysqli_query($this->dbc, "SELECT SUM(state='draft') as draft,  SUM(article_type='news' and state='published') as news,  SUM(article_type='guidance' and state='published') as guidance  from `news_advice`") or die("Couldn't ViewSql page USERS lists()");
        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $this->draft = $row["draft"];
            $this->news = $row["news"];
            $this->guidance = $row["guidance"];
        }// end while
        mysqli_close($this->dbc);
    }//  add_articles()

    // This function gets a list of members in a court.
    public function court_members()
    {

        $query = "SELECT * FROM users join users_court on users.id = users_court.user_id WHERE users_court.court1_id = $this->thiscourt or users_court.court2_id = $this->thiscourt";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't ViewSql users lists:(" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);

        while ($row = mysqli_fetch_assoc($cart_result)) {

            $court_in_list .=  $row['user_id'] . ", ";

        $this->userlist .= "<li><a href='users-details.php?user_id=" . $row['user_id'] . "'> " . openssl_decrypt(clean($row['firstname']), ENCRYPTION_METHOD, ENCRYPTION_KEY) . " " .
                                    openssl_decrypt(clean($row['lastname']), ENCRYPTION_METHOD, ENCRYPTION_KEY) .
            "  (" .$row['status'] .
                            ")</a></li>";
        }

        $court_in_list = rtrim($court_in_list, ", ");
        $this->court_in = "(" . $court_in_list . ")";

    }


    public function list_emails()
    {

        $query = "SELECT * FROM users";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't ViewSql users lists:(" . mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);

        while ($row = mysqli_fetch_assoc($cart_result)) {

            echo
                $row['id'] .",".
                openssl_decrypt(clean($row['firstname']), ENCRYPTION_METHOD, ENCRYPTION_KEY) . "," .
                openssl_decrypt(clean($row['middlename']), ENCRYPTION_METHOD, ENCRYPTION_KEY) . "," .
                openssl_decrypt(clean($row['lastname']), ENCRYPTION_METHOD, ENCRYPTION_KEY) . "," .


                $row['email_news'] . ",".
                $row['email_confirmed'] . "," . openssl_decrypt(clean($row['email']), ENCRYPTION_METHOD, ENCRYPTION_KEY)  . "<br>";
        }

    }


}