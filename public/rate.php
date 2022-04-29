<?php
require_once "../includes/init.php"; 
if(isset($_POST['feedback'])):
    $comment = clean($_POST['comment']);
    $customer = clean($_POST['customer']);
    $productid = clean($_POST['product']);
    $ratepoint = clean($_POST['ratepoint']);

    $products = new Product();
    if($products->notRated($customer, $productid)):
        $products->addComment($customer, $ratepoint, $comment, $productid);
        header("location:view.php?id=$productid");
        die;
    else:
        $products->updateComment($ratepoint, $comment, $customer, $productid);
        header("location:view.php?id=".$productid);
        die;
    endif;
else:
    echo "<script>window.location.replace('index.php')</script>";
    die;
endif;
?>