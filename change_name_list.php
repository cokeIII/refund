<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
require_once "connect.php";
$student_id = $_SESSION["student_id"];
if ($_SESSION["user_status"] == "registration") {
    $sql = "select c.*,s.stu_fname,s.stu_lname from change_name_old c, student s where c.student_id = s.student_id";
} else {
    $sql = "";
}
$res = mysqli_query($conn, $sql);
?>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <button class="btn btn-info" id="printChangeName"><i class="fas fa-print"></i> พิมพ์รายงาน</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table " id="changeNameTable">
                        <thead>
                            <tr>
                                <th>ที่</th>
                                <th>รหัสนักศึกษา</th>
                                <th width="20%">ชื่อ - สกุล</th>
                                <th>ชื่อเดิม</th>
                                <th>เกี่ยวข้องเป็น</th>
                                <th>ชื่อที่ต้องการเปลี่ยน</th>
                                <th>เบอร์ติดต่อกลับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $row["student_id"]; ?></td>
                                    <td><?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                    <td><?php echo $row["th_name_old"]; ?></td>
                                    <td><?php echo $row["status"]; ?></td>
                                    <td><?php echo $row["th_name_new"]; ?></td>
                                    <td><?php echo $row["tel"]; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
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
        $('#changeNameTable').DataTable();
        $(document).on('click', '#printChangeName', function() {

            $.redirect("report_3.php", {
                id: $(this).attr("enrollId"),
            }, "POST","_blank");

        })
    })
</script>