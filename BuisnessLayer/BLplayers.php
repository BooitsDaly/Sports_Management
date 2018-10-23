<?php
session_start();
if(isset($_POST['call']) != 'null'){
    $call = $_POST['call'];
    include('helper.php');
    include('./../DataLayer/Player.class.php');
    if($call == 'add'){
        if(isset($_POST['firstname'])&& $_POST['firstname'] != 'null' && $_POST['firstname'] != 'undefined'){
            if(isset($_POST['lastname'])&& $_POST['lastname'] != 'null' && $_POST['lastname'] != 'undefined'){
                if(isset($_POST['dob'])&& $_POST['dob'] != 'null'&& $_POST['dob'] != 'undefined'){
                    if(isset($_POST['jerseynumber'])&& $_POST['jerseynumber'] != 'null' && $_POST['jerseynumber'] != 'undefined'){
                        if(isset($_POST['team'])&& $_POST['team'] != 'null' && $_POST['team'] != 'undefined'){
                            $firstname = sanitizeString($_POST['firstname']);
                            $lastname = sanitizeString($_POST['lastname']);
                            $dob = sanitizeString($_POST['dob']);
                            $jerseynumber = sanitizeString($_POST['jerseynumber']);
                            $team = sanitizeString($_POST['team']);

                            $db = new Player();
                            $results = $db->addPlayers($firstname, $lastname, $dob, $jerseynumber, $team);
                            echo $results;
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
        $db = new Player();
        $data;
        if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
            $data = $db->getAllPlayers();
        }elseif($_SESSION['role'] == 3 || $_SESSION['role'] == 4){
            $data = $db->getPlayersbyTeam($_SESSION['team']);
        }
        $results = $db->getAsTable($data);
        echo $results;

    }elseif($call == 'delete'){
        if(isset($_POST['team']) && isset($_POST['jerseynumber'])){
            if(isset($_POST['team']) != 'null' || isset($_POST['team']) != 'undefined' || isset($_POST['jerseynumber']) != 'null' || isset($_POST['jerseynumber']) != 'undefined'){
                $team = sanitizeString($_POST['team']);
                $jerseynumber = sanitizeString($_POST['jerseynumber']);

                $db = new Player();
                $result = $db->deletePlayer($team, $jerseynumber);
                echo $result;
            }else{
                errorMessage();
            }
        }else{
            errorMessage();
        }


    }elseif($call == 'edit'){
        if(isset($_POST['team']) && isset($_POST['jerseynumber']) && isset($_POST['oldteam']) && isset($_POST['oldjerseynumber']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['dob'])){
            if($_POST['team'] != 'null' || $_POST['team'] != 'undefined'){
                if($_POST['oldteam'] != 'null' || $_POST['oldteam'] != 'undefined'){
                    if($_POST['oldjerseynumber'] != 'null' || $_POST['oldjerseynumber'] != 'undefined'){
                        if($_POST['jerseynumber'] != 'null' || $_POST['jerseynumber'] != 'undefined'){
                            if($_POST['firstname'] != 'null' || $_POST['firstname'] != 'undefined'){
                                if($_POST['lastname'] != 'null' || $_POST['lastname'] != 'undefined'){
                                    if($_POST['dob'] != 'null' || $_POST['dob'] != 'undefined') {
                                        $team = sanitizeString($_POST['team']);
                                        $oldteam = sanitizeString($_POST['oldteam']);
                                        $oldjerseynumber = sanitizeString($_POST['oldjerseynumber']);
                                        $jerseynumber = sanitizeString($_POST['jerseynumber']);
                                        $firstname = sanitizeString($_POST['firstname']);
                                        $lastname = sanitizeString($_POST['lastname']);
                                        $dateofbirth = sanitizeString($_POST['dob']);

                                        $db = new Player();
                                        $results = $db->editPlayer($team,$firstname, $lastname, $dateofbirth, $jerseynumber, $oldteam, $oldjerseynumber );
                                        echo $results;
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
                }else{
                    errorMessage();
                }
            }else{
                errorMessage();
            }
        }else{
            errorMessage();
        }

    }elseif($call == 'modal'){
        include("./../DataLayer/Team.class.php");
        $db = new Team();
        $data = $db->getAllTeams();
        $result = $db->getModals($data, 'playerTeamsModal');
        echo $result;

    }
}