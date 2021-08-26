<?php
header('Content-Type: text/html; charset=UTF-8');
require_once "connect.php";

$sql = "select status,student_id from enroll";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    // $student_id = $row["student_id"];
    // $sqlStd = "select student_id from student where student_id = '$student_id'";
    // $resSql = mysqli_query($conn,$sqlStd);
    // $rowcount=mysqli_num_rows($resSql);
    // if($rowcount <= 0 )
    // echo  $student_id;
    //////////////////////////////////////

    // if($row["status"] == "พิมพ์แล้ว" || $row["status"] == "ส่งเอกสารแล้ว"){
    //     $student_id = $row["student_id"];
    //     $sqlCheck = "select status,id from enroll where status = 'เอกสารไม่ถูกต้องสมบูรณ์' and student_id = '$student_id'";
    //     $resCheck = mysqli_query($conn,$sqlCheck);
    //     while($rowCheck = mysqli_fetch_array($resCheck)){
    //         $id = $rowCheck["id"];
    //         $sqlUp = "update enroll set status = 'ยกเลิก' where id='$id'";
    //         $resUP = mysqli_query($conn,$sqlUp);
    //         if($resUP)
    //             echo "ok";
    //     }
    // }
    // if($row["status"] == "ส่งเอกสารแล้ว"){
    //     $student_id = $row["student_id"];
    //     $sqlCheck = "select status,id from enroll where status = 'ส่งเอกสารแล้ว' and student_id = '$student_id' order by id";
    //     $resCheck = mysqli_query($conn,$sqlCheck);
    //     $i = 0;
    //     while($rowCheck = mysqli_fetch_array($resCheck)){
    //         $id = $rowCheck["id"];
    //         echo $id."<br>";
    //         if($i > 0){
    //             $sqlUp = "update enroll set status = 'ยกเลิก' where id='$id'";
    //             $resUP = mysqli_query($conn,$sqlUp);
    //             if($resUP)
    //                 echo "ok";
    //         }
    //         $i++;
    //     }
    //     echo "---------------------<br>";
    // }
        if($row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์"){
        $student_id = $row["student_id"];
        $sqlCheck = "select status,id from enroll where status = 'เอกสารไม่ถูกต้องสมบูรณ์' and student_id = '$student_id' order by id DESC";
        $resCheck = mysqli_query($conn,$sqlCheck);
        $i = 0;
        while($rowCheck = mysqli_fetch_array($resCheck)){
            $id = $rowCheck["id"];
            echo $id."<br>";
            if($i > 0){
                $sqlUp = "update enroll set status = 'ยกเลิก' where id='$id'";
                $resUP = mysqli_query($conn,$sqlUp);
                if($resUP)
                    echo "ok";
            }
            $i++;
        }
        echo "---------------------<br>";
    }


}
