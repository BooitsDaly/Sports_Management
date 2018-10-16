<?php
    include('./../DataLayer/Sport.class.php');

    $db = new Sport();
    $result = $db->getAllSportsAsTable();
    echo $result;