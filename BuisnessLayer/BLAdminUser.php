<?php
include('./../DataLayer/User.class.php');
$user = new User();
$response = $user->selectUsers();
echo $response;