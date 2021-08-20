<?php
require_once "connect.php";
session_start();
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
$student_id = $_POST["student_id"];
$prefix_name = $_POST["prefix_name"];
$people_id = $_POST["people_id"];
$stu_fname = $_POST["stu_fname"];
$stu_lname = $_POST["stu_lname"];
$group_id = $_POST["group_id"];
$major_name = $_POST["major_name"];
$minor_name = $_POST["minor_name"];
$grade_name = $_POST["grade_name"];
$student_group_no = $_POST["student_group_no"];
$recipient = $_POST["recipient"];
$recipient_fname = $_POST["recipient_fname"];
$recipient_lname = $_POST["recipient_lname"];
$recipient_bank = $_POST["recipient_bank"];
$recipient_bank_number = $_POST["recipient_bank_number"];
$student_group_short_name = $_POST["student_group_short_name"];
$phone = $_POST["phone"];

$sqlPay = "select * from pay where grade_name = '$grade_name'";
$resPay = mysqli_query($conn, $sqlPay);
$rowPay = mysqli_fetch_array($resPay);
$pay = $rowPay["id"];
$sqlCheck = "SELECT status
FROM   enroll 
WHERE student_id = '$student_id'
ORDER  BY time_stamp DESC
LIMIT  1;";
$resCheck = mysqli_query($conn, $sqlCheck);
$rowcount = mysqli_num_rows($resCheck);
if ($rowcount == 0) {
    date_default_timezone_set("Asia/Bangkok");
    $nameDate = date("YmdHis");
    $target_dir = "uploads/";
    $id_card_pic_std =  "id_card_pic_std" . $student_id . "_" . $nameDate . ".jpg";
    $target_file_id_card_pic_std = $target_dir . $id_card_pic_std;
    $id_card_pic = "id_card_pic_" . $student_id . "_" . $nameDate . ".jpg";
    $target_file_id_card_pic = $target_dir . $id_card_pic;
    $account_book_pic =  "account_book_pic_" . $student_id . "_" . $nameDate . ".jpg";
    $target_file_account_book_pic = $target_dir . $account_book_pic;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file_id_card_pic, PATHINFO_EXTENSION));
    $folderPath = "uploads/signature/";

    $image_parts = explode(";base64,", $_POST['signed']);

    $image_type_aux = explode("image/", $image_parts[0]);

    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);

    $file = $folderPath . $student_id . "_" . $nameDate . '.' . $image_type;
    $stu_signature = $student_id . "_" . $nameDate . '.' . $image_type;
    file_put_contents($file, $image_base64);


    $image_parts_parent = explode(";base64,", $_POST['signed2']);

    $image_type_aux_parent = explode("image/", $image_parts_parent[0]);

    $image_type_parent = $image_type_aux_parent[1];

    $image_base64_parent = base64_decode($image_parts_parent[1]);

    $file_parent = $folderPath . $student_id . "P_" . $nameDate . '.' . $image_type_parent;
    $stu_signature_parent = $student_id . "P_" . $nameDate . '.' . $image_type_parent;
    file_put_contents($file_parent, $image_base64_parent);

    $check = getimagesize($_FILES["id_card_pic_std"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    $check = getimagesize($_FILES["id_card_pic"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    $check = getimagesize($_FILES["account_book_pic"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["id_card_pic_std"]["tmp_name"], $target_file_id_card_pic_std)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        if (move_uploaded_file($_FILES["id_card_pic"]["tmp_name"], $target_file_id_card_pic)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        if (move_uploaded_file($_FILES["account_book_pic"]["tmp_name"], $target_file_account_book_pic)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        //base64
        // $id_card_pic_std = $_POST["id_card_pic_std_h"];
        // $id_card_pic = $_POST["id_card_pic_h"];
        // $account_book_pic = $_POST["account_book_pic_h"];

     
            $folderPath = "uploads/";
            $image_parts = explode(";base64,", $_POST["id_card_pic_std_h"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $student_id . "std_" . $nameDate . '.' . $image_type;
            $id_card_pic_std = $student_id . "std_" . $nameDate . '.' . $image_type;
            file_put_contents($file, $image_base64);
        
            $folderPath = "uploads/";
            $image_parts = explode(";base64,", $_POST["id_card_pic_h"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $student_id . "p_" . $nameDate . '.' . $image_type;
            $id_card_pic = $student_id . "p_" . $nameDate . '.' . $image_type;
            file_put_contents($file, $image_base64);

            $folderPath = "uploads/";
            $image_parts = explode(";base64,", $_POST["account_book_pic_h"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $student_id . "ab_" . $nameDate . '.' . $image_type;
            $account_book_pic = $student_id . "ab_" . $nameDate . '.' . $image_type;
            file_put_contents($file, $image_base64);
        
        $sql = "insert into enroll 
    (
        people_id,
        student_id,
        prefix_name,
        stu_fname,
        stu_lname,
        group_id,
        student_group_no,
        major_name,
        minor_name,
        grade_name,
        student_group_short_name,
        stu_signature,
        parent_signature,
        id_card_pic_std,
        id_card_pic,
        account_book_pic,
        status,
        recipient,
        recipient_fname,
        recipient_lname,
        recipient_bank,
        recipient_bank_number,
        pay_id,
        phone

    ) values(
        '$people_id',
        '$student_id',
        '$prefix_name',
        '$stu_fname',
        '$stu_lname',
        '$group_id',
        '$student_group_no',
        '$major_name',
        '$minor_name',
        '$grade_name',
        '$student_group_short_name',
        '$stu_signature',
        '$stu_signature_parent',
        '$id_card_pic_std',
        '$id_card_pic',
        '$account_book_pic',
        'ลงทะเบียนสำเร็จ',
        '$recipient',
        '$recipient_fname',
        '$recipient_lname',
        '$recipient_bank',
        '$recipient_bank_number',
        '$pay',
        '$phone'
    );
    ";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("location: listEnroll_std.php");
        } else {
            echo $sql;
        }
    }
} else {
    $rowCheck = mysqli_fetch_array($resCheck);
    if ($rowCheck["status"] == "ยกเลิก") {
        date_default_timezone_set("Asia/Bangkok");
        $nameDate = date("YmdHis");
        $target_dir = "uploads/";
        $id_card_pic_std =  "id_card_pic_std" . $student_id . "_" . $nameDate . ".jpg";
        $target_file_id_card_pic_std = $target_dir . $id_card_pic_std;
        $id_card_pic = "id_card_pic_" . $student_id . "_" . $nameDate . ".jpg";
        $target_file_id_card_pic = $target_dir . $id_card_pic;
        $account_book_pic =  "account_book_pic_" . $student_id . "_" . $nameDate . ".jpg";
        $target_file_account_book_pic = $target_dir . $account_book_pic;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file_id_card_pic, PATHINFO_EXTENSION));
        $folderPath = "uploads/signature/";

        $image_parts = explode(";base64,", $_POST['signed']);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . $student_id . "_" . $nameDate . '.' . $image_type;
        $stu_signature = $student_id . "_" . $nameDate . '.' . $image_type;
        file_put_contents($file, $image_base64);

        $image_parts_parent = explode(";base64,", $_POST['signed2']);

        $image_type_aux_parent = explode("image/", $image_parts_parent[0]);
    
        $image_type_parent = $image_type_aux_parent[1];
    
        $image_base64_parent = base64_decode($image_parts_parent[1]);
    
        $file_parent = $folderPath . $student_id . "P_" . $nameDate . '.' . $image_type_parent;
        $stu_signature_parent = $student_id . "P_" . $nameDate . '.' . $image_type_parent;
        file_put_contents($file_parent, $image_base64_parent);
        
        $check = getimagesize($_FILES["id_card_pic_std"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        $check = getimagesize($_FILES["id_card_pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        $check = getimagesize($_FILES["account_book_pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["id_card_pic_std"]["tmp_name"], $target_file_id_card_pic_std)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["id_card_pic"]["tmp_name"], $target_file_id_card_pic)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            if (move_uploaded_file($_FILES["account_book_pic"]["tmp_name"], $target_file_account_book_pic)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            //base64
            // $id_card_pic_std = $_POST["id_card_pic_std_h"];
            // $id_card_pic = $_POST["id_card_pic_h"];
            // $account_book_pic = $_POST["account_book_pic_h"];

            $folderPath = "uploads/";
            $image_parts = explode(";base64,", $_POST["id_card_pic_std_h"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $student_id . "std_" . $nameDate . '.' . $image_type;
            $id_card_pic_std = $student_id . "std_" . $nameDate . '.' . $image_type;
            file_put_contents($file, $image_base64);
        
            $folderPath = "uploads/";
            $image_parts = explode(";base64,", $_POST["id_card_pic_h"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $student_id . "p_" . $nameDate . '.' . $image_type;
            $id_card_pic = $student_id . "p_" . $nameDate . '.' . $image_type;
            file_put_contents($file, $image_base64);

            $folderPath = "uploads/";
            $image_parts = explode(";base64,", $_POST["account_book_pic_h"]);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $student_id . "ap_" . $nameDate . '.' . $image_type;
            $account_book_pic = $student_id . "ap_" . $nameDate . '.' . $image_type;
            file_put_contents($file, $image_base64);
            $sql = "insert into enroll 
        (
            people_id,
            student_id,
            prefix_name,
            stu_fname,
            stu_lname,
            group_id,
            student_group_no,
            major_name,
            minor_name,
            grade_name,
            student_group_short_name,
            stu_signature,
            parent_signature,
            id_card_pic_std,
            id_card_pic,
            account_book_pic,
            status,
            recipient,
            recipient_fname,
            recipient_lname,
            recipient_bank,
            recipient_bank_number,
            pay_id,
            phone
    
        ) values(
            '$people_id',
            '$student_id',
            '$prefix_name',
            '$stu_fname',
            '$stu_lname',
            '$group_id',
            '$student_group_no',
            '$major_name',
            '$minor_name',
            '$grade_name',
            '$student_group_short_name',
            '$stu_signature',
            '$stu_signature_parent',
            '$id_card_pic_std',
            '$id_card_pic',
            '$account_book_pic',
            'ลงทะเบียนสำเร็จ',
            '$recipient',
            '$recipient_fname',
            '$recipient_lname',
            '$recipient_bank',
            '$recipient_bank_number',
            '$pay',
            '$phone'
        );
        ";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                header("location: listEnroll_std.php");
            } else {
                echo $sql;
            }
        }
    } else {
        header("location: pageError.php?text_err=ท่านลงทะเบียนเรียบร้อยแล้ว");
    }
}
