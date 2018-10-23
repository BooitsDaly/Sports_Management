<?php
include('./helper.php');
include('./../DataLayer/Seasons.class.php');
//check if data was sent
//check if id = an existing id
if(isset($_POST['oldID'])&& $_POST['oldID'] != 'null' && $_POST['oldID'] != 'undefined'){
    if(isset($_POST['newID'])&& $_POST['newID'] != 'null' && $_POST['newID'] != 'undefined'){
        if(isset($_POST['year'])&& $_POST['year'] != 'null' && $_POST['year'] != 'undefined'){
            if(isset($_POST['description'])&& $_POST['description'] != 'null' && $_POST['description'] != 'undefined') {
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