<?php
if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET['showorders'])){        
        $title = "Deliver";
        require_once "layout/header.php";
        $cus_id = $_GET['cus_id'];
        $ORDERS = new Orders;
        $CUSTOMER = new Customer;
        if($ORDERS->getSelected($cus_id) > 0){
            $allorders = $ORDERS->getSelected($cus_id);
        ?>
        <h2>Delivery Details: <span class="text-success"><?=$CUSTOMER->customerDetails($cus_id)['name']; ?></span></h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Order Date</th>
                        <th>Bill No</th>
                        <th>Address</th>
                        <th>Delivery</th>
                        <th>Payment</th>
                        <!-- <th>Action</th> -->
                    </tr>        
                </thead>  
                <tbody>
                    
                        <?php 
                            foreach($allorders as $details){?>
                                <tr>
                                    <td><?=$details['pr_name']?></td>
                                    <td><img src="../admin/uploads/<?=$details['pr_img']?>" alt="image" height="100px" width="100px"></td>
                                    <td><?=$details['quantity']?></td>
                                    <td><?=number_format($details['amount'], 2)?></td>
                                    <td><?=$details['order_date']?></td>
                                    <td><?=$details['bill_no']?></td>
                                    <td><?=$details['order_address']?></td>
                                    <td>
                                        <?php
                                        
                                            if($details['order_delivered'] === '1'){
                                                echo "<h2>&#10004;</h2>";
                                            }elseif($details['order_delivered'] === '0'){
                                        ?>
                                                <form action="toggle.php" method="post">
                                                    <input type="hidden" name="orderid" value="<?=$details['id']?>" required>
                                                    <input type="hidden" name="cus_id" value="<?=$cus_id?>" required>
                                                    <button type="submit" class="btn btn-warning" name="delivery_confirm" onClick="return confirm('Confirm Delivery?')">Confirm Delivery</button>
                                                </form>
                                        <?php
                                            }
                                        ?>
                                    </td>  
                                    <td>
                                        <?php
                                            if($details['payment_received'] === '1'){
                                                echo "<h2>&#10004;</h2>";
                                            }elseif($details['payment_received'] === '0'){
                                        ?>
                                                <form action="toggle.php" method="post">
                                                    <input type="hidden" name="orderid" value="<?=$details['id']?>" required>
                                                    <input type="hidden" name="cus_id" value="<?=$cus_id?>" required>
                                                    <button type="submit" class="btn btn-info" name="payment_confirm" onClick="return confirm('Confirm Payment?')">Confirm Payment</button>
                                                </form>
                                        <?php
                                            }
                                        ?>
                                    </td>                                    
                                </tr>
                            <?php
                            }
        }else{
            echo "<script>window.location.replace('index.php');</script>";
            die;        
        }
                        ?>        
                </tbody>
            </table>       
        <?php require_once "layout/footer.php"; ?>
  <?php
    }
}else{
    header("Location:index.php");
    die;
}
