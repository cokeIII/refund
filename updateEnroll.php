<?php
require_once "connect.php";
if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    $status = "";
    if (!empty($_POST["update"])) {
        $status = "โอนแล้ว";
    } else {
        $status = "ลงทะเบียนสำเร็จ";
    }
    $sql = "update enroll set status='$status' where id='$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("location: listEnroll.php");
    } else {
        header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
}
