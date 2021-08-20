<?php
/**
 * Created by IntelliJ IDEA.
 * User: Woody
 * Date: 19/08/2017
 * Time: 10:30
 */

class CRUDusers
{

    public $id;
    public $post;


    function __construct() {
        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error());

    }

// Update SQL
    public function update_user(){

        unset($this->post['button']);
        unset($this->post['nb']);
        unset($this->post['edit']);
        unset($this->post['id']);

        foreach($this->post  as $key => $value){
            $setvar .= "users.$key = '" . mysqli_real_escape_string($this->dbc, $value) . "', ";

        }

        $setvar = rtrim($setvar, ', ');
        $query = "UPDATE users join users_court on users.id = users_court.user_id SET $setvar, users.date_updated = now()  WHERE  users.id = '$this->id'";
        // This will replace 'users.status', 'users_court.status' so that it can be added into the correct table.
        $query = str_replace('users.status', 'users_court.status', $query);
        $query = str_replace('users.apprentice_master', 'users_court.apprentice_master', $query);

        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't upload  update_user() :( ()!"  . mysqli_error($this->dbc));

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }// end function update_sql()


    public function delete_user(){

        $id = $this->post['id'];

        $query = "DELETE from `users` WHERE id = '$id'";
        $cart_result = @mysqli_query($this->dbc, $query) or die("Couldn't delete updated  :( ()!". mysqli_error($this->dbc));
        $this->num_rows = mysqli_num_rows($cart_result);
        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }

}