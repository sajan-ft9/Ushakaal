<?php 
$title= "Delivery";
require_once "layout/header.php"; 
$DELIVER = new Deliver();
if($_SERVER['REQUEST_METHOD']=== "POST"){
    if(isset($_POST['delivery_reset'])){
        $err = "";
        $del_id = clean($_POST['del_id']);
        if(empty($del_id)){
            $err .= "<li>Username required</li>";
        }
        }if(empty($err)){
            $pass = password_hash("Admin@123", PASSWORD_DEFAULT);
            $DELIVER->changePass($pass, $del_id);
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>User Reset Success.</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
        }else{
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error: <ul></strong> $err </ul>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
        }
    }
?>
<h1>DELIVERY USERS</h1>
<div class="mt-4" style="width:300px;">
   <ol>
       <?php 
       if($DELIVER->getAll() > 0){
           foreach($DELIVER->getAll() as $users){
            ?>
               <li style='position:relative;' class='mb-4'><?php echo substr($users['del_user'],0,12);?>
                <span style='position:absolute;right:0px;'>
                    <form action="" method="post">
                        <input type="hidden" name="del_id" value="<?=$users['del_id']?>" required>
                        <button type="submit" name="delivery_reset" class='btn btn-info' onClick="return confirm('Confirm Reset')">Reset Password</button>
                    </form>
                </span>
               </li>
            <?php
            }
       }
       ?>
   </ol>
</div>

<?php require_once "layout/footer.php" ?>