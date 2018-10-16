<?php
include('./helper.php');
include('./../DataLayer/Seasons.class.php');
//check if data was sent
//check if id = an existing id
if(isset($_POST['oldID'])){
    if(isset($_POST['newID'])){
        if(isset($_POST['year'])){
            if(isset($_POST['description'])) {
                $oldId = sanitizeString($_POST['oldID']);
                $newId = sanitizeString($_POST['newID']);
                $year = sanitizeString($_POST['year']);
                $description = sanitizeString($_POST['description']);
                $db = new Seasons();
                $ids = $db->getIDs();
                //check if the inputted id is the same as one that exists
                $check = false;
                foreach ($ids as $i) {
                    if ($i == $newId) {
                        $check = true;
                    }
                }
                if ($check == false) {
                    $dbh = new Seasons();
                    $response = $dbh->editSeason($oldId, $year, $oldId, $description);
                    echo $response;
                } else {
                    echo "ID exists";
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