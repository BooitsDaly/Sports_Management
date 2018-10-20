<?php
    session_start();
    include('./../DataLayer/Team.class.php');
    include('helper.php');
    if(isset($_POST['call'])){
        $call = $_POST['call'];
        if($call == 'add'){
            if(isset($_POST['name'])) {
                if(isset($_POST['sport'])) {
                    if(isset($_POST['league'])) {
                        if(isset($_POST['season'])) {
                            if(isset($_POST['awaycolor'])) {
                                $mascot = "";
                                $picture = "";
                                $maxplayers = "";
                                $homecolor = 'white';

                                if(isset($_POST['mascot'])){
                                    $mascot = sanitizeString($_POST['mascot']);
                                }
                                if(isset($_POST['picture'])){
                                    $picture = sanitizeString($_POST['picture']);
                                }

                                if(isset($_POST['homecolor'])) {
                                    $homecolor = sanitizeString($_POST['homecolor']);
                                }
                                if(isset($_POST['maxplayers'])){
                                    $maxplayers = sanitizeString($_POST['maxplayers']);

                                }
                                 $name = sanitizeString($_POST['name']);
                                 $sport = sanitizeString($_POST['sport']);
                                 $league = sanitizeString($_POST['league']);
                                 $season = sanitizeString($_POST['season']);
                                 $awaycolor = sanitizeString($_POST['awaycolor']);

                                 $db = new Team();
                                 $results = $db->addTeam($name,$mascot,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers);
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
            $db = new Team();
            if($_SESSION['league'] != null){
                $data = $db->getTeams($_SESSION['league']);
            }else{
                $data = $db->getTeams();
            }
            $results = $db->getAllTeamsAsTable($data);
            echo $results;

        }elseif($call == 'delete'){
            if(isset($_POST['id'])){
                $id = sanitizeString($_POST['id']);
                $db = new Team();
                $results = $db->deleteTeam($id);
                echo $results;
            }else{
                errorMessage();
            }

        }elseif($call == 'edit'){

            if(isset($_POST['name'])) {
                if(isset($_POST['sport'])) {
                    if(isset($_POST['league'])) {
                        if(isset($_POST['season'])) {
                            if(isset($_POST['awaycolor'])) {
                                if(isset($_POST['id'])) {

                                    $mascot = "";
                                    $picture = "";
                                    $maxplayers = "";
                                    $homecolor = 'white';

                                    if (isset($_POST['mascot'])) {
                                        $mascot = sanitizeString($_POST['mascot']);
                                    }
                                    if (isset($_POST['picture'])) {
                                        $picture = sanitizeString($_POST['picture']);
                                    }

                                    if (isset($_POST['homecolor'])) {
                                        $homecolor = sanitizeString($_POST['homecolor']);
                                    }
                                    if (isset($_POST['maxplayers'])) {
                                        $maxplayers = sanitizeString($_POST['maxplayers']);
                                    }

                                    $name = sanitizeString($_POST['name']);
                                    $sport = sanitizeString($_POST['sport']);
                                    $league = sanitizeString($_POST['league']);
                                    $season = sanitizeString($_POST['season']);
                                    $awaycolor = sanitizeString($_POST['awaycolor']);
                                    $id = sanitizeString($_POST['id']);

                                    $db = new Team();
                                    $results = $db->editTeam($id, $name, $mascot, $sport, $league, $season, $picture, $homecolor, $awaycolor, $maxplayers);
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

        }elseif($call == 'modal'){

        }
    }
