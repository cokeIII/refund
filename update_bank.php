<?php
require_once "connect.php";
if (!empty($_POST["bank_name"])) {
    $id = $_POST["enroll_id"];
    $bank_name = $_POST["bank_name"];

    $sql = "update enroll set recipient_bank = '$bank_name' where id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
        // header("location: listEnroll.php");
    } else {
        echo "fail";
        // header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
} else if(!empty($_POST["bank_num"])){
    $id = $_POST["enroll_id"];
    $bank_num = $_POST["bank_num"];
    $sql = "update enroll set recipient_bank_number = '$bank_num' where id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
        // header("location: listEnroll.php");
    } else {
        echo "fail";
        // header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
}
