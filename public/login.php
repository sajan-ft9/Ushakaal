<?php 
session_start();
if(isset($_SESSION['customer'])){
    header("location:index.php");
    die;
}
require_once "layout/header.php";
$customer = new Customer();
if($_SERVER['REQUEST_METHOD']== "POST"){
    if(isset($_POST['login'])){
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        if($customer->selected($email) > 0){
                if(password_verify($password, $customer->selected($email)['password'])){
                    $_SESSION['customer'] = $customer->selected($email)['email'];
                    $_SESSION['customer_id'] = $customer->selected($email)['cus_id'];
                    echo "<script>window.location.replace('index.php')</script>";
                    die;
                }else{
                    $err = "Incorrect password";
                }
        }else{
            $err = "No such user.";
        }
    }
}
?>
<link rel="stylesheet" href="layout/css/login.css">
<div class="container">
    <?php 
    if(isset($err)){
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> $err
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
    }
    ?>
<div class="wrapper">
    <!-- <div class="logo"> <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt=""> </div> -->
    <div class="logo"> <img src="logos/ushakal.png" alt=""> </div>
    <div class="text-center mt-4 name"> Ushakaal</div>
    <form class="p-3 mt-3" action="" method="POST">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="email" name="email" id="userName" placeholder="Email" required> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="password" id="pwd" placeholder="Password" required> </div> <button type="submit" class="btn mt-3" name="login">Login</button>
    </form>

    <div class="text-center fs-6"><a href="signup.php">Sign up</a> </div>
</div>
</div>
</div>
<?php 
require_once "layout/footer.php";
?>