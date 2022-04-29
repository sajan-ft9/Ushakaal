<?php
session_start();
include 'layout/header.php';
$blog = new Blog();
$blogs = $blog->getall();
?>
<!-- <link href="layout/css/usakal.css" rel="stylesheet"> -->
<style>

.uploadRecipes
{
  margin-right: 10.5%;
}
.uploadRecipes 
{
  display: inline;
  float: right;
  padding-left: 1%;
}

.uploadRecipes button[type="button"]
{
  background-color: var(--primary-color);
  color: white;
  padding: 12px 42px;
  margin: 18px 1px;
  border: none;
  border-radius: 0px;
  cursor: pointer;
  width: 100%;
}

.uploadRecipes button[type="button"]:hover
{
  background-color: transparent;
  color: var(--secondary-color);
  border: 4px solid;
  border-color: var(--primary-color);
  -webkit-transition: all .4s ease-out 0s;
  -o-transition: all .4s ease-out 0s;
  -moz-transition: all .4s ease-out 0s;
  transition: all .4s ease-out 0s;
}

.uploadRecipes a:link
{
   color: white;
}

.blog-container{
  margin-left: 200px;
  text-align: center;
  border-radius: 25px;
  background-color: white;
  width: 70%
}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}

</style>

<div class="uploadRecipes">
<form action="blog_add.php" method="POST">
  <a href="blog_add.php"><button type="button" name="addBlog"> Upload Blogs </button></a>
</form>
</div>
<br>
<br>
<br>
<br>
<br>
<div class="blog-container" style="margin-bottom:50px;">
  <?php

  foreach ($blogs as $row){
    ?>
  <div>
  <h3><?=$row['title']?></h3>
  <img src="../picUpload/<?=$row['photo']?>" width="350px" height="300px" class="center"> 
  <p><?=$row['description']?></p>
<hr>  
</div>
  <?php  
  }
  ?>

</div>
<?php require_once "layout/footer.php" ?>