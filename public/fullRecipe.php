
<?php error_reporting (E_ALL ^ E_NOTICE); ?>


<?php
include 'links/links.php';
?>


<?php
include 'includes/Navbar.php';
?>


<?php
date_default_timezone_set('Asia/Kathmandu');
?>



<!-- <button onclick="goBack()" class="main-btn mt-4" style="margin-left: 2%;">Back</button> -->


<?php
        $BLOG = new Blog();
        $blog_data = $BLOG->get();
        print_r($blog_data);
        if(is_array($blog_data)){
        foreach($blog_data as $row){
            
        }
    }
?>
<?php 
    include('includes/footer.php');
?>
