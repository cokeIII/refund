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
$sql = "select * from enroll e, pay p where e.id ='$id' and e.pay_id = p.id";
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

        .text-size2 {
            font-size: 19px;
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

        .w-100 {
            width: 100%;
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

        .m-t-5 {
            margin-top: -8px;
        }

        .m-t-18 {
            margin-top: -18px;
        }

        .m-l {
            margin-left: 30px;
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
    <div class="center text-size"><strong>วิทยาลัยเทคนิคชลบุรี</strong></div>
    <div class="center text-size2 w-100">หลักฐานการรับเงินตามประกาศวิทยาลัยเทคนิคชลบุรี เรื่องการคืนเงินบำรุงการศึกษาในสถานศึกษา ค่าธรรมเนียมการเรียนและค่าธรรมเนียมอื่นในสถานศึกษา</div>
    <!-- <div class="center text-size">ในสถานศึกษา ค่าธรรมเนียมการเรียนและค่าธรรมเนียมอื่นในสถานศึกษา</div> -->
    <div class="center text-size">ประกาศ วันที่ 21 กรกฎาคม 2564</div>

    <div class="text-size">1.สำเนาบัตรประชาชนของนักเรียน/นักศึกษา หมายเลขโทรศัพท์ <?php echo $row["phone"]; ?> ชั้น/ช่าง <?php echo $row["student_group_short_name"]; ?> รหัส <?php echo $row["student_id"]; ?></div>
    <!-- <div class="text-size txt-right">ชั้น/ช่าง <?php //echo $row["student_group_short_name"]; 
                                                    ?> รหัส <?php //echo $row["student_id"]; 
                                                            ?></div> -->
    <div class="center"><img src="uploads/<?php echo $row["id_card_pic_std"]; ?>" alt="" height="131" width="271"></div>
    <div class="text-size center">สำเนาถูกต้อง</div>
    <div class="text-size width-sig">ลงชื่อ<img class="sig-size" src="uploads/signature/<?php echo $row["stu_signature"]; ?>" width="75px" height="30px"></div>
    <div class="text-size center">(<?php echo $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"]; ?>)</div>
    <div class="text-size">2.สำเนาบัตรประชาชน<?php echo $row["recipient"]; ?></div>
    <div class="center m-t-18"><img src="uploads/<?php echo $row["id_card_pic"]; ?>" alt="" height="131" width="++271"></div>
    <div class="text-size center">สำเนาถูกต้อง</div>
    <div class="text-size width-sig">ลงชื่อ <img class="sig-size" src="uploads/signature/<?php echo $row["parent_signature"]; ?>" width="75px" height="30px"></div>
    <div class="text-size center">(<?php echo trim($row["recipient_prefix"]) . $row["recipient_fname"] . " " . $row["recipient_lname"]; ?>)</div>
    <div class="text-size m-t-5">3.เลขบัญชีธนาคารของ<?php echo $row["recipient"]; ?>โดยถ่ายหน้าบัญชี<?php echo $row["recipient_bank"]; ?> หมายเลขบัญชี <?php echo $row["recipient_bank_number"]; ?></div>
    <div class="center"><img src="uploads/<?php echo $row["account_book_pic"]; ?>" alt="" height="131" width="271"></div>
    <div class="text-size tab">ขอรับรองว่าเป็น<?php echo $row["recipient"]; ?>ของ <?php echo $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"]; ?></div>
    <div class="text-size m-t-5">ได้รับเงินตามประกาศวิทยาลัยเทคนิคชลบุรี จำนวน <?php echo $row["pay2"]; ?> บาทเรียบร้อยแล้ว</div>
    <table width="100%">
        <tr class="txt-right text-size2 ">
            <td width="50%" class="center text-size2 m-l">
                <div>ลงชื่อ <img class="sig-size" src="uploads/signature/<?php echo $row["parent_signature"]; ?>"> ผู้รับเงิน</div>
                <div>(<?php echo trim($row["recipient_prefix"]) . $row["recipient_fname"] . " " . $row["recipient_lname"]; ?>)</div>
                <div>วันที่................................................</div>
            </td>
            <td class="text-size center">
                <div>ลงชื่อ................................................ผู้จ่ายเงิน</div>
                <div>(นางกรรณิการ์ บำรุงญาติ)</div>
                <div>หัวหน้างานการเงิน</div>
                <div>วันที่................................................</div>
            </td>
        </tr>
        <!-- <tr> -->
        <!-- <td width="50%" class="text-size2 center">(<?php //echo trim($row["recipient_prefix"]).$row["recipient_fname"] . " " . $row["recipient_lname"]; 
                                                        ?>)</td> -->
        <!-- <td class="text-size2 center"><div>(นางกรรณิการ์ บำรุงญาติ)</div><div>หัวหน้างานการเงิน</div> -->
        <!-- </td> -->
        <!-- </tr> -->
        <!-- <tr>
            <td width="50%" class="text-size2 center">วันที่................................................</td>
            <td class="text-size2 center">วันที่................................................</td>
        </tr> -->
        <!-- <tr width="100% text-size2">
            <td class="center" width="100%" colspan="2">
                <br>
                <div>ลงชื่อ................................................</div>
                <div>(นายอำนวย เหิมขุนทด)</div>
                <div>รองผู้อำนวยการ ฝ่ายบริหารทรัพยากร</div>
            </td>
        </tr> -->
    </table>
    <div class="center text-size2">
        <div>ลงชื่อ................................................</div>
        <div>(นายอำนวย เหิมขุนทด)</div>
        <div>รองผู้อำนวยการฝ่ายบริหารทรัพยากร</div>
    </div>
    <br>

    <!-- <div class="text-size">หมายเหตุ : โดยให้<?php //echo $row["recipient"];
                                                    ?>นักเรียน/นักศึกษาเป็นผู้รับผิดชอบค่าธรรมเนียมในการโอนเงินฝากธนาคาร</div> -->
</body>

</html>
<?php
$html = ob_get_contents();
// $mpdf->AddPage('L');
$mpdf->WriteHTML($html);
$taget = "pdf/" . $id . "_report4.pdf";
$mpdf->Output($taget);
ob_end_flush();
echo "<script>window.location.href='$taget';</script>";
exit;

function getPrice()
{
}
?>