<?php
    class Team{
        private $id;
        private $team;
        private $mascott;
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

        function getTeamsinLeague($id){
            try{
                if($stmt = $this->dbh->prepare("SELECT * from server_team WHERE league = :id")){
                    $stmt->bindParam(':id',$id,PDO::FETCH_CLASS);
                    $stmt->setFetchMode(PDO::FETCH_CLASS, "Team");

                    $result = array();
                    while($row = $stmt->fetch()){
                        $result[] = $row->name;
                    }
                    $this->dbh = null;
                    return $result;
                }else{
                    $this->dbh = null;
                    return "failed";
                }

            }catch(PDOException $e){
                die($e);
            }
        }

        function getTeams($id){
            try{
                if($stmt = $this->dbh->prepare("SELECT * from server_team")){
                    $stmt->setFetchMode(PDO::FETCH_CLASS, "Team");
                    $result = array();
                    while($row = $stmt->fetch()){
                        $result[] = $row->name;
                    }
                    $this->dbh = null;
                    return $result;
                }else{
                    $this->dbh = null;
                    return "failed";
                }

            }catch(PDOException $e){
                die($e);
            }
        }

        function addTeam($name,$mascott,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers){
            try {
                if ($stmt = $this->dbh->prepare("INSERT INTO server_sport (id, team, mascott, sport, league, season, picture,homecolor,awaycolor,maxplayers)
                                            VALUES ('', :team, :mascott, :sport, :league, :season, :picture, :homecolor, :awaycolor, :maxplayers)")) {
                    //$stmt->bindParam(":id", $id);
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":id", $mascott);
                    $stmt->bindParam(":name", $sport);
                    $stmt->bindParam(":id", $league);
                    $stmt->bindParam(":name", $season);
                    $stmt->bindParam(":id", $picture);
                    $stmt->bindParam(":name", $homecolor);
                    $stmt->bindParam(":id", $awaycolor);
                    $stmt->bindParam(":name", $maxplayers);
                    $stmt->execute();
                    $this->dbh = null;
                    return "Success!";
                }else{
                    $this->dbh = null;
                    return "fail";
                }
            } catch (PDOException $e) {
                die("Error");
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
        function editTeam($id,$name,$mascott,$sport,$league,$season,$picture,$homecolor,$awaycolor,$maxplayers){
            try {
                if ($stmt = $this->dbh->prepare("UPDATE server_team
                                                 SET team=:team, mascott=:mascott, sport=:sport, league=:league, season=:season, picture=:picture,homecolor=:homecolor,awaycolor=:awaycolor,maxplayers=:maxplayers
                                                 WHERE id=:id")){
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":id", $mascott);
                    $stmt->bindParam(":name", $sport);
                    $stmt->bindParam(":id", $league);
                    $stmt->bindParam(":name", $season);
                    $stmt->bindParam(":id", $picture);
                    $stmt->bindParam(":name", $homecolor);
                    $stmt->bindParam(":id", $awaycolor);
                    $stmt->bindParam(":name", $maxplayers);
                    $stmt->execute();
                    $this->dbh = null;
                    return "Success!";
                }else{
                    $this->dbh = null;
                    return "fail";
                }
            } catch (PDOException $e) {
                die("Error");
            }
        }
    }