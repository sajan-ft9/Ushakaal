<?php 
$title= "Feedback";
require_once "layout/header.php";
?>

<h1 class="mt-4">Feedback</h1>

<div>
    <form action="" method="post">
        <input type="text" name="customer">
        <button type="submit" name="search" class="btn btn-success">Search</button>
    </form>
</div>
<?php 
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                if(isset($_POST['search'])){
                    $cus_name = clean($_POST['customer']);

?>
<div class="">
    <ul>
        <?php 
            $admin = new Admin();
            if($admin->allComments($cus_name) > 0){
            foreach($admin->allComments($cus_name) as $comment){
                ?>
                    <li><?=$comment['feedback']?> - <span class="text-success"><?=$comment['name']?>
                        <?php if(!empty($comment['feedback_reply'])){
                            echo "-<span class='text-danger'>Replied:".$comment['feedback_reply']."</span>";
                        } ?>
                    </span>
                        <form action="deletefb.php" method="post">
                            <input type="hidden" name="id" value="<?=$comment['id']?>">
                            <input type="text" name="fbreply" required>
                            <?php if(!empty($comment['feedback_reply'])){?>
                                <button type="submit" class="btn btn-info" name="reply" onclick="return(confirm('Already replied.Update?'))">Reply</button>                                
                            <?php
                            }else{?>
                                <button type="submit" class="btn btn-info" name="reply">Reply</button>
                            <?php }
                            ?>  
                            <button type="submit" class="btn btn-danger" name="delfb" onclick="return(confirm('Confirm delete?'))">Delete</button>
                        </form>
                    </li>
                <?php
            }
        }
        else{
            echo "Not found";
        }
        }
    }
        ?>
    </ul>
</div>
</div>

<?php require_once "layout/footer.php" ?>