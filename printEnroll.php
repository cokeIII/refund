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
$schoolYear = $term . "/" . $Y;
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
$sql = "select * from enroll where id='$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
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
            border: 0px solid black;
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
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="35%"><strong>รหัสนักศึกษา</strong> <?php echo $row["student_id"]; ?></td>
            <td width="65%"><strong>รหัสกลุ่ม</strong> <?php echo $row["group_id"]; ?></td>
        </tr>
        <tr>
            <td><strong>รหัสบัตรประชาชน</strong> <?php echo $row["people_id"]; ?></td>
            <td><strong>สาขาวิชา</strong> <?php echo $row["major_name"]; ?></td>
        </tr>
        <tr>
            <td><strong>ชื่อ - สกุล</strong> <?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
            <td><strong>สาขางาน</strong> <?php echo $row["minor_name"] . " (" . $row["grade_name"] . " (" . $row["student_group_short_name"] . ")" . ")"; ?></td>
        </tr>

    </table>
    <table>
        <tr>
            <td width="100%">
                <br>
                <img src="uploads/<?php echo $row["id_card_pic"]; ?>" alt="" height="330px">
            </td>
        </tr>
        <tr>
            <td width="100%">
                <br>
                <img src="uploads/<?php echo $row["account_book_pic"]; ?>" alt="" height="350px">
            </td>
        </tr>
        <tr>
            <td class="center">
                <div>ลงชื่อนักศึกษา</div>
            </td>
        </tr>
        <tr>
            <td width="100%" align="center">
                <img src="uploads/signature/<?php echo $row["stu_signature"]; ?>" height="50px" alt="">
            </td>
        </tr>
        <tr>
            <td width="100%" class="center">
                <P class="txt-h"><?php echo "(" . $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"] . ")"; ?></P>
            </td>
        </tr>
        <tr>
            <td width="100%" class="center">
                <P class="txt-h"><?php echo DateThai($dateD); ?></P>
            </td>
        </tr>
    </table>
</body>

</html>

<?php
$html = ob_get_contents();
// $mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$taget = "pdf/" . $row["student_id"] . ".pdf";
$mpdf->Output($taget);
ob_end_flush();
echo "<script>window.location.href='$taget';</script>";
exit;
?>