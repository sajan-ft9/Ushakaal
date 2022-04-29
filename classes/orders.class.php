<?php  
require_once "../classes/dbh.class.php";

class Orders extends Dbh {

    public function allOrders(){
        $sql = "SELECT * FROM `orders` INNER JOIN products WHERE products.pr_id = productid AND sold = 0";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function allAdminOrders($customer){
        $sql = "SELECT * FROM `orders` INNER JOIN products WHERE (products.pr_id = productid AND sold = 0 AND products.cus_id = ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer]);

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function pendingOrders($sellerId){
        $sql = "SELECT * FROM `orders` WHERE (sold = 0 AND seller_id = $sellerId )";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function getSelected($customer_id){
        $sql = "SELECT * FROM `orders` INNER JOIN products WHERE products.pr_id = productid AND customer_id = ? AND sold = 0 ORDER BY orders.order_date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer_id]);

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function getSelectedSold($customer_id){
        $sql = "SELECT * FROM `orders` INNER JOIN products WHERE products.pr_id = productid AND customer_id = ? AND sold = 1 ORDER BY orders.order_date DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$customer_id]);

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function add($customer_id, $pr_id, $pr_qty, $payment_type, $amount, $order_date, $order_address, $bill_no, $sellerId){
        if($payment_type === 'cash'){
            $sql = "INSERT INTO `orders`(`customer_id`, productid, quantity, `payment_type`, `amount`, `order_date`, `order_address`, `order_delivered`, payment_received, sold, bill_no, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?, 0, 0, 0, ?,?)";
            $stmt= $this->connect()->prepare($sql);
            $stmt->execute([$customer_id, $pr_id, $pr_qty, $payment_type, $amount, $order_date, $order_address, $bill_no, $sellerId]);
        }
        if($payment_type === 'esewa'){
            $sql = "INSERT INTO `orders`(`customer_id`, productid, quantity, `payment_type`, `amount`, `order_date`, `order_address`, `order_delivered`, payment_received, sold, bill_no, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?, 0, 1, 0, ?,?)";
            $stmt= $this->connect()->prepare($sql);
            $stmt->execute([$customer_id, $pr_id, $pr_qty, $payment_type, $amount, $order_date, $order_address, $bill_no,$sellerId]);    
        }
    }

    public function salesMade($order_id){    
        $sql = "UPDATE `orders` SET sold = 1 WHERE id = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);
    }

    // public function delete($order_id){    
    //     $sql = "DELETE FROM `orders` WHERE id = ?";
    //     $stmt= $this->connect()->prepare($sql);
    //     $stmt->execute([$order_id]);
    // }

    public function deliveryConfirm($order_id){    
        $sql = "UPDATE `orders` SET order_delivered = 1 WHERE id = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);
    }

    public function paymentConfirm($order_id){    
        $sql = "UPDATE `orders` SET payment_received = 1 WHERE id = ?";
        $stmt= $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);
    }

    public function getToggle($order_id) {
        $sql = "SELECT * FROM `orders` WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$order_id]);

        $result = $stmt->fetch();
        return $result;
    }

    public function showOrders(){
        $sql = "SELECT * FROM customers INNER JOIN orders WHERE customers.cus_id=orders.customer_id AND orders.sold = 0 GROUP BY customers.cus_id ORDER BY orders.order_date";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function dashboardEarnings($time,$sellerId){
        date_default_timezone_set('Asia/Kathmandu');
        if($time == 'daily'){
            $req_date = date("Y-m-d");
            $sql = "SELECT DATE(order_date),SUM(amount)
            FROM orders WHERE (DATE(order_date) = '$req_date' AND sold = 1 AND seller_id = $sellerId)
            GROUP BY DATE(order_date)";
        }if($time == 'monthly'){
            $year = date("Y"); $month = date("m");
            $sql = "SELECT MONTH(order_date),SUM(amount)
            FROM orders WHERE ((YEAR(order_date) = '$year' AND MONTH(order_date) = '$month') AND (sold = 1 AND seller_id = $sellerId ))
            GROUP BY MONTH(order_date)";
        }if($time == 'yearly'){
            $year = date("Y");
            $sql = "SELECT YEAR(order_date),SUM(amount)
            FROM orders WHERE (YEAR(order_date) = '$year' AND (sold = 1 AND seller_id = $sellerId ))
            GROUP BY YEAR(order_date)";
        }
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }    

    public function filterGraph($time, $sellerId){
        if($time == 'MONTH'){
            $sql = "SELECT YEAR(order_date), MONTHNAME(order_date),SUM(amount)
                    FROM orders WHERE seller_id = $sellerId
                    GROUP BY YEAR(order_date), $time(order_date)";
        }else{
            $sql = "SELECT YEAR(order_date), $time(order_date),SUM(amount)
                    FROM orders WHERE seller_id = $sellerId
                    GROUP BY YEAR(order_date), $time(order_date)";
        }       
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while($result = $stmt->fetchAll()) {
            return $result;
        }
    }

}
?>