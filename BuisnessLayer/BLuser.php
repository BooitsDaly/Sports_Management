<?php
session_start();
if(isset($_POST['call'])){
    $call = $_POST['call'];
    include('helper.php');
    include('./../DataLayer/User.class.php');

    /**
     * User Add
     * verify data was sent
     * sanatize data
     * call database
     * return values
     */
    if($call == 'add'){
        if(isset($_POST['username']) && $_POST['username'] != 'null' && $_POST['username'] != 'undefined'){
            if(isset($_POST['password']) && $_POST['password'] != 'null' && $_POST['password'] != 'undefined'){
                if(isset($_POST['role']) && $_POST['role'] != 'null' && $_POST['role'] != 'undefined'){
                    if(isset($_POST['team']) && $_POST['team'] != 'null' && $_POST['team'] != 'undefined'){
                        if(isset($_POST['league']) && $_POST['league'] != 'null' && $_POST['league'] != 'undefined'){

                            //all of the data is filled out do something
                            //get all of the data -- sanitize
                            $username = sanitizeString($_POST['username']);
                            $password = hash('sha256',sanitizeString($_POST['password']));
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

        /**
         * User view
         *
         * sanatize data
         * call database
         * return values
         */
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

        /**
         * User Delete
         * verify data was sent
         * sanatize data
         * call database
         * return values
         */
    }elseif($call == 'delete'){
        if(isset($_POST['username']) && $_POST['username'] != 'null' && $_POST['username'] != 'undefined'){
            $username = sanitizeString($_POST['username']);
            $db = new User();
            $result = $db->deleteUser($username);
            echo $result;
        }else{
            errorMessage();
        }

        /**
         * User edit
         * verify data was sent
         * sanatize data
         * call database
         * return values
         */
    }elseif($call == 'edit'){
        if(isset($_POST['newUser']) && $_POST['newUser'] != 'null' && $_POST['newUser'] != 'undefined'){
            if(isset($_POST['password']) && $_POST['password'] != 'null' && $_POST['password'] != 'undefined'){
                if(isset($_POST['role']) && $_POST['role'] != 'null' && $_POST['role'] != 'undefined'){
                    if(isset($_POST['team']) && $_POST['team'] != 'null' && $_POST['team'] != 'undefined'){
                        if(isset($_POST['league']) && $_POST['league'] != 'null' && $_POST['league'] != 'undefined'){
                            if(isset($_POST['oldUser']) && $_POST['oldUser'] != 'null' && $_POST['oldUser'] != 'undefined') {
                                //all of the data is filled out do something
                                //get all of the data -- sanitize
                                $newName = sanitizeString($_POST['newUser']);
                                $password = hash('sha256',sanitizeString($_POST['password']));
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