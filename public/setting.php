<?php 
require_once "../includes/init.php";

$customer_id = $_SESSION['customer_id'];

$cart = new Cart();


// Change Info From Here

$epay_url = "https://uat.esewa.com.np/epay/main";
$pid = mt_rand();
$successurl = "http://localhost/sem-V/public/success.php?q=su";
$failedurl = "http://localhost/sem-V/public/failed.php?q=fu";
$merchant_code = "EPAYTEST"; 
$fraudcheck_url = "https://uat.esewa.com.np/epay/transrec";

// For Amount Check
$actualamount = $cart->total($customer_id);

?>