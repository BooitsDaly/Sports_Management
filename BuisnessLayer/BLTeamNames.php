<?php

/**
 * get the team names and return them for the modal
 */
    include("./../DataLayer/Team.class.php");
    $Team = new Team();
    $names = $Team->getAllTeams();
    $results = $Team->getModals($names,'team');
    echo $results;