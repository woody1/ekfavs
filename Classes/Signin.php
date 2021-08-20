<?php

defined('signin') or header( 'Location: /404');

class Signin {

    public $email;
    public $password;


    function __construct() {
        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($con));

    }


    public function verify($password, $hashed){
        if (password_verify($password, $hashed)) {
            RETURN TRUE;
        } else {
            RETURN FALSE;
        }

    }



// Update password
    public function password()
    {

        $query = "SELECT * FROM users WHERE email = '$this->email'";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't password() sign in ");

        $this->num_rows = mysqli_num_rows($cart_result);
        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->hashed = $row["password"];
            $this->id = $row["id"];
            $this->failed_attempts = $row["failed_attempts"];
            $this->failed_attempts_time = $row["failed_attempts_time"];

            $this->verified = Signin::verify($this->password, $this->hashed);

        }

        mysqli_close($this->dbc);

    }// end function view_sql()
}// end viewCart class