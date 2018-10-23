<?php
session_start();
include ("./../DataLayer/Schedule.class.php");
include ("helper.php");
if(isset($_POST['call'])){
    $call = $_POST['call'];
    if($call == 'add'){
        if(isset($_POST['sport']) && $_POST['sport'] != 'null' &&  $_POST['sport'] != 'undefined'){
            if(isset($_POST['league']) && $_POST['league'] != 'null' &&  $_POST['league'] != 'undefined'){
                if(isset($_POST['season']) && $_POST['season'] != 'null' &&  $_POST['season'] != 'undefined'){
                    if(isset($_POST['hometeam']) && $_POST['hometeam'] != 'null'  && $_POST['hometeam'] != 'undefined'){
                        if(isset($_POST['awayteam']) && $_POST['awayteam'] != 'null'  && $_POST['awayteam'] != 'undefined'){
                            if(isset($_POST['homescore']) && $_POST['homescore'] != 'null'  && $_POST['homescore'] != 'undefined'){
                                if(isset($_POST['awayscore']) && $_POST['awayscore'] != 'null'  && $_POST['awayscore'] != 'undefined'){
                                    if(isset($_POST['scheduled']) && $_POST['scheduled'] != 'null'  && $_POST['scheduled'] != 'undefined'){
                                        if(isset($_POST['completed']) && $_POST['completed'] != 'null'  && $_POST['completed'] != 'undefined'){
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
        if(isset($_POST['sport'])&& $_POST['sport'] != 'null' && $_POST['sport'] != 'undefined'){
            if(isset($_POST['league'])&& $_POST['league'] != 'null' && $_POST['league'] != 'undefined'){
                if(isset($_POST['season'])&& $_POST['season'] != 'null' && $_POST['season'] != 'undefined'){
                    if(isset($_POST['hometeam'])&& $_POST['hometeam'] != 'null' && $_POST['hometeam'] != 'undefined'){
                        if(isset($_POST['awayteam'])&& $_POST['awayteam'] != 'null' && $_POST['awayteam'] != 'undefined'){
                            if(isset($_POST['homescore'])&& $_POST['homescore'] != 'null' && $_POST['homescore'] != 'undefined'){
                                if(isset($_POST['awayscore'])&& $_POST['awayscore'] != 'null' && $_POST['awayscore'] != 'undefined'){
                                    if(isset($_POST['scheduled'])&& $_POST['scheduled'] != 'null' && $_POST['scheduled'] != 'undefined'){
                                        if(isset($_POST['completed'])&& $_POST['completed'] != 'null' && $_POST['completed'] != 'undefined'){
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
        if(isset($_POST['sport'])&& $_POST['sport'] != 'null' && $_POST['sport'] != 'undefined'){
            if(isset($_POST['league'])&& $_POST['league'] != 'null' && $_POST['league'] != 'undefined'){
                if(isset($_POST['season'])&& $_POST['season'] != 'null' && $_POST['season'] != 'undefined'){
                    if(isset($_POST['hometeam'])&& $_POST['hometeam'] != 'null' && $_POST['hometeam'] != 'undefined'){
                        if(isset($_POST['awayteam'])&& $_POST['awayteam'] != 'null' && $_POST['awayteam'] != 'undefined'){
                            if(isset($_POST['homescore'])&& $_POST['homescore'] != 'null' && $_POST['homescore'] != 'undefined'){
                                if(isset($_POST['awayscore'])&& $_POST['awayscore'] != 'null' && $_POST['awayscore'] != 'undefined'){
                                    if(isset($_POST['scheduled'])&& $_POST['scheduled'] != 'null' && $_POST['scheduled'] != 'undefined'){
                                        if(isset($_POST['completed'])&& $_POST['completed'] != 'null' && $_POST['completed'] != 'undefined'){
                                            if(isset($_POST['oldsport'])&& $_POST['oldsport'] != 'null' && $_POST['oldsport'] != 'undefined'){
                                                if(isset($_POST['oldleague'])&& $_POST['oldleague'] != 'null' && $_POST['oldleague'] != 'undefined'){
                                                    if(isset($_POST['oldseason'])&& $_POST['oldseason'] != 'null' && $_POST['oldseason'] != 'undefined'){
                                                        if(isset($_POST['oldhometeam'])&& $_POST['oldhometeam'] != 'null' && $_POST['oldhometeam'] != 'undefined'){
                                                            if(isset($_POST['oldawayteam'])&& $_POST['oldawayteam'] != 'null' && $_POST['oldawayteam'] != 'undefined'){
                                                                    if(isset($_POST['oldawayscore'])&& $_POST['oldawayscore'] != 'null' && $_POST['oldawayscore'] != 'undefined'){
                                                                        if(isset($_POST['oldscheduled'])&& $_POST['oldscheduled'] != 'null' && $_POST['oldscheduled'] != 'undefined'){
                                                                            if(isset($_POST['oldcompleted'])&& $_POST['oldcompleted'] != 'null' && $_POST['oldcompleted'] != 'undefined'){
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
    }elseif($call == 'schedulePage'){
        $db = new Schedule();
        if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
            $data = $db->getAllGames();
        }else{
            $data = $db->getAllGamesbyTeam($_SESSION['team']);
        }
        $results = $db->viewGames($data);
        echo $results;
    }
}

