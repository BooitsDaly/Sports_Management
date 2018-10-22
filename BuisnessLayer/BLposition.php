<?php

if(isset($_POST['call'])){
    include ("helper.php");
    include("./../DataLayer/Position.class.php");
    $call = $_POST['call'];
    if($call == 'add'){
        if(isset($_POST['position'])){
            $position = sanitizeString($_POST['position']);
            $db = new Position();
            $results = $db->addPosition($position);
            echo $results;
        }else{
            errorMessage();
        }
    }elseif($call == 'view') {
        $db = new Position();
        $data = $db->getAllPositions();
        $results = $db->getAsTable($data);
        echo $results;
    }else{
        errorMessage();
    }
}else{
    errorMessage();
}