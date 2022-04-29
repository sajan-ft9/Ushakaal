<?php 
$title= "Dashbaord";
require_once "layout/header.php"; 
$products = new Product();
?>
<h1 class="mt-4">Products</h1>

<form class="text-center" action="" method="post">
    <input type="text" name="searchitem" placeholder="Search" required>
    <button type="submit" name="search">Search</button>
</form>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['search'])){
        $item = clean($_POST['searchitem']);
?>
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
    <?php 
        $products = new Product();
        if($products->searchAdminItem($item, $customer) > 0): 
    ?>
        <?php foreach($products->searchAdminItem($item, $customer) as $product): ?>
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
<?php
    }

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




<?php require_once "layout/footer.php" ?>