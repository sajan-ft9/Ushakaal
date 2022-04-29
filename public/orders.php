<?php 
// session_start();
require_once "../includes/init.php";
customerLogin();
require_once "layout/header.php";
$customer_id = $_SESSION['customer_id'];
$orders = new Orders();
?>
<div class="container mt-4">
    <a href="ordersuccess.php" class="mb-2 btn btn-success">Click To View Success</a>
</div>
<?php
if($orders->getSelected($customer_id) > 0){
    $allorders = $orders->getSelected($customer_id);
?>
<div class="ordersss container mt-4 mb-4" style="max-height:500px; overflow-y:scroll;">
<table class="table table-primary table-hover table-striped">
    <thead style="text-align: center;">
        <tr>
            <th colspan="2">Product</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Delivery Status</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php foreach($allorders as $all){
            ?>
                <tr>
                    <td><?=$all['pr_name']?></td>
                    <td><img src="../admin/uploads/<?=$all['pr_img']?>" alt="productimg" width="100px" height="100px"></td>
                    <td><?=$all['quantity']?></td>
                    <td><?=$all['amount']?></td>
                    <td><?php 
                        if($all['order_delivered'] == false){
                            echo "<p style='color:red'>Pending</p>";
                        }else{
                            echo "<p style='color:green'>Delivered</p>";
                        }
                    
                    ?></td>
                    <td><?php 
                        if($all['payment_received'] == false){
                            echo "<i style='color:red'; class='fa fa-times'></i>";
                        }else{
                            echo "<i style='color:green' class = 'fas fa-check'></i>";
                        }
                    
                    ?></td>
                </tr>
        <?php
        } ?>
        
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <td colspan="3" style="padding-left: 30px;">
                <?php
                $total = 0;
                foreach($allorders as $all){
                    $total = $total + $all['amount'];
                } 
                echo number_format($total,2) ;
                ?>
            </td>
        </tr>
    </tfoot>
</table>
<?php
    

}else{
    echo "
        <div class='alert alert-primary' role='alert'>
            No orders made!
        </div>
    ";
}
?>
</div>
</div>

<?php require_once "layout/footer.php" ?>