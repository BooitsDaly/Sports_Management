<?php
include("./../DataLayer/SLSeason.class.php");

/**
 * get the SLS modal
 */
$db = new SLSeason();
$data = $db->getAllSLSeason();
$result = $db->getModals($data, 'teamsls');
echo $result;