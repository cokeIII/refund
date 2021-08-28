<?php
require_once "connect.php";
if (!empty($_POST["status"])) {
    $student_id = $_POST["student_id"];
    $status = $_POST["status"];

    $sql = "replace into student_status (student_id,status_std) values('$student_id','$status')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
        // header("location: listEnroll.php");
    } else {
        echo "fail";
        // header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
} else if(!empty($_POST["del"])){
    $student_id = $_POST["student_id"];
    $sql = "delete from student_status where student_id = '$student_id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
        // header("location: listEnroll.php");
    } else {
        echo "fail";
        // header("location: pageError.php?text_err=อัพเดทไม่สำเร็จ");
    }
}
