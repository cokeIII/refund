<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$id = $_POST["id"];

$data = array();

$sql = "select note from enroll where id = '$id'";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res)){
    $data = $row["note"];
}
echo $data;