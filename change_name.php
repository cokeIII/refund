<?php
error_reporting(E_ERROR | E_PARSE);
require_once "connect.php";
$student_id = $_REQUEST["student_id"];
$th_prefix_old = $_REQUEST["th_prefix_old"];
$th_name_old = $_REQUEST["th_name_old"];
$th_lname_old = $_REQUEST["th_lname_old"];
$th_prefix_new = $_REQUEST["th_prefix_new"];
$th_name_new = $_REQUEST["th_name_new"];
$th_lname_new = $_REQUEST["th_lname_new"];
$status = $_REQUEST["status"];
$tel = $_REQUEST["tel"];

$sql = "insert into change_name 
(
    student_id, 
    status,
    th_prefix_old,
    th_name_old,
    th_lname_old,
    th_prefix_new,
    th_name_new,
    th_lname_new,
    tel,
    change_status
) value(
    '$student_id',
    '$status',
    '$th_prefix_old',
    '$th_name_old',
    '$th_lname_old',
    '$th_prefix_new',
    '$th_name_new',
    '$th_lname_new',
    '$tel',
    'ยังไม่ได้แก้ไข'

)";

$res = mysqli_query($conn,$sql);
if($res){
    echo "true";
} else {
    echo "false";
}

