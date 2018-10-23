<?php
include("./../DataLayer/Sport.class.php");
include("./../DataLayer/Seasons.class.php");
include("./../DataLayer/League.class.php");

/**
 * modals for SLS
 */
$league = new League();
$namess = $league->getLeagueNames();
    $bigString = $league->getModals($namess,'SSLleague');



    $sport = new Sport();
    $names = $sport->getAllSports();
    $bigString .= $sport->getModals($names,'SSLsport');
    


    $seasons = new Seasons();
    $snames = $seasons->getAllSeason();
    $bigString .= $seasons->getModals($snames,'SSLseason');

    echo $bigString;
