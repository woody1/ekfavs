<?php
class users {

    public $email;
    public $password;
    public $id;
    public $sql;

    function __construct() {
        $this->dbc = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error " . mysqli_error($con));

    }

// This function is for showing the list of items added to user_track (the cart)
    public function view_login(){

// Get all data for email and password

        $sql = "SELECT * FROM `users` where email = '$this->email'";

        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't view_login()!");
        $this->num_rows = mysqli_num_rows($cart_result);


        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->id				= $row["id"];
            $this->hashed			= $row["password"];
            $this->role				= $row["role"];
            $this->first_name		= $row["first_name"];
            $this->last_name		= $row["last_name"];

            if (password_verify($this->password, $this->hashed)) {

                $this->verify = true;
            } else {
                $this->verify = false;
            }


        }// end while

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }// end view_login


    // This function is for showing the list of items added to user_track (the cart)
    public function view_users_list(){


// Get all data for email and password

        $sql = "SELECT users.id,
			CONCAT(users.title, ' ', users.first_name, ' ', users.last_name) as full_name,
			users.contact_mobile, users.email, users.role,
			property.address_1, property.address_2, property.post_code, property.post_town
				 
			FROM `users` 
			LEFT JOIN `property` on property.tenants_user_id = users.id
			WHERE users.tech = 1
			
	";

        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't view_users_list()");
        $this->num_rows = mysqli_num_rows($cart_result);


        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->table_list .= "
		
		
				<tr>
                  <td><a href=\"viewstaff_detail.php?id=". $row["id"]."\">". $row["full_name"]."	</a></td>
                  <td>". $row["address_1"] ." ". $row["address_2"] ."</td>
                  <td><a href=\"https://www.google.co.uk/maps/dir/".$row["post_code"]."\" target=\"_blank\">".$row["post_code"]."</a></td>
                  <td>".$row["contact_mobile"]."</td>
				  <td><a href=mailto:". $row["email"] ."> ". $row["email"] ."</a></td>
				  <td>".$row["role"]."</td>
                </tr>

		
		
		
		";


        }// end while

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }// end view_users



    // This function is for showing the list of items added to user_track (the cart)
    public function view_users(){


// Get all data for email and password

        $sql = "SELECT * FROM `users` WHERE id = $this->id";


        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't view_users()");
        $this->num_rows = mysqli_num_rows($cart_result);


        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->id				= $row["id"];
            $this->title			= $row["title"];
            $this->first_name		= $row["first_name"];
            $this->last_name		= $row["last_name"];
            $this->email			= $row["email"];
            $this->property_home_id	= $row["property_home_id"];
            $this->contact_landline	= $row["contact_landline"];
            $this->contact_mobile	= $row["contact_mobile"];
            $this->created			= $row["created"];
            $this->updated			= $row["updated"];
            $this->role				= $row["role"];
            $this->oftec_no 		= $row["oftec_no"];

        }// end while

    }// end view_users

    public function view_users_sql(){




        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't get cart!");
        $this->num_rows = mysqli_num_rows($cart_result);




        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->id				= $row["id"];
            $this->title			= $row["title"];
            $this->first_name		= $row["first_name"];
            $this->last_name		= $row["last_name"];
            $this->email			= $row["email"];
            $this->property_home_id	= $row["property_home_id"];
            $this->contact_landline	= $row["contact_landline"];
            $this->contact_mobile	= $row["contact_mobile"];
            $this->created			= $row["created"];
            $this->updated			= $row["updated"];
            $this->role				= $row["role"];





        }// end while

    }// end view_users



// This function is for showing the sfaff for staff list
    public function view_staff(){

        $sql = "SELECT users.id,
			CONCAT(users.title, ' ', users.first_name, ' ', users.last_name) as full_name,
			users.contact_mobile, users.email, users.role,
			property.address_1, property.address_2, property.post_code, property.post_town
				 
			FROM `users` 
			LEFT JOIN `property` on property.tenants_user_id = users.id
			WHERE users.tech = 1";

        $cart_result = @mysqli_query($this->dbc, $sql) or die("Couldn't view_staff_list()");
        $this->num_rows = mysqli_num_rows($cart_result);


        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->id				= $row["id"];
            $this->title			= $row["title"];
            $this->first_name		= $row["first_name"];
            $this->last_name		= $row["last_name"];
            $this->email			= $row["email"];
            $this->property_home_id	= $row["property_home_id"];
            $this->contact_landline	= $row["contact_landline"];
            $this->contact_mobile	= $row["contact_mobile"];
            $this->created			= $row["created"];
            $this->updated			= $row["updated"];
            $this->role				= $row["role"];

            $this->staff_list .= "
			<tr>
                  <td><a href=\"viewstaff_detail.php?user_id=". $row["id"]."\">". $row["full_name"]."	</a></td>
                  <td>". $row["address_1"] ." ". $row["address_2"] ."</td>
                  <td><a href=\"https://www.google.co.uk/maps/dir/".$row["post_code"]."\" target=\"_blank\">".$row["post_code"]."</a></td>
                  <td>".$row["contact_mobile"]."</td>
				  <td><a href=mailto:". $row["email"] ."> ". $row["email"] ."</a></td>
				  <td>".$row["role"]."</td>
        	</tr>
			";


        }// end while

        mysqli_free_result($cart_result);
        mysqli_close($this->dbc);

    }// end view staff


    // This function is for showing the staff list for adding to jobs
    public function view_staff_list(){

        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't view_staff_list()");
        $this->num_rows = mysqli_num_rows($cart_result);


        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->id				= $row["id"];
            $this->title			= $row["title"];
            $this->first_name		= $row["first_name"];
            $this->last_name		= $row["last_name"];
            $this->email			= $row["email"];
            $this->property_home_id	= $row["property_home_id"];
            $this->contact_landline	= $row["contact_landline"];
            $this->contact_mobile	= $row["contact_mobile"];
            $this->created			= $row["created"];
            $this->updated			= $row["updated"];
            $this->role				= $row["role"];


            $this->staff_list .= "<option value=\"".$this->id."\"  required>$this->first_name $this->last_name</option>";
            $this->selected = "<option value=\"".$this->id."\"  selected=\"selected\">$this->first_name $this->last_name</option>";


        }// end while

    }// end view_users



// This function is for showing the list of users for a dropdown -
    // EDITED FOR viewpropery_detail.php page !!!

    public function view_users_drop(){

// Get all data for email and password

        $cart_result = @mysqli_query($this->dbc, $this->sql) or die("Couldn't view_users_drop()");
        $this->num_rows = mysqli_num_rows($cart_result);

        while ($row = mysqli_fetch_assoc($cart_result)) {

            $this->id				= $row["id"];
            $this->title			= $row["title"];
            $this->first_name		= $row["first_name"];
            $this->last_name		= $row["last_name"];
            $this->email			= $row["email"];
            $this->property_home_id	= $row["property_home_id"];
            $this->contact_landline	= $row["contact_landline"];
            $this->contact_mobile	= $row["contact_mobile"];
            $this->created			= $row["created"];
            $this->updated			= $row["updated"];
            $this->role				= $row["role"];


            $this->users_list .= " <option value='viewpropery_detail.php?property_id=$this->property_id&tenants_user_id=$this->id&update=tenant'>$this->title $this->first_name $this->last_name</option> ";


            $this->selected = "<option value=\"".$this->id."\"  selected=\"selected\">$this->company_name $this->title $this->first_name $this->last_name</option>";

        }// end while

    }// end view_users



}// end viewCart class