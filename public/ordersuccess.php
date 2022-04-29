<?php 
// session_start();
require_once "../includes/init.php";
customerLogin();
require_once "layout/header.php";
$customer_id = $_SESSION['customer_id'];
$orders = new Orders();
?>
<div class="container">
<a href="orders.php" class="mb-2 mt-4 btn btn-info">Click To View Pending</a>
</div>
<?php
if($orders->getSelectedSold($customer_id) > 0){
    $allorders = $orders->getSelectedSold($customer_id);
?>
<div class="ordersss container mb-5" style="max-height:420px; overflow-y:scroll;">
<table class="table table-dark table-hover table-striped">
    <thead style="text-align: center;">
        <tr>
            <th colspan="2">Product</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Received Date</th>
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
                   <td><?=$all['order_date']?></td>
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
                echo number_format($total,2);
                ?>
            </td>
        </tr>
    </tfoot>
</table>
</div>

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