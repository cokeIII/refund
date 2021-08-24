<?php
require_once "connect.php";
if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    $status = $_POST["status"];
    $val = $_POST["val"];

    $sql = "update change_name set change_status='$val' where student_id ='$id' and status='$status'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
        // header("location: listEnroll.php");
    } else {
        echo "fail";
        // header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
}