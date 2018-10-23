<?php
include('./helper.php');
include('./../DataLayer/SLSeason.class.php');
//check if data was sent
//check if id = an existing id
if(isset($_POST['call'])){
    $call = $_POST['call'];
    /**
     * SLS add
     */
    if($call == 'add'){
        if(isset($_POST['sport']) && $_POST['sport'] != 'null' && $_POST['sport'] != 'undefined'){
            if(isset($_POST['season']) && $_POST['season'] != 'null' && $_POST['season'] != 'undefined'){
                if(isset($_POST['league']) && $_POST['league'] != 'null' && $_POST['league'] != 'undefined') {
                    $sport = sanitizeString($_POST['sport']);
                    $season = sanitizeString($_POST['season']);
                    $league = sanitizeString($_POST['league']);
                    $db = new SLSeason();
                    $result = $db->addSLSeason($sport, $league, $season);
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
        /**
         * SLS view
         */
    }elseif($call == 'view'){

        $db = new SLSeason();
        $seasons = $db->getAllSLSeason();
        $response = $db->getAllSLSeasonsAsTable($seasons);
        echo $response;

        /**
         * SLS delete
         */
    }elseif($call == 'delete'){
        if(isset($_POST['oldSport'])&& $_POST['oldSport'] != 'null' && $_POST['oldSport'] != 'undefined'){
            if(isset($_POST['oldSeason'])&& $_POST['oldSeason'] != 'null' && $_POST['oldSeason'] != 'undefined'){
                if(isset($_POST['oldLeague'])&& $_POST['oldLeague'] != 'null' && $_POST['oldLeague'] != 'undefined'){
                    $oldSport = sanitizeString($_POST['oldSport']);
                    $oldSeason = sanitizeString($_POST['oldSeason']);
                    $oldLeague = sanitizeString($_POST['oldLeague']);
                    $dbh = new SLSeason();
                    $response = $dbh->deleteSLSeason($oldSport,$oldSeason,$oldLeague);
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

        /**
         * SLS edit
         */
    }elseif($call == 'edit'){
        if(isset($_POST['oldSport'])&& $_POST['oldSport'] != 'null' && $_POST['oldSport'] != 'undefined'){
            if(isset($_POST['newSport'])&& $_POST['newSport'] != 'null' && $_POST['newSport'] != 'undefined'){
                if(isset($_POST['season'])&& $_POST['season'] != 'null' && $_POST['season'] != 'undefined'){
                    if(isset($_POST['league'])&& $_POST['league'] != 'null' && $_POST['league'] != 'undefined') {
                        if(isset($_POST['oldSeason'])&& $_POST['oldSeason'] != 'null' && $_POST['oldSeason'] != 'undefined') {
                            if (isset($_POST['oldLeague'])&& $_POST['oldLeague'] != 'null' && $_POST['oldLeague'] != 'undefined') {
                                $oldSport = sanitizeString($_POST['oldSport']);
                                $newSport = sanitizeString($_POST['newSport']);
                                $season = sanitizeString($_POST['season']);
                                $league = sanitizeString($_POST['league']);
                                $oldSeason = sanitizeString($_POST['oldSeason']);
                                $oldLeague = sanitizeString($_POST['oldLeague']);
                                $dbh = new SLSeason();
                                $response = $dbh->editSLSeason($newSport, $oldSport, $season, $league,$oldSeason,$oldLeague);
                                echo $response;
                            }
                        }
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
