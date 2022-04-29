<?php 
require_once "../includes/init.php";
$category = new Category();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //edit
    if(isset($_POST['editcat']) && isset($_POST['ct_id'])){
        echo "edit";
    }
    //del
    if(isset($_POST['delcat']) && isset($_POST['ct_id'])){
        $id = clean($_POST['ct_id']);
        $category->delete($id);
        header("location:allcat.php");
    }

}

