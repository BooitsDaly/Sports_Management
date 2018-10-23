<?php

    class Sport{
        private $id;
        private $name;
        private $dbh;

        /**
         * Sport constructor.
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
         * @param $id
         * @param $name
         * @return string
         */
        function addSport($id,$name){
            try {
                if ($stmt = $this->dbh->prepare("INSERT INTO server_sport (id, name)
                                            VALUES (:id , :name)")) {
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":name", $name);
                    $stmt->execute();
                    return "Success!";
                }else{
                    return "fail";
                }
            } catch (PDOException $e) {
                die("Error");
            }
        }

        /**
         * @param $id
         * @return string
         */
        function deleteSport($id){
            try{
                if($stmt = $this->dbh->prepare("DELETE from server_sport WHERE id=:id")){
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

        /**
         * @return array|string
         */
        function getSportNames(){
            try{
                if($stmt = $this->dbh->prepare("SELECT name FROM server_sport")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS,'Sport');
                    $result = array();
                    while($row = $stmt->fetch()){
                        $result[] = $row->name;
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

        /**
         * @return array|string
         */
        function getIDs(){
            try{
                if($stmt = $this->dbh->prepare("SELECT id FROM server_sport")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS,'Sport');
                    $result = array();
                    while($row = $stmt->fetch()){
                        $result[] = $row->id;
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

        /**
         * @param $newID
         * @param $sportName
         * @param $oldID
         * @return string
         */
        function editSport($newID,$sportName,$oldID){
            try{
                if($stmt = $this->dbh->prepare("UPDATE server_sport
                                                SET id=:newID, name=:sportName
                                                WHERE id=:oldID")){
                    $stmt->bindParam(":newID", $newID);
                    $stmt->bindParam(":sportName", $sportName);
                    $stmt->bindParam(":oldID", $oldID);
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
         * @return string
         */
        function getAllSportsAsTable(){
            $result = $this->getAllSports();
            $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Sports</span>
                      <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
                            foreach($result as $row){
                                $bigString .="
                            <tr>
                                <td class='sportId'>{$row->id}</td>
                                <td class='sportName'>{$row->name}</td>
                                <td><a class=\"waves-effect waves-light btn editSportsButton modal-trigger\" href=\"#editSports\">Edit</a></td>
                                <td><a class=\"waves-effect waves-light btn deleteSportsButton\"><i class=\"material-icons right\">clear</i></a></td>
                            </tr>
                            ";
                            }
                            $bigString .="</tbody><a id='sportAdd' href='#editSports' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
            return $bigString;
        }

        /**
         * @return array|string
         */
        function getAllSports(){
            try{
                if($stmt = $this->dbh->prepare("SELECT * FROM server_sport")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS,'Sport');
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