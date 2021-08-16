<?php
// Require composer autoload
date_default_timezone_set("Asia/Bangkok");
$dates = date("d/m/") . (date("Y") + 543);
$m = date("m");
$Y = date("Y") + 543;
if ($m >= 11) {
    $Y = (date("Y") + 543) - 1;
    $term = 2;
} else if ($m >= 5) {
    $term = 1;
} else {
    $term = 3;
}
$schoolYear = $term . " ปีการศึกษา " . $Y;
$dateD = date("Y-m-d");
session_start();

// if (empty($_SESSION["status"])) {
//     header("location: index.php");
// }

require_once 'vendor/autoload.php';
require_once 'vendor/mpdf/mpdf/mpdf.php';
require_once 'connect.php';
error_reporting(error_reporting() & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);


header('Content-Type: text/html; charset=utf-8');
// เพิ่ม Font ให้กับ mPDF
$mpdf = new mPDF();
date_default_timezone_set("asia/bangkok");
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    // return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    return "$strDay $strMonthThai $strYear";
}
ob_start(); // Start get HTML code
$id = $_GET["id"];
$major_name = $_POST["major_name"];
$grade_name = $_POST["grade_name"];
$student_group_no = $_POST["student_group_no"];
$status = $_POST["status"];
$sql = "select * from enroll,pay p 
where enroll.major_name='$major_name' 
and enroll.grade_name='$grade_name' 
and enroll.student_group_no='$student_group_no' 
and enroll.status='$status' 
and enroll.pay_id = p.id";
$res = mysqli_query($conn, $sql);
echo $sql;
?>


<!DOCTYPE html>
<html>

<head>
    <title>CTC Refund</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/ovec-removebg.ico" />
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "thsarabun";
        }

        .txt-h {
            text-align: center;
        }
        .text-size{
            font-size: 20px;
        }
        .text-right{
            text-align: right;
        }
        .content {
            padding: 24px;

        }

        .txt-bold {
            font-weight: bold;
        }

        .pic-h {
            height: 3in;
        }

        td,
        th {
            font-size: 20px;
            text-align: left;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }

        .center {
            text-align: center;
        }

        .red {
            background-color: red;
        }
        .mr{
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <h2 class="center">ช้อมูลการโอนเงินคืนค่าลงทะเบียน</h2>
    <h2 class="center">ภาคเรียนที่ <?php echo $schoolYear; ?></h2>
    <h2 class="center">วันที่ <?php echo DateThai($dateD); ?></h2>
    <h2 class="center">ระดับชั้น <?php echo $major_name . " " . $grade_name . " กลุ่ม " . $student_group_no; ?></h2>
    <table width="100%">
        <tr>
            <th>ที่</th>
            <th>รหัสนักเรียน</th>
            <th>ชื่อ-สกุล</th>
            <th>ชื่อบัญชี</th>
            <th>เลขที่บัญชี</th>
            <th>ธนาคาร</th>
            <th>ความสัมพันธ์</th>
        </tr>
        <?php $i = 0;
        $pay = 0;
        while ($row = mysqli_fetch_array($res)) { $pay+=$row["pay"];?>
            <tr>
                <td><?php echo ++$i; ?></td>
                <td><?php echo $row["student_id"]; ?></td>
                <td><?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                <td><?php echo $row["recipient_fname"] . " " . $row["recipient_lname"]; ?></td>
                <td><?php echo $row["recipient_bank_number"]; ?></td>
                <td><?php echo $row["recipient_bank"]; ?></td>
                <td><?php echo $row["recipient"]; ?></td>
            
            </tr>
        <?php } ?>
        <tr>
            <td colspan="6">รวมเงิน</td>
            <td><?php echo $pay;?></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <div width="100%" class="text-size text-right">
        <div>(นางกรรณิการ์ บำรุงญาติ)</div>
        <div class="mr">หัวหน้างานการเงิน</div>
    </div>
</body>
</html>
<?php
$html = ob_get_contents();
// $mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$taget = "pdf/report1.pdf";
$mpdf->Output($taget);
ob_end_flush();
echo "<script>window.location.href='$taget';</script>";
exit;
?>