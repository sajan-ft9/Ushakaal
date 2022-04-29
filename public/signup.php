<?php
session_start();
if(isset($_SESSION['customer'])){
    header("location:index.php");
    die;
}
require_once "../public/layout/header.php";

if($_SERVER['REQUEST_METHOD'] = "POST"){
    if(isset($_POST['signup'])){
        $customer = new Customer();
        $err = "";
        $name = clean($_POST['name']);
        $contact = clean($_POST['contact']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $cpassword = clean($_POST['cpassword']);
        
        if(empty($name)){
            $err .= "<li>Name required</li>";
        }
        if(empty($contact) || !is_numeric($contact)){
            $err .= "<li>Contact not valid</li>";
        }
        if(empty($email)){
            $err .= "<li>Email required</li>";
        }else if(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/", $email)){
            $err .= "<li>Enter valid email.</li>";
        }else if($customer->selected($email) > 0){
            $err .= "<li>Email already has account. <a href='login.php'>Login</a></li>";
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
        }
        if(empty($err)){
            $pass = password_hash($password, PASSWORD_DEFAULT);

            $customer->add($name, $contact, $email, $pass);
            echo "<script>window.location.replace('login.php')</script>";
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
    <div class="col-md-6 col-lg-12 p-5">
        <form action="" method="post">
                <label  for="">Full Name</label>
                <input class="form-control" type="text" name="name" placeholder="e.g. Fernando Torres" required>
                <label for="">Phone Number</label>
                <input class="form-control" type="tel" name="contact" required>
                <label for="">Email</label>
                <input class="form-control" type="email" name="email" placeholder="example@gmail.com" required>
                <label for="">Password</label>
                <input class="form-control" type="password" name="password" required>
                <label for="">Confirm Password</label>
                <input class="form-control" type="password" name="cpassword" required>
                <div class="mt-2 text-center">
                <button style="width: 200px;" class="btn btn-outline-dark" type="submit" name="signup">Signup</button>
                <p>Already have account?<a href="login.php">Login</a></p>
                </div>
        </form>
    </div>

</div>


<?php require_once "layout/footer.php" ?>
