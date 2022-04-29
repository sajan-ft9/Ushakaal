<?php
$title = "Admin";
require_once "layout/header.php";

$notice = new Notice;
$allnotice = $notice->getAll();
?>
<div class="container">
    <div class="text-center">
        <h1>Add  Notice</h1> 
    </div>
    <div>
        <form action="noticework.php" method="post">
            <input required type="text" name="notice" id="" class="form-control mb-2" placeholder="Notice">
            <button class="btn btn-info" type="submit" name="noticeadd">Upload</button>
        </form>
    </div>
    <div>
        <?php if(is_array($allnotice)){ ?>
        <table class="table table-dark table-hover mt-4">
        <thead>
            <tr>
                <th>Notices</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allnotice as $row) { ?>
                <tr>
                    <td><?=$row['notices']?></td>
                    <td><form action="noticework.php" method="post">
                        <input type="hidden" name="id" value="<?=$row['id']?>">
                        <button class="btn btn-danger" type="submit" name="delnot" onClick="return confirm('Confirm Delete')">DELETE</button>
                    </form></td>
                </tr>
                <?php } ?>
            <tbody>
        </table>
            <?php } ?>
    </div>
</div>

<?php require_once "layout/footer.php"; ?>