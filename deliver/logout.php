<?php 
require_once "../helpers/functions.php";
session_start();
if(isset($_SESSION['deliver'])) {
    unset($_SESSION['deliver']);
    unset($_SESSION['deliverid']);
    header("location:../index.php");
    die;
}