<?php
require_once "connect.php";
$id = $_POST["id"];
$sql = "delete from enroll where id='$id'";
$res = mysqli_query($conn,$sql);
if($res){
    header("location: listEnroll.php");
} else {
    header("location: pageError.php?text_err=ลบไม่สำเร็จ");
}