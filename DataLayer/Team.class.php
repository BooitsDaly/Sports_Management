<?php
    class Team{
        private $id;
        private $name;
        private $mascot;
        private $sport;
        private $league;
        private $season;
        private $picture;
        private $homecolor;
        private $awaycolor;
        private $maxplayers;
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

        function getTeamNames(){
            try{
                if($stmt = $this->dbh->prepare("SELECT name FROM server_team")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS, "Team");
                    $result = array();
                    while($row = $stmt->fetch()){
                        $result[] = $row->name;
                    }
                    $this->dbh = null;
                    return $result;
                }
            }catch(PDOException $e){
                die($e);
            }
        }

        function getTeams($id){
            try{
                if($id){
                    if($stmt = $this->dbh->prepare("SELECT * from server_team WHERE league=:id")){
                        $stmt->bindParam(':id',$id,PDO::FETCH_CLASS);
                        $stmt->setFetchMode(PDO::FETCH_CLASS, "Team");
                        $stmt->execute();
                        $result = array();
                        while($row = $stmt->fetch()){
                            $result[] = $row;
                        }
                        $this->dbh = null;
                        return $result;
                    }else {
                        $this->dbh = null;
                        return "failed";
                    }
                }else{
                    if($stmt = $this->dbh->prepare("SELECT * from server_team")){
                        $stmt->setFetchMode(PDO::FETCH_CLASS, "Team");
                        $result = array();
                        while($row = $stmt->fetch()){
                            $result[] = $row;
                        }
                        $this->dbh = null;
                        return $result;
                    }else{
                        $this->dbh = null;
                        return "failed";
                    }
                }

            }catch(PDOException $e){
                die($e);
            }
        }

        function addTeam($name,$mascot,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers){
            try {
                if ($stmt = $this->dbh->prepare("INSERT INTO server_team (id, name, mascot, sport, league, season, picture,homecolor,awaycolor,maxplayers)VALUES ('', :name, :mascot, :sport, :league, :season, :picture, :homecolor, :awaycolor, :maxplayers)")){
                    //$stmt->bindParam(":id", $id);
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":mascot", $mascot);
                    $stmt->bindParam(":sport", $sport);
                    $stmt->bindParam(":league", $league);
                    $stmt->bindParam(":season", $season);
                    $stmt->bindParam(":picture", $picture);
                    $stmt->bindParam(":homecolor", $homecolor);
                    $stmt->bindParam(":awaycolor", $awaycolor);
                    $stmt->bindParam(":maxplayers", $maxplayers);
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
        function deleteTeam($id){
            try{
                if($stmt = $this->dbh->prepare("DELETE from server_team WHERE id=:id")){
                    $stmt->bindParam(':id',$id);
                    $stmt->execute();
                    $stmt->dbh = null;
                    return "Success!";
                }else{
                    $this->dbh = null;
                    return "Failed";
                }
            }catch(PDOException $e){
                die($e);
            }
        }
        function editTeam($id,$name,$mascot,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers){
            try {
                if ($stmt = $this->dbh->prepare("UPDATE server_team
                                                 SET name=:name, mascot=:mascot, sport=:sport, league=:league, season=:season, picture=:picture,homecolor=:homecolor,awaycolor=:awaycolor,maxplayers=:maxplayers
                                                 WHERE id=:id")){
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":mascot", $mascot);
                    $stmt->bindParam(":sport", $sport);
                    $stmt->bindParam(":league", $league);
                    $stmt->bindParam(":season", $season);
                    $stmt->bindParam(":picture", $picture);
                    $stmt->bindParam(":homecolor", $homecolor);
                    $stmt->bindParam(":awaycolor", $awaycolor);
                    $stmt->bindParam(":maxplayers", $maxplayers);
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

        function getAllTeamsAsTable($result){
            $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Teams</span>
                      <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mascot</th>
                            <th>Sport</th>
                            <th>League</th>
                            <th>Season</th>
                            <th>Picture</th>
                            <th>Home color</th>
                            <th>Away color</th>
                            <th>Max Players</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
            foreach($result as $row){
                $bigString .="
                            <tr>
                                <td class='teamID'>{$row->id}</td>
                                <td class='teamName'>{$row->name}</td>
                                <td class='teamMascott'>{$row->mascot}</td>
                                <td class='teamSport'>{$row->sport}</td>
                                <td class='teamLeague'>{$row->league}</td>
                                <td class='teamSeason'>{$row->season}</td>
                                <td class='teamPicture'>{$row->picture}</td>
                                <td class='homecolor'>{$row->homecolor}</td>
                                <td class='awaycolor'>{$row->awaycolor}</td>
                                <td class='maxplayers'>{$row->maxplayers}</td>
                                <td><a class=\"waves-effect waves-light btn editTeamsButton modal-trigger\" href=\"#editTeams\">Edit</a></td>
                                <td><a class=\"waves-effect waves-light btn deleteTeamsButton\"><i class=\"material-icons right\">clear</i></a></td>
                            </tr>
                            ";
            }
            $bigString .="</tbody><a id='teamAdd' href='#editTeams' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
            return $bigString;
        }
    }