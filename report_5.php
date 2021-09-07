<?php
require_once "connect.php";
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=บัญชีรายชื่อนักเรียน-นักศึกษาที่อยู่ในระบบ ศธ.02 ณ วันที่ 6 ส.ค. 64 ที่สามารถจ่ายเงินได้.xls");
header("Pragma: no-cache");
header("Expires: 0");
$group_id = $_REQUEST["group_id"];
if (!empty($group_id)) {
    $sqlG = "select * from enroll where group_id = '$group_id' and status = 'พิมพ์แล้ว'";
} else {
    $sqlG = "";
}
$resRow = mysqli_query($conn, $sqlG);
$rowcount = mysqli_num_rows($resRow);
$resGetG = mysqli_query($conn, $sqlG);
$rowGetG = mysqli_fetch_array($resGetG);
?>
<style>
    .text-center {
        text-align: center;
    }

    .m-t {
        margin-top: 30px;
    }
    div.page { 
        page-break-after: always; 
    }
</style>
<?php
$count = 0;
for ($i = 0; $i < ceil($rowcount / 20); $i++) {
    $page = $i * 20;
?>
<table>
    <tr>
        <th class="text-center" colspan="10">บัญชีรายชื่อนักเรียน-นักศึกษาที่อยู่ในระบบ ศธ.02 ณ วันที่ 6 ส.ค. 64 ที่สามารถจ่ายเงินได้</th>
    </tr>
    <tr>
        <th class="text-center" colspan="10">ตามโครงการให้ความช่วยเหลือบรรเทาภาระค่าใช้จ่ายด้านการศึกษาในช่วงแพร่ระบาดของโควิด - 19</th>
    </tr>
    <tr>
        <th class="text-center" colspan="10">วิทยาลัยเทคนิคชลบุรี</th>
    </tr>
    <tr>
        <th colspan="2">ระดับชั้น <?php echo  $rowGetG["student_group_short_name"];?></th>
    </tr>
</table>
<table class="table" style="width:100%" border='1'>
    <thead>
        <tr>
            <th width="50px">ที่</th>
            <th class="text-center" width="130px">เลขประจำตัวประชาชน<br>ของนักเรียน/นักศึกษา
            </th>
            <th>ชื่อ-สกุล นักเรียน/นักศึกษา</th>
            <th>ชื่อผู้ปกครองนักเรียน<div>ที่รับเงินช่วยเหลือ</div>
            </th>
            <!-- <th width="100px">ความสัมพันธ์กับนักเรียน<div>(บิดา มารดา ตา ยาย ฯลฯ)</div> -->
            <th width="100px">ความสัมพันธ์<div>กับนักเรียน</div>
            </th>
            <th class="text-center">
                <table class="table" style="width:100%" border='1'>
                    <tr>
                        <th colspan="4">วิธีการจ่ายเงิน</th>
                    </tr>
                    <tr>
                        <th colspan="2">เงินสด</th>
                        <th colspan="2">โอนเข้าบัญชีเงินฝาก</th>
                    </tr>
                    <tr>
                        <th>ผู้ปกครอง</th>
                        <th>นักเรียน</th>
                        <th>ผู้ปกครอง</th>
                        <th>นักเรียน</th>
                    </tr>
                </table>
            </th>
            <th class="text-center">หมายเหตุ</th>
        </tr>



    </thead>
    <tbody>
        <?php

        $sqlLimit = "select e.*,p.people_name,p.people_surname 
        from 
        enroll e,
        student_group g,
        people p
        where e.group_id = g.student_group_id
        and p.people_id = g.teacher_id1
        and e.group_id = '$group_id'
        and e.status = 'พิมพ์แล้ว' limit $page,20";
        // $sqlLimit = "select e.*,p.people_name,p.people_surname 
        // from 
        // enroll e,
        // student_group g,
        // people p
        // where e.group_id = g.student_group_id
        // and p.people_id = g.teacher_id1
        // and e.group_id = '$group_id'
        // ";
        $res = mysqli_query($conn, $sqlLimit);
        while ($row = mysqli_fetch_array($res)) {
            $teachName = $row["people_name"] . " " . $row["people_surname"];
        ?>
            <tr>
                <td><?php echo ++$count; ?></td>
                <td><?php echo "" . $row["people_id"]; ?></td>
                <td><?php echo $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                <td><?php echo $row["recipient_prefix"] . $row["recipient_fname"] . " " . $row["recipient_lname"]; ?></td>
                <td><?php echo $row["recipient"]; ?></td>
                <td>
                    <table border="1">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<table width="100%">
    <tr>
        <td class="text-center" colspan="4">
            <div><strong>ตรวจสอบแล้วถูกต้อง</strong></div>
            <br>
            <div>ลงชื่อ....................................................</div>
            <div>(<?php echo $teachName; ?>)</div>
            <div>อาจารย์ที่ปรึกษา</div>
            <div>วันที่..............เดือน..................................พ.ศ.2564</div>
        </td>
        <td class="text-center" colspan="6">
            <div><strong>รับรองขอมูลถูกต้อง</strong></div>
            <br>
            <div class="m-t">ลงชื่อ....................................................</div>
            <div>(นายนิทัศน์ วีระโพธิ์ประสิทธิ์)</div>
            <div>ผู้อำนวยการสถานศึกษา</div>
            <div>วันที่..............เดือน..................................พ.ศ.2564</div>
        </td>
    </tr>
</table>
<div class="page"></div>
<?php }
