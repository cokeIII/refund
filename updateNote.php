<?php
require_once "connect.php";
error_reporting(E_ERROR | E_PARSE);
if (!empty($_POST["enroll_id"])) {
    $enroll_id = $_POST["enroll_id"];
    $note = implode(",",$_POST["note"]);

    $sql = "update enroll set note='$note' where id = '$enroll_id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "ok";
    } else {
        echo "fail";
    }
}