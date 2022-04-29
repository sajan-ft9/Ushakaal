<?php
if(isset($_GET['fu'])){
require_once "../helpers/functions.php";
customerLogin();
 echo "failed. <a class='btn' href='cart.php'>Cart page</a>" ;
}else{
    header("location:index.php");
    die;
}
?>