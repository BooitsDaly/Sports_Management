<?php
include("./../DataLayer/League.class.php");
/**
 * get the league names as a modal and return
 */
$league = new League();
$names = $league->getLeagueNames();
$results = $league->getModals($names,'league');
echo $results;
