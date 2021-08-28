<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set("Asia/Bangkok");
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
require_once "connect.php";

if (isset($_POST['level'])){
    $level=$_POST['level'];
    $_SESSION['level']=$level;
}
$student_all='2405';
?>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container ">
            
            <!-- <div class="card"> -->
                <h3>สรุปการส่งข้อมูล  วันที่ <?php echo chDay(date("Y-m-d"));?> &nbsp; เวลา <?php echo date("H:i")?> น.</h3>
                
                <div class="row justify-content-center" style="margin:auto">
                    <div class="card bg-primary" style="width:200px">
                        <div class="card-header text-white">จำนวนที่ส่งข้อมูล</div>
                        <div class="card-body text-white text-center"><?php echo $s1=get_all_sent()?> 
                        &nbsp;&nbsp;(<?php echo number_format($s1/$student_all*100,2) ?> %)
                        </div>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="card bg-warning" style="width:230px">
                        <div class="card-header ">จำนวนข้อมูล ไม่ถูกต้อง</div>
                        <div class="card-body text-white text-center"><?php echo $s2=get_no()?></div>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="card bg-success" style="width:200px">
                        <div class="card-header text-white text-center">จำนวนที่พิมพ์แล้ว</div>
                        <div class="card-body text-white text-center"><?php echo $s3=get_print()?>
                        &nbsp;&nbsp;(<?php echo number_format($s3/$student_all*100,2) ?> %)
                        </div>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="card bg-info" style="width:200px">
                        <div class="card-header text-white text-center">จำนวนที่รอตรวจ</div>
                        <div class="card-body text-white text-center"><?php echo $s1-$s2-$s3?></div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-2">
                                <label style="display:block; text-align: right;">เลือกระดับชั้น:</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="level" id="">
                                    <?php
                                    $a1='';$a2='';$a3='';$a4='';$a5='';
                                    if (isset($_SESSION['level'])){
                                        if ($_SESSION['level']=='642')
                                            $a1="selected";
                                        elseif ($_SESSION['level']=='632')
                                            $a2="selected";
                                        elseif ($_SESSION['level']=='622')
                                            $a3="selected";
                                        elseif ($_SESSION['level']=='643')
                                            $a4="selected";
                                        elseif ($_SESSION['level']=='633')
                                            $a5="selected";
                                        elseif ($_SESSION['level']=='623')
                                            $a6="selected"; 
                                        elseif ($_SESSION['level']=='612')
                                            $a7="selected";   
                                        elseif ($_SESSION['level']=='602')
                                            $a8="selected";
                                        elseif ($_SESSION['level']=='592')
                                            $a9="selected";
                                        elseif ($_SESSION['level']=='613')
                                            $a9="selected";
                                    }
                                    ?>
                                    <option value="">--เลือกระดับชั้น--</option>
                                    <option value="642" <?php echo $a1?>>ปวช.1</option>
                                    <option value="632" <?php echo $a2?>>ปวช.2</option>
                                    <option value="622" <?php echo $a3?>>ปวช.3</option>
                                    <option value="612" <?php echo $a7?>>ปวช.3 ตกค้าง (รหัส 61) </option>
                                    <option value="602" <?php echo $a8?>>ปวช.3 ตกค้าง (รหัส 60) </option>
                                    <option value="592" <?php echo $a9?>>ปวช.3 ตกค้าง (รหัส 59) </option>
                                    <option value="643" <?php echo $a4?>>ปวส.1</option>
                                    <option value="633" <?php echo $a5?>>ปวส.2</option>
                                    <option value="623" <?php echo $a6?>>ปวส.2 ตกค้าง+ปวส.3  (รหัส 62) </option>
                                    <option value="613" <?php echo $a10?>>ปวส.2 ตกค้าง (รหัส 61) </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary"> OK </button>
                            </div>
                        </div>
                        
                        
                        <br>
                        
                    </form>
                </div>
                <?php
                if (isset($_SESSION['level'])){
                    $level=$_SESSION['level'];
                
                    $sql="SELECT stdg.`student_group_short_name` as name ,sg.group_name,stdg.`teacher_id1`
                    FROM `student_group` stdg
                    INNER JOIN std_group sg on sg.group_id=stdg.`student_group_id`
                    where substr(stdg.`student_group_id`,1,3) = '$level'
                    ORDER by stdg.`student_group_id`";


                    $res=mysqli_query($conn, $sql);
                    ?>
                
                    <table class="table">
                        <thead>
                            <!-- <tr>
                                <th colspan=6>ระดับ <?php echo $level ?></th>
                            </tr> -->
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
                                <td class="text-center"><?php echo $csum[]=count_sum($level,$row['name'])?></td>
                                <td class="text-center"><?php echo $csent[]=status_sent($level,$row['name'])?></td>
                                <td class="text-center"><?php echo $cprint[]=status_print($level,$row['name'])?></td>
                                <td></td>
                            </tr>
                            <?php
                            }
                            ?>    
                        
                    <?php
                }
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
function get_all_sent(){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` where `status`!='ยกเลิก' ";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function get_no(){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` where `status` LIKE 'เอกสารไม่ถูกต้องสมบูรณ์'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function get_print(){
    global $conn;
    $sql="SELECT count(*) as c FROM `enroll` where `status` LIKE 'พิมพ์แล้ว'";
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

function count_sum($level,$s){
    global $conn;
    $id=$level."%";
    $sql="SELECT count(*) as c FROM `student` 
    INNER JOIN std_group on student.group_id=std_group.group_id
    WHERE `group_shortname` = '$s'
    and `status`='0' and `student_id` like '$id' ";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function status_sent($level,$s){
    global $conn;
    $id=$level."%";
    $sql="SELECT count(*) as c FROM `enroll` where `status`!='ยกเลิก' 
    AND `student_group_short_name`='$s' and `student_id` like '$id' ";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}

function status_print($level,$s){
    global $conn;
    $id=$level."%";
    $sql="SELECT count(*) as c FROM `enroll` where `status`='พิมพ์แล้ว' 
    AND `student_group_short_name`='$s' and `student_id` like '$id'";
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

