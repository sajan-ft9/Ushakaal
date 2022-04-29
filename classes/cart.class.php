<?php  
require_once "../classes/dbh.class.php";

class Cart extends Dbh {
    public function getAll($customer_id) {
        $sql = "SELECT * FROM cart INNER JOIN products WHERE product_id = products.pr_id AND customer_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer_id]);

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function selected($product_id, $customer_id){
        $sql = "SELECT * FROM cart WHERE product_id = ? AND customer_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product_id, $customer_id]);

        $result = $stmt->fetch();
        return $result;
    }

    public function add($product, $customer_id, $qty) {
        $sql = "INSERT INTO cart (product_id, customer_id, qty) VALUES (?, ?, ?)";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$product, $customer_id, $qty]);
    }

    public function update( $qty, $product, $customer_id) {
        $sql = "UPDATE `cart` SET qty = ? WHERE product_id = ? AND customer_id = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$qty, $product, $customer_id]);
    }

    public function delete($product_id, $customer_id) {
        $sql = "DELETE FROM `cart` WHERE product_id = ? AND customer_id = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$product_id, $customer_id]);
    }

    public function deleteAll($customer_id) {
        $sql = "DELETE FROM `cart` WHERE customer_id = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$customer_id]);
    }

    public function total($customer_id)
    {
        $total = 0;
        $allitem = $this->getAll($customer_id);
        if($allitem > 0){
            foreach($allitem as $item){
                $total = $total + $item['qty'] * $item['pr_price'];
            }
            return $total;
        }else{
            return 0;
        }
        
    }
}
