<?php 
require_once "../classes/dbh.class.php";

class Customer extends Dbh{
    public function getAll(){
        $sql = "SELECT * FROM customers";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function selected($email) {
        $sql = "SELECT * FROM `customers` WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);

        $result = $stmt->fetch();
        return $result;
    }

    public function customerDetails($id) {
        $sql = "SELECT name FROM `customers` WHERE cus_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }

    public function add($name, $contact, $email, $password) {
        $sql = "INSERT INTO customers (name, contact, email, password, login_type) VALUES (?, ?, ?, ?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$name, $contact, $email, $password, "custom"]);
    }

    public function addGmail($name, $contact, $email, $password) {
        $sql = "INSERT INTO customers (name, contact, email, password, login_type) VALUES (?, ?, ?, ?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$name, $contact, $email, $password, "gmail"]);
    }

    public function changePass($password, $del_id){
        $sql = "UPDATE customers SET password = ? WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$password, $del_id]);
    }
    
}

