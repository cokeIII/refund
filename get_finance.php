<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";
if (!empty($_POST["room_name"])) {
    $room_name = $_POST["room_name"];
    $sql = "select * from enroll 
    where 
    student_group_short_name = '$room_name'  and 
    status != 'ยกเลิก' order by student_id";
} else {
    $sql = "select * from enroll where status != 'ยกเลิก'";
}
$res = mysqli_query($conn, $sql);
$i = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $techlist["data"][$i]["no"] = $i + 1;
    $techlist["data"][$i]["student_id"] = $row["student_id"];
    $techlist["data"][$i]["stu_name"] = $row["stu_fname"] . " " . $row["stu_lname"];
    $techlist["data"][$i]["student_group_short_name"] = $row["student_group_short_name"];
    $techlist["data"][$i]["phone"] = $row["phone"];
    $techlist["data"][$i]["status"] = '<div class="col-status-'.$row["id"].' '.($row["status"] == "ยกเลิก" || $row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์"?'text-danger':'text-success').'">'.$row["status"]."</div>";
    $techlist["data"][$i]["time_stamp"] = $row["time_stamp"];
    $techlist["data"][$i]["select_status"] = ' <select enrollId="' . $row["id"] . '" std_id="' . $row["student_id"] . '" name="status" id="status" class="form-control status">
    <option value="พิมพ์แล้ว"' . ($row["status"] == "พิมพ์แล้ว" ? "selected" : "") . '>พิมพ์แล้ว</option>
    <option value="เอกสารไม่ถูกต้องสมบูรณ์"' . ($row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์" ? "selected" : "") . '>เอกสารไม่ถูกต้องสมบูรณ์</option>
    <option value="โอนแล้ว"' . ($row["status"] == "โอนแล้ว" ? "selected" : "") . '>โอนแล้ว</option>
    <option value="ส่งเอกสารแล้ว"' . ($row["status"] == "ส่งเอกสารแล้ว" ? "selected" : "") . '>ส่งเอกสารแล้ว</option>
    <option value="ยกเลิก"' . ($row["status"] == "ยกเลิก" ? "selected" : "") . '>ยกเลิก</option>
</select>';
    $techlist["data"][$i]["btn_note"] = '<button class="btn btn-warning modal-note" enrollId="' . $row["id"] . '"><i class="fas fa-sticky-note"></i> หมายเหตุ</button>';
    $techlist["data"][$i]["btn_print"] = '<a id="btnPrint" href="report_2.php?id=' . $row["id"] . '" target="_blank"><button class="btn btn-info"><i class="fas fa-print"></i> พิมพ์</button></a>';
    $techlist["data"][$i]["btn_edit"] = '<button class="btn btn-info modal-edit" enrollId="' . $row["id"] . '" stdId="'.$row["student_id"].'"><i class="fas fa-user-cog"></i>แก้ไข</button>';
    $i++;
}
echo json_encode($techlist, JSON_UNESCAPED_UNICODE);
