<?php
include('./helper.php');
include('./../DataLayer/Sport.class.php');
//check if data was sent
//check if id = an existing id
if(isset($_POST['oldID'])){
    if(isset($_POST['newID'])){
        if(isset($_POST['sportName'])){
            $oldId = sanitizeString($_POST['oldID']);
            $newId = sanitizeString($_POST['newID']);
            $sportName = sanitizeString($_POST['sportName']);
            $db = new Sport();
            $ids = $db->getIDs();
            //check if the inputted id is the same as one that exists
            $check = false;
            foreach($ids as $i){
                if($i == $newId){
                    $check = true;
                }
            }
            if($check == false){
                $dbh = new Sport();
                $response = $dbh->editSport($newId,$sportName,$oldId);
                echo $response;
            }else{
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