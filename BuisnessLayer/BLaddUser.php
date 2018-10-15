<?php
include('helper.php');
include('./../DataLayer/User.class.php');
if(isset($_POST['username'])){
    if(isset($_POST['password'])){
        if(isset($_POST['role'])){
            if(isset($_POST['team'])){
                if(isset($_POST['league'])){

                    //all of the data is filled out do something
                    //get all of the data -- sanitize
                    $username = sanitizeString($_POST['username']);
                    $password = sha1(sanitizeString($_POST['password']));
                    $role = sanitizeString($_POST['role']);
                    $team = sanitizeString($_POST['team']);
                    $league = sanitizeString($_POST['league']);

                    //create the database object
                    $db = new User();
                    //call the function
                    $response = $db->addUser($username, $password, $team, $league, $role);
                    //echo out result
                    echo $response;

                }else{
                    errorMessage();
                }

            }else{
                errorMessage();
            }

        }else{
            errorMessage();
        }

    }else{
        errorMessage();
    }
}else{
    errorMessage();
}