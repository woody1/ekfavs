<?php



// Stop a direct link to this page and any include pages
defined('flower') or die('Not with me my friend');

function decrypt($tocode){
    return openssl_decrypt($tocode, ENCRYPTION_METHOD, ENCRYPTION_KEY);
}

function encrypt($tocode){
    return openssl_encrypt($tocode, ENCRYPTION_METHOD, ENCRYPTION_KEY);
}


// role mask
function bitMask($mask) {
    if(!is_numeric($mask)) {
        return array();
    }
    $return = array();
    while ($mask > 0) {
        for($i = 0, $n = 0; $i <= $mask; $i = 1 * pow(2, $n), $n++) {
            $end = $i;
        }
        $return[] = $end;
        $mask = $mask - $end;
    }
    sort($return);
    return $return;
}

//
    for ($x = 3; $x <= 14; $x++) {
        $ageoption .= "<option value='$x'>$x</option>";
    }


// watch out for the '
function escape_string($variable) {$variable = mysqli_real_escape_string(trim($variable));return $variable;}

//this function removes all html special characters
function clean($variable) {$variable = htmlspecialchars(trim($variable));return $variable;}

//this function will ensure it only an email
function validate_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return FALSE;
    } else {
        return TRUE;
    }
}


//this function will ensure it only has proper name characters
function validate_name($name){
   if(!preg_match('/^([a-zA-Z]+[\'-]?[a-zA-Z]+[ ]?)+$/', $name)){ return FALSE; } else { return TRUE; }
}

function validate_number($number){
    if(!preg_match('/^[0-9]{1,}$/', $number)){ return FALSE; } else { return TRUE; }
}

function validate_id($id){
    if(ctype_alnum($id)){ return TRUE; } else { return FALSE; }
}

// Stop the emails farming - ooh aah ooh aah
//

function obfuscate($email)
{
    $encoded_email = '';
    for ($a = 0,$b = strlen($email);$a < $b;$a++)
    {
        $encoded_email .= '&#'.(mt_rand(0,1) == 0 ? 'x'.dechex(ord($email[$a])) : ord($email[$a]));
    }
    return $encoded_email;
}



// Check password
function check_password($pwd){{if (strlen($pwd) < 8) {return FALSE;} else {return TRUE;}}

// Encrypt and Decrypt
        function encrypt($text){return openssl_encrypt($text, ENCRYPTION_METHOD, ENCRYPTION_KEY);}
        function decrypt($text){return openssl_decrypt($text, ENCRYPTION_METHOD, ENCRYPTION_KEY);}
    }



// This is to see if the bitmap number tallies to an input ARRAY. Input is from the list which has been added up i.e 15
// The bitmap is looking for that number i.e
// Example CRUD - C = 1 / R = 2 / U = 4 and D = 8. See if in the array there is the correct permsions.

function bitmap($input, $bitmap){
    foreach ($input as &$value) {
        foreach (bitMask($value) as &$value) {
            $role .= $value . " ~ ";
        }
    }
    if (preg_match("/$bitmap/i", $role)) {
        return TRUE;
    } else {
        return FALSE;
    }
}



// This function returns the CRUD 1 2 4 8 16 for a given column in the roles table - i.e news 15 would be 1 2 4 8 output is an array.

function userscrud($roles){
    foreach ($roles as $result) {
        foreach (bitMask($result) as $result) {
            $output[] .= $result;
        }
    }
    Return $output;

}
