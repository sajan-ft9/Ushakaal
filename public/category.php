<?php 
$banda = true;
session_start();
if(!isset($_GET['id'])){
    header("location:index.php");
}
$title = "Category";
require_once "layout/header.php"; 
// require_once "../includes/init.php";
$category = new Category();
$result = $category->selectedCategory($_GET['id']);
if(empty($result)){
    ?>
        <div class="p-2 text-center">
            <h2 class="mt-4"><?=$category->selected($_GET['id'])["ct_name"]?></h2>
            <p><?=$category->selected($_GET['id'])["ct_desc"]?></p>
        </div>
    <?php
    }
    ?>
<link rel="stylesheet" href="layout/css/productlist.css">

  <div class="p-2 text-center">
      <?php if(is_array($result)){ ?>
  <h2 class="mt-4"><?=$result[0]["ct_name"]?></h2>
  
  <p><?=$result[0]["ct_desc"]?></p>
  <?php
  }
  ?>
  </div>

 
</div>

    <div class="container mt-2 mb-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
            if($result):
                foreach ($result as $category):?>
                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">    
                    <div class="card p-2 ml-5 border">
                        <div class="p-info px-3 py-3">
                            <div>
                                <h5 class="mb-0"><?=$category['pr_name']?></h5> <span><?=$category['ct_name']?></span>
                         </div>
                            <div class="p-price d-flex flex-row"> <span>Rs</span>
                                <h3><?=$category['pr_price']?></h3>
                            </div>
                            <form action="wish.php" method="post">
                                <input type="hidden" name="product" value="<?=$category['pr_id']?>" required>
                                <div class="heart">
                                <button type="submit" name="wish">
                                    <i class="fas fa-heart"></i> 
                                </button>
                                </div>
                            </form>
                            <!-- <div class="heart"> <i class="fas fa-heart"></i> </div> -->
                        </div>
                        <div class="text-center p-image"> <img src="../admin/uploads/<?=$category['pr_img']?>"> </div>
                        <div class="p-about">
                            <p><?=$category['pr_desc']?></p>
                        </div>
                        <div class="buttons d-flex flex-row gap-3 px-3"> <a href="view.php?id=<?=$category['pr_id']?>" class="text-white"><button class="btn btn-danger w-100">View</button></a> 
                            <form action="buynow.php" method="post">
                                <input type="hidden" name="product" value="<?=$category['pr_id']?>" required>
                                <button type="submit" name="buynow" class="btn btn-outline-danger w-100"><i class="fas fa-shopping-cart"></i></button> 
                            </form> 
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
          </div>
          <a href='index.php' class='btn btn-info'>Go Back</a>";
            endif;
        ?>
              </div>
    </div>
        </div>
<?php require_once "layout/footer.php"; ?>

