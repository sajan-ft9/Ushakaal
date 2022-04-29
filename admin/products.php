<?php 
$title= "Dashbaord";
require_once "layout/header.php"; 
$products = new Product();

if($_SERVER['REQUEST_METHOD'] == "POST"){

  // Product Post
  if(isset($_POST['submit'])) {
    $err = "";
    $name = clean($_POST['p_name']);
    $desc = clean($_POST['p_desc']);
    $category = clean($_POST['category']);
    $price = clean($_POST['price']);
    $qty = clean($_POST['qty']);
    $brand = clean($_POST['brand']);
    $filename = $_FILES["fileToUpload"] ["name"];
    $tempname = $_FILES["fileToUpload"] ["tmp_name"];


    if(empty($name)){
      $err .= "Name required<br>";
    }else {
      if(!preg_match("/^[a-zA-Z0-9-' ]{3,254}$/", $name)) {
        $err .= "Name can only use(- and alphanumeric 3-254 characters)<br>";
      }
    }

    if(empty($desc)){
      $err .= "Description required<br>";
    }else{
      if(strlen($desc) >= 254) {
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
    
    if(empty($qty)) {
      $err .= "Quantity required<br>";
    }else{
      if($qty < 0){
        $err .= "Quantity cannot be negative.<br>";
      }elseif($qty > 100000000) {
        $err .= "Too much quantity product<br>";
      }
    }


    if(empty($brand)) {
      $err .= "Brand required<br>";
    }

    if(empty($filename)) {
      $err .= "Image required<br>";
    }else {
      $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); //gives extension
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $err .= "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
      }
    }

    if(empty($err)){
      $newFileName = uniqid('', true) . "." . $imageFileType;
      $fileDestination = "uploads/".$newFileName;
  
      $seller_id = $customer;
      $products->addProduct($name, $desc, $newFileName, $price, $qty, $category, $brand, $seller_id);
      
      move_uploaded_file($tempname, $fileDestination);
    }
    else{ 
      echo "<p style='color:red;'>Error: $err</p>";
    }
  }
  // End Product Post

  // Add Quantity
  if(isset($_POST['addqty'])){
    $err = "";
    $quantity = clean($_POST['quantity']);
    $id = clean($_POST['pid']);
    $db_qty = $products->selected($id)['pr_qty']+ $quantity;
    $db_stock = $products->selected($id)['stock'] + $quantity;
    $products->addQuantity($db_qty, $db_stock, $id);
  }
  // End Add Quantity
}



?>

<h1 class="mt-4">Products</h1>

<!-- Button trigger modal -->
<div class="text-center">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
  Add New Product
</button>
<a href="search.php" class="btn btn-info">Search</a>
</div>


<!-- Products Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="productsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Product Name</label>
                <input class="form-control" type="text" name="p_name" required>
                <label for="">Description</label>
                <textarea class="form-control" type="text" name="p_desc" required></textarea>
                <label for="">Price</label>
                <input class="form-control" type="number" name="price" required>
                <label for="">Quantity</label>
                <input class="form-control" type="number" name="qty" required>
                <label for="">Brand</label>
                <input class="form-control" type="text" name="brand" required>
                <label for="">Category</label>
                <select class="form-control" name="category" id="" required>
                    <option value="">Select Category</option>
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
                <label for="">Add Product Image</label>
                <input class="form-control" type="file" name="fileToUpload">
            </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name='submit' class="btn btn-primary">Add Product</button>
                </div>
        </form>
    </div>
  </div>
</div>
<!-- End product Modal -->


<div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
    <?php 
        $products = new Product();
        if($products->getAdminProduct($_SESSION['customer_id']) > 0): 
    ?>
        <?php foreach($products->getAdminProduct($_SESSION['customer_id']) as $product): ?>
            <div class="col">
                <div class="card">
                    <img src="uploads/<?=$product['pr_img']?>" class="card-img-top img-fluid" alt="image">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['pr_name']?></h5>
                        <p class="card-text"><?=$product['pr_desc']?></p>
                        <p class="text-end">Quantity: <?=$product['pr_qty']?></p>
                        <p class="text-end">Brand: <?=$product['pr_brand']?></p>
                        <small class="card-link">Category: <a href="category.php?id=<?=$product['ct_id']?>"><?=$product['ct_name']?></a></small>
                      </div>
                    <div class="card-footer">
                        <small class="card-link">Rs. <?=$product['pr_price']?></small>
                        <small><a href="editForm.php?id=<?=$product['pr_id']?>" class="btn btn-warning btn-sm active">Edit</a></small>                     
                        <small><a href="delete.process.php?send=del&id=<?=$product['pr_id']?>&name=<?=$product['pr_img']?>" class="btn btn-danger btn-sm active" onClick="return confirm('Do you want to delete??')">Delete</a></small>
                        <form action="" method="post">
                          <input type="hidden" name="pid" value="<?=$product['pr_id']?>" required>
                          <input style="width:80px" type="number" name="quantity" placeholder="add qty" required>
                          <button type="submit" name="addqty" class="btn btn-primary btn-sm">Add Quantity</button>
                        </form> 
                    </div>
                </div>
            </div>   
        <?php endforeach; ?>
    <?php 
      else:
        echo "
              <div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>Alert!</strong> No Products to show.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
            ";
      endif;
    ?>
</div>

<?php require_once "layout/footer.php" ?>