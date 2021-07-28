<?php
require_once "connect.php";
if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    $status = $_POST["update"];

    $sql = "update enroll set status='$status' where id='$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
        // header("location: listEnroll.php");
    } else {
        echo "fail";
        // header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
}
