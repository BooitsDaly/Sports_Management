<?php

class League{
    private $id;
    private $name;
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

    function getLeagueNames(){
        try{
            if($stmt = $this->dbh->prepare("SELECT name FROM server_league")){
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, "League");
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
