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
$id = $_REQUEST["id"];
$sql = "select * from enroll where id ='$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
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

        .text-size {
            font-size: 20px;
        }

        .text-right {
            text-align: right;
        }

        .content {
            padding: 24px;

        }

        .txt-right {
            text-align: right;
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
            /* border: 1px solid black; */
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

        .mr {
            margin-right: 20px;
        }

        .width-sig {
            margin-left: 40%;
        }

        .tab {
            margin-left: 10%;
        }

        .m-r {
            margin-right: 15%;
        }

        .m-r-n {
            margin-right: 12%;
        }

        .sig-size {
            width: 75px;
            height: 30px;
        }
    </style>
</head>

<body>
    <h2 class="center">วิทยาลัยเทคนิคชลบุรี</h2>
    <div class="center text-size">หลักฐานการรับเงินเยียวยาที่ได้รับผลกระทบจากสถานการณ์การระบาดของโรคติดเชื้อไวรัสโคโรน่า 2019</div>
    <div class="text-size">1.สำเนาบัตรประชาชนของนักเรียน/นักศึกษา หมายเลขโทรศัพท์  <?php echo $row["phone"]; ?></div>
    <div class="text-size txt-right">ชั้น/ช่าง <?php echo $row["student_group_short_name"]; ?> รหัส <?php echo $row["student_id"]; ?></div>
    <div class="center"><img src="uploads/<?php echo $row["id_card_pic_std"]; ?>" alt="" height="135" width="275"></div>
    <div class="text-size center">สำเนาถูกต้อง</div>
    <div class="text-size width-sig">ลงชื่อ<img class="sig-size" src="uploads/signature/<?php echo $row["stu_signature"]; ?>" width="75px" height="30px"></div>
    <div class="text-size center">(<?php echo $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"]; ?>)</div>
    <div class="text-size">2.สำเนาบัตรประชาชน<?php echo $row["recipient"];?></div>
    <div class="center"><img src="uploads/<?php echo $row["id_card_pic"]; ?>" alt="" height="135" width="275"></div>
    <div class="text-size center">สำเนาถูกต้อง</div>
    <div class="text-size width-sig">ลงชื่อ <img class="sig-size" src="uploads/signature/<?php echo $row["parent_signature"]; ?>" width="75px" height="30px"></div>
    <div class="text-size center">(<?php echo $row["recipient_fname"] . " " . $row["recipient_lname"]; ?>)</div>
    <div class="text-size">3.เลขบัญชีธนาคารของ<?php echo $row["recipient"];?>โดยถ่ายหน้าบัญชีธนาคาร หมายเลขบัญชี <?php echo $row["recipient_bank_number"];?></div>
    <div class="center"><img src="uploads/<?php echo $row["account_book_pic"]; ?>" alt="" height="135" width="275"></div>
    <div class="text-size tab">ขอรับรองว่าเป็น<?php echo $row["recipient"];?>ของ <?php echo $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"]; ?></div>
    <div class="text-size">ได้รับเงินช่วยเหลือจากรัฐบาล จำนวน 2,000 บาท เรียบร้อยแล้ว</div>
    <table>
        <tr class="txt-right text-size ">
            <td>ลงชื่อ  <img class="sig-size" src="uploads/signature/<?php echo $row["parent_signature"]; ?>">  ผู้รับเงิน</td>
        </tr>
        <tr>
            <td class="text-size center">(<?php echo $row["recipient_fname"] . " " . $row["recipient_lname"]; ?>)</td>
        </tr>
        <tr>
            <td class="text-size center">วันที่................................................</td>
        </tr>
    </table>
    <!-- <div class="text-size">หมายเหตุ : โดยให้<?php //echo $row["recipient"];?>นักเรียน/นักศึกษาเป็นผู้รับผิดชอบค่าธรรมเนียมในการโอนเงินฝากธนาคาร</div> -->




</body>

</html>
<?php
$html = ob_get_contents();
// $mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$taget = "pdf/" . $id . "_report2.pdf";
$mpdf->Output($taget);
ob_end_flush();
echo "<script>window.location.href='$taget';</script>";
exit;
?>