<?php
require_once "layout/header.php";

if(isset($_POST['deleteBlog']))
{
    $id=$_POST['blogid'];
    $blog=new Blog();
  $blogs=$blog->get_blogid($id);
  // unlink("uploads/$img_del");

  echo "<script>window.location.replace('myblog.php')</script>";
      die;
}

?>