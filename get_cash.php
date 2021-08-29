<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
// if (empty($_SESSION["user_status"])) {
//     header("location: index.php");
// }
require_once "connect.php";
$people_id = $_SESSION["people_id"];
if (isset($_POST['std_code'])){
    $student_name=get_student_name($_POST['std_code']);
    $student_group_name=get_student_group_name($_POST['std_code']);
    $_SESSION['std_id']=$_POST['std_code'];
}
if (isset($_POST['cash'])){
    insert_cash($_SESSION['std_id'],$_POST);
}
?>
<style>
    .f18{
        font-size:18px;
        
        /* background-color:red; */
    }
    .boxcenter{
        font-size:25px;
        left: 30px;
        font-weight: bold;
        
    }
</style>
<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body" >
                    <div class="row mb-8" >
                        <h3>การขอรับเงินโครงการให้ความช่วยเหลือบรรเทาภาระค่าใช้จ่ายด้านการศึกษา เป็นเงินสด</h3>
                        <?php
                        if ($student_name == ''){
                            ?>
                            <form action="" method="post" class="form-inline">
                            <div class="form-group text-center" >
                                <label for="std_code" >รหัสนักเรียน: &nbsp;&nbsp;</label>
                                <input type="number" class="form-control" placeholder="ใส่รหัสนักเรียน" id="std_code" name="std_code">
                            </div>
                            &nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">OK</button>
                            </form>
                            <?php
                        }else{
                            // echo $student_name;
                            ?>
                            <form action="" method="post">
                                <div class="form-inline boxcenter text-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label  >ชื่อนักเรียน: &nbsp;</label>
                                    <label  ><?php echo $student_name;?></label>
                                    <label  > &nbsp;&nbsp; สาขางาน <?php echo $student_group_name;?></label>
                                </div>
                                <br>
                                <div class="form-inline f18">
                                    <label  >วันที่นัดรับเงิน : &nbsp;</label>
                                    <input type="date" name="date" id="" required>
                                    &nbsp;&nbsp;
                                    <label  >เวลานัดรับเงิน : &nbsp;</label>
                                    <select name="time" id="" required>
                                        <option value="">--เลือกช่วงเวลา--</option>
                                        <option value="9:00-9:30">9:00-9:30 น.</option>
                                        <option value="9:30-10:00">9:30-10:00 น.</option>
                                        <option value="10:00-10:30">10:00-10:30 น.</option>
                                        <option value="10:30-11:00">10:30-11:00 น.</option>
                                        <option value="11:00-11:30">11:00-11:30 น.</option>
                                        <option value="11:30-12:00">11:30-12:00 น.</option>
                                        <option value="13:00-13:30">13:00-13:30 น.</option>
                                        <option value="13:30-14:00">13:30-14:00 น.</option>
                                        <option value="14:00-14:30">14:00-14:30 น.</option>
                                        <option value="14:30-15:00">14:30-15:00 น.</option>
                                        <option value="15:00-15:30">15:00-15:30 น.</option>
                                        <option value="15:30-16:00">15:30-16:00 น.</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-inline f18">
                                    <label  >สาเหตุในการขอรับเงินสด เนื่องจาก : &nbsp;</label>
                                    <textarea name="cause" id="" cols="40" rows="1" required></textarea>
                                </div>
                                <br>
                                <div class="form-inline f18">
                                    <label  >เบอร์โทรศัพท์ติดต่อ : &nbsp;</label>
                                    <input type="number" name="tel" id="" required>
                                    &nbsp;&nbsp;
                                    <?php
                                    $num=maxnumber();
                                    $number=$num+1;
                                    ?>
                                    <label  >ลำดับที่ : &nbsp;</label>
                                    <input type="text"  style="width:50px" value="<?php echo $number?>" disabled>
                                    <input type="hidden" name="no" value="<?php echo $number?>">
                                </div>
                                <br>
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit" name="cash"> &nbsp; OK &nbsp;</button>
                                </div>
                                
                                
                            </form>

                            <?php
                        }
                        ?>
                    </div>
                </div><!-- card body -->
                <div class="card-footer">
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>รหัสนักเรียน</th>
                                <th>ชื่อนักเรียน</th>
                                <th>วันที่นัด</th>
                                <th>เวลานัด</th>
                                <th>เบอร์โทร</th>
                                <th>ลำดับการนัด</th>
                                <th>การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql="SELECT * FROM `cash` ORDER BY `cash`.`number` DESC limit 5";
                            $res=mysqli_query($conn,$sql);
                            while ($row=mysqli_fetch_assoc($res)){
                                $id=$row['student_id'] ;
                            ?>
                            <tr>
                                <td><?php echo $row['student_id']?></td>
                                <td><?php echo get_student_name($row['student_id'])?></td>
                                <td><?php echo $row['day']?></td>
                                <td><?php echo $row['time']?></td>
                                <td><?php echo $row['tel']?></td>
                                <td><?php echo $row['number']?></td>
                                <!-- <td>
                                    <a href="edit_user.php?user_id=<?php echo $row['student_id'] ?>"><button></button></a>
                                </td> -->
                                <td class="text-center">
                                    <a href="#.php?id=<?php echo $id?>" >
                                        <button class=" btn-info" title="แก้ไข"><i class="fas fa-pen"></i></button>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="get_cash.php?act=del&id=<?php echo $id?>">
                                    <button class=" btn-danger" title="ลบ" onclick="return confirm('ต้องการลบข้อมูลนี้ ?')"><i class="fas fa-trash-alt"></i></button>
                                    </a>
                                    
                                    
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>                
                </div>
            </div>
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
function get_student_name($code){
    global $conn;
    $sql="SELECT concat(prefix.`prefix_name`,`stu_fname`,'  ',`stu_lname`) as name 
    FROM `student` 
    INNER JOIN prefix on student.`perfix_id`=prefix.prefix_id
    WHERE `student_id` ='$code'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['name'];
}
function get_student_group_name($code){
    global $conn;
    $sql="SELECT `minor_name` as name 
    FROM `student` 
    INNER JOIN prefix on student.`perfix_id`=prefix.prefix_id
    WHERE `student_id` ='$code'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['name'];
}

function insert_cash($std_id,$data){
    // print_r($data);
    global $conn;
    $student_id=$std_id;
    $cause=$data['cause'];
    $day=$data['date'];
    $time=$data['time'];
    $tel=$data['tel'];
    $number=$data['no'];
    $sql="INSERT INTO `cash` VALUES ('$student_id','$cause','$day','$time','$tel','$number')";
    // echo $sql;exit();
    $res=mysqli_query($conn,$sql);
    // echo $res;exit();
}

function maxnumber(){
    global $conn;
    $sql="SELECT max(`number`) as c FROM `cash`";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    return $row['c'];
}