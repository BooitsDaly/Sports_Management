<?php

    class Player{
        private $id;
        private $firstname;
        private $lastname;
        private $dateofbirth;
        private $jerseynumber;
        private $team;
        private $dbh;

        /**
         * Player constructor.
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
         * @param $firstname
         * @param $lastname
         * @param $dob
         * @param $jerseynumber
         * @param $team
         * @return string
         */
        function addPlayers($firstname, $lastname, $dob, $jerseynumber, $team){
            try {
                if ($stmt = $this->dbh->prepare("INSERT INTO server_player (id, firstname, lastname, dateofbirth, jerseynumber, team) 
VALUES ('', :firstname, :lastname, :dateofbirth, :jerseynumber, :team)")){
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":dateofbirth", $dob);
                    $stmt->bindParam(":jerseynumber", $jerseynumber);
                    $stmt->bindParam(":team", $team);
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
         * @param $team
         * @return array|string
         */
        function getPlayersbyTeam($team){
            try{
                if($stmt = $this->dbh->prepare("SELECT * from server_player WHERE team=:team")){
                    $stmt->bindParam(':team',$team,PDO::FETCH_CLASS);
                    $stmt->setFetchMode(PDO::FETCH_CLASS, "Player");
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

            }catch(PDOException $e){
                die($e);
            }
        }

        /**
         * @param $team
         * @param $jerseynumber
         * @return string
         */
        function deletePlayer($team, $jerseynumber){
            try{
                if($stmt = $this->dbh->prepare("DELETE FROM server_player WHERE team=:team AND jerseynumber = :jerseynumber")){
                    $stmt->bindParam(':team', $team);
                    $stmt->bindParam(':jerseynumber', $jerseynumber);
                    $stmt->execute();

                    $this->dbh = null;
                    return "Success!";
                }else {
                    $this->dbh = null;
                    return "failed";
                }

            }catch(PDOException $e){
                die($e);
            }
        }

        /**
         * @return array|string
         */
        function getAllPlayers(){
            try{
                if($stmt = $this->dbh->prepare("SELECT * from server_player")){
                    $stmt->setFetchMode(PDO::FETCH_CLASS, "Player");
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

            }catch(PDOException $e){
                die($e);
            }
        }

        /**
         * @param $team
         * @param $firstname
         * @param $lastname
         * @param $dateofbirth
         * @param $jerseynumber
         * @param $oldteam
         * @param $oldjerseynumber
         * @return string
         */
        function editPlayer($team,$firstname, $lastname, $dateofbirth, $jerseynumber, $oldteam, $oldjerseynumber ){
            try{
                if($stmt = $this->dbh->prepare("UPDATE server_player
                                                SET firstname = :firstname, lastname = :lastname, dateofbirth = :dateofbirth, jerseynumber = :jerseynumber, team=:team 
                                                WHERE team=:oldteam AND jerseynumber = :oldjerseynumber")){
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":dateofbirth", $dateofbirth);
                    $stmt->bindParam(":jerseynumber", $jerseynumber);
                    $stmt->bindParam(":team", $team);

                    $stmt->bindParam(':oldteam', $oldteam);
                    $stmt->bindParam(':oldjerseynumber', $oldjerseynumber);
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

        /**
         * @param $result
         * @return string
         */
        function getAsTable($result){
            $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Players</span>
                      <table>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>DOB</th>
                            <th>Jersey #</th>
                            <th>Team</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
            foreach($result as $row){
                $bigString .="
                            <tr>
                                <td >{$row->id}</td>
                                <td >{$row->firstname}</td>
                                <td >{$row->lastname}</td>
                                <td >{$row->dateofbirth}</td>
                                <td >{$row->jerseynumber}</td>
                                <td >{$row->team}</td>
                                <td><a class=\"waves-effect waves-light btn editPlayersButton modal-trigger\" href=\"#editPlayers\">Edit</a></td>
                                <td><a class=\"waves-effect waves-light btn deletePlayersButton\"><i class=\"material-icons right\">clear</i></a></td>
                            </tr>
                            ";
            }
            $bigString .="</tbody><a id='playersAdd' href='#editPlayers' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
            return $bigString;
        }

        /**
         * @param $data
         * @param $id
         * @return string
         */
        function getModals($data, $id){
            $bigString = "<div class=\"input-field col s12\">
    <select id='{$id}'>
        <option value=\"\" disabled selected>Select Team</option>";
            foreach($data as $row) {
                $bigString .= "
        <option value='{$row->id}'>{$row->name}</option>
        ";
            }

            $bigString .= "
        </select>
        <label>Team</label>
    </div>";
            return $bigString;
        }
    }
