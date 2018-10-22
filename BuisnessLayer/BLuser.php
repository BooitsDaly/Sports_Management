<?php
session_start();
if(isset($_POST['call'])){
    $call = $_POST['call'];
    include('helper.php');
    include('./../DataLayer/User.class.php');
    if($call == 'add'){
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

    }elseif($call == 'view'){
        $db = new User();
        if($_SESSION['role'] == 1){
            $data = $db->selectUsers();
        }else if($_SESSION['role'] == 2){
            $data = $db->selectUsersByRole(3,4);
        }else if($_SESSION['role'] == 3 || $_SESSION['role'] == 4){
            $data = $db->selectUsersByTeam(3,4,5,$_SESSION['team']);
        }
        $response = $db->getTable($data);
        echo $response;

    }elseif($call == 'delete'){
        if(isset($_POST['username'])){
            $username = sanitizeString($_POST['username']);
            $db = new User();
            $result = $db->deleteUser($username);
            echo $result;
        }else{
            errorMessage();
        }

    }elseif($call == 'edit'){
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
            errorMessage();
        }

    }
}