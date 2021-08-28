<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
require_once "connect.php";

?>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>ข้อมูลการโอนเงินคืนค่าลงทะเบียน</h4>
                            <form action="report_1.php" method="POST" target="_blank">
                                <?php
                                $sqlMajor = "select major_name from enroll group by major_name";
                                $resMajor = mysqli_query($conn, $sqlMajor);
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>เลือกแผนก</label>
                                            <select name="major_name" id="major_name" class="form-control" required>
                                                <option value="">--เลือกแผนก--</option>
                                                <?php while ($rowMajor = mysqli_fetch_array($resMajor)) { ?>
                                                    <option value="<?php echo $rowMajor["major_name"]; ?>"><?php echo $rowMajor["major_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>เลือกระดับชั้น</label>
                                            <select name="grade_name" id="grade_name" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>เลือกห้อง</label>
                                            <select name="student_group_no" id="student_group_no" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>สถานะ</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="ตรวจแล้ว">ตรวจแล้ว</option>
                                                <option value="โอนแล้ว">โอนแล้ว</option>
                                                <option value="ลงทะเบียนสำเร็จ">ลงทะเบียนสำเร็จ</option>
                                                <option value="ยกเลิก">ยกเลิก</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label></label>
                                        <button class="btn btn-info mt-2">พิมพ์รายงาน</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <h4>ข้อมูลการโอนเงินคืนค่าลงทะเบียน</h4>
                                <label>เลือกกลุ่มเรียน</label>
                                <form action="form_report_sms.php" method="post">
                                    <select class="form-control" name="group_name" id="group_name">
                                        <option value="">เลือกทุกกลุ่ม</option>
                                        <?php

                                        $sqlSMS = "select student_group_short_name from enroll group by student_group_short_name";
                                        $resSMS = mysqli_query($conn, $sqlSMS);

                                        while ($rowSMS = mysqli_fetch_array($resSMS)) {
                                        ?>
                                            <option value="<?php echo $rowSMS["student_group_short_name"] ?>"><?php echo $rowSMS["student_group_short_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" class="btn btn-info mt-2">รายงานส่ง SMS</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {
        $("#major_name").change(function() {
            let val = $(this).val()
            $.ajax({
                type: "POST",
                url: "get_group.php",
                data: {
                    major_name: val
                },
                success: function(result) {
                    if (result) {
                        let obj = JSON.parse(result)
                        $("#grade_name").html("")
                        $("#grade_name").append('<option value="">--เลือกระดับชั้น--</option>')
                        obj.forEach(element => {
                            $("#grade_name").append('<option  value="' + element + '">' + element + '</option>')
                        });
                    }
                }
            });
        })
        $("#grade_name").change(function() {
            let val = $("#major_name").val()
            let valgrade_name = $(this).val()
            $.ajax({
                type: "POST",
                url: "get_group_no.php",
                data: {
                    major_name: val,
                    grade_name: valgrade_name
                },
                success: function(result) {
                    if (result) {
                        let obj = JSON.parse(result)
                        $("#student_group_no").html("")
                        $("#student_group_no").append('<option value="">--เลือกห้อง--</option>')
                        obj.forEach(element => {
                            $("#student_group_no").append('<option  value="' + element + '">' + element + '</option>')
                        });
                    }
                }
            });
        })
    })
</script>