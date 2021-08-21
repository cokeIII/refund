<?php
error_reporting(E_ERROR | E_PARSE);
require_once "connect.php";
$student_id = $_REQUEST["student_id"];
$th_name_old = $_REQUEST["th_name_old"];
$th_name_new = $_REQUEST["th_name_new"];
$status = $_REQUEST["status"];
$tel = $_REQUEST["tel"];

$sql = "insert into change_name 
(
    student_id, 
    status,
    th_name_old,
    th_name_new,
    tel
) value(
    '$student_id',
    '$status',
    '$th_name_old',
    '$th_name_new',
    '$tel'
)";

$res = mysqli_query($conn,$sql);
if($res){
    echo "true";
} else {
    echo "false";
}

