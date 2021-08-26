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
if ($_SESSION["user_status"] == "finance") {

    if (!empty($_POST["room_name"])) {
        $room_name = $_POST["room_name"];
        $sql = "select * from enroll 
        where 
        student_group_short_name = '$room_name'  and 
        status != 'ยกเลิก' order by student_id";
    } else {
        $sql = "select * from enroll where status != 'ยกเลิก'";
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
                                <th>เบอร์โทรศัพท์</th>
                                <!-- <th>รูปบัตรประชาชนนักเรียน/นักศึกษา</th>
                                <th>รูปบัตรประชาชนผู้ปกครอง</th>
                                <th>รูปหน้าสมุดบัญชี</th> -->
                                <th>สถานะ</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo ++$no; ?></td>
                                    <td><?php echo $row["student_id"]; ?></td>
                                    <td><?php echo $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                    <td><?php echo $row["student_group_short_name"]; ?></td>
                                    <td><?php echo $row["phone"]; ?></td>
                                    <!-- <td><button class="btn btn-info see-pic" title="รูปบัตรประชาชนนักเรียน/นักศึกษา" pic="<?php echo $row["id_card_pic_std"]; ?>">ดูรูป</button></td>
                                    <td><button class="btn btn-info see-pic" title="รูปบัตรประชาชนผู้ปกครอง" pic="<?php echo $row["id_card_pic"]; ?>">ดูรูป</button></td>
                                    <td><button class="btn btn-info see-pic" title="รูปหน้าสมุดบัญชี" pic="<?php echo $row["account_book_pic"]; ?>">ดูรูป</button></td> -->
                                    <td class="col-status-<?php echo $row["id"]; ?> <?php if ($row["status"] == "ยกเลิก" || $row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์") {
                                                                                        echo "text-danger";
                                                                                    } else {
                                                                                        echo "text-success";
                                                                                    } ?>">
                                        <?php echo $row["status"]; ?>
                                    </td>
                                    <td width="">
                                        <select enrollId="<?php echo $row["id"]; ?>" std_id="<?php echo $row["student_id"]; ?>" name="status" id="status" class="form-control status">
                                            <option value="พิมพ์แล้ว" <?php echo ($row["status"] == "พิมพ์แล้ว" ? "selected" : ""); ?>>พิมพ์แล้ว</option>
                                            <option value="เอกสารไม่ถูกต้องสมบูรณ์" <?php echo ($row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์" ? "selected" : ""); ?>>เอกสารไม่ถูกต้องสมบูรณ์</option>
                                            <option value="โอนแล้ว" <?php echo ($row["status"] == "โอนแล้ว" ? "selected" : ""); ?>>โอนแล้ว</option>
                                            <option value="ส่งเอกสารแล้ว" <?php echo ($row["status"] == "ส่งเอกสารแล้ว" ? "selected" : ""); ?>>ส่งเอกสารแล้ว</option>
                                            <option value="ยกเลิก" <?php echo ($row["status"] == "ยกเลิก" ? "selected" : ""); ?>>ยกเลิก</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning modal-note" enrollId="<?php echo $row["id"]; ?>"><i class="fas fa-sticky-note"></i> หมายเหตุ</button>
                                    </td>
                                    <td><a id="btnPrint" href="report_2.php?id=<?php echo $row["id"]; ?>" target="_blank"><button class="btn btn-info"><i class="fas fa-print"></i> พิมพ์</button></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td></td>
                                <th></th>
                                <!-- <th></th>
                                <th></th>
                                <th></th> -->
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
                <img id="pic" src="" alt="" width="100%" height="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeMd" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">หมายเหตุ</h5>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="checkboxes">
                    <div><input type="checkbox" class="note" id="notePhone" value="ไม่มีเบอร์โทรศัพท์"> : ไม่มีเบอร์โทรศัพท์</div>
                    <div><input type="checkbox" class="note" id="noteIdCard" value="รูปภาพบัตรประชาชนนักเรียนนักศึกษาไม่สมบูรณ์"> : รูปภาพบัตรประชาชนนักเรียน นักศึกษาไม่สมบูรณ์</div>
                    <div><input type="checkbox" class="note" id="noteIdCardParrent" value="รูปภาพบัตรประชาชนผู้ปกครองไม่สมบูรณ์"> : รูปภาพบัตรประชาชนผู้ปกครองไม่สมบูรณ์</div>
                    <div><input type="checkbox" class="note" id="noteBookBank" value="รูปภาพหน้าสมุดบัญชีธนาคารไม่สมบูรณ์"> : รูปภาพหน้าสมุดบัญชีธนาคารไม่สมบูรณ์</div>
                    <div>อื่นๆ : <input type="text" class="note" id="noteText" class="formcontrol"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary submitNote">ใส่หมายเหตุ</button>
                <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let enrollId
        $(".submitNote").click(function() {
            var selected = [];
            $('#checkboxes input:checked').each(function() {
                selected.push($(this).val());
            });
            selected.push("other," + $("#noteText").val())
            $.ajax({
                type: "POST",
                url: "updateNote.php",
                data: {
                    enroll_id: enrollId,
                    note: selected,
                },
                success: function(result) {
                    console.log(result)
                    if(result == "ok"){
                        $('#modalNote').modal('hide');
                        $('input:checkbox').removeAttr('checked');
                    }
                }
            });
        })
        $(".closeModal").click(function() {
            $('#modalNote').modal('hide');
            $('#checkboxes input:checked').each(function() {
                $(this).attr('checked', false);
                selected = []
            });
            $('input:checkbox').removeAttr('checked');
            
            $("#noteText").val("")
        })
        $(".modal-note").click(function() {
            enrollId = $(this).attr("enrollId")
            $.ajax({
                type: "POST",
                url: "getCheckList.php",
                data: {
                    id: enrollId,
                },
                success: function(result) {
                    let data = result.split(",")
                    if (data.length > 0) {
                        $.each(data, function(index, value) {
                            if (value != "")
                                $("input[value=" + value + "]").attr('checked', true)
                            if (value == "other") {
                               $("#noteText").val(data[index+1])
                                return false; // breaks
                            }
                        });
                    }
                    $('#modalNote').modal('show');
                }
            });
        })
        $('#enrollTable').DataTable({
            // initComplete: function() {
            //     this.api().columns().every(function() {
            //         var column = this;
            //         // console.log(column)
            //         if (column.selector.cols != 0 && column.selector.cols != 1 && column.selector.cols != 2 && column.selector.cols != 3 && column.selector.cols != 4 && column.selector.cols != 5 && column.selector.cols != 6) {
            //             var select = $('<select class="form-control"><option value=""></option></select>')
            //                 .appendTo($(column.footer()).empty())
            //                 .on('change', function() {
            //                     var val = $.fn.dataTable.util.escapeRegex(
            //                         $(this).val()
            //                     );
            //                     column
            //                         .search(val ? '^' + val + '$' : '', true, false)
            //                         .draw();
            //                 });

            //             column.data().unique().sort().each(function(d, j) {
            //                 select.append('<option value="' + d + '">' + d + '</option>')
            //             });
            //         }
            //     });
            // },
            fixedColumns: true
        });

        $("#room").change(function() {
            $.redirect("listEnroll_finance.php", {
                room_name: $(this).val(),
            }, "POST");
        })
        $(".closeMd").click(function() {
            $('#picSee').modal('hide');
        })
        $(".see-pic").click(function() {
            $("#modalLabel").html($(this).attr("title"))
            $("#pic").attr("src", "uploads/" + $(this).attr("pic"))
            $('#picSee').modal('show');
        })
        $(document).on('change', '.status', function() {
            let id = $(this).attr("enrollId")
            let std_id = $(this).attr("std_id")
            let val = $(this).val()

            $.ajax({
                type: "POST",
                url: "user_ac.php",
                data: {
                    detail: std_id + ":" + val,
                    enroll_id: id,
                },
                success: function(result) {

                }
            });
            $.ajax({
                type: "POST",
                url: "updateEnroll.php",
                data: {
                    id: id,
                    update: val,
                },
                success: function(result) {
                    console.log(result)
                    if (result == "ok") {
                        if (val == "ยกเลิก" || val == "เอกสารไม่ถูกต้องสมบูรณ์") {
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
    })
</script>