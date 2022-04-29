<?php  
require_once "../includes/init.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['delComment'])){
        $customer = clean($_POST['customerId']);
        $product = clean($_POST['product']);
        $PRODUCT = new Product;
        $PRODUCT->delComment($customer, $product);
        header("location:view.php?id=".$_POST['product']);
        die;
    }

    if(isset($_POST['delwish'])){
        $customer = clean($_POST['customerid']);
        $product = clean($_POST['productid']);
        $WISH = new Wish;
        $WISH->delete($product, $customer);
        header("location:wish.php");
        die;
    }

}