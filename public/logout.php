<?php 
require_once "../helpers/functions.php";
// session_start();
customerLogin();
if(isset($_SESSION['customer'])){
    unset($_SESSION['customer']); 
    unset($_SESSION['customer_id']);
    // session_destroy();
    header("location:index.php");
    die;
}