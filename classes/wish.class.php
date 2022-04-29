<?php  
require_once "../classes/dbh.class.php";

class Wish extends Dbh {
    public function getAll($customer_id) {
        $sql = "SELECT * FROM `wishes` INNER JOIN products WHERE wish_product = products.pr_id AND wish_cust = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer_id]);

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function add($product_id, $customer_id) {
        $sql = "INSERT INTO wishes (wish_product, wish_cust) VALUES (?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$product_id, $customer_id]);
    }

    public function present($product_id, $customer_id) {
        $sql = "SELECT * FROM wishes WHERE wish_product = ? AND wish_cust = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$product_id, $customer_id]);

        if($stmt->fetch() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function delete($product_id, $customer_id) {
        $sql = "DELETE FROM wishes WHERE wish_product = ? AND wish_cust = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product_id, $customer_id]);
    }
    

}