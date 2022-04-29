<?php 
session_start();
    if(!isset($_GET['id'])){
        header("location:index.php");
        die;
    }
    require_once "layout/header.php";
    require_once "../includes/init.php";
    $id = $_GET['id'];
    $products = new Product();
?>
  <link rel="stylesheet" href="layout/css/single.css">
  <div class="container">  
    <div class="row d-flex justify-content-center mt-4">
        <?php
        $product = $products->selected($id);  
            if(count($product) > 1):
        ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-6">
                    <a href="../admin/uploads/<?=$product['pr_img']?>">
                    <img src="../admin/uploads/<?=$product['pr_img']?>" class="img-fluid rounded-start" alt="...">

                    </a>
                </div>
                <div class="col-md-6">
                <div class="card-body">
                    <h4 class="card-title"><?=$product['pr_name']?></h4>
                    <p class="card-text"><small class="text-muted"><?=$product['ct_name']?></small></p>
                    <strong>Brand:</strong><?=$product['pr_brand']?>

                    <p class="card-text"><?=$product['pr_desc']?></p>
                    <h5>Rs.<?=$product['pr_price']?></h5>

                    
                    <span class="card-text text-muted"> Rating: <?php echo $products->getStar($product['pr_id'])['rating'] > 0 ? $products->getStar($product['pr_id'])['rating']."/5" : "No reviews yet!" ?></span>                    
                    <ul class="rating-stars">
                        <li style="width:<?=$products->getStar($product['pr_id'])['percent']?>%" class="stars-active">
                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </li>
                        <li>
                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </li>                    
                    </ul>  
                    <p class="text">Qty: <?=$product['pr_qty']?></p>
                    <form class="mt-3" action="" method="post">
                        <?php 
                        if($_SERVER['REQUEST_METHOD']=="POST"){
                            if(isset($_SESSION['customer'])){
                                if(isset($_POST['tocart'])){
                                    if(is_numeric($_POST['quantity']) && ($_POST['quantity'] > 0)){
                                        $qty = clean($_POST['quantity']);
                                        if($qty <= $product['pr_qty']){
                                            $cart = new Cart();
                                            $select = $cart->selected($product['pr_id'], $_SESSION['customer_id']);
                                            if($select > 0){
                                                if(($select['qty'] + $qty) <= $product['pr_qty']){
                                                    $cart->update($select['qty']+ $qty, $product['pr_id'], $_SESSION['customer_id']);
                                                    echo "<script>window.location.replace('cart.php')</script>";
                                                    die;
                                                }else{
                                                    echo  "<p style='color:red'>Cart quantity exceeds stock.</p>";
                                                }
                                                
                                            }else{
                                                echo "none";
                                                $cart->add($product['pr_id'], $_SESSION['customer_id'], $qty);
                                                echo "<script>window.location.replace('cart.php')</script>";
                                                die;
                                            }    
                                        }else{
                                            echo  "<p style='color:red'>Selected quantity is more than stock.</p>";
                                        }
                                        
                                    }
                                    else{
                                        echo  "<p style='color:red'>Enter valid quantity</p>";
                                    }     
                                }
                            }else{
                                echo  "<a style='color:red' href='login.php'><p>Login to add</p></a>";
                            }        
                        }
                        ?>
                        <div class="btn btn-info" onclick="add()"><i class="fa fa-plus"></i></div> 
                        <input style="width: 80px; background-color:white; padding-left:5px; border-radius:10px;" type="tel" name="quantity" id="qty" placeholder="Qty" value="1" required>
                        <div class="btn btn-dark" onclick="sub()"><i class="fa fa-minus"></i></div> 
                        <button class="mt-2 btn btn-outline-success" type="submit" name="tocart"><h5>Add to Cart</h5></button>
                    </form>
                    
                    <form action="wish.php" method="post">
                                <input type="hidden" name="product" value="<?=$product['pr_id']?>">
                                
                                <button class="heart btn btn-outline-light" type="submit" name="wish">
                                    <i class="fas fa-heart"></i> 
                                </button>
                                
                            </form>
                </div>
                </div>
            </div>
        </div>
        <?php                 
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
  <div class="container feedback text-center border mb-4 p-2 text-light">
      <h2>Feedback & Rating</h2>
      <?php 
        if(cLogged()):
            ?>
                <div class="inner p-4">
                    
                    <form action="rate.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="customer" value="<?php echo $_SESSION['customer_id']?>">
                            <input type="hidden" name="product" value="<?=$product['pr_id']?>">
                        <label for="">Rate Product</label><br>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="ratepoint" value="5" required /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4half" name="ratepoint" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                            <input type="radio" id="star4" name="ratepoint" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                            <input type="radio" id="star3half" name="ratepoint" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                            <input type="radio" id="star3" name="ratepoint" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half" name="ratepoint" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                            <input type="radio" id="star2" name="ratepoint" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                            <input type="radio" id="star1half" name="ratepoint" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                            <input type="radio" id="star1" name="ratepoint" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                            <input type="radio" id="starhalf" name="ratepoint" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                        </fieldset>
                        </div>
                        <div class="form-group">
                            <textarea name="comment" id="" class="form-control" cols="40" placeholder="Feedback" required></textarea>
                        </div>
                        <button type="submit" class="mt-2 btn btn-info" name="feedback">Send Feedback</button>    
                    </form>
                </div>
            <?php
      else:
        echo "
        <div class='alert alert-info alert-dismissible fade show' role='alert'>
            <strong>Info:</strong> Login to provide feedback & rating.<a class='alert-link' href='login.php'>Login</a>. 
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
      endif; ?>

      <div class="oldfeed text-start">
          <ol>
              <?php 
                if($products->getComments($id) > 0):
                    foreach($products->getComments($id) as $comment):
              ?>
                        <li>
                            <b><?=$comment['name']?> <span style="color: #f3aa06;" title="rating given">
                                <?php
                                echo "(";
                                ?>
                        <ul class="rating-stars">
                            <li style="width:<?=($comment['rate_points']/5)*100?>%" class="stars-active">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>                    
                        </ul>
                            <?php
                                echo ")";
                            ?>
                            </span></b>
                            <p><?=$comment['feedback']?>  
                                <?php 
                                    if(isset($_SESSION['customer'])){
                                        if($_SESSION['customer'] === $comment['email']):
                                            ?>
                                            <form action="delcomment.php" method="post">
                                                    <input type="hidden" name="customerId" value="<?php echo $_SESSION['customer_id']?>">
                                                    <input type="hidden" name="product" value="<?php echo $product['pr_id']?>">
                                                    <button class="text-center btn" type="submit" name="delComment"><i class="fas fa-trash" style="color:red;"></i></button>
                                            </form>  
                                            <?php
                                        endif;
                                    }
                                     
                                ?>
                        </p>
                        <?php if(!empty($comment['feedback_reply'])){ ?>
                        <p class="text-muted"><i class="fas fa-retweet"></i>:<?=$comment['feedback_reply'];?>- By Admin</p>
                            <?php } ?>
                        </li>
              <?php
                    endforeach;
                else: echo "<p style='color:red'>No comments yet</p>";
                endif;
              ?>
          </ol>
      </div>
  </div>
  </div>

<!-- Related -->
<div>
    <h2>Related Products</h2>
<div class="card-group" style="margin:10px">
    <?php 
     $related_pr1 = $products->relatedProduct($product['cat_id'],$product['pr_brand'], $id);
     $related_pr2 = $products->relatedProduct2($product['cat_id'],$product['pr_brand'], $id);
     $prd3=$products->salesRelated($id);

     if(($related_pr1 && $related_pr2) > 0):   
        if($related_pr1 > 0):
            foreach($related_pr1 as $prod):
    ?>
  <div class="col-lg-3">
        <a href="view.php?id=<?=$prod['pr_id']?>">
            <div style="height:200px; width:200px;"><img width="200px" height="200px" src="../admin/uploads/<?=$prod['pr_img']?>" class="card-img-top" alt="..."></div>
        </a>
            <div class="card-body">
            <h5 class="card-title"><?=$prod['pr_name']?></h5>
            <p class="card-text"><strong>Rs.</strong><?=$prod['pr_price']?></p>
            </div>
        
  </div>
    <?php
        endforeach;
    endif;
    if($related_pr2):
        foreach($related_pr2 as $prod):
?>
        <div class="col-lg-3">
                <a href="view.php?id=<?=$prod['pr_id']?>">
                    <div style="height:200px; width:200px;"><img width="200px" height="200px" src="../admin/uploads/<?=$prod['pr_img']?>" class="card-img-top" alt="..."></div>
                    <div class="card-body">
                </a>
                    <h5 class="card-title"><?=$prod['pr_name']?></h5>
                    <p class="card-text"><strong>Rs.</strong><?=$prod['pr_price']?></p>
                    </div>
                
        </div>
<?php
    endforeach;
endif;
elseif($prd3 > 0):
    foreach($prd3 as $prod):
?>
<div class="col-lg-3">
    <a href="view.php?id=<?=$prod['pr_id']?>">
        <div style="height:200px; width:200px;"><img width="200px" height="200px" src="../admin/uploads/<?=$prod['pr_img']?>" class="card-img-top" alt="..."></div>
        <div class="card-body">
    </a>
        <h5 class="card-title"><?=$prod['pr_name']?></h5>
        <p class="card-text"><strong>Rs.</strong><?=$prod['pr_price']?></p>
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
<!-- related close -->
  
<?php

    require_once "layout/footer.php"; 
?>
<script>
    function add() {
        qty = document.getElementById('qty').value;
        document.getElementById('qty').value =  parseInt(qty) + 1;
        
    }
    function sub() {
        qty = document.getElementById('qty').value;
        value = document.getElementById('qty').value =  parseInt(qty) - 1;
        if(value <= 0){
            document.getElementById('qty').value = 1;
        }
        
    }
</script>
