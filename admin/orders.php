<?php 

$title = "Category";
require_once "layout/header.php"; 
require_once "../includes/init.php";

$ORDERS = new Orders;

?>
<div class="d-flex flex-row">
  <div class="p-2">
  <h1 class="mt-4">Orders</h1>
</div>

</div>
<?php
if($ORDERS->allAdminOrders($customer) > 0){
    $result = $ORDERS->allAdminOrders($customer);    
?>
<table class="table table-primary table-hover table-striped">
    <thead style="text-align: center;">
        <tr>
            <th colspan="2">Product</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Bill No.</th>
            <th>Delivery Status</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php foreach($result as $all){
            ?>
                <tr>
                    <td><?=$all['pr_name']?></td>
                    <td><img src="../admin/uploads/<?=$all['pr_img']?>" alt="productimg" width="100px" height="100px"></td>
                    <td><?=$all['quantity']?></td>
                    <td><?=$all['amount']?></td>
                    <td><?=$all['bill_no']?></td>
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
<?php require_once "layout/footer.php"; ?>