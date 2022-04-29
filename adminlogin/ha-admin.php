<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<div class="container login-container">
    <div class="text-center"> <h1>Admin</h1> </div>

            <div class="mt-4" style="display:flex; justify-content:center; align-self:center">
                    <form method="POST">
                        <div class="form-group">
                            <input class="form-control" type="text" name="username" class="form-control" placeholder="Username *" required/>
                        </div>
                        <div class="form-group mt-2">
                            <input class="form-control" type="password" name="password" class="form-control" placeholder="Your Password *" value="" required/>
                        </div>
                        <div class="form-group mt-2">
                            <input class="btn btn-info" type="submit" name="adminlogin" class="btnSubmit" value="Login" />
                            <a class="btn btn-secondary" href="../index.php">Go Back</a>
                        </div>
                    </form>
                </div>

<?php  
    
session_start();

if(isset($_SESSION['logged'])){
    header('Location:../superadmin/index.php');
    die;
}

    require_once "../includes/init.php";

     if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['adminlogin'])) {
            $err = "";
            $username = clean($_POST['username']);
            $password = clean($_POST['password']);

            if(empty($username)){
                $err .= "Username required.<br>";
            }
            if(empty($password)){
                $err .= "Password required.<br>";
            }
            if(empty($err)){
                $admin = new Admin();
                
                if($admin->get($username) > 0){
                    $verify = $admin->get($username);
                    if(password_verify($password, $verify['password'])){
                        // $otp = otpGenerate();
                        date_default_timezone_set('Asia/Kathmandu');
                        // $date=strtotime(date("h:i:s"))+900;
                        // $otp_time=date("Y-m-d h:i:s",$date);
                        // $admin->otpUpdate($otp, $otp_time);
                        $_SESSION['logged'] = $verify['username'];
                        $_SESSION['email'] = $verify['email'];         
                        header("Location: ../superadmin/index.php");
                        die;
                    }
                    else{
                        echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Error:</strong> Invalid password.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                      ";
                    }
                }
                else{
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Error:</strong> No such user.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                      ";
                }
                
            }else{
                echo "
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error:</strong> $err
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
                ";
            }
            
        }
    }     