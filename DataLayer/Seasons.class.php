<?php

    class Seasons{
        private $id;
        private $year;
        private $description;
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

        function addSeason($id, $year, $description){
            try {
                if ($stmt = $this->dbh->prepare("INSERT INTO server_season (id, year, description)
                                            VALUES (:id,:year,:description)")) {
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":year", $year);
                    $stmt->bindParam(":description", $description);
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

        function deleteSeason($id)
        {
            try {
                if ($stmt = $this->dbh->prepare("DELETE from server_season
                                                WHERE id = :id")) {
                    $stmt->bindParam(":id", $id);
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

        function editSeason($newID,$year,$oldID, $description){
            try{
                if($stmt = $this->dbh->prepare("UPDATE server_season
                                                SET id=:newID, year=:year, description=:description
                                                WHERE id=:oldID")){
                    $stmt->bindParam(":newID", $newID);
                    $stmt->bindParam(":year", $year);
                    $stmt->bindParam(":oldID", $oldID);
                    $stmt->bindParam(":description", $description);
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

        function getAllSeason(){
            try{
                if($stmt = $this->dbh->prepare("SELECT * FROM server_season")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS,'Seasons');
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

        function getIDs(){
            try{
                if($stmt = $this->dbh->prepare("SELECT id FROM server_season")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS,'Seasons');
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

        function getAllSeasonsAsTable($result){
            $bigString="<div class=\"row\">
                <div class=\"col m12\">
                  <div class=\"card blue-grey darken-1\">
                    <div class=\"card-content white-text\">
                      <span class=\"card-title\">Seasons</span>
                      <table>
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
            foreach($result as $row){
                $bigString .="
                            <tr>
                                <td class='seasonId'>{$row->id}</td>
                                <td class='seasonName'>{$row->year}</td>
                                <td class='seasonName'>{$row->description}</td>
                                <td><a class=\"waves-effect waves-light btn editSeasonsButton modal-trigger\" href=\"#editSeasons\">Edit</a></td>
                                <td><a class=\"waves-effect waves-light btn deleteSeasonsButton\"><i class=\"material-icons right\">clear</i></a></td>
                            </tr>
                            ";
            }
            $bigString .="</tbody><a id='seasonAdd' href='#editSeasons' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
            return $bigString;
        }


    }