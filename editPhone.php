<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$enrollId = $_POST["enrollId"];
$phone = $_POST["phone"];
$data = array();

$sql = "update enroll set phone ='$phone' where id = '$enrollId'";
$res = mysqli_query($conn,$sql);
if($res){
    echo "ok";
} else {
    echo "fail";
}
