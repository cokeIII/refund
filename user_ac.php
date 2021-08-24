<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
session_start();
$detail = $_REQUEST["detail"];
$people_id = $_SESSION["people_id"];
$enroll_id = $_REQUEST["enroll_id"];
$sql = "insert into log_data (
    detail, 
    people_id, 
    enroll_id
) value(
    '$detail',
    '$people_id',
    '$enroll_id'
)";
$res = mysqli_query($conn,$sql);

if($res){
    echo "upDateAction";
} else {
    echo $sql;
}