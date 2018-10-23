<?php
include('./../DataLayer/Seasons.class.php');
//get seasons as table
$db = new Seasons();
$seasons = $db->getAllSeason();
$response = $db->getAllSeasonsAsTable($seasons);
echo $response;