<?php
include('helper.php');
//check if subimmted
/**
 * get data
 * sanatize and check if the credential are correct
 * if so then redirect
 */
if($_POST['username'] != null){
    if($_POST['password'] != null){
        //sanitize
        //encrypt
        $username = sanitizeString($_POST['username']);
        $pass = hash('sha256',sanitizeString($_POST['password']));
        //validate
        include('../DataLayer/User.class.php');
        $user = new User();
        $role = $user->login($username,$pass);
        //redirect based on role
        if($role != "False"){
            echo $role;
        }else{
            //login failed
            echo 0;
        }
    }else{
        //print out error message
        echo "error";
    }
}else{
    //print out error message
    echo "error";

}

