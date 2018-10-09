<?php
/**
 * User: Caitlyn
 * Date: 10/9/2018
 * Time: 9:59 AM
 */

//import needed files here
require 'Database.class.php';

/**
 * class that will replicate the people class in the DB
 */
class User{
    private $username;
    private $role;
    private $password;
    private $team;
    private $league;
    private $dbh;

    /*
     * default constructor
     */
    function __construct($username, $password){
        $this->$username = $username;
        $this->$password = $password;

        //create the DB
        $dbh = new DB();
    }

    function login(){
        try{
            if($stmt = $this->dbh->prepare("SELECT * from server_user WHERE username = :username AND password = :password")){
                $result = array();
                $stmt->bindParam(":username", $this->username, PDO::FETCH_CLASS);
                $stmt->bindParam(":password", $this->password, PDO::FETCH_CLASS);
                $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
                $stmt->execute();
                while($user = $stmt->fetch()){
                    $result[] = $user;
                }

                //set up all of the sessions
                $_SESSION['username'] = $result['username'];
                $_SESSION['role'] = $result['role'];
                $_SESSION['team'] = $result['team'];
                $_SESSION['league'] = $result['league'];

                return $_SESSION['role'];

            }else{
                return "False";
            }
        }catch(PDOException $e){
            die("Error occured while trying to login");
        }

    }
}
