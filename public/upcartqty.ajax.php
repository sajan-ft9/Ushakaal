<?php 

require_once "../includes/init.php";
customerLogin();
$cart = new Cart();


if(isset($_POST['qty']) && isset($_POST['product_id'])){
    if($_POST['qty'] < 0 || !is_numeric($_POST['qty'])){
        $_POST['qty'] = 1;
    }
        $qty = $_POST['qty'];
        $product_id  = $_POST['product_id'];
        $cart->update($qty,$product_id, $_SESSION['customer_id']);
        die;
        // echo "<script>alert('".$qty."<br>" .$product_id."<br>"  . $_SESSION['customer_id']."')</script>";
}
elseif (isset($_POST['path']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $cart->delete($product_id, $_SESSION['customer_id']);
    die;

}
else{
    echo "<script>alert('Not allowed')</script>";
    die;
}
    
