<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";

$sql = "select 
s.student_id,
s.people_id,
s.stu_fname,
s.stu_lname,
s.group_id,
p.prefix_name,
g.grade_name,
g.major_name,
g.minor_name,
g.student_group_no,
g.student_group_short_name,
st.status_std
from student s left join student_group g on s.group_id = g.student_group_id
left join prefix p on p.prefix_id = s.perfix_id
left join student_status st on st.student_id = s.student_id
where status = '0'";

$res = mysqli_query($conn, $sql);
$i = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $techlist["data"][$i]["student_id"] = $row["student_id"];
    $techlist["data"][$i]["stu_name"] = $row["stu_fname"] . " " . $row["stu_lname"];
    $techlist["data"][$i]["student_group_short_name"] = $row["student_group_short_name"];
    $techlist["data"][$i]["status1"] = '<input type="radio" name="' . $row["student_id"] . '" stdId="' . $row["student_id"] . '" class="status-radio" value="ผ่อนผัน" ' . ($row["status_std"] == "ผ่อนผัน" ? "checked" : "") . '>: ผ่อนผัน';
    $techlist["data"][$i]["status2"] = '<input type="radio" name="' . $row["student_id"] . '" stdId="' . $row["student_id"] . '" class="status-radio" value="ไม่ได้ลงทะเบียน" ' . ($row["status_std"] == "ไม่ได้ลงทะเบียน" ? "checked" : "") . '>: ไม่ได้ลงทะเบียน';
    $techlist["data"][$i]["clear"] = '<button class="btn btn-danger btn-clear" stdId="' . $row["student_id"] . '">ล้างสถานะ</button>';
    $i++;
}
echo json_encode($techlist, JSON_UNESCAPED_UNICODE);
