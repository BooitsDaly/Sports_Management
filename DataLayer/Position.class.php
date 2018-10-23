<?php

    class Position{
        private $name;
        private $id;
        private $dbh;

        /**
         * Position constructor.
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
         * @param $name
         * @return string
         */
        function addPosition($name){
            try {
                if ($stmt = $this->dbh->prepare("INSERT INTO server_position (id, name) VALUES ('', :name)")){
                    //$stmt->bindParam(":id", $id);
                    $stmt->bindParam(":name", $name);
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
         * @return array
         */
        function getAllPositions(){
            try{
                if($stmt = $this->dbh->prepare("SELECT * FROM server_position")){
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_CLASS, "Position");
                    $result = array();
                    while($row = $stmt->fetch()){
                        $result[] = $row;
                    }
                    $this->dbh = null;
                    return $result;
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
                      <span class=\"card-title\">Positions</span>
                      <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                        <tbody>";
            foreach($result as $row){
                $bigString .="
                            <tr>
                                <td class='teamID'>{$row->id}</td>
                                <td class='teamName'>{$row->name}</td>
                            </tr>
                            ";
            }
            $bigString .="</tbody><a id='positionAdd' href='#editPosition' class=\"btn-floating halfway-fab waves-effect waves-light red modal-trigger\"><i class=\"material-icons\">add</i></a>   
                      </table>
                    </div>
                  </div>
                </div>
              </div>";
            return $bigString;
        }
    }