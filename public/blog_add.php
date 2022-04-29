<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<link href="layout/css/usakal.css" rel="stylesheet">
<?php
session_start();
require_once "../helpers/functions.php";
customerLogin();
require_once "layout/header.php";


echo "<br><br>";


// File upload path


if(isset($_POST['upload'])){
    $cust_id=$_SESSION['customer_id'];
    $name=$_POST['title'];
    $description=$_POST['description'];
    $filename = $_FILES["fileToUpload"] ["name"];
    $tempname = $_FILES["fileToUpload"] ["tmp_name"];

    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); //gives extension
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      $err .= "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
    }
    if(empty($err)){
        $newFileName = uniqid('', true) . "." . $imageFileType;
        $fileDestination = "../picUpload/".$newFileName;
    
        $blog = new Blog();
        $blog->addBlog($cust_id, $name, $description, $newFileName);
      move_uploaded_file($tempname, $fileDestination);
      echo "<script>window.location.replace('myblog.php')</script>";
      die;

    }else{
        echo $err;
    }



}
?>
<center>
  <div class="container mb-5 mt5" style="width:300px">
	<div class="recipes" style="margin-top: -2%;">
<form action="" method="POST" enctype="multipart/form-data">
  <h2 style="color : #F789B5">Add Blog</h2>
	<ul>
        <li>
	<span class="topics">Blog Title:</span><br>  
		<input class="form-control" type="text" name="title" id="title" placeholder="Blog Title" required>
		
        </li>

       <li>
        <span class="topics">Description:</span> <br>
        <textarea class="form-control" name="description" id="description"  placeholder="Description of your blog" required></textarea>
         </li>


        <li>
        <span class="topics">Upload a photo for your blog</span><br>
        <input type="file" name="fileToUpload" class="fileupload form-control">
        </li> 


        <li>
        <button type="submit" name="upload" class="btn btn-outline-success mt-2">Upload</button>
        </li>
      
       </ul>
        
          
</form>
</div>
</div>

</center>
<?php require_once "layout/footer.php" ?>
