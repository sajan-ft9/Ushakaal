<?php
session_start();

if(isset($_SESSION['order_placed'])){
  unset($_SESSION['order_placed']);
}


require_once "layout/header.php";
$products = new Product();
$product = $products->getProduct();

?>
<div class="container">
<section id="home">
   <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="carousel/crochet.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Beautiful Crochet</h5>
        <a href="cart.php"><button class="main-btn ms-lg-4 mt-lg-0 mt-4">Shop now</button></a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="carousel/handbag.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Handbag</h5>
        <a href="cart.php"><button class="main-btn ms-lg-4 mt-lg-0 mt-4">Shop now</button></a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="carousel/sweater.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Sweater</h5>
        <a href="cart.php"><button class="main-btn ms-lg-4 mt-lg-0 mt-4">Shop now</button></a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</section>
<section id="products">
    <div class="products-section wrapper">
      <div class="text-center mb-4 text-danger"><h2>New Arrivals</h2></div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
                if(is_array($product)):
                    foreach ($product as $prod):
            ?>
            <div class="col">
            <a href="view.php?id=<?=$prod['pr_id']?>">    
            <div class="card h-100">
                    <img src="../admin/uploads/<?=$prod['pr_img']?>" class="card-img-top" alt="..." style="width: 100%; height: 300px;">
                <div class="card-body">
                    <h3 class="card-title"><?=$prod['pr_name']?></h3>
                    <h5 class="card-title"><?=$prod['pr_price']?></h5>
                    </a>
                    <form action="buynow.php" method="POST">
                        <input type="hidden" name="product" value="<?=$prod['pr_id']?>">
                        <button class="main-btn mt-4" name="buynow" type="submit">Add To Cart</button></a>
                    </form>
                </div>
                </div>
            </div>
            
<?php
endforeach;
else:
    echo "No data";
endif;
            ?>
    </div>
    </div>
</div>


<?php require_once "layout/footer.php" ?>