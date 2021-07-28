<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
require_once "connect.php";
$student_id = $_SESSION["student_id"];
if ($_SESSION["user_status"] == "staff") {
    $sql = "select * from enroll";
} else {
    $sql = "select * from enroll where student_id = '$student_id'";
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

                    <table class="table table-responsive" id="enrollTable">
                        <thead>
                            <tr>
                                <th>รหัสนักศึกษา</th>
                                <th width="20%">ชื่อ - สกุล</th>
                                <th>สาขาวิชา</th>
                                <th>ชั้น</th>
                                <th>สถานะ</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo $row["student_id"]; ?></td>
                                    <td><?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                    <td><?php echo $row["major_name"]; ?></td>
                                    <td><?php echo $row["student_group_short_name"]; ?></td>
                                    <td class="col-status-<?php echo $row["id"];?> <?php if ($row["status"] == "ยกเลิก") {
                                                    echo "text-danger";
                                                } else {
                                                    echo "text-success";
                                                } ?>">
                                        <?php echo $row["status"]; ?>
                                    </td>
                                    <?php if ($_SESSION["user_status"] == "staff") { ?>
                                        <td width="20%">
                                            <select enrollId="<?php echo $row["id"]; ?>" name="status" id="status" class="form-control status">
                                                <option value="ตรวจแล้ว" <?php echo ($row["status"] == "ตรวจแล้ว" ? "selected" : ""); ?>>ตรวจแล้ว</option>
                                                <option value="โอนแล้ว" <?php echo ($row["status"] == "โอนแล้ว" ? "selected" : ""); ?>>โอนแล้ว</option>
                                                <option value="ลงทะเบียนสำเร็จ" <?php echo ($row["status"] == "ลงทะเบียนสำเร็จ" ? "selected" : ""); ?>>ลงทะเบียนสำเร็จ</option>
                                                <option value="ยกเลิก" <?php echo ($row["status"] == "ยกเลิก" ? "selected" : ""); ?>>ยกเลิก</option>
                                            </select>
                                        </td>
                                        <td><a href="printEnroll.php?id=<?php echo $row["id"]; ?>" target="_blank"><button class="btn btn-info"><i class="fas fa-print"></i> พิมพ์</button></a></td>
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-danger btnDel"><i class="fas fa-trash-alt"></i> ลบ</button></td>
                                    <?php } else { ?>
                                        <?php if ($row["status"] == "ลงทะเบียนสำเร็จ") { ?>
                                            <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-danger btnCancel"><i class="fas fa-window-close"></i> ยกเลิก</button></td>
                                            <td></td>
                                            <td></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>สาขาวิชา</th>
                                <th>ระดับชั้น</th>
                                <th>สถานะ</th>
                            </tr>
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
        $('#enrollTable').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    console.log(column)
                    if (column.selector.cols != 0 && column.selector.cols != 1) {
                        var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    }
                });
            },
            fixedColumns: true
        });
        $(".btnCancel").click(function() {
            if (confirm("you want to cancel the item ?")) {
                $.redirect("cancelEnroll.php", {
                    id: $(this).attr("enrollId"),
                }, "POST");
            }
        })
        $(".btnDel").click(function() {
            if (confirm("you want to delete the item ?")) {
                $.redirect("delEnroll.php", {
                    id: $(this).attr("enrollId"),
                }, "POST");
            }
        })
        $(".status").change(function() {
            let id = $(this).attr("enrollId")
            let val = $(this).val()
            $.ajax({
                type: "POST",
                url: "updateEnroll.php",
                data: {
                    id: id,
                    update: val,
                },
                success: function(result) {
                    if (result == "ok") {
                        if(val != "ยกเลิก") {
                            $(".col-status-"+id).removeClass("text-danger");
                            $(".col-status-"+id).addClass("text-success");
                        } else {
                            $(".col-status-"+id).removeClass("text-success");
                            $(".col-status-"+id).addClass("text-danger");
                        }
                        $(".col-status-"+id).html(val)
                    } else if(result == "fail"){
                        alert("แก้ไขไม่สำเร็จ")
                    }
                }
            });
        })

    })
</script>