<?php

defined('Create') or header( 'Location: /404');

class Create {

    public $sql;
    public $email;
    public $udid;
    public $ip_address;
    public $firstname;
    public $lastname;
    public $password;
    public $status;
    public $create_no;

    function __construct() {
        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
    }

// View SQL
    public function checkemail(){

        $email = openssl_encrypt(clean(strtolower($this->email)), ENCRYPTION_METHOD, ENCRYPTION_KEY);
        $query = "SELECT * FROM users WHERE email = '$email'";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't ViewSql page view_sql()" .  mysqli_error($this->dbc));

        if (mysqli_num_rows($cart_result) > 0) {
            return FALSE;
        }else{
            return TRUE;}

        mysqli_close($this->dbc);

    }// end function view_sql()

// Update SQL
    public function insert_user(){

        if (Create::checkemail() === TRUE) {

            $firstname = mysqli_real_escape_string($this->dbc, $this->firstname);
            $lastname = mysqli_real_escape_string($this->dbc, $this->lastname);

            $email = openssl_encrypt(clean(strtolower($this->email)), ENCRYPTION_METHOD, ENCRYPTION_KEY);

            $query = "INSERT INTO users (firstname, lastname, age, email, create_no, udid, usid, account_created, email_confirmed_udid, ip_address, clases) 
                                VALUES ('$firstname', '$lastname', '16', '$email', '$this->create_no', '$this->udid', '$this->udid', NOW(), '$this->udid', '$this->ip_address', 'N;')";

            @mysqli_query($this->dbc, $query) or die("Couldn't update_sql  users :( " . mysqli_error($this->dbc));
            $new_id = mysqli_insert_id($this->dbc);

            $query_users_contact = "INSERT INTO users_contact (household) VALUES ('$new_id')";
            @mysqli_query($this->dbc, $query_users_contact) or die("Couldn't users_contact, users_court " . mysqli_error($this->dbc));

            $add_household = "UPDATE users SET household = '$new_id' WHERE id = '$new_id'";
            @mysqli_query($this->dbc, $add_household) or die("Couldn't add household " . mysqli_error($this->dbc));

            $this->entry_added = "YES";
        } else {
            $this->entry_added = "NO";
        }

        mysqli_close($this->dbc);

    }// end function update_sql()
}// end viewCart class

