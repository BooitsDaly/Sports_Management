<?php
    include('./helper.php');
    include('./../DataLayer/Sport.class.php');
    if(isset($_POST['ID'])){
        $id = sanitizeString($_POST['ID']);
        $db = new Sport();
        $result = $db->deleteSport($id);
        echo $result;
    }else{
        errorMessage();
    }