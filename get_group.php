<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$major_name = $_POST["major_name"];
$data = array();

$sql = "select grade_name from enroll where major_name = '$major_name' group by grade_name";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res)){
    $data[] = $row["grade_name"];
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);