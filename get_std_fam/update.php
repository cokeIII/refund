
<?php
$servername = "localhost";
$username = "root";
$password = '';
$database = "dve2020";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$servername2 = "localhost";
$username2 = "root";
$password2 = '';
$database2 = "refund";
// Create connection
$conn2 = new mysqli($servername2, $username2, $password2,$database2);
$conn2->set_charset("utf8");
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

$sql = "select 
student_id,
parent_th_name,
parent_th_surname,
father_th_name,
father_th_surname,
father_middle_name,
mother_th_name,
mother_th_surname,
mother_middle_name
from student where school_id='1320026101'";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){
    $student_id = $row["student_id"];
    $parent_th_name = $row["parent_th_name"];
    $parent_th_surname = $row["parent_th_surname"];
    $father_th_name = $row["father_th_name"];
    $father_th_surname = $row["father_th_surname"];
    $father_middle_name = $row["father_middle_name"];
    $mother_th_name = $row["mother_th_name"];
    $mother_th_surname = $row["mother_th_surname"];
    $mother_middle_name = $row["mother_middle_name"];
    $sqlInsert = "insert into student_family (
    student_id,
    parent_th_name,
    parent_th_surname,
    father_th_name,
    father_th_surname,
    father_middle_name,
    mother_th_name,
    mother_th_surname,
    mother_middle_name
) value(
    '$student_id',
    '$parent_th_name',
    '$parent_th_surname',
    '$father_th_name',
    '$father_th_surname',
    '$father_middle_name',
    '$mother_th_name',
    '$mother_th_surname',
    '$mother_middle_name'
)";
mysqli_query($conn2,$sqlInsert);
}
?>