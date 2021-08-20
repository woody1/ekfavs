<?php

defined('Create') or header( 'Location: /404');

class CRUD
{
    public $sql;
    public $email;
    public $udid;
    public $ip_address;
    public $firstname;
    public $lastname;
    public $password;
    public $status;
    public $create_no;
    public $updated_by;

function __construct() {
    $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($this->dbc));
}


// Update SQL
    public function insert_user()
    {

        $firstname = mysqli_real_escape_string($this->dbc, $this->firstname);
        $lastname = mysqli_real_escape_string($this->dbc, $this->lastname);
        $email = !$this->email ? 'null' : "'openssl_encrypt(clean(strtolower($this->email)), ENCRYPTION_METHOD, ENCRYPTION_KEY)'";

        $query = "INSERT INTO users (firstname, lastname, age, email, create_no, udid, usid, account_created, email_confirmed_udid, ip_address, clases, updated_by) 
                                VALUES ('$firstname', '$lastname', '$this->age', $email, '$this->create_no', '$this->udid', '$this->udid', NOW(), '$this->udid', '$this->ip_address', 'N;', '$this->updated_by')";

        @mysqli_query($this->dbc, $query) or die("Couldn't update_sql  users :( " . mysqli_error($this->dbc));
        $this->new_id = mysqli_insert_id($this->dbc);

        $query_users_contact = "INSERT INTO users_contact (household) VALUES ('$this->new_id')";
        @mysqli_query($this->dbc, $query_users_contact) or die("Couldn't users_contact, users_court " . mysqli_error($this->dbc));

        $add_household = "UPDATE users SET household = '$this->new_id' WHERE id = '$this->new_id'";
        @mysqli_query($this->dbc, $add_household) or die("Couldn't add household " . mysqli_error($this->dbc));


        mysqli_close($this->dbc);


    }// end function update_sql()

}