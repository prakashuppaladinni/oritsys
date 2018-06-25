<?php
/**
 * Created by PhpStorm.
 * User: Prakash
 * Date: 6/22/2018
 * Time: 11:20 PM
 */

require_once("dbconfig.php");

class Assignment{

    private $conn;

    public function __construct(){
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql){
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt -> fetchAll();

            echo "Watchlist words:\n";
            foreach( $result as $row ) {
                echo $row['word']."\n";
            }
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertIntoUniqueWords($data){
        try {
            foreach ($data as $value){
                $stmt = $this->conn->prepare("INSERT INTO uniqueWords(word) VALUES(:word)");
                $stmt->bindparam(":word", $value);
                $stmt->execute();
            }
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function countUniqueWords($taskNumber){
        try {
            $stmt = $this->conn->prepare("SELECT COUNT( DISTINCT(`word`) ) as cnt FROM `uniqueWords`");
            $stmt->execute();
            $row = $stmt->fetch();

            if($taskNumber == '2'){
                echo "Distinct unique words : ".$row[0]."\n\n\n";
            }elseif ($taskNumber == '3'){
                echo "Distinct unique words : ".$row[0]."\n";
            }
        } catch(PDOException $e) {
            echo $e->getMessage()."\n\n\n";
        }
    }
}