<?php

if(isset($_POST['call'])){
    include('./helper.php');
    include('./../DataLayer/Sport.class.php');
    $call = $_POST['call'];
    if($call == 'add'){
        if(isset($_POST['ID']) && $_POST['ID'] != 'null'){
            if(isset($_POST['sportName']) && $_POST['sportName'] != 'null'){
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
                    echo "<script>alert('ID exists');</script>";
                }

            }else{
                errorMessage();
            }
        }else{
            errorMessage();
        }

    }


        /**
         * delete sport
         * get data
         * sanatize
         * call db
         */
    elseif($call == 'delete'){

        if(isset($_POST['ID']) && $_POST['ID'] != 'null'){
            $id = sanitizeString($_POST['ID']);
            $db = new Sport();
            $result = $db->deleteSport($id);
            echo $result;
        }else{
            errorMessage();
        }

        /**
         * Sports edit
         * get data
         * sanatixe
         * echo
         */
    }elseif($call == 'edit'){
        //check if data was sent
        //check if id = an existing id
        if(isset($_POST['oldID']) && $_POST['oldID'] != 'null'){
            if(isset($_POST['newID']) && $_POST['newID'] != 'null'){
                if(isset($_POST['sportName']) && $_POST['sportName'] != 'null'){
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
                        echo "<script>alert('ID exists');</script>";
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