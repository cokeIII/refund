<?php
    require_once "connect.php";
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    $level=$_GET['level'];
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
    <table class="table" style="width:100%" border='1'>
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
                <th class="text-center">เบอร์โทร</th>
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
                <?php
                if (substr($row['recipient_bank_number'],0,1)==0){
                    $num_b="A ".$row['recipient_bank_number'];
                }else{
                    $num_b=$row['recipient_bank_number'];
                }
                ?>
                <td class="text-center"><?php echo $num_b ?></td>
                <td><?php echo $row['recipient_name']?></td>
                <td class="text-center"><?php echo $row['bank_name']?></td>
                <td class="text-center"><?php echo $row['phone']?></td>
            </tr>
            <?php
            }
            ?>    
        </tbody>
    </table>
    <?php 

                    