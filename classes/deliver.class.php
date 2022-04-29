<?php 
require_once "../classes/dbh.class.php";
class Deliver extends Dbh {

    public function get($del_id) {
        $sql = "SELECT * FROM delivery WHERE del_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$del_id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getAll(){
        $sql = "SELECT * FROM `delivery` ORDER BY del_id DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function selected($del_user) {
        $sql = "SELECT * FROM `delivery` WHERE del_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$del_user]);

        $result = $stmt->fetch();
        return $result;
    }

    public function add($del_id, $password) {
        $sql = "INSERT INTO delivery (del_user, password) VALUES (?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$del_id, $password]);
    }

    public function changePass($password, $del_id){
        $sql = "UPDATE delivery SET password = ? WHERE del_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$password, $del_id]);
    }

}
