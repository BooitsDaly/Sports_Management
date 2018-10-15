<?php
include("./../DataLayer/League.class.php");
$league = new League();
$names = $league->getLeagueNames();
$bigString = "<div class=\"input-field col s12\">
                    
                    <select id='league'>
                        <option value=\"\" disabled selected>Choose a new League</option>";
                        $cnt =1;
                        foreach($names as $row) {
                            $bigString .= "
                        <option value='{$cnt}'>{$row}</option>
                        ";
                            $cnt++;
                        }
                        $bigString .= "
                    </select>
                    <label>Leagues</label>
                </div>";
echo $bigString;