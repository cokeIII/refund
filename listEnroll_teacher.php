<!DOCTYPE html>
<html lang="en">
<?php
// error_reporting(0);
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
require_once "connect.php";
$student_id = $_SESSION["student_id"];
$room_name = "";
if ($_SESSION["user_status"] == "teacher") {
    if (!empty($_POST["room_name"])) {
        $room_name = $_POST["room_name"];
        $sql = "select * from enroll where student_group_short_name = '$room_name'";
    } else {
        $sql = "select * from enroll";
    }
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
                            <h4>เลือกห้องเรียน</h4>
                            <select class="form-control" id="room">
                                <option value="">-- เลือกห้องเรียน --</option>
                                <?php
                                $sqlRoom = "select student_group_short_name from enroll group by student_group_short_name";
                                $resRoom  = mysqli_query($conn, $sqlRoom);
                                while ($rowRoom = mysqli_fetch_array($resRoom)) {
                                ?>
                                    <option value="<?php echo $rowRoom["student_group_short_name"]; ?>" <?php echo ($rowRoom["student_group_short_name"] == $room_name ? "selected" : "") ?>><?php echo $rowRoom["student_group_short_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <!-- <button class="btn btn-info" id="printAll"><i class="fas fa-print"></i> พิมพ์รายงาน ทั้งหมด</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table " id="enrollTable">
                        <thead>
                            <tr>
                                <th>ที่</th>
                                <th>รหัสนักศึกษา</th>
                                <th width="20%">ชื่อ - สกุล</th>
                                <th>ช่าง</th>
                                <th>รูปบัตรประชาชนนักเรียน/นักศึกษา</th>
                                <th>รูปบัตรประชาชนผู้ปกครอง</th>
                                <th>รูปหน้าสมุดบัญชี</th>
                                <th>สถานะ</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; while($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo ++$no; ?></td>
                                    <td><?php echo $row["student_id"]; ?></td>
                                    <td><?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                    <td><?php echo $row["student_group_short_name"]; ?></td>
                                    <td><button class="btn btn-info see-pic" title="รูปบัตรประชาชนนักเรียน/นักศึกษา" pic="<?php echo $row["id_card_pic_std"];?>">ดูรูป</button></td>
                                    <td><button class="btn btn-info see-pic" title="รูปบัตรประชาชนผู้ปกครอง" pic="<?php echo $row["id_card_pic"];?>">ดูรูป</button></td>
                                    <td><button class="btn btn-info see-pic"  title="รูปหน้าสมุดบัญชี" pic="<?php echo $row["account_book_pic"];?>">ดูรูป</button></td>
                                    <td class="col-status-<?php echo $row["id"]; ?> <?php if ($row["status"] == "ยกเลิก") {
                                                                                        echo "text-danger";
                                                                                    } else {
                                                                                        echo "text-success";
                                                                                    } ?>">
                                        <?php echo $row["status"]; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
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
<!-- Modal -->
<div class="modal fade" id="picSee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close closeMd" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="alertText"></div>
        <img id="pic" src="" alt="" width="100%" height="100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary closeMd" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#btnPrint").click(function(){
            alert("print")
        })
        $('#enrollTable').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    // console.log(column)
                    if (column.selector.cols != 0 && column.selector.cols != 1 && column.selector.cols != 2 && column.selector.cols != 4  && column.selector.cols != 5  && column.selector.cols != 6) {
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

        $("#room").change(function() {
            $.redirect("listEnroll_teacher.php", {
                room_name: $(this).val(),
            }, "POST");
        })
        $(".closeMd").click(function() {
            $('#picSee').modal('hide');
        })
        $(".see-pic").click(function(){
            $("#modalLabel").html($(this).attr("title"))
            $("#pic").attr("src", "uploads/"+$(this).attr("pic"))
            if($(this).attr("pic")==""){

            }
            $('#picSee').modal('show');
        })

    })
</script>