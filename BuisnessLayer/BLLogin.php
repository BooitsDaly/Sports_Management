<?php
include('helper.php');
//check if subimmted
if($_POST['username'] != null){
    if($_POST['password'] != null){
        //sanitize
        //encrypt
        $username = sanitizeString($_POST['username']);
        $pass = sha1(sanitizeString($_POST['password']));
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

