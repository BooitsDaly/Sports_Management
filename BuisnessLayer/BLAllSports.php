<?php
    include('./../DataLayer/Sport.class.php');
    //get all sports
    $db = new Sport();
    $result = $db->getAllSportsAsTable();
    echo $result;