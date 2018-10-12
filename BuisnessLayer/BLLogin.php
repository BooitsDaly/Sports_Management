<?php

//check if subimmted
if($_POST['username'] != null){
    if($_POST['password'] != null){
        //sanitize
        //encrypt
        $user = sanitizeString($_POST['username']);
        $pass = sha1(sanitizeString($_POST['password']));
        //validate
        include('../DataLayer/User.class.php');
        $user = new User();
        $role = $user->login($user,$pass);
        //redirect based on role
        if($role != "False"){
            //login success
            switch ($role) {
                //admin
                case 1:
                    echo "i equals 0";
                    break;
                //League Manager
                case 2:
                    echo "i equals 1";
                    break;
                //Team Manager
                case 3:
                    echo "i equals 2";
                    break;
                //Team Coach
                case 4:
                    echo "i equals 2";
                    break;
                //parent
                case 5:
                    echo "i equals 2";
                    break;
            }

        }else{
            //login failed
        }

    }else{
        //print out error message
        echo "incorrect login credentials";
    }

}else{
    //print out error message
    echo "incorrect login credentials";

}


/**
 * Sanitize String
 * Helper function to sanitize inputs
 *
 * @param $var
 * @return string
 */


//sanitize input
function sanitizeString($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}
