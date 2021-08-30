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
if ($_SESSION["user_status"] != "finance") {
    header("location: index.php");
}
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
                        <div class="col-md-4">
                            <label><strong>ตัวเลือกพิมพ์รายงาน</strong></label>
                            <div>
                                <input type="radio" name="printMode" id="report2" value="report2" checked> : เงินเยียวยา 2000
                                <input type="radio" name="printMode" id="report4" value="report4" class="ml-2"> : เงิน บกศ
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row justify-content-end">
                                <div class="col-md-12">
                                    <a href="form_stutus_std.php"><button class="btn btn-info" id="stdStatus"><i class="fas fa-user-edit"></i> แก้ไขสถานะนักเรียนนักศึกษา</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table" id="enrollTable" width="1200">
                        <thead>
                            <tr>
                                <th>ที่</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ช่าง</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>สถานะ</th>
                                <th>วันเวลา</th>
                                <th></th>
                                <th width="40"></th>
                                <th width="50"></th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <th>ที่</th>
                            <th>รหัสนักศึกษา</th>
                            <th>ชื่อ - สกุล</th>
                            <th>ช่าง</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>สถานะ</th>
                            <th>วันเวลา</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
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
<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $sqlBank = "select * from bank";
                        $resBank = mysqli_query($conn, $sqlBank);
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <form id="bank_form">
                                        <label>ธนาคาร</label>
                                        <select name="recipient_bank" id="recipient_bank" class="form-control" required>
                                            <option value="">---เลือกธนาคาร---</option>
                                            <?php while ($rowBank = mysqli_fetch_array($resBank)) { ?>
                                                <option value="<?php echo $rowBank["bank_name"]; ?>"><?php echo $rowBank["bank_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary mt-3">แก้ไขธนาคาร</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <form id="bank_num">
                                        <label>เลขบัญชีธนาคาร</label>
                                        <input type="number" name="recipient_bank_number" id="recipient_bank_number" class="form-control" required>
                                        <button type="submit" class="btn btn-primary mt-3">แก้ไขเลขบัญชี</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let enrollId
        let stdId
        $(document).on('click', '.btnPrint', function() {
            if ($('input[name=printMode]:checked').val() == "report2") {
                $.redirect("report_2.php", {
                    id: $(this).attr("enrollId"),
                }, "GET", "_blank");
            } else if ($('input[name=printMode]:checked').val() == "report4") {
                $.redirect("report_4.php", {
                    id: $(this).attr("enrollId"),
                }, "GET", "_blank");
            }
        })
        $(document).on('submit', '#bank_form', function() {
            $.ajax({
                type: "POST",
                url: "update_bank.php",
                data: {
                    enroll_id: enrollId,
                    bank_name: $("#recipient_bank").val(),
                },
                success: function(result) {
                    console.log(result)

                    if (result == "ok") {
                        $.ajax({
                            type: "POST",
                            url: "user_ac.php",
                            data: {
                                detail: stdId + ":" + $("#recipient_bank").val(),
                                enroll_id: enrollId,
                            },
                            success: function(result) {

                            }
                        });

                        alert("แก้ไขสำเร็จ กรุณาพิมพ์เพื่อตรวจสอบข้อมูลใหม่")
                        $("#recipient_bank").val("")
                        $('#modalEdit').modal('hide');
                    } else {
                        alert("แก้ไขไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่")
                    }
                }
            });
            return false
        })
        $(document).on('submit', '#bank_num', function() {
            $.ajax({
                type: "POST",
                url: "update_bank.php",
                data: {
                    enroll_id: enrollId,
                    bank_num: $("#recipient_bank_number").val(),
                },
                success: function(result) {
                    console.log(result)
                    if (result == "ok") {
                        $.ajax({
                            type: "POST",
                            url: "user_ac.php",
                            data: {
                                detail: stdId + ":" + $("#recipient_bank_number").val(),
                                enroll_id: enrollId,
                            },
                            success: function(result) {

                            }
                        });
                        alert("แก้ไขสำเร็จ กรุณาพิมพ์เพื่อตรวจสอบข้อมูลใหม่")
                        $("#recipient_bank_number").val("")
                        $('#modalEdit').modal('hide');
                    } else {
                        alert("แก้ไขไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่")
                    }
                }
            });
            return false
        })
        loadTable("")
        $('#modalNote').on('hidden.bs.modal', function() {
            $('input:checkbox').prop('checked', false);
            $("#noteText").val("")
        })
        $('#modalEdit').on('hidden.bs.modal', function() {
            $("#recipient_bank").val("")
            $("#recipient_bank_number").val("")
        })
        $(".submitNote").click(function() {
            var selected = [];
            $('#checkboxes input:checked').each(function() {
                selected.push($(this).val());
                console.log(selected)
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
                    if (result == "ok") {
                        $('#modalNote').modal('hide');
                        $('input:checkbox').prop('checked', false);
                    }
                }
            });
        })
        $(document).on('click', '.closeModal', function() {

            $('#modalNote').modal('hide');
            $('#modalEdit').modal('hide');
            $('#checkboxes input:checked').each(function() {
                $(this).attr('checked', false);
                selected = []
            });
            $('input:checkbox').removeAttr('checked');

            $("#noteText").val("")
        })
        $(document).on('click', '.modal-note', function() {
            enrollId = $(this).attr("enrollId")
            console.log(enrollId)
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
                                $("input[value=" + value + "]").prop('checked', true)
                            if (value == "other") {
                                $("#noteText").val(data[index + 1])
                                return false; // breaks
                            }
                        });
                    }
                    $('#modalNote').modal('show');
                }
            });
        })
        $(document).on('click', '.modal-edit', function() {
            stdId = $(this).attr("stdId")
            enrollId = $(this).attr("enrollId")
            console.log(enrollId)
            $('#modalEdit').modal('show');
        })

        function loadTable(room_name) {
            $('#enrollTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "bDestroy": true,
                "responsive": true,
                "autoWidth": false,
                "pageLength": 30,
                "scrollX": true,
                "ajax": {
                    "url": "get_finance.php",
                    "type": "POST",
                    "data": function(d) {
                        d.room_name = room_name
                    }
                },
                'processing': true,
                "columns": [{
                        "data": "no"
                    },
                    {
                        "data": "student_id"
                    },
                    {
                        "data": "stu_name"
                    },
                    {
                        "data": "student_group_short_name"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "time_stamp"
                    },
                    {
                        "data": "select_status"
                    },
                    {
                        "data": "btn_note"
                    },
                    {
                        "data": "btn_print"
                    }, {
                        "data": "btn_edit"
                    },
                ],
                "language": {
                    'processing': '<img src="img/tenor.gif" width="80">',
                    "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                    "zeroRecords": "ไม่มีข้อมูล",
                    "info": "กำลังแสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "search": "ค้นหา:",
                    "infoEmpty": "ไม่มีข้อมูลแสดง",
                    "infoFiltered": "(ค้นหาจาก _MAX_ total records)",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "หน้าต่อไป",
                        "previous": "หน้าก่อน"
                    }
                }
            });
        }

        // $('#enrollTable').DataTable({
        //     // initComplete: function() {
        //     //     this.api().columns().every(function() {
        //     //         var column = this;
        //     //         // console.log(column)
        //     //         if (column.selector.cols != 0 && column.selector.cols != 1 && column.selector.cols != 2 && column.selector.cols != 3 && column.selector.cols != 4 && column.selector.cols != 5 && column.selector.cols != 6) {
        //     //             var select = $('<select class="form-control"><option value=""></option></select>')
        //     //                 .appendTo($(column.footer()).empty())
        //     //                 .on('change', function() {
        //     //                     var val = $.fn.dataTable.util.escapeRegex(
        //     //                         $(this).val()
        //     //                     );
        //     //                     column
        //     //                         .search(val ? '^' + val + '$' : '', true, false)
        //     //                         .draw();
        //     //                 });

        //     //             column.data().unique().sort().each(function(d, j) {
        //     //                 select.append('<option value="' + d + '">' + d + '</option>')
        //     //             });
        //     //         }
        //     //     });
        //     // },
        //     fixedColumns: true,
        //     "pageLength": 30,
        //     "scrollX": true
        // });

        $("#room").change(function() {
            loadTable($(this).val())
            // $.redirect("listEnroll_finance.php", {
            //     room_name: $(this).val(),
            // }, "POST");
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