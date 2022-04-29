<?php 

session_start();
require_once "layout/header.php";

if(!isset($_SESSION['customer'])){
    echo "
    <div class='alert alert-info' role='alert'>
        Please login to access wishlist! <a href='login.php' class='alert-link'>Login</a>
    </div>
";
echo "</div>";
require_once "layout/footer.php";

    die;
}

$WISH = new Wish();

if(isset($_POST['wish'])){
    $product_id = clean($_POST['product']);
    if(!$WISH->present($product_id, $_SESSION['customer_id'])){
        $WISH->add($product_id, $_SESSION['customer_id']);
        // echo "<script>window.location.replace('index.php')</script>";
        // die;
    }else{
        echo "<script>window.location.replace('index.php')</script>";
        die;
    }
    
}

if($WISH->getAll($_SESSION['customer_id']) > 0):
    foreach($WISH->getAll($_SESSION['customer_id']) as $list):
    ?>
<!-- <link rel="stylesheet" href="layout/css/wish.css"> -->
    <div class="container">

        <div class="row dd-flex justify-content-center mt-4">
            <div class="col-md-8 mb-4">
                <div class="card px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-row align-items-center"><span class="fw-bold ms-1 fs-5"><?=$list['pr_brand']?></span> </div>
                            <h1 class="fs-1 ms-1 mt-3"><a style="text-decoration: none;" href="view.php?id=<?=$list['pr_id']?>"><?=$list['pr_name']?></a></h1>
                            <div class="ms-1"> <span><?=$list['pr_desc']?></span> </div>
                            <h3 class="mt-5">Rs.<?=$list['pr_price']?></h3>
                            <form action="buynow.php" method="post">
                                <input type="hidden" name="product" value="<?=$list['pr_id']?>" required>
                                <button type="submit" name="buynow" class="button"><span>Order Now</span> <i class="ms-2 fa fa-long-arrow-right"></i> </button> 
                            </form>
                            <div class="delwish">
                                <form action="delcomment.php" method="post">
                                    <input type="hidden" name="productid" value="<?=$list['pr_id']?>" required>
                                    <input type="hidden" name="customerid" value="<?php echo $_SESSION['customer_id']; ?>" required>
                                    <button class="btn" type="submit" name="delwish" onclick="return(confirm('Do you wish to Delete?'))"><i style="color:red; font-size:1.5rem" class="fas fa-trash"></i></button>
                                </form>
                            </div>
                            <form action=""></form>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="product-image"> <img src="../admin/uploads/<?=$list['pr_img']?>" height="250px" width ="250px"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
endforeach;
else:
    echo "
    <div class='alert alert-primary' role='alert'>
        Wishlist is empty!
    </div>
";
endif;
?>
</div>
<?php require_once "layout/footer.php"; ?>