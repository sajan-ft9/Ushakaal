<?php 
require_once "../classes/dbh.class.php";
class Notice extends Dbh {

    public function getAll(){
        $sql = "SELECT * FROM notice";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function addNotice($notice) {
        $sql = "INSERT INTO notice (notices) VALUES (?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$notice]);
    }

    public function delNotice($id) {
        $sql = "DELETE FROM notice WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }


}