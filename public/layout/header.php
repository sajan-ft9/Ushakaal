<?php 
require_once "../includes/init.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="layout/css/style.css"> -->
    <link href="layout/css/usakal.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- try -->
    <link href="layout/css/ui.css" rel="stylesheet" type="text/css" />




    <title>Ushakaal</title>
</head>
<body>
<header id="header">
  
  <nav id="sticky" class="navbar navbar-expand-lg navigation-wrap">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img src="logos/ushakal.png" width="70" height="60"></a>
        
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-stream navbar-toggler-icon"></i>
      </button>
     <div>

     <div class="collapse navbar-collapse" id="navbarText">
         
        
         <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
         <div class="search-container">  
         <form action="search.php" method="POST">
         <input type="search" placeholder="Find products" name="search">
         <button type="submit" name="submit-search" class="button"><i class="fa fa-search" style="margin-left: 3px;"></i></button>
          </div>
         </form>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='index'){echo 'active';}?>"  href="index.php">Home</a>
           </li>
           <li class="nav-item">
             <a class="nav-link <?php if($page=='about'){echo 'active';}?>" href="about.php">About Us</a>
           </li>

           <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
                <?php
                $ct = new Category();
                $cs = new Customer();
                $allcat = $ct->getAll();
                    if(is_array($allcat)):
                        foreach($allcat as $cat):
                ?>
            <li><a class="dropdown-item" href="category.php?id=<?=$cat['ct_id']?>"><?=$cat['ct_name']?></a></li>
            <?php
endforeach;
endif;
            ?>
          </ul>
        </li>
           <li class="nav-item">
             <a class="nav-link"  href="blog.php" >Blogs</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="contact.php">Contact Us</a>
           </li>
           
<?php
              if(!isset($_SESSION['customer_id'])){
?>
           <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fas fa-user"></i>
              <?php
              
                    echo "Login/Sign up";
              
               ?>
              
            </a>
            </li>
<?php }else{
    ?>
     <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $cs->customerDetails($_SESSION['customer_id'])['name']; ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../admin">Admin</a></li>

            <li><a class="dropdown-item" href="myblog.php">My Blog</a></li>
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
            <li><a class="dropdown-item" href="notices.php">Notices</a></li>
            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
        </li>
    <?php
}
?>
            <li class="nav-item">
             <a class="nav-link"  href="cart.php" ><i class="fa fa-shopping-cart" style='font-size: 20px;'></i></a>
           </li>
            
          </ul>
        </div>
      </div>
      </div>
    </nav>

    <span class="nav-indicator"></span>
  </header>