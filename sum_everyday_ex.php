<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set("Asia/Bangkok");
// require_once "setHead.php";
// if (empty($_SESSION["user_status"])) {
//     header("location: index.php");
// }
require_once "connect.php";
header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=export_02.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
$student_all='2409';
?>

<body id="page-top">
    <!-- Navigation-->
    <div class="masthead">
        <div class="container ">
            
            <!-- <div class="card"> -->
                <h3>สรุปการส่งข้อมูล  วันที่ <?php echo chDay(date("Y-m-d"));?> &nbsp; เวลา <?php echo date("H:i")?> น.</h3>
                
                
                
                <?php
                

                
                    $sql="SELECT stdg.`student_group_short_name` as name ,sg.group_name,stdg.`teacher_id1`
                    FROM `student_group` stdg
                    INNER JOIN std_group sg on sg.group_id=stdg.`student_group_id`
                    where stdg.`student_group_id` !='632090103' and stdg.`student_group_id` !='632090104'
                    and stdg.`student_group_id` not LIKE '62202%'
                    ORDER by stdg.`student_group_id`";


                    $res=mysqli_query($conn, $sql);
                    ?>
                
                    <table class="table" border=1>
                        <thead>
                            <tr>
                                <th>ที่</th>
                                <th>รหัสกลุ่ม</th>
                                <th>ชื่อกลุ่ม</th>
                                <th>ชื่อครูที่ปรึกษา</th>
                                <th class="text-center">จำนวนนักเรียนทั้งหมด</th>
                                <th class="text-center">ส่งเอกสาร</th>
                                <th class="text-center">พิมพ์แล้ว</th>
                                <th>ส่ง SMS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter=1;
                            while ($row = mysqli_fetch_array($res)){
                            ?>
                            <tr>
                                <td><?php echo $counter++?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['group_name']?></td>
                                <td><?php echo get_teacher_name($row['teacher_id1'])?></td>
                                <td class="text-center"><?php echo $csum[]=count_sum($row['name'])?></td>
                                <td class="text-center"><?php echo $csent[]=status_sent($row['name'])?></td>
                                <td class="text-center"><?php echo $cprint[]=status_print($row['name'])?></td>
                                <td></td>
                            </tr>
                            <?php
                            }
                            ?>    
                        
                    <?php
           
                if (is_array($csum)){
                ?>   
                    <tr class="bg-info">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center"><?php echo Array_sum($csum)?></td>
                        <td class="text-center"><?php echo Array_sum($csent)?></td>
                        <td class="text-center"><?php echo Array_sum($cprint)?></td>
                    </tr>  
                    <?php
                }
                ?>                      
                    </tbody>
                </table>



                </div>
            <!-- </div> -->
        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {






    })
</script>
<?php
//ส่งทั้งหมด  เอา ทวิศึกษา ออก
function get_all_sent(){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` 
    INNER JOIN student on student.student_id=enroll.student_id
    where enroll.`status`!='ยกเลิก'
    and student.status='0'
    and student.group_id != '632090103' and student.group_id !='632090104'
    and student.group_id not LIKE '62202%'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}
//เอกสารไม่ถูกต้อง เอา ทวิศึกษา ออก
function get_no(){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` 
    INNER JOIN student on student.student_id=enroll.student_id
    where enroll.`status` LIKE 'เอกสารไม่ถูกต้องสมบูรณ์'
    and student.group_id != '632090103' and student.group_id !='632090104'
    and student.group_id not LIKE '62202%'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}
//พิมพ์แล้วเอา ทวิศึกษา ออก
function get_print(){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` 
    INNER JOIN student on student.student_id=enroll.student_id
    where enroll.`status` LIKE 'พิมพ์แล้ว'
    and student.group_id != '632090103' and student.group_id !='632090104'
    and student.group_id not LIKE '62202%'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function get_teacher_name($id){
    global $conn;
    $sql="SELECT concat(`people_name`,'  ',`people_surname`) as name FROM `people` 
    WHERE `people_id`='$id'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['name'];
}

function count_sum($s){
    global $conn;
    $sql="SELECT count(*) as c FROM `student` 
    INNER JOIN std_group on student.group_id=std_group.group_id
    WHERE student.`group_shortname` = '$s'
    and student.`status`='0'  ";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function status_sent($s){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` 
    INNER JOIN student on student.student_id=enroll.student_id
    where enroll.`status`!='ยกเลิก' 
    AND `student_group_short_name`='$s'  ";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function status_print($s){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` 
    INNER JOIN student on student.student_id=enroll.student_id
    where enroll.`status`='พิมพ์แล้ว' 
    AND `student_group_short_name`='$s' ";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

//แปลง 2011-03-08 to 8 มีนาคม 2554
function chDay($s){
	$d=explode("-",$s);
	//print_r($d);
	$arr_month=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน',
                     'กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	$y=$d[0]+543;
	//$da=ins0($d[0]);
    return del0($d[2])." ".$arr_month[$d[1]-1]." ".$y;
}

//ตัดเลข 0 ถ้าไม่ถึง 10 //=== 08 >> 8
function del0($s){
    if ($s<10){
        $r=substr($s,1);
    }else{
        $r=$s;
    }
    return $r;
}

