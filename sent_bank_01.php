<?php
require_once "setHead.php";
// if (empty($_SESSION["user_status"])) {
//     header("location: index.php");
// }
require_once "connect.php";
if (isset($_POST['level'])){
    $level=$_POST['level'];
    $_SESSION['level']=$level;
}
?>
<style>
    table{
        font-size:13px;

    }

</style>
<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <h3>รายชื่อสำหรับส่งธนาคาร</h3>
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
                                        $a10="selected";
                                    elseif ($_SESSION['level']=='603')
                                        $a11="selected";
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
                                <option value="603" <?php echo $a11?>>ปวส.2 ตกค้าง (รหัส 60) </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"> OK </button>
                        </div>
                        <div class="col-md-2">
                            <a href="sent_bank_01_ex.php?level=<?php echo $level?>">
                            <button type="button" class="btn btn-info"> excel </button></a>
                        </div>
                    </div>
                    <br>    
                </form>
            </div>  
            <?php
            if (isset($_SESSION['level'])){
                    $level=$_SESSION['level'];
                    $group=$level."%";
                    $sql="SELECT student.student_id ,student.`group_shortname`,
                    concat(student.stu_fname,'  ',student.stu_lname) as std_name ,
                    bank.bank_id ,`recipient_bank_number`,
                    concat(`recipient_prefix`,`recipient_fname`,' ',`recipient_lname`) as recipient_name , 
                    bank.bank_name
                    FROM `enroll` 
                    INNER JOIN student on student.student_id=enroll.student_id
                    INNER JOIN `bank` ON bank.bank_name = enroll.`recipient_bank`
                    WHERE enroll.status='พิมพ์แล้ว'
                    AND student.group_id LIKE '$group'
                    and student.`group_id` !='632090103' and student.`group_id` !='632090104'
                    and student.`group_id` not LIKE '62202%'
                    ORDER BY  student.student_id , bank.bank_id";
                    $res=mysqli_query($conn, $sql);
                    ?>
                
                    <table class="table" style="width:100%">
                        <thead>
                            <!-- <tr>
                                <th colspan=6>ระดับ <?php echo $level ?></th>
                            </tr> -->
                            <tr>
                                <th width="50px">ที่</th>
                                <th class="text-center" width="130px">รหัสนักเรียน</th>
                                <th>ชื่อนักเรียน</th>
                                <th>กลุ่ม</th>
                                <th>รหัสธนาคาร</th>
                                <th class="text-center">เลขบัญชี</th>
                                <th class="text-center" >ชื่อ บช.ผู้รับเงิน</th>
                                <th class="text-center">ชื่อธนาคาร</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter=1;
                            while ($row = mysqli_fetch_array($res)){
                            ?>
                            <tr>
                                <td><?php echo $counter++?></td>
                                <td><?php echo $row['student_id']?></td>
                                <td><?php echo $row['std_name']?></td>
                                <td><?php echo $row['group_shortname']?></td>
                                <td><?php echo $row['bank_id']?></td>
                                <td class="text-center"><?php echo $row['recipient_bank_number'] ?></td>
                                <td><?php echo $row['recipient_name']?></td>
                                <td class="text-center"><?php echo $row['bank_name']?></td>
                            </tr>
                            <?php
                            }
                            ?>    
                        
                    <?php
                } 
                ?>
        </div>
    </div>
</body>