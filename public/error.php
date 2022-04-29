<?php 
    require_once "layout/header.php";

$err = $_SERVER['REDIRECT_STATUS'];

$err_title = "";
$err_msg = "";
if($err == 404){
    $err_title = "404 page not found.";
    $err_msg = " Click on link below to go back.";
}
?>

<div class="container mt-5 mb-5">
    <h2>Error 404</h2>
    <?php echo $err_title. $err_msg; ?><br>
    <a class="btn btn-success" href="/sem-v/index.php">Home</a>
</div>
    <?php 
    require_once "layout/footer.php";
    ?>