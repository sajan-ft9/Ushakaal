<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    require_once "../includes/init.php";
    $ORDER = new Orders;
    $SALES = new Sales;
    $PRODUCTS = new Product;
    if(isset($_POST['delivery_confirm'])){
        $cus_id = $_POST['cus_id'];
        $url = "showorders.php?cus_id=$cus_id&showorders=";
        $order_id = clean($_POST['orderid']);
        $req_order = $ORDER->getToggle($order_id);
        $product_id = $req_order['productid']; 
        $seller_id = $PRODUCTS->sellerId($product_id)['cus_id'];
        echo $quantity = $req_order['quantity'];
        $ORDER->deliveryConfirm($order_id);
        if(($ORDER->getToggle($order_id)['order_delivered']) === '1' && ($ORDER->getToggle($order_id)['payment_received']) === '1'){
            $ORDER->salesMade($order_id);
                if($SALES->checkProduct($product_id) > 0){
                    $quantity1 = $SALES->checkProduct($product_id)['sales_qty'] + $quantity; 
                    $SALES->update($quantity1, $product_id, $seller_id);
                    header("location:$url");
                    die;
                }else{
                    $SALES->add($product_id, $quantity, $seller_id);
                    header("location:$url");
                    die;
                }
        }else{
            header("location:$url");
            die;
        }
    }
    if(isset($_POST['payment_confirm'])){
        $cus_id = $_POST['cus_id'];
        $url = "showorders.php?cus_id=$cus_id&showorders=";
        $order_id = clean($_POST['orderid']);
        $req_order = $ORDER->getToggle($order_id);
        $product_id = $req_order['productid']; 
        $seller_id = $PRODUCTS->sellerId($product_id)['cus_id'];
        echo $quantity = $req_order['quantity'];
        $ORDER->paymentConfirm($order_id);
        if(($ORDER->getToggle($order_id)['order_delivered']) === '1' && ($ORDER->getToggle($order_id)['payment_received']) === '1'){
            $ORDER->salesMade($order_id);
                if($SALES->checkProduct($product_id) > 0){
                    $quantity1 = $SALES->checkProduct($product_id)['sales_qty'] + $quantity; 
                    $SALES->update($quantity1, $product_id);
                    header("location:$url");
                    die;
                }else{
                    $SALES->add($product_id, $quantity, $seller_id);
                    header("location:$url");
                    die;
                }
        }else{
            header("location:$url");
            die;
        }
    }        
}
?>