<?php
include("./../DataLayer/SLSeason.class.php");

$db = new SLSeason();
$data = $db->getAllSLSeason();
$result = $db->getModals($data, 'teamsls');
echo $result;