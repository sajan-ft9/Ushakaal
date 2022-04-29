<?php
require_once "../includes/init.php";
$notice = new Notice;
$allnotice = $notice->getAll();
// add
if(isset($_POST['noticeadd'])){
    $noty = $_POST['notice'];
    $notice->addNotice($noty);
    header("Location:index.php");
    die;
}
// delete
if(isset($_POST['delnot'])){
    $id = $_POST['id'];
    $notice->delNotice($id);
    header("Location:index.php");
    die;
}
?>