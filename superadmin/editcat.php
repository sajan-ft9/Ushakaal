<?php 
$title = "Edit";
require_once "../includes/init.php";
require_once "layout/header.php";
$category = new Category();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //edit
    if(isset($_POST['editcat']) && isset($_POST['ct_id'])){
        $id = $_POST['ct_id'];
        $old = $category->selected($id);
    ?>
    <h1 class="m-auto" style="color: blue;">Update Category</h1>
    <div class="m-auto mt-4 col-6">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?=$id?>" required>
            Name<input type="text" class="form-control" name="ct_name" value="<?=$old['ct_name']?>" required>
            Description<input type="text" class="form-control" name="ct_desc" value="<?=$old['ct_desc']?>" required>
            <div class="col-4 m-auto mt-1">
                <input type="submit" class="btn btn-info" value="Update" name="update">
                <a href="allcat.php" class="btn btn-dark">Close</a>
            </div>
        </form>
    </div>
<?php
    }
}else{
    echo "<script>window.location.replace('allcat.php')</script>";
}?>
<?php require_once "layout/footer.php"; ?>
<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Update
    if(isset($_POST['update']) && isset($_POST['ct_name']) && isset($_POST['ct_desc']) ){
        $name = $_POST['ct_name'];
        $desc = $_POST['ct_desc'];
        $id = $_POST['id'];
        $category->update($name, $desc, $id);
    echo "<script>window.location.replace('allcat.php')</script>";
    }
}

?>