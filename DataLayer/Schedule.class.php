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

    function getAllGames(){
        try{
            if($stmt = $this->dbh->prepare("SELECT * from server_schedule")){
                $stmt->setFetchMode(PDO::FETCH_CLASS, "Schedule");
                $stmt->execute();
                $result = Array();
                while($row = $stmt->fetch()){
                    $result[] = $row;
                }
            }else{

            }

        }catch(PDOException $e){
            die($e);
        }
    }
}