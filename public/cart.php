<?php 

session_start();
require_once "layout/header.php";

if(!isset($_SESSION['customer'])){
    echo "
    <div class='alert alert-info' role='alert'>
        Please login to access cart! <a href='login.php' class='alert-link'>Login</a>
    </div>
";
echo "</div>";
require_once "layout/footer.php";

die();
}

if(isset($_SESSION['customer'])){

    $cart = new Cart();
    $products = new Product();
 
    // print_r($cart->getAll($_SESSION['customer_id']));
    if($cart->getAll($_SESSION['customer_id']) > 0):
        $total = 0;
?>
<div class="container mt-5 mb-5">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th colspan="2">Product</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <p style="color: red;" id="show"></p>

            <?php 

                    foreach ($cart->getAll($_SESSION['customer_id']) as $items) {
                            $total = $total + $items['pr_price']*$items['qty'];
                        ?>
                            <tr>
                                <input type="hidden" id="product<?=$items['pr_id']?>" value="<?=$items['pr_id']?>">
                                <td><a style="text-decoration: none; color:white" href="view.php?id=<?=$items['pr_id']?>"><?=$items['pr_name']?></a></td>
                                <td><img src="../admin/uploads/<?=$items['pr_img']?>" alt="" srcset="" height="70px" width="70px"></td>
                                <td><input type="text" id="qty<?=$items['pr_id']?>" value="<?=$items['qty']?>"></td>
                                <td><?=$items['pr_price']?></td>
                                <td id="amt"><?=$items['pr_price']*$items['qty']?></td>
                                <td id="del<?=$items['pr_id']?>"><i class="fas fa-trash" style="color:red"></i></td>
                            </tr>
                        <?php
                    }

            ?>
        </tbody>
        <?php 
               if(isset($total)){
        ?>
        <tfoot>
            <td><a href="index.php" class="btn btn btn-warning">Continue Shopping</a></td>
            <td colspan="3" style="text-align:center"><b>Total</b></td>
            <td colspan="">
                <?php
             
                        echo $total;
                    
            ?>
            </td>
            <td><a href="checkout.php" class="btn btn-outline-info"> Checkout</a></td>
            <?php } ?>
        </tfoot>
        <?php
            else:
                echo "
                    <div class='alert alert-info' role='alert'>
                    No items present in cart! <a class='btn' href='index.php'>Add Items</a>
                    </div>
                ";
            endif; 
        ?>
    </table>
        
    <?php
    
}
?>
</div>
</div>

<?php 
                if($cart->getAll($_SESSION['customer_id']) > 0):

    foreach ($cart->getAll($_SESSION['customer_id']) as $items) {
 
?>
<script>
    $(document).ready(function(){
        $("#del<?=$items['pr_id']?>").click(function(){
            var prod = $("#product<?=$items['pr_id']?>").val();
            var path = true;
            if(path == true){
                $.post("upcartqty.ajax.php",{
                product_id: prod,
                path: path
            },function(data, status) {
                // $(".show").html(data);
                window.location.reload()
            }
            );
            }
            
        })
    })

    $(document).ready(function(){
        $("#qty<?=$items['pr_id']?>").keyup(function(){
            var quantity = $("#qty<?=$items['pr_id']?>").val();
            var prod = $("#product<?=$items['pr_id']?>").val();
            if(quantity > 0){
                if(quantity > <?=$products->selected($items['pr_id'])['pr_qty']?>){
                $("#show").html("Quantity exceeds stock");
                return false;
            }else{
                $.post("upcartqty.ajax.php",{
                qty: quantity,
                product_id: prod
            },function(data, status) {
                // $(".show").html("hifdf");
                window.location.reload()
            }
            );
            }
            
            }
            
        })
    })

</script>
<?php 
}
endif;
require_once "layout/footer.php";
?>

