<?php 
$banda = true;
session_start();
if(isset($_POST['submit-search'])):
    require_once "layout/header.php";
    $PRODUCT = new Product;
    $item = clean($_POST['search']);
?>
<link rel="stylesheet" href="layout/css/productlist.css">
</div>
<div class="container">
        <div class="row g-1 mt-4 mb-5">
<?php
        if($PRODUCT->searchItem($item) > 0):
                foreach($PRODUCT->searchItem($item) as $product):
            ?>
                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">    
                    <div class="card p-2 ml-5 border">
                        <div class="p-info px-3 py-3">
                            <div>
                                <h5 class="mb-0"><?=$product['pr_name']?></h5> <span><?=$product['ct_name']?></span>
                            </div>
                            <div class="p-price d-flex flex-row"> <span>Rs</span>
                                <h3><?=$product['pr_price']?></h3>
                            </div>
                            <form action="wish.php" method="post">
                                <input type="hidden" name="product" value="<?=$product['pr_id']?>">
                                <div class="heart">
                                <button type="submit" name="wish">
                                    <i class="fas fa-heart"></i> 
                                </button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center p-image"> <img src="../admin/uploads/<?=$product['pr_img']?>"> </div>
                        <div class="p-about">
                            <p><?=$product['pr_desc']?></p>
                        </div>
                        <div class="buttons d-flex flex-row gap-3 px-3"> <a href="view.php?id=<?=$product['pr_id']?>" class="text-white"><button class="btn btn-danger w-100">View</button></a> 
                            <form action="buynow.php" method="post">
                                <input type="hidden" name="product" value="<?=$product['pr_id']?>" required>
                                <button type="submit" name="buynow" class="btn btn-outline-danger w-100"><i class="fas fa-shopping-cart"></i></button> 
                            </form> 
                        </div>
                    </div>
                </div>
            <?php    
                endforeach;
            else:
                echo "
                    <div class='alert alert-info alert-dismissible fade show' role='alert'>
                        <strong>Alert!</strong> No product available. 
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            endif;
            ?>
        </div>
        </div>
        
<?php
else:
    header("Location:index.php");
    die;
endif;
?>



<?php require_once "layout/footer.php" ?>
