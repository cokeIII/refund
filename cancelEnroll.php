<?php
require_once "connect.php";
$id = $_POST["id"];
$sql = "update enroll set status = 'ยกเลิก' where id = '$id'";
$res  = mysqli_query($conn,$sql);
if($res){
    header("location: listEnroll.php");
} else {
    header("location: pageError.php?text_err=ยกเลิกไม่สำเร็จ");
}