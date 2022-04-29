<?php 
require_once "../includes/init.php";
customerLogin();

$customer = new Customer();
$dbpass = $customer->selected($_SESSION['customer']);
if($dbpass['login_type'] == 'gmail'){
    header("location:profile.php");
    die;
}
$title= "Change Password";
require_once "layout/header.php"; 
if($_SERVER['REQUEST_METHOD']=== "POST"){
    if(isset($_POST['passChange'])) {
        $err = "";
        $oldpass = clean($_POST['oldpass']);
        $newpass = clean($_POST['newpass']);
        $hash = password_hash($newpass, PASSWORD_DEFAULT);
        $confirmpass = clean($_POST['confirmpass']);
        $dbpass = $customer->selected($_SESSION['customer']);
        if(empty($oldpass)){
            $err .= "Password required.";
        }else{
            if(!password_verify($oldpass, $dbpass['password'])){
                $err .= "Old Password not valid.<br>";
            }
        }
        if($oldpass == $newpass){
            $err = "New password cannot be same as old password.";
        }
        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$newpass)){
            $err .= "Password must contain t least 8 characters<br>
            <li>at least one lowercase char</li>
            <li>at least one uppercase char</li>
            <li>at least one digit</li>
            <li>at least one speacial character</li>"
            ;
        }else{
            if($newpass !== $confirmpass){
                $err .= "Password did not match.<br>";
            }
        }
        if(empty($err)){
            $customer->changePass($hash, $_SESSION['customer']);
            echo "
              <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Password Successfully Changed.</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
                ";
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
?>
<h2 class="text-center">Change Password</h2>
<div class="mt-4 mb-4" style="display:flex; justify-content:center; align-self:center;">
    <form action="" method="POST">
        <label for="">Enter old Password</label>
        <input type="password" class="form-control" name="oldpass" required>
        <label for="">Enter new Password</label>
        <input type="password" class="form-control" name="newpass" required>
        <label for="">Confirm Password</label>
        <input type="password" class="form-control" name="confirmpass" required>
        <button type="submit" name="passChange" class="btn btn-success mt-3 form-control">Update Password</button>
    </form>
</div>
</div>

<?php require_once "layout/footer.php" ?>