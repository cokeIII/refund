<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$major_name = $_POST["major_name"];
$grade_name = $_POST["grade_name"];
$data = array();

$sql = "select student_group_no	from enroll where major_name = '$major_name' and grade_name = '$grade_name' group by student_group_no";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res)){
    $data[] = $row["student_group_no"];
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);