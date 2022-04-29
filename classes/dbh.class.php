<?php 

class Dbh {

    // localhost
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "project";

    public function connect () {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        try{
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        }catch (PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

}


