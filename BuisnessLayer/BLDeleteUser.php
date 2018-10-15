<?php
    include('helper.php');
    include('./../DataLayer/User.class.php');
    if(isset($_POST['username'])){
        $username = sanitizeString($_POST['username']);
        $db = new User();
        $result = $db->deleteUser($username);
        echo $result;
    }else{
        errorMessage();
    }