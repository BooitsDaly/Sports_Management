<?php

class League{
    private $id;
    private $name;
    private $dbh;

    /**
     * League constructor.
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
     * @return array
     */
    function getLeagueNames(){
        try{
            if($stmt = $this->dbh->prepare("SELECT * FROM server_league")){
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, "League");
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
