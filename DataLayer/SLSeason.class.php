<?php

class SLSeason{
    private $sport;
    private $season;
    private $league;
    private $dbh;

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

    function addSLSeason($sport, $league, $seson){
        try {
            if ($stmt = $this->dbh->prepare("INSERT INTO server_slseason (sport, league, season)
                                            VALUES (:sport,:league,:season)")) {
                $stmt->bindParam(":sport", $sport);
                $stmt->bindParam(":league", $league);
                $stmt->bindParam(":season", $seson);
                $stmt->execute();
                $this->dbh = null;
                return "Success!";
            }else{
                return "fail";
            }
        } catch (PDOException $e) {
            die($e);
        }
    }

    function deleteSLSeason($sport, $season, $league)
    {
        try {
            if ($stmt = $this->dbh->prepare("DELETE FROM server_slseason
                                                WHERE sport=:sport AND season=:season AND league=:league")) {
                $stmt->bindParam(":sport", $sport);
                $stmt->bindParam(":season", $season);
                $stmt->bindParam(":league", $league);
                $stmt->execute();
                $this->dbh=null;
                return "Success!";
            }else{
                return "failed";
            }
        } catch (PDOException $e) {
            die("Error");
        }
    }

    function editSLSeason($newSport,$oldSport,$season, $league, $oldSeason, $oldLeague){
        try{
            if($stmt = $this->dbh->prepare("UPDATE server_slseason
                                                SET sport=:newSport, season=:season, league=:league
                                                WHERE sport=:oldSport AND season=:oldSeason AND league=:oldLeague")){
                $stmt->bindParam(":newSport", $newSport);
                $stmt->bindParam(":season", $season);
                $stmt->bindParam(":oldSport", $oldSport);
                $stmt->bindParam(":league", $league);
                $stmt->bindParam(":oldSeason", $oldSeason);
                $stmt->bindParam(":oldLeague", $oldLeague);
                $stmt->execute();
                $this->dbh = null;
                return "Success!";
            }else{
                $this->dbh = null;
                return "Failed";
            }
        }catch(PDOException $e){
            die($e);
        }
    }

    function getAllSLSeason(){
        try{
            if($stmt = $this->dbh->prepare("SELECT * FROM server_slseason")){
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS,'SLSeason');
                $result = array();
                while($row=$stmt->fetch()){
                    $result[] = $row;
                }
                $this->dbh = null;
                return $result;
            }else{
                $this->dbh = null;
                return "Failed";
            }

        }catch(PDOException $e){
            die($e);
        }
    }

    function getIDs(){
        try{
            if($stmt = $this->dbh->prepare("SELECT sport FROM server_slseason")){
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS,'SLSeason');
                $result = array();
                while($row = $stmt->fetch()){
                    $result[] = $row->sport;
                }

                return $result;

            }else{
                $this->dbh = null;
                return "Failed";
            }
        }catch(PDOException $e){
            die($e);
        }
    }

    function getModals($data, $id){
        $bigString = "<div class=\"input-field col s12\">
    <select id='{$id}'>
        <option value=\"\" disabled selected>Select Sport/League/Season Combination</option>";
        foreach($data as $row) {
            $bigString .= "
        <option value='{$row->sport},{$row->league},{$row->season}'>Sport: {$row->sport}, League: {$row->league},Season: {$row->season}</option>
        ";
        }
        $bigString .= "
        </select>
        <label>Sports/League/Season</label>
    </div>";
        $this->dbh = null;
        return $bigString;
    }

    function getAllSLSeasonsAsTable($result){
        $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Sports Seasons Leagues</span>
                      <table>
                        <tr>
                            <th>Sport</th>
                            <th>Season</th>
                            <th>League</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
        foreach($result as $row){
            $bigString .="
                            <tr>
                                <td class='seasonId'>{$row->sport}</td>
                                <td class='seasonName'>{$row->season}</td>
                                <td class='seasonName'>{$row->league}</td>
                                <td><a class=\"waves-effect waves-light btn editSLSeasonsButton modal-trigger\" href=\"#editSLSeasons\">Edit</a></td>
                                <td><a class=\"waves-effect waves-light btn deleteSLSeasonsButton\"><i class=\"material-icons right\">clear</i></a></td>
                            </tr>
                            ";
        }
        $bigString .="</tbody><a id='SLseasonAdd' href='#editSLSeasons' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
        $this->dbh = null;
        return $bigString;
    }




}
