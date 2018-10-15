<?php
include('helper.php');
include('./../DataLayer/User.class.php');
if(isset($_POST['newUser'])){
    if(isset($_POST['password'])){
        if(isset($_POST['role'])){
            if(isset($_POST['team'])){
                if(isset($_POST['league'])){
                    if(isset($_POST['oldUser'])) {
                        //all of the data is filled out do something
                        //get all of the data -- sanitize
                        $newName = sanitizeString($_POST['newUser']);
                        $password = sha1(sanitizeString($_POST['password']));
                        $role = sanitizeString($_POST['role']);
                        $team = sanitizeString($_POST['team']);
                        $league = sanitizeString($_POST['league']);
                        $oldName = sanitizeString($_POST['oldUser']);

                        //create the database object
                        $db = new User();
                        //call the function
                        $response = $db->editUser($oldName, $password, $team, $league, $role, $newName);
                        //echo out result
                        echo $response;
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
}else{
    echo "user";
    errorMessage();
}
