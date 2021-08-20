<?php

defined('Update') or header( 'Location: /404');

class Update
{

    public $udid;
    public $ip_address;
    public $current_password;
    public $new_password;
    public $post;
    public $firstname;
    public $lastname;
    public $age;
    public $household;
    public $memberid;
    public $clases;

    function __construct()
    {
        $this->dbc = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// Update password
    public function update_user()
    {
        unset($this->post['nb']);
        unset($this->post['button']);
        unset($this->post['user_id']);
        unset($this->post['files']);
        unset($this->post['memberid']);

        foreach ($this->post as $key => $value) {
            $setvar .= "$key = '" . mysqli_real_escape_string($this->dbc, $value) . "', ";
        }
        $query = "UPDATE users SET
        $setvar
        users.date_updated = now()
        WHERE id = '$this->memberid'";


        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't upload updated " . mysqli_error($this->dbc));

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }//  update_stockists()

    // Update password
    public function update_clases()
    {


        $query = "UPDATE users SET clases = '$this->clases', date_updated = now() WHERE id = '$this->memberid'";

        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't upload updated " . mysqli_error($this->dbc));

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }//  update_stockists()



    // Update password
    public function password(){

        $cart_result = @mysqli_query($this->dbc, "SELECT password FROM users WHERE udid = '$this->udid'") or die("Couldn't password() why :( ");

        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->hashed = $row["password"];

            if (password_verify($this->current_password, $this->hashed)) {
                RETURN TRUE;
            } else {
                RETURN FALSE;
            }
        }


        mysqli_close($this->dbc);

    }// end function view_sql()

// Update SQL

    public function update_password(){

        if (Update::password() === TRUE) {

            $query = "UPDATE users SET password = '". password_hash($this->new_password, PASSWORD_DEFAULT) ."' WHERE udid = '$this->udid'";

            $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't update_sql :( ");
            $this->entry_added = "<h4 class='alert alert-success p-2 col-6'>Password Updated</h4>";
        } else {
            $this->entry_added = "<h4 class='alert alert-danger p-2 col-6'>The current password you entered is not correct. Please try again.</h4>";
        }

        mysqli_close($this->dbc);

    }// end function update_sql()


    public function add_password(){

        $query = "UPDATE users SET password = '". password_hash($this->new_password, PASSWORD_DEFAULT) ."' WHERE udid = '$this->udid'";

        @mysqli_query($this->dbc, $query) or die("Couldn't update_sql :( " . mysqli_error($this->dbc));



mysqli_close($this->dbc);

    }// end function update_sql()

    public function add_user(){

        $firstname = mysqli_real_escape_string($this->dbc, $this->firstname);
        $lastname = mysqli_real_escape_string($this->dbc, $this->lastname);
        $query = "INSERT INTO users (firstname, lastname, age, account_created, household)
                VALUES ('$firstname', '$lastname', '$this->age', NOW(), '$this->household')";
        @mysqli_query($this->dbc, $query) or die("Couldn't update_sql :( ");

        mysqli_close($this->dbc);

    }// end function update_sql()

    public function add_scarecrow(){

        $scarecrow_name = mysqli_real_escape_string($this->dbc, $this->scarecrow_name);
        $home_name_number = mysqli_real_escape_string($this->dbc, $this->home_name_number);
        $home_street = mysqli_real_escape_string($this->dbc, $this->home_street);
        $home_postcode = mysqli_real_escape_string($this->dbc, $this->home_postcode);
        $query = "UPDATE users, users_contact SET users.scarecrow = 1, users_contact.scarecrow_name = '$scarecrow_name', users_contact.home_name_number = '$home_name_number', users_contact.home_street = '$home_street', users_contact.home_postcode = '$home_postcode' WHERE users_contact.household = users.household and  users.id  = '$this->udid'";

        @mysqli_query($this->dbc, $query) or die("Couldn't update_sql :( " . mysqli_error($this->dbc));

        mysqli_close($this->dbc);

    }// end function update_sql()

}// end viewCart class

