<?php
include("./../DataLayer/Sport.class.php");
include("./../DataLayer/Seasons.class.php");
include("./../DataLayer/League.class.php");
$league = new League();
$namess = $league->getLeagueNames();
$bigString = "<div class=\"input-field col s12\">
                    
                    <select id='SLSleague'>
                        <option value=\"\" disabled selected>Choose a new League</option>";
$cnt =1;
foreach($namess as $row) {
    $bigString .= "
                        <option value='{$cnt}'>{$row}</option>
                        ";
    $cnt++;
}
$bigString .= "
                    </select>
                    <label>Leagues</label>
                </div>";



$sport = new Sport();
$names = $sport->getSportNames();
$bigString .= "<div class=\"input-field col s12\">
                    <select id='SSLsport'>
                        <option value=\"\" disabled selected>Choose a new Sport</option>";
            $cnt =1;
            foreach($names as $row) {
                $bigString .= "
                                    <option value='{$cnt}'>{$row}</option>
                                    ";
                $cnt++;
            }
            $bigString .= "
                                </select>
                                <label>Sports</label>
                            </div>";


$seasons = new Seasons();
$snames = $seasons->getIDs();
$bigString .= "<div class=\"input-field col s12\">
                            
                            <select id='SSLseason'>
                                <option value=\"\" disabled selected>Choose a new Season</option>";
        $cnt =1;
        foreach($snames as $row) {
            $bigString .= "
                                <option value='{$cnt}'>{$row}</option>
                                ";
            $cnt++;
        }
        $bigString .= "
                            </select>
                            <label>Seasons</label>
                        </div>";
        echo $bigString;
