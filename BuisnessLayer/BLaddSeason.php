<?php
    include('./helper.php');
    include('./../DataLayer/Seasons.class.php');

    if(isset($_POST['id'])){
        if(isset($_POST['year'])){
            if(isset($_POST['description'])) {
                $id = sanitizeString($_POST['id']);
                $year = sanitizeString($_POST['year']);
                $description = sanitizeString($_POST['description']);
                $db = new Seasons();
                $ids = $db->getIDs();
                //check if the inputted id is the same as one that exists
                $check = false;
                foreach ($ids as $i) {
                    if ($i == $id) {
                        $check = true;
                    }
                }
                if ($check == false) {
                    $db = new Seasons();
                    $result = $db->addSeason($id, $year, $description);
                    echo $result;
                } else {
                    echo "failed";
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