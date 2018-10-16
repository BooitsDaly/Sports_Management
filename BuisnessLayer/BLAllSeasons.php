<?php
include('./../DataLayer/Seasons.class.php');
$db = new Seasons();
$seasons = $db->getAllSeason();
$response = $db->getAllSeasonsAsTable($seasons);
echo $response;