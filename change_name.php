<?php
require_once "connect.php";
$student_id = $_REQUEST["student_id"];
$th_name_old = $_REQUEST["th_name_old"];
$th_name_new = $_REQUEST["th_name_new"];
$status = $_REQUEST["status"];

$sql = "insert into change_name 
(
    student_id, 
    status,
    th_name_old,
    th_name_new
) value(
    '$student_id',
    '$status',
    '$th_name_old',
    '$th_name_new'
)";

$res = mysqli_query($conn,$sql);
echo $res;
