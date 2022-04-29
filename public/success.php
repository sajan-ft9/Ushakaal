<?php
require_once "../helpers/functions.php";
customerLogin();

if(isset($_GET['refId'])){
require_once 'setting.php';

$ref = $_GET['refId'];

$data =[
    'amt'=>$actualamount,
    'rid'=> $ref,
    'pid'=>$pid,
    'scd'=> $merchant_code
];

    $curl = curl_init($fraudcheck_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl); 
    curl_close($curl);
    
if(!isset($_SESSION['order_placed'])){
    $customer_id = $_SESSION['customer_id'];
    $PROD = new Product();
    $cart = new Cart();
    $orders = new Orders();
    $order_address = $_SESSION['address'];
    $payment_type = "esewa";
    date_default_timezone_set('Asia/Kathmandu');
                $order_date = date("Y-m-d H:i:s");
                $cart_detail = $cart->getAll($customer_id);
                $bill_no =  "ES-".$customer_id."-".time();
                if($cart_detail > 0){
                    foreach($cart_detail as $detail){
                        $amount = $detail['pr_price'] * $detail['qty'];
                        $sellerId = $PROD->sellerId($detail['product_id'])['cus_id'];
                        $orders->add($customer_id, $detail['product_id'], $detail['qty'], $payment_type, $amount, $order_date, $order_address, $bill_no,$sellerId);
                        $changeqty = $detail['pr_qty'] - $detail['qty'];
                        $PROD->updateProductQty($changeqty, $detail['product_id']);
                    }
                    $cart->deleteAll($customer_id);
                    $_SESSION['order_placed'] = true;
                    echo "Payment successful. <a href='index.php' class='btn btn-primary'>Homepage</a>";
                    // echo "<script>window.location.replace('orders.php')</script>";
                    die;
                }else{
                    echo "<script>window.location.replace('index.php')</script>";
                    die;                
                }
}else{
    header("location:index.php");
    die;
}
}else{
    header("location:index.php");
    die;
}
?>