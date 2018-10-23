<?php
include('helper.php');
include('./../DataLayer/Seasons.class.php');
if(isset($_POST['id']) && $_POST['id'] != '' && $_POST['id'] != 'null'){
    $id = sanitizeString($_POST['id']);
    $db = new Seasons();
    $result = $db->deleteSeason($id);
    echo $result;
}else{
    errorMessage();
}