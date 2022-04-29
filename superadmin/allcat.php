<?php
    $title = "All Categories";
    require_once "layout/header.php"; 
    require_once "../includes/init.php";

      // Category Post
  if(isset($_POST['cat_submit'])) {
    $category = new Category();
    $check = [];
    foreach ($category->getAll() as $name) {
        $check[] = strtoupper($name['ct_name']);
    };
    $cat_name = clean(strtoupper($_POST['cat_name']));
    $cat_desc = clean($_POST['cat_desc']);
    $err = "";
    if(empty($cat_name)){
      $err .= "Category name required.<br>";
    }
    if(in_array($cat_name, $check, TRUE)) {
        $err .= "Category exists. Try another<br>";
    }
    if(!preg_match("/^[a-zA-Z0-9-' ]{3,25}$/", $cat_name)) {
      $err .= "Name can only use(- and alphanumeric 3-25 characters)<br>";
    }
    if(empty($cat_desc)){
      $err .= "Description required<br>";
    }
    if(strlen($cat_desc) >= 254 ) {
      $err .= "Too long description<br>";
    }
    if(empty($err)) {
      $category->addCategory($cat_name, $cat_desc);
    }
    else{
      // echo "<p style='color:red;'>$err</p>";
      echo "
          <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong>Error!</strong> $err
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
      ";
    }

  }
  // End Category Post
?>
<h1><u>All Categories</u></h1>
<div class="text-center mb-4">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
  Add New Category
</button>
</div>
<!-- Add category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label for="">Category Name</label>    
                <input class="form-control" type="text" name="cat_name" placeholder="" required>
                <label for="">Description</label>    
                <textarea class="form-control" name="cat_desc" required></textarea>
            </div>    
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="cat_submit" class="btn btn-primary">Add Category</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!-- End Category Modal -->
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>SN</th>
            <th>Category</th>
            <th>Description</th>
            <th colspan="2">Action</th>
        </tr>        
    </thead>  
    <tbody>
        <?php 
            $category = new Category();
            if($category->getAll() > 0):
                $count = 0;
                foreach($category->getAll() as $cat): $count++;?>
                    <tr>
                        <td><?=$count;?></td>
                        <td><a style="text-decoration:none;color:white;" href="category.php?id=<?=$cat['ct_id']?>"><?=$cat['ct_name']?></a></td>
                        <td><?=$cat['ct_desc']?></td>
                        <td>
                            <form action="editcat.php" method="post">
                                <input type="hidden" name="ct_id" value="<?=$cat['ct_id']?>">
                                <button class="btn btn-warning" type="submit" name="editcat">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="delcat.php" method="post">
                                <input type="hidden" name="ct_id" value="<?=$cat['ct_id']?>">
                                <button class="btn btn-danger" type="submit" name="delcat">Delete</button>
                            </form>
                        </td>
                    </tr>                
                <?php endforeach;
            else:
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Alert!</strong> You should add in some of Categories.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            endif;
        ?>
    </tbody>  
</table>



<?php 
require_once "layout/footer.php" ?>
