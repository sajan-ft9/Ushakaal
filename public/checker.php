<?php
session_start();
require_once "../includes/init.php";
$blog = new Blog();
$prod= new Product();
print_r($prod->sellerId(40)['cus_id']);
?>
