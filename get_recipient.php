<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$student_id = $_POST["student_id"];
$data = array();

if ($_POST["get_status"] == "บิดา") {
    $sql = "select fat_fname,fat_lname from student where student_id = '$student_id'";
    $res = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($res)){
        $data["recipient_fname"] = $row["fat_fname"];
        $data["recipient_lname"] = $row["fat_lname"];
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
} else if ($_POST["get_status"] == "มารดา") {
    $sql = "select mot_fname,mot_lname from student where student_id = '$student_id'";
    $res = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($res)){
        $data["recipient_fname"] = $row["mot_fname"];
        $data["recipient_lname"] = $row["mot_lname"];
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
} else if ($_POST["get_status"] == "ผู้ปกครอง") {
    $sql = "select par_fname,par_lname from student where student_id = '$student_id'";
    $res = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($res)){
        $data["recipient_fname"] = $row["par_fname"];
        $data["recipient_lname"] = $row["par_lname"];
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
