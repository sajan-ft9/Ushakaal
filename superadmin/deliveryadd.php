<?php 
$title= "Delivery";
require_once "layout/header.php"; 
if($_SERVER['REQUEST_METHOD']=== "POST"){
    if(isset($_POST['delivery'])){
        $DELIVER = new Deliver();
        $err = "";
        $del_user = clean($_POST['del_user']);
        $password = clean($_POST['password']);
        $cpassword = clean($_POST['cpassword']);
        if(empty($del_user)){
            $err .= "<li>Username required</li>";
        }else if($DELIVER->selected($del_user) > 0){
            $err .= "<li>Username already exists.</li>";
        }else if(!preg_match("/^[a-zA-Z0-9' ]{3,25}$/", $del_user)) {
            $err .= "<li>Username can only use alphanumeric 3-25 characters</li>";
          }
        if(empty($password)){
            $err .= "<li>Password required</li>";
        }  
        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password)){
            $err .= "<li>Password must contain at least 8 characters with 1-UPPERCASE 1-number & 1-special char.</li>";
        }
        if(empty($cpassword)){
            $err .= "<li>Please Confirm password</li>";
        }
        if($password !== $cpassword){
            $err .= "<li>Passwords do not match</li>";
        }if(empty($err)){
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $DELIVER->add($del_user,$pass);
            echo "
            <script>window.location.replace('deliverylist.php')</script>
        ";
        die;
        }else{
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error: <ul></strong> $err </ul>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
        }
    }
}
?>
<h1>ADD DELIVERY USER</h1>
<div class="mt-4" style="display:flex; justify-content:center; align-self:center">
    <form action="" method="post">
        <label style="float: left;" for="">Username</label><br>
        <input class="form-control mb-2" name="del_user" type="text" placeholder="e.g.Sam WikWiki">
        <label style="float: left;" for="">Password</label><br>
        <input class="form-control mb-2" type="password" name="password" placeholder="password" required>
        <label style="float: left;" for="">Confrim Password</label><br>
        <input class="form-control mb-2" type="password" name="cpassword" placeholder="confirm password" required>
        <button type="submit" name="delivery" class="btn btn-success form-control">
            Add New User
        </button>
    </form>
</div>

<?php require_once "layout/footer.php" ?>