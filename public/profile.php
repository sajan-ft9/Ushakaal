<?php 
require_once "../helpers/functions.php";
customerLogin();
$title= "Change Password";
require_once "layout/header.php"; 
$CUSTOMER = new Customer();
$cus_data = $CUSTOMER->selected($_SESSION['customer']);
if(is_array($cus_data)){
    ?>
    <div class="container mt-5 mb-5">
        <strong>Name: </strong><p><?=$cus_data['name']?></p>
        <strong>Email: </strong><p><?=$cus_data['email']?></p>
        <strong>Contact: </strong><p><?=$cus_data['contact']?></p>
        <strong>Login Type: </strong><p><?=$cus_data['login_type']?></p>
    <?php
    }
?>
<?php
if($cus_data['login_type'] == 'custom'){
?>

<a class="btn btn-info" href="changepassword.php">Change Password</a>
</div>
<?php 
}
?>
</div>

<?php require_once "layout/footer.php"; ?>