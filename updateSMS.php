<?php
require_once "connect.php";
error_reporting(E_ERROR | E_PARSE);
if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    $phone = $_POST["phone"];

    $sql = "update enroll set sms='ส่งแล้ว' where id = '$id' and phone='$phone'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
    } else {
        echo "fail";
    }
}