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
    function login($username, $password){
        try {
            if ($stmt = $this->dbh->prepare("SELECT username, role, team, league from server_user WHERE username=:username AND password=:password")) {
                $stmt->bindParam(":username",  $username, PDO::FETCH_CLASS);
                $stmt->bindParam(":password", $password, PDO::FETCH_CLASS);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
                $result = $stmt->fetch();
                if($result != "false"){
                    //set up all of the sessions
                    session_start();
                    $_SESSION['username'] = $result->username;
                    $_SESSION['role'] = $result->role;
                    $_SESSION['team'] = $result->team;
                    $_SESSION['league'] = $result->league;

                    $this->dbh = null;
                    return $result->role;
                }
            } else {
                return "False";
            }
        } catch (PDOException $e) {
            die($e);

        }

    }

    /**
     * ADMIN STATEMENTS
     * ADD / DELETE / VIEW / EDIT ANY USER
     *
     */

    function addUser($user, $pass, $team, $league, $role)
    {
        try {
            if ($stmt = $this->dbh->prepare("INSERT INTO server_user (username, role, password, team, league)
                                            VALUES (:user , :role, :pass, :team, :league)")) {
                $stmt->bindParam(":user", $user);
                $stmt->bindParam(":role", $role);
                $stmt->bindParam(":pass", $pass);
                $stmt->bindParam(":team", $team);
                $stmt->bindParam(":league", $league);
                $stmt->execute();
                $this->dbh = null;
                return "Success!";
            }else{
                return "fail";
            }
        } catch (PDOException $e) {
            die("Error");
        }
    }

    function editUser($user, $pass, $team, $league,$role, $newUser)
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
                $this->dbh = null;
                return "Success!";
            }else{
                return "Failed!";
            }

        } catch (PDOException $e) {
            die($e);
        }
    }

    function deleteUser($user)
    {
        try {
            if ($stmt = $this->dbh->prepare("DELETE from server_user
                                                WHERE username = :username")) {
                $stmt->bindParam(":username", $user);
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

    function selectUser($username)
    {
        try {
            if ($stmt = $this->dbh->prepare("SELECT username, role, team, league from server_user WHERE username=:username")) {
                $result = array();
                $stmt->bindParam(":username", $username, PDO::FETCH_CLASS);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
                $result[] = $stmt->fetch();
                $this->dbh = null;
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

    function selectUsers()
    {
        try {
            if ($stmt = $this->dbh->prepare("SELECT server_user.username, server_roles.name, server_team.name, server_league.name
                                                        FROM server_user
                                                        JOIN server_roles 
                                                        ON server_user.role=server_roles.id
                                                        JOIN server_team
                                                        ON server_team.id=server_user.team
                                                        JOIN server_league
                                                        ON server_league.id=server_user.league")) {
                $result = array();
                $stmt->execute();

                while($values = $stmt->fetch()){
                    $result[] = $values;
                }
                $bigString = "
                    <div class=\"row\">
                        <div class=\"col s12\">
                          <div class=\"card blue-grey darken-1\">
                            <div class=\"card-content white-text\">
                              <span class=\"card-title\">All Users</span>
                                <table class='highlight'>
                                    <thead>
                                      <tr>
                                          <th>Username</th>
                                          <th>Role</th>
                                          <th>Team</th>
                                          <th>League</th>
                                          <th></th>
                                          <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                              foreach($result as $row){
                                $bigString .= "
                                    <tr>
                                        <td id='username'>{$row['username']}</td>
                                        <td id='role'>{$row[1]}</td>
                                        <td id='team'>{$row[2]}</td>
                                        <td id='league'>{$row['name']}</td>
                                        <td><a class=\"waves-effect waves-light btn editButton modal-trigger\" href=\"#edit\">Edit</a></td>
                                        <td><a class=\"waves-effect waves-light btn deleteButton\"><i class=\"material-icons right\">clear</i></a></td>
                                    </tr>
                                ";
                              }
                              $bigString .= "</tbody><a id='userAdd' href='#edit' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>
                            </table>
                            </div>
                          </div>
                        </div>
                      </div>                    
                ";
                $this->dbh = null;
                 return $bigString;
            } else {
                return "False";
            }
        } catch (PDOException $e) {
            die($e);
        }
    }


}
