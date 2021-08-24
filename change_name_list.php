<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
$valDate = "";
require_once "connect.php";
$student_id = $_SESSION["student_id"];
if ($_SESSION["user_status"] == "registration") {
    if (!empty($_POST["valDate"])) {
        $valDate = $_POST["valDate"];
        $sql = "select 
        c.*,
        s.stu_fname,
        s.stu_lname 
        from 
        change_name c, student s 
        where 
        c.student_id = s.student_id and date(time_stamp) = '$valDate'";
    } else {
        $sql = "select 
        c.*,
        s.stu_fname,
        s.stu_lname 
        from 
        change_name c, student s 
        where 
        c.student_id = s.student_id";
    }
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
                                <?php
                                $sqlD = "select date(time_stamp) as dateTime from change_name group by date(time_stamp)";
                                $resD = mysqli_query($conn, $sqlD); 
                                ?>
                            
                                <div class="col-md-1">วันที่</div>
                                <div class="col-md-4">
                                    <select id="changeDate" class="form-control">
                                        <option value="">-- วันที่ --</option>
                                        <?php while ($rowD = mysqli_fetch_array($resD)) { ?>
                                            <option value="<?php echo $rowD["dateTime"]; ?>" <?php echo ($rowD["dateTime"] == $valDate?"selected":"");?>><?php echo $rowD["dateTime"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
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
                                <th>ชื่อ - สกุล นักศึกาษา</th>
                                <th>ชื่อเดิม</th>
                                <th>เกี่ยวข้องเป็น</th>
                                <th>ชื่อที่ต้องการเปลี่ยน</th>
                                <th>เบอร์ติดต่อกลับ</th>
                                <th>สถานะแก้ไข</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $row["student_id"]; ?></td>
                                    <td><?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                    <td><?php echo $row["th_prefix_old"] . $row["th_name_old"] . " " . $row["th_lname_old"]; ?></td>
                                    <td><?php echo $row["status"]; ?></td>
                                    <td><?php echo $row["th_prefix_new"] . $row["th_name_new"] . " " . $row["th_lname_new"]; ?></td>
                                    <td><?php echo $row["tel"]; ?></td>
                                    <td class="col-status-<?php echo $row["student_id"]; ?> <?php if ($row["change_status"] == "ยังไม่ได้แก้ไข") {
                                                                                                echo "text-danger";
                                                                                            } else {
                                                                                                echo "text-success";
                                                                                            } ?>"><?php echo $row["change_status"]; ?></td>
                                    <td><select class="form-control" chId="<?php echo $row["student_id"]; ?>" chStatus="<?php echo $row["status"]; ?>" id="fixName">
                                            <option value="แก้ไขแล้ว" <?php echo ($row["change_status"] == "แก้ไขแล้ว" ? "selected" : ""); ?>>แก้ไขแล้ว</option>
                                            <option value="ยังไม่ได้แก้ไข" <?php echo ($row["change_status"] == "ยังไม่ได้แก้ไข" ? "selected" : "") ?>>ยังไม่ได้แก้ไข</option>
                                        </select></td>
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

        $(document).on('change', '#changeDate', function() {
            $.redirect("change_name_list.php", {
                valDate: $(this).val()
            }, "POST");
        })
        $('#changeNameTable').DataTable();
        $(document).on('click', '#printChangeName', function() {
            $.redirect("report_3.php", {
                id: $(this).attr("enrollId"),
                valDate: $("#changeDate").val(),
            }, "POST", "_blank");
        })
    })
    $(document).on('change', '#fixName', function() {
        let val = $(this).val()
        let id = $(this).attr("chId")
        let status = $(this).attr("chStatus")
        $.ajax({
            type: "POST",
            url: "updateChangeName.php",
            data: {
                id: id,
                val: val,
                status: status
            },
            success: function(result) {
                console.log(result)
                if (result == "ok") {
                    if (val == "ยังไม่ได้แก้ไข") {
                        $(".col-status-" + id).removeClass("text-success");
                        $(".col-status-" + id).addClass("text-danger");
                    } else {
                        $(".col-status-" + id).removeClass("text-danger");
                        $(".col-status-" + id).addClass("text-success");
                    }
                    $(".col-status-" + id).html(val)
                } else if (result == "fail") {
                    alert("แก้ไขไม่สำเร็จ")
                }
            }
        });
    })
</script>