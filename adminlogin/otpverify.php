<?php
  header("Location:ha-admin.php");
  die;
?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<div class="container login-container">
<div class="text-center"><h1>Otp Verification</h1></div>

    <div class="mt-4" style="display:flex; justify-content:center; align-self:center">
                        <h3 style="margin-right:10px;">Enter OTP</h3> 
                        <form method="POST">
                            <div class="form-group">
                                <input class="form-control" type="text" name="otp" class="form-control" placeholder="XXXXXX" required/>
                            </div>
                            <div class="form-group mt-2">
                                <input class="btn btn-info" type="submit" name="otpverify" class="btnSubmit" value="Submit" />
                            </div>
                        </form>
                    </div>
<?php 
session_start();
if(!isset($_SESSION['ha-admin'])){
    header('Location:ha-admin.php');
    die;
}

if(isset($_SESSION['logged'])){
    header('Location:../admin/index.php');
    die;
}

require_once "../includes/init.php";

    //  if($_SERVER['REQUEST_METHOD'] == "POST"){

    //     if(isset($_POST['otpverify'])) {
    //         date_default_timezone_set('Asia/Kathmandu');
    //         $admin = new Admin();
    //         $err = "";
    //         $username = "admin";
    //         $otp = clean($_POST['otp']);
    //         $db_otp = $admin->getOtp();
    //         $now = date("Y-m-d h:i:s");
    //         if($now > $db_otp['otp_time']){
    //             echo "Otp time exceeded. Please relogin.";
    //             sleep(1);
    //             echo "<script>window.location.replace('ha-admin.php');</script>";
    //             die;
    //         }
    //         else{
    //             if(empty($otp)){
    //                 $err .= "OTP cannot be empty.<br>";
    //             }
    //             if(empty($err)){
    //                 if($otp == $otp){
    //                     if($admin->get($username) > 0){
    //                         $verify = $admin->get($username);
    //                         // session_start();
    //                         $_SESSION['logged'] = $verify['username'];
    //                         $_SESSION['email'] = $verify['email'];
    //                         // echo $_SESSION['logged'];
    //                         // echo $_SESSION['email'];
    //                         session_unset($_SESSION['ha-admin']);
    //                         header("Location: ../admin/index.php");
    //                         die;
    //                     }

    //                 }
    //                 else{
    //                     echo "Otp does not match";
    //                 }
    //             }
    //             elseif{
    //                 echo $err;
    //             }
    //         }    
    //     }
    // }