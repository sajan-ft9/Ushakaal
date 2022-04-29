<?php 
$title = "Edit";
require_once "layout/header.php"; 
require_once "../includes/init.php";

$products = new Product();
$product = $products->editProduct($_GET['id']);

  // Update Product
  if(isset($_POST['update'])) {
    $id = $_GET['id'];
    $err = "";
    $name = clean($_POST['p_name']);
    $desc = clean($_POST['p_desc']);
    $category = clean($_POST['category']);
    $price = clean($_POST['price']);
    // $qty = clean($_POST['qty']);
    $brand = clean($_POST['brand']);
    $filename = $_FILES["fileToUpload"] ["name"];
    $tempname = $_FILES["fileToUpload"] ["tmp_name"];
    $img_del = $_POST['del_img'];

    if(empty($name)){
      $err .= "Name required<br>";
    }else {
      if(!preg_match("/^[a-zA-Z0-9-' ]{3,25}$/", $name)) {
        $err .= "Name can only use(- and alphanumeric 3-25 characters)<br>";
      }
    }

    if(empty($desc)){
      $err .= "Description required<br>";
    }else{
      if(strlen($desc) >= 254 ) {
        $err .= "Too long description<br>";
      }
    }

    if(empty($category)) {
      $err .= "Category required<br>";
    }

    if(empty($price)) {
      $err .= "Price required<br>";
    }else{
      if($price < 0){
        $err .= "Price cannot be negative.<br>";
      }
      elseif($price > 100000000) {
        $err .= "Expensive. Try lowering price<br>";
      }
    }
    
    // if(empty($qty)) {
    //   $err .= "Quantity required<br>";
    // }else{
    //   if($qty < 0){
    //     $err .= "Quantity cannot be negative.<br>";
    //   }elseif($qty > 100000000) {
    //     $err .= "Too much quantity product<br>";
    //   }
    // }


    if(empty($brand)) {
      $err .= "Brand required<br>";
    }

    if(!empty($filename)) {
      $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); //gives extension
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $err .= "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
      }
    }

    if(!empty($err)){ 
      echo "<p style='color:red;'>Error: $err</p>";
    }

    if(empty($err)){
      if(!empty($filename)){
        $newFileName = uniqid('', true) . "." . $imageFileType;
        $fileDestination = "uploads/".$newFileName;
        
        // $stock = $product['stock']+ $qty;
        
        $products->updateProduct($name, $desc, $newFileName, $price, $category, $brand, $id);
        
        move_uploaded_file($tempname, $fileDestination);
  
        unlink("uploads/$img_del");
    
        echo "<script>window.location.replace('products.php')</script>";
        die;
      }else{
        // $stock = $product['stock']+ $qty;

        $products->updateProduct($name, $desc, $img_del, $price, $category, $brand, $id);
        echo "<script>window.location.replace('products.php')</script>";
        die;

      }
    }
  
  }
  // End update Product
?>
<h1 class="mt-4">Edit Product</h1>

        <!-- Product Update form -->
<div class="row">
    <div class="col-md-7 mx-auto">
    <form action="editForm.php?id=<?=$_GET['id']?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="del_img" value="<?=$product['pr_img']?>">
                <label for="">Product Name</label>
                <input class="form-control" type="text" name="p_name" value="<?=$product['pr_name']?>" required>
                <label for="">Description</label>
                <textarea class="form-control" type="text" name="p_desc" required><?=$product['pr_desc']?></textarea>
                <label for="">Price</label>
                <input class="form-control" type="number" name="price" value="<?=$product['pr_price']?>" required>
                <!-- <label for="">Quantity</label>
                <input class="form-control" type="number" name="qty" value="<?=$product['pr_qty']?>" required> -->
                <label for="">Brand</label>
                <input class="form-control" type="text" name="brand" value="<?=$product['pr_brand']?>" required>
                <label for="">Category</label>
                <select title="Previous is red in color" class="form-control" name="category" id="" required>
                    <option style="color:red;" value="<?=$product['cat_id']?>" selected><?=$product['ct_name']?></option>
                    <?php
                        $categories = new Category();
                        if($categories->getAll()):
                            foreach($categories->getAll() as $category):
                        ?>
                        <option value="<?=$category['ct_id']?>"><?=$category['ct_name']?></option>
                        <?php
                            endforeach;
                        endif;
                    ?>
                </select>
                Old Image: <br><input type="image" name="previmg" src="uploads/<?=$product['pr_img']?>" alt="img" height="100px">
                <br><label for="">Change Product Image</label>
                <input class="form-control" type="file" name="fileToUpload">
                <div class="modal-footer">
                <a href="index.php" type="button" class="btn btn-secondary">Close</a>
                <button type="submit" name='update' class="btn btn-primary">Update Product</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Product Update form -->
<?php require_once "layout/footer.php" ?>
