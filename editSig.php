<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once "connect.php";
$enrollId = $_POST["enrollId"];
$status = $_POST["status"];
$student_id = $_SESSION["student_id"];
$folderPath = "uploads/signature/";
date_default_timezone_set("Asia/Bangkok");
$nameDate = date("YmdHis");

$image_parts = explode(";base64,", $_POST['signed']);

$image_type_aux = explode("image/", $image_parts[0]);

$image_type = $image_type_aux[1];

$image_base64 = base64_decode($image_parts[1]);

$file = $folderPath . $student_id . "_" . $nameDate . '.' . $image_type;
$signature = $student_id . "_" . $nameDate . '.' . $image_type;
file_put_contents($file, $image_base64);
if($status == "นักเรียน นักศึกษา"){
    $sql = "update enroll set stu_signature ='$signature' where id = '$enrollId'";
} else {
    $sql = "update enroll set parent_signature ='$signature' where id = '$enrollId'";
}

$res = mysqli_query($conn,$sql);
if($res){
    echo "ok";
} else {
    echo "fail";
}
