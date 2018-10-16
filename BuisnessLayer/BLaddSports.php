<?php
    include('./helper.php');
    include('./../DataLayer/Sport.class.php');

    if(isset($_POST['ID'])){
        if(isset($_POST['sportName'])){
            $id = sanitizeString($_POST['ID']);
            $sportname = sanitizeString($_POST['sportName']);
            $db = new Sport();
            $ids = $db->getIDs();
            //check if the inputted id is the same as one that exists
            $check = false;
            foreach($ids as $i){
                if($i == $id){
                    $check = true;
                }
            }
            if($check == false){
                $db = new Sport();
                $result = $db->addSport($id,$sportname);
                echo $result;
            }else{
                echo "failed";
            }

        }else{
            errorMessage();
        }
    }else{
        errorMessage();
    }

