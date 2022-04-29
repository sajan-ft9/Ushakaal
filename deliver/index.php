<?php
$title = "Deliver";
require_once "layout/header.php";
$ORDERS = new Orders;
?>
<h1>Pending Deliveries</h1>
<?php 
    if($ORDERS->showOrders() > 0){
?>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Order Date</th>
            <th>Address</th>
            <th>Action</th>
        </tr>        
    </thead>  
    <tbody>
        
            <?php 
                foreach($ORDERS->showOrders() as $details){?>
                    <tr>
                        <td><?=$details['name']?></td>
                        <td><?=$details['order_date']?></td>
                        <td><?=$details['order_address']?></td>
                        <td>
                            <form action="showorders.php" method="get">
                                <input type="hidden" name="cus_id" value="<?=$details['cus_id']?>" required>
                                <button type="submit" class="btn btn-outline-info" name="showorders">View Orders</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
            
            ?>        
    </tbody>
</table>
<?php 
}else{
    echo "
          <div class='alert alert-success alert-d fade show' role='alert'>
          <strong>Wow! No pending deliveries left.</strong> 
          </div>";
}

require_once "layout/footer.php";
?>