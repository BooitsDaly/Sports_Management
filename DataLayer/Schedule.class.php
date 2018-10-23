<?php
/**
 * Created by PhpStorm.
 * User: Caitlyn
 * Date: 10/9/2018
 * Time: 9:55 AM
 */

class Schedule{
    private $sport;
    private $league;
    private $season;
    private $hometeam;
    private $awayteam;
    private $homescore;
    private $awayscore;
    private $scheduled;
    private $completed;
    private $dbh;

    /**
     * Schedule constructor.
     */
    function __construct(){
        try {
            // open a connection
            $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);

            //change error reporting for development
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOExeption $e) {
            die("Big Problem");
        }

    }

    /**
     * @return array|string
     */
    function getAllGames(){
        try{
            if($stmt = $this->dbh->prepare("SELECT * from server_schedule")){
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Schedule");
                $stmt->execute();
                $result = Array();
                while($row = $stmt->fetch()){
                    $result[] = $row;
                }
                $this-> dbh = null;
                return $result;
            }else{
                $this->dbh = null;
                return "failed";
            }

        }catch(PDOException $e){
            die($e);
        }
    }

    /**
     * @param $team
     * @return array|string
     */
    function getAllGamesbyTeam($team){
        try{
            if($stmt = $this->dbh->prepare("SELECT * from server_schedule WHERE awayteam = :team OR hometeam=:team")){
                $stmt->bindParam(':team',$team, PDO::FETCH_CLASS);
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Schedule");
                $stmt->execute();
                $result = Array();
                while($row = $stmt->fetch()){
                    $result[] = $row;
                }
                $this-> dbh = null;
                return $result;
            }else{
                $this->dbh = null;
                return "failed";
            }

        }catch(PDOException $e){
            die($e);
        }
    }

    /**
     * @param $sport
     * @param $league
     * @param $season
     * @param $hometeam
     * @param $awayteam
     * @param $homescore
     * @param $awayscore
     * @param $scheduled
     * @param $completed
     * @return string
     */
    function addSchedule($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed){
        try {
            if ($stmt = $this->dbh->prepare("INSERT INTO server_schedule (sport, league, season, hometeam, awayteam, homescore, awayscore, scheduled, completed)
                VALUES (:sport, :league, :season, :hometeam, :awayteam, :homesocre, :awayscore, :scheduled, :completed)")){
                $stmt->bindParam(":sport", $sport);
                $stmt->bindParam(":league", $league);
                $stmt->bindParam(":season", $season);
                $stmt->bindParam(":hometeam", $hometeam);
                $stmt->bindParam(":awayteam", $awayteam);
                $stmt->bindParam(":homesocre", $homescore);
                $stmt->bindParam(":awayscore", $awayscore);
                $stmt->bindParam(":scheduled", $scheduled);
                $stmt->bindParam(":completed", $completed);
                $stmt->execute();
                $this->dbh = null;
                return "Success!";
            }else{
                $this->dbh = null;
                return "fail";
            }
        } catch (PDOException $e) {
            die($e);
        }
    }

    /**
     * @param $sport
     * @param $league
     * @param $season
     * @param $hometeam
     * @param $awayteam
     * @param $homescore
     * @param $awayscore
     * @param $scheduled
     * @param $completed
     * @param $oldsport
     * @param $oldleague
     * @param $oldseason
     * @param $oldhometeam
     * @param $oldawayteam
     * @param $oldhomescore
     * @param $oldawayscore
     * @param $oldscheduled
     * @param $oldcompleted
     * @return string
     */
    function editSchedule($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed,$oldsport,$oldleague,$oldseason,$oldhometeam,$oldawayteam,$oldhomescore,$oldawayscore,$oldscheduled,$oldcompleted){
        try {
            if ($stmt = $this->dbh->prepare("UPDATE server_schedule
                SET sport = :sport, league = :league, season = :season, hometeam = :hometeam, awayteam = :awayteam, homescore = :homescore, awayscore = :awayscore, scheduled = :scheduled, completed = :completed
                WHERE sport = :oldsport AND league = :oldleague AND season = :oldseason AND hometeam = :oldhometeam AND awayteam = :oldawayteam AND homescore = :oldhomescore AND awayscore = :oldawayscore AND completed = :oldcompleted")){
                $stmt->bindParam(":sport", $sport);
                $stmt->bindParam(":league", $league);
                $stmt->bindParam(":season", $season);
                $stmt->bindParam(":hometeam", $hometeam);
                $stmt->bindParam(":awayteam", $awayteam);
                $stmt->bindParam(":homescore", $homescore);
                $stmt->bindParam(":awayscore", $awayscore);
                $stmt->bindParam(":scheduled", $scheduled);
                $stmt->bindParam(":completed", $completed);
                $stmt->bindParam(":oldsport", $oldsport);
                $stmt->bindParam(":oldleague", $oldleague);
                $stmt->bindParam(":oldseason", $oldseason);
                $stmt->bindParam(":oldhometeam", $oldhometeam);
                $stmt->bindParam(":oldawayteam", $oldawayteam);
                $stmt->bindParam(":oldhomescore", $oldhomescore);
                $stmt->bindParam(":oldawayscore", $oldawayscore);
                //$stmt->bindParam(":oldscheduled", $oldscheduled);
                $stmt->bindParam(":oldcompleted", $oldcompleted);
                $stmt->execute();
                $this->dbh = null;
                return "Success!";
            }else{
                $this->dbh = null;
                return "fail";
            }
        } catch (PDOException $e) {
            die($e);
        }
    }

    /**
     * @param $sport
     * @param $league
     * @param $season
     * @param $hometeam
     * @param $awayteam
     * @param $homescore
     * @param $awayscore
     * @param $scheduled
     * @param $completed
     * @return string
     */
    function deleteSchedule($sport,$league,$season,$hometeam,$awayteam,$homescore,$awayscore,$scheduled,$completed){
        try {
            if ($stmt = $this->dbh->prepare("DELETE FROM server_schedule 
                WHERE sport = :sport AND league = :league AND season = :season AND hometeam = :hometeam AND awayteam = :awayteam AND homescore = :homescore AND awayscore = :awayscore AND completed = :completed")){
                $stmt->bindParam(":sport", $sport);
                $stmt->bindParam(":league", $league);
                $stmt->bindParam(":season", $season);
                $stmt->bindParam(":hometeam", $hometeam);
                $stmt->bindParam(":awayteam", $awayteam);
                $stmt->bindParam(":homescore", $homescore);
                $stmt->bindParam(":awayscore", $awayscore);
                $stmt->bindParam(":completed", $completed);
                $stmt->execute();
                $this->dbh = null;
                return "Success!";
            }else{
                $this->dbh = null;
                return "fail";
            }
        } catch (PDOException $e) {
            die($e);
        }
    }

    /**
     * @param $result
     * @return string
     */
    function getAllGamesAsTable($result){
        $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Schedules</span>
                      <table>
                        <tr>
                            <th>Sport</th>
                            <th>League</th>
                            <th>Season</th>                        
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Home Score</th>
                            <th>Away Score</th>
                            <th>Scheduled</th>
                            <th>Completed</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
        foreach($result as $row){
            $bigString .="
                            <tr>
                                <td >{$row->sport}</td>
                                <td >{$row->league}</td>
                                <td >{$row->season}</td>
                                <td >{$row->hometeam}</td>
                                <td >{$row->awayteam}</td>
                                <td >{$row->homescore}</td>
                                <td >{$row->awayscore}</td>
                                <td >{$row->scheduled}</td>
                                <td >{$row->completed}</td>
                                <td><a class=\"waves-effect waves-light btn editScheduleButton modal-trigger\" href=\"#editSchedule\">Edit</a></td>
                                <td><a class=\"waves-effect waves-light btn deleteScheduleButton\"><i class=\"material-icons right\">clear</i></a></td>
                            </tr>
                            ";
        }
        $bigString .="</tbody><a id='scheduleAdd' href='#editSchedule' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
        return $bigString;
    }

    /**
     * @param $result
     * @return string
     */
    function viewGames($result){
        $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Schedule</span>
                      <table>
                        <tr>
                            <th>Sport</th>
                            <th>League</th>
                            <th>Season</th>                        
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Home Score</th>
                            <th>Away Score</th>
                            <th>Scheduled</th>
                            <th>Completed</th>
                        </tr>
                        <tbody>";
        foreach($result as $row){
            $bigString .="
                            <tr>
                                <td >{$row->sport}</td>
                                <td >{$row->league}</td>
                                <td >{$row->season}</td>
                                <td >{$row->hometeam}</td>
                                <td >{$row->awayteam}</td>
                                <td >{$row->homescore}</td>
                                <td >{$row->awayscore}</td>
                                <td >{$row->scheduled}</td>
                                <td >{$row->completed}</td>
                            </tr>
                            ";
        }
        $bigString .="</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
        return $bigString;
    }


}