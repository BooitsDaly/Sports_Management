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
class User
{
    private $username;
    private $role;
    private $password;
    private $team;
    private $league;
    private $dbh;

    /*
     * default constructor
     */
    function __construct()
    {
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
     * Function: Login
     * Validates user and sets sessions
     * @return mixed|string
     */
    function login($user, $pass)
    {
        try {
            if ($stmt = $this->dbh->prepare("SELECT * from server_user WHERE username = :username AND password = :password;")) {
                $stmt->bindParam(":username", $user, PDO::FETCH_CLASS);
                $stmt->bindParam(":password", $pass, PDO::FETCH_CLASS);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, "User");

                $result = $stmt->fetch();

                //set up all of the sessions
                $_SESSION['username'] = $result->username;
                $_SESSION['role'] = $result->role;
                $_SESSION['team'] = $result->team;
                $_SESSION['league'] = $result->league;

                return $result->role;
            } else {
                return "False";
            }
        } catch (PDOException $e) {
            die("Error occured while trying to login");
        }

    }

    /**
     * ADMIN STATEMENTS
     * ADD / DELETE / VIEW / EDIT ANY USER
     *
     */

    function addUser($user, $pass, $team, $league)
    {
        try {
            if ($stmt = $this->dbh->prepare("INSERT INTO server_user (username, role, password, team, league)
                                            VALUES (:user , :role, :pass, :team, :league)")) {
                $result = array();
                $stmt->bindParam(":user", $user, PDO::FETCH_CLASS);
                $stmt->bindParam(":role", $role, PDO::FETCH_CLASS);
                $stmt->bindParam(":pass", $pass, PDO::FETCH_CLASS);
                $stmt->bindParam(":team", $team, PDO::FETCH_CLASS);
                $stmt->bindParam(":league", $league, PDO::FETCH_CLASS);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die("Error");
        }
    }

    function editUser($user, $pass, $team, $league, $newUser)
    {
        try {
            if ($stmt = $this->dbh->prepare("UPDATE server_user
                                                 SET username = :newUser, role = :role, password= :pass, team = :team, league = :league
                                                 WHERE username = :user")) {
                $stmt->bindParam(":user", $user);
                $stmt->bindParam(":role", $role);
                $stmt->bindParam(":pass", $pass);
                $stmt->bindParam(":team", $team);
                $stmt->bindParam(":league", $league);
                $stmt->bindParam(":newUser", $newUser);
                $stmt->execute();
            }

        } catch (PDOException $e) {
            die("Error");
        }
    }

    function deleteUser($user)
    {
        try {
            if ($stmt = $this->dbh->prepare("DELETE from server_user
                                                WHERE username = :username")) {
                $stmt->bindParam(":username", $user);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die("Error");
        }
    }

    function selectUser($username)
    {
        try {
            if ($stmt = $this->dbh->prepare("SELECT username, role, team, league from server_user WHERE username=:username")) {
                $result = array();
                $stmt->bindParam(":username", $username, PDO::FETCH_CLASS);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
                $result[] = $stmt->fetch();
                return $result;
            } else {
                return "False";
            }
        } catch (PDOException $e) {
            die("Error occured while trying to login");
        }
    }

    function getUserData($data){
        if (count($data) > 0) {
        foreach($data as $row)
            var_dump($row);
            $string = "<p>{$row->username}</p>" .
                "<p>{$row->role}</p>" .
                "<p>{$row->team}</p>" .
                "<p>{$row->league}</p>";
        return $string;

        }else{
            return "No data found";
        }
    }


}
