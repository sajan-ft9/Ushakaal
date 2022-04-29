<?php 
require_once "../helpers/functions.php";
session_start();
checkLogin();
if(isset($_SESSION['logged']) && $_SESSION['email']) {
    unset($_SESSION['logged']); 
    unset($_SESSION['email']); 
    // session_destroy();
    header("location:../index.php");
    die;
}