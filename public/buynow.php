<?php 
require_once "../includes/init.php";
customerLogin();
if(isset($_POST['buynow'])):
    $product_id = clean($_POST['product']);
    $qty = 1;
    $cart = new Cart();
    $PRODUCT = new Product();
    $product = $PRODUCT->selected($product_id);  
    
    $select = $cart->selected($product_id, $_SESSION['customer_id']);
    if($select > 0){
        if(($select['qty'] + $qty) <= $product['pr_qty']){
            echo "Loading";
            $cart->update($select['qty']+ $qty, $product['pr_id'], $_SESSION['customer_id']);
            echo "<script>window.location.replace('cart.php')</script>";
            die;
        }else{
            echo  "<p style='color:red'>Cart quantity exceeds stock.</p>";
            echo "<a href='index.php'>Go back</a>";
            die;
        }
        
    }else{
        echo "Loading";
        $cart->add($product['pr_id'], $_SESSION['customer_id'], $qty);
        echo "<script>window.location.replace('cart.php')</script>";
        die;
    }
else:
    header("location:index.php");
endif;

?>