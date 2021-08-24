<?php

$servername = "localhost";
$username = "root";
$password = '';
$database = "refund";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from student_family_temp";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){

    $parent_th_prefix = $row["parent_th_prefix"];
    $parent_th_name = $row["parent_th_name"];
    $parent_th_surname = $row["parent_th_surname"];

    $father_th_prefix = $row["father_th_prefix"];
    $father_th_name = $row["father_th_name"];
    $father_th_surname = $row["father_th_surname"];
    $father_middle_name = $row["father_middle_name"];

    $mother_th_prefix = $row["mother_th_prefix"];
    $mother_th_name = $row["mother_th_name"];
    $mother_th_surname = $row["mother_th_surname"];
    $mother_middle_name = $row["mother_middle_name"];

    $student_id = $row["student_id"];

    $sqlUp = "update student_family set 
    parent_th_prefix = ' $parent_th_prefix',
    parent_th_name = ' $parent_th_name',
    parent_th_surname = ' $parent_th_surname',
    father_th_prefix = ' $father_th_prefix',
    father_th_name = ' $father_th_name',
    father_th_surname = ' $father_th_surname',
    father_middle_name = ' $father_middle_name',
    mother_th_prefix = ' $mother_th_prefix',
    mother_th_name = ' $mother_th_name',
    mother_th_surname = ' $mother_th_surname',
    mother_middle_name = ' $mother_middle_name'
    where student_id = '$student_id';
    ";
    mysqli_query($conn,$sqlUp);
}