<?php
include ("./../DataLayer/Schedule.class.php");
include ("helper.php");
if(isset($_POST['call'])){
    $call = $_POST['call'];
    if($call == 'add'){
        if(isset($_POST['sport'])){
            if(isset($_POST['league'])){
                if(isset($_POST['season'])){
                    if(isset($_POST['hometeam'])){
                        if(isset($_POST['awayteam'])){
                            if(isset($_POST['homescore'])){
                                if(isset($_POST['awayscore'])){
                                    if(isset($_POST['scheduled'])){
                                        if(isset($_POST['completed'])){
                                            $sport = sanitizeString($_POST['sport']);
                                            $league = sanitizeString($_POST['league']);
                                            $season = sanitizeString($_POST['season']);
                                            $hometeam = sanitizeString($_POST['hometeam']);
                                            $awayteam = sanitizeString($_POST['awayteam']);
                                            $homescore = sanitizeString($_POST['homescore']);
                                            $awayscore = sanitizeString($_POST['awayscore']);
                                            $scheduled = sanitizeString($_POST['scheduled']);
                                            $completed = sanitizeString($_POST['completed']);

                                            if($awayteam != $hometeam){
                                                $db = new Schedule();
                                                $result = $db->addSchedule($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed);
                                                echo $result;
                                            }else{
                                                echo "teams cannot be the same";
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
            }else{
                errorMessage();
            }
        }else{
            errorMessage();
        }
    }elseif($call == 'view'){
        $db = new Schedule();
        $data = $db->getAllGames();
        $results = $db->getAllGamesAsTable($data);
        echo $results;

    }elseif($call == 'delete'){
        if(isset($_POST['sport'])){
            if(isset($_POST['league'])){
                if(isset($_POST['season'])){
                    if(isset($_POST['hometeam'])){
                        if(isset($_POST['awayteam'])){
                            if(isset($_POST['homescore'])){
                                if(isset($_POST['awayscore'])){
                                    if(isset($_POST['scheduled'])){
                                        if(isset($_POST['completed'])){
                                            $sport = sanitizeString($_POST['sport']);
                                            $league = sanitizeString($_POST['league']);
                                            $season = sanitizeString($_POST['season']);
                                            $hometeam = sanitizeString($_POST['hometeam']);
                                            $awayteam = sanitizeString($_POST['awayteam']);
                                            $homescore = sanitizeString($_POST['homescore']);
                                            $awayscore = sanitizeString($_POST['awayscore']);
                                            $scheduled = sanitizeString($_POST['scheduled']);
                                            $completed = sanitizeString($_POST['completed']);
                                            $db = new Schedule();
                                            $result = $db->deleteSchedule($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed);
                                            echo $result;


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
        }else{
            errorMessage();
        }

    }elseif($call == 'edit'){
        if(isset($_POST['sport'])){
            if(isset($_POST['league'])){
                if(isset($_POST['season'])){
                    if(isset($_POST['hometeam'])){
                        if(isset($_POST['awayteam'])){
                            if(isset($_POST['homescore'])){
                                if(isset($_POST['awayscore'])){
                                    if(isset($_POST['scheduled'])){
                                        if(isset($_POST['completed'])){
                                            if(isset($_POST['oldsport'])){
                                                if(isset($_POST['oldleague'])){
                                                    if(isset($_POST['oldseason'])){
                                                        if(isset($_POST['oldhometeam'])){
                                                            if(isset($_POST['oldawayteam'])){
                                                                if(isset($_POST['oldhomescore'])){
                                                                    if(isset($_POST['oldawayscore'])){
                                                                        if(isset($_POST['oldscheduled'])){
                                                                            if(isset($_POST['oldcompleted'])){
                                                                                $sport = sanitizeString($_POST['sport']);
                                                                                $league = sanitizeString($_POST['league']);
                                                                                $season = sanitizeString($_POST['season']);
                                                                                $hometeam = sanitizeString($_POST['hometeam']);
                                                                                $awayteam = sanitizeString($_POST['awayteam']);
                                                                                $homescore = sanitizeString($_POST['homescore']);
                                                                                $awayscore = sanitizeString($_POST['awayscore']);
                                                                                $scheduled = sanitizeString($_POST['scheduled']);
                                                                                $completed = sanitizeString($_POST['completed']);

                                                                                $oldsport = sanitizeString($_POST['oldsport']);
                                                                                $oldleague = sanitizeString($_POST['oldleague']);
                                                                                $oldseason = sanitizeString($_POST['oldseason']);
                                                                                $oldhometeam = sanitizeString($_POST['oldhometeam']);
                                                                                $oldawayteam = sanitizeString($_POST['oldawayteam']);
                                                                                $oldhomescore = sanitizeString($_POST['oldhomescore']);
                                                                                $oldawayscore = sanitizeString($_POST['oldawayscore']);
                                                                                $oldscheduled = sanitizeString($_POST['oldscheduled']);
                                                                                $oldcompleted = sanitizeString($_POST['oldcompleted']);

                                                                                if($awayteam != $hometeam){
                                                                                    $db = new Schedule();
                                                                                    $result = $db->editSchedule($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed,$oldsport,$oldleague,$oldseason,$oldhometeam,$oldawayteam,$oldhomescore,$oldawayscore,$oldscheduled,$oldcompleted);
                                                                                    echo $result;
                                                                                }else{
                                                                                    echo "teams cannot be the same";
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
        include("./../DataLayer/SLSeason.class.php");
        include("./../DataLayer/Team.class.php");

        $db = new SLSeason();
        $data = $db->getAllSLSeason();
        $result = $db->getModals($data, "scheduleSLS");
        echo $result;

        $db2 = new Team();
        $data2 = $db2->getAllTeams();
        $results2 = $db2->getModals($data2,"hometeam");
        $results3 = $db2->getModals($data2,"awayteam");

        echo $results2;
        echo $results3;



    }
}

