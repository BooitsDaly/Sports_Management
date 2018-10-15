<?php
    include("./../DataLayer/Team.class.php");
    $Team = new Team();
    $names = $Team->getTeamNames();
    $bigString = "<div class=\"input-field col s12\">
                    
                    <select id='team'>
                        <option value=\"\" disabled selected>Choose a new Role</option>";
                            $cnt = 1;
                        foreach($names as $row){
                            $bigString .= "
                            <option value='{$cnt}'>{$row}</option>
                            ";
                            $cnt++;
                        }
        $bigString .= "
                    </select>
                    <label>Teams</label>
                </div>";
    echo $bigString;