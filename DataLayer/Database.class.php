<?php
/**
 * User: Caitlyn
 * Date: 10/9/2018
 * Time: 10:26 AM
 */

class DB{
    private $dbh;
    function __construct(){
        try {
            //open a connection
            $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);

            //set the attributes
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Error: Failed to Login");
        }
    }
    /**
     * Fucntion that will prepare the sql statement
     */
    function prepare($sql){
        try{
            $stmt = $this->dbh->prepare($sql);
            return $stmt;
        }catch(PDOException $e){
            die("Error");
        }

    }
    /**
     * Function that will execute the prepared statement,
     * fetch all of the dat, and then return the result.
     */
    function getData($sql,$class){
        try{
            $result = array();
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, $class);
            // While data is returned add data to array
            while($classResult = $sql->fetch()){
                $result[] = $classResult;
            }
            return $result;
        }catch(PDOException $e){
            die("Error getting Data");
        }

    }
    /**
     * Function that will create, read, and delete
     * elements from the DB.
     */
    function setData($stmt){
        return $stmt->execute();
    }
    /**
     * Function that will close the DB connection.
     */
    function close(){
        $dbh = null;
    }
}