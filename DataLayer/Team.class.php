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
    }