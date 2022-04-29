<?php 
require_once "../includes/init.php";
session_start();
if(isset($_SESSION['deliver'])){
    header("location:index.php");
    die;
}
$DELIVER = new Deliver();

if($_SERVER['REQUEST_METHOD']==="POST"){
    if(isset($_POST['delivery'])){
        $del_user = clean($_POST['del_user']);
        $password = clean($_POST['password']);
        if($DELIVER->selected($del_user) > 0){       
            if(password_verify($password, $DELIVER->selected($del_user)['password'])){
                $_SESSION['deliver'] = $DELIVER->selected($del_user)['del_user'];
                $_SESSION['deliverid'] = $DELIVER->selected($del_user)['del_id'];

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
    <link href="layout/css/styles.css" rel="stylesheet" />
    <link href="layout/css/card.css" rel="stylesheet" />
</head>
<body>
<div class="text-center">
   <h1>Login</h1> 
</div>
<div class="mt-4" style="display:flex; justify-content:center; align-self:center">
    <form action="" method="post">
        <label style="float: left;" for="">Username</label><br>
        <input class="form-control mb-2" name="del_user" type="text" placeholder="e.g.Sam WikWiki" required>
        <label style="float: left;" for="">Password</label><br>
        <input class="mb-2 form-control" type="password" name="password" placeholder="password" required>
        <button type="submit" name="delivery" class="btn btn-success">
            Login
        </button><span><a href="../index.php" class="btn btn-secondary mx-2">Close</a></span>
    </form>
</div>
</body>
</html> 