<?php
require_once "layout/header.php";

$notice = new Notice;
$allnotice = $notice->getAll();
?>
<div class="container">
    <div class="text-center">
        <h1 class="text-dark">Notices</h1> 
    </div>
    <div>
        <?php if(is_array($allnotice)){ ?>
            <?php foreach ($allnotice as $row) { ?>
                <div class="mb-2">
                    <p><?=$row['notices']?></p>
                </div>
                <hr>
                <?php } ?>
            <?php }else{
                echo "No notices yet";
            } ?>
    </div>
</div>

<?php require_once "layout/footer.php"; ?>