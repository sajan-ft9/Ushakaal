<?php 

if(!isset($_GET['id'])){
    header("location:index.php");
}
$title = "Category";
require_once "layout/header.php"; 
require_once "../includes/init.php";

$category = new Category();
$result = $category->selectedCategory($_GET['id']);
if(empty($result)){
?>
    <div class="d-flex flex-row">
    <div class="p-2">
        <h1 class="mt-4"><?=$category->selected($_GET['id'])["ct_name"]?></h1>
        <h4><?=$category->selected($_GET['id'])["ct_desc"]?></h4>
    </div>
    </div>
<?php
}
?>
<div class="d-flex flex-row">
  <div class="p-2">
    <h1 class="mt-4"><?=$result[0]["ct_name"]?></h1>
    <h4><?=$result[0]["ct_desc"]?></h4>
  </div>
</div>
<div class="d-flex flex-row-reverse">
  <div class="p-2">
<a href="allcat.php" class="btn btn-info d-flex justify-content-end">Go Back</a>

  </div>
  
</div>
    <div class="mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
            if($result):
                foreach ($result as $category):?>
                    <div class="col">
                        <div class="card">
                        <img class="card-img-top" src="uploads/<?=$category['pr_img']?>" alt="Product Image" height="300px">
                            <div class="card-body" height="200px">
                                <h5 class="card-title"><?=$category['pr_name']?></h5>
                                <p class="card-text"><?=$category['pr_desc']?></p>
                            </div>
                            <div class="card-footer">
                                <small class="card-link">Category: <a href="category.php?id=<?=$category['ct_id']?>"><?=$category['ct_name']?></a></small>
                                <small class="card-link">Rs. <?=$category['pr_price']?></small>
                            </div>
                        </div>
                    </div>   
          
    <?php 
                endforeach;
            else:
                echo "
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong>No Products available for this category!</strong> 
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          <a href='allcat.php' class='btn btn-info'>Go Back</a>
          </div>";
            endif;
        ?>
              </div>
    </div>
<?php require_once "layout/footer.php"; ?>