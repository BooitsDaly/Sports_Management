<?php
include('./helper.php');
include('./../DataLayer/SLSeason.class.php');
//check if data was sent
//check if id = an existing id
if(isset($_POST['call'])){
    $call = $_POST['call'];
    if($call == 'add'){
        if(isset($_POST['sport'])){
            if(isset($_POST['season'])){
                if(isset($_POST['league'])) {
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

    }elseif($call == 'view'){

        $db = new SLSeason();
        $seasons = $db->getAllSLSeason();
        $response = $db->getAllSLSeasonsAsTable($seasons);
        echo $response;

    }elseif($call == 'delete'){

    }elseif($call == 'edit'){
        if(isset($_POST['oldSport'])){
            if(isset($_POST['newSport'])){
                if(isset($_POST['season'])){
                    if(isset($_POST['league'])) {
                        $oldSport = sanitizeString($_POST['oldSport']);
                        $newSport = sanitizeString($_POST['newSport']);
                        $season = sanitizeString($_POST['season']);
                        $league = sanitizeString($_POST['league']);
                        $dbh = new SLSeason();
                        $response = $dbh->editSLSeason($newSport, $oldSport, $season,$league );
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
    }
}
