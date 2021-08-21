<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
$id = $_REQUEST["id"];
$username = $_REQUEST["username"];
$data = array();

$sql = "update enroll set user_action = '$username' where id = '$id'";
$res = mysqli_query($conn,$sql);

if($res){
    echo "upDateAction";
} else {
    echo "failUpDateAction";
}