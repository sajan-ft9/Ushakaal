<?php
session_start();
require_once "layout/header.php";
?>

<link href="layout/css/usakal.css" rel="stylesheet">



<div class="blog-container mt-5 mb-5">
<?php
  $blog=new Blog();
  $blogs=$blog->getid($_SESSION['customer_id']);
  if(is_array($blogs)){
  foreach ($blogs as $row){
    ?>
  
  <div>
  <h3 class="aligntitle">
      <?=$row['title']?>
    </h3>
  <!-- <div style="text-align:right"> -->
     <p class="alignright">
     <div class="editAndDelete">
         <ul class="eandd">
     <li>
<form action="blog_edit.php" method="POST">
<input type="hidden" name="blogid1" value="<?=$row['blog_id']?>">
  <button type="submit" class="btn btn-info" name="editBlog"> Edit </button>
</form>
</li>
<li>
<form action="blog_delete.php" method="POST">
    <input type="hidden" name="blogid" value="<?=$row['blog_id']?>">
  <button type="submit" name="deleteBlog" class="btn btn-danger" onClick="return confirm('Are you sure you want to Delete this?')"> Delete </button>
</form>
</li>
</ul>

</div>
  </p>
<!-- </div> -->
</p>
<br>
<br>
<br>
<br>
<br>
<div>
  <img src="../picUpload/<?=$row['photo']?>" width="350px" height="300px" class="center"> 
  <p><?=$row['description']?></p>
  </div>
  <hr> 
  <br>
  </div>
  <?php
  }}
  else{
      echo "Add a blog to view. <a class='btn btn-primary' href='blog_add.php'>Add Blog</a>";
  }
  ?>
  <!-- <a href="#">Load more..</a> -->
</div>
















<?php require_once "layout/footer.php" ?>