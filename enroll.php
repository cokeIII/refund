<!DOCTYPE html>
<html lang="en">
<?php require_once "setHead.php"; ?>
<?php
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
?>

<style>
    .kbw-signature {
        width: 400px;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
</style>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body">
                    <form id="enrollData" action="insertEnroll.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="student_id" value="<?php echo $_SESSION["student_id"]; ?>">
                        <input type="hidden" name="prefix_name" value="<?php echo $_SESSION["prefix_name"]; ?>">
                        <input type="hidden" name="people_id" value="<?php echo $_SESSION["people_id"]; ?>">
                        <input type="hidden" name="stu_fname" value="<?php echo $_SESSION["stu_fname"]; ?>">
                        <input type="hidden" name="stu_lname" value="<?php echo $_SESSION["stu_lname"]; ?>">
                        <input type="hidden" name="group_id" value="<?php echo $_SESSION["group_id"]; ?>">
                        <input type="hidden" name="minor_name" value="<?php echo $_SESSION["minor_name"]; ?>">
                        <input type="hidden" name="grade_name" value="<?php echo $_SESSION["grade_name"]; ?>">
                        <input type="hidden" name="student_group_short_name" value="<?php echo $_SESSION["student_group_short_name"]; ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group p-1">
                                    <label>ชื่อ-สกุล</label>
                                    <input value="<?php echo $_SESSION["prefix_name"] . $_SESSION["stu_fname"] . " " . $_SESSION["stu_lname"]; ?>" type="text" name="stu_name" id="stu_name" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group p-1">
                                    <label>กลุ่ม</label>
                                    <input value="<?php echo $_SESSION["student_group_no"] ?>" type="text" name="student_group_no" id="student_group_no" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-1">
                                    <label>แผนก</label>
                                    <input value="<?php echo $_SESSION["major_name"] ?>" type="text" name="major_name" id="major_name" class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <strong>ข้อมูลผู้รับเงิน</strong>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <label>เกี่ยวข้องเป็น</label>
                                    <select name="recipient" id="recipient" class="form-control">
                                        <option value="ผู้ปกครอง">ผู้ปกครอง</option>
                                        <!-- <option value="บิดา">บิดา</option>
                                        <option value="มารดา">มารดา</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="recipient_fname" id="recipient_fname" required>
                        <input type="hidden" name="recipient_lname" id="recipient_lname" required>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <label>ชื่อ-สกุล ผู้รับเงิน</label>
                                    <input type="text" name="recipient_name" id="recipient_name" class="form-control readonly" required>
                                </div>
                            </div>
                        </div>
                        <strong>ข้อมูลการโอนเงิน</strong>
                        <?php
                        require_once "connect.php";
                        $sqlBank = "select * from bank";
                        $resBank = mysqli_query($conn, $sqlBank);
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <label>ธนาคาร</label>
                                    <select name="recipient_bank" id="recipient_bank" class="form-control" required>
                                        <option value="">---เลือกธนาคาร---</option>
                                        <?php while ($rowBank = mysqli_fetch_array($resBank)) { ?>
                                            <option value="<?php echo $rowBank["bank_name"]; ?>"><?php echo $rowBank["bank_name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <label>เลขบัญชี</label>
                                    <input type="number" name="recipient_bank_number" id="recipient_bank_number" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group p-1">
                                    <label>รูปบัตรประชาชนผู้รับเงิน <a href="#" data-toggle="modal" data-target="#exampleModalCard">ตัวอย่าง</a></label>
                                    <input type="file" name="id_card_pic" id="id_card_pic" class="form-control" accept="image/*" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>รูปหน้าสมุดบัญชีผู้รับเงิน <a href="#" data-toggle="modal" data-target="#exampleModalAcc">ตัวอย่าง</a></label>
                                    <input type="file" name="account_book_pic" id="account_book_pic" class="form-control" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="d-flex justify-content-center text-center">
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>ลายเซ็นนักเรียนนักศึกษา</label>
                                        <div class="wrapper">
                                            <div id="sig"></div>
                                            <!-- <canvas id="signature-pad" class="signature-pad border" width=400 height=200></canvas> -->
                                            <textarea id="signature64" name="signed" style="display: none" required></textarea>
                                        </div>
                                        <div class="mt-2">
                                            <!-- <button id="save" type="button">Save</button> -->
                                            <button id="clear" type="button">Clear</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="d-flex justify-content-center text-center">
                                <button class="btn btn-primary"><i class="fas fa-clipboard-list"></i> ลงทะเบียนรับเงินคืน</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalAcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ตัวอย่าง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="img/acc.jpg" alt="" calss="img-ex" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ตัวอย่าง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="img/card.jpg" alt="" calss="img-ex" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>
<script>
    $(document).ready(function() {
        $(".readonly").on('keydown paste focus mousedown', function(e) {
            if (e.keyCode != 9) // ignore tab
                e.preventDefault();
        });
        get_recipient("ผู้ปกครอง")
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
        $("#recipient").change(function() {
            let status = $("#recipient").val()
            get_recipient(status)
        })

    })

    function get_recipient(status) {
        $.ajax({
            type: "POST",
            url: "get_recipient.php",
            data: {
                student_id: "<?php echo $_SESSION["student_id"]; ?>",
                get_status: status,
            },
            success: function(result) {
                if (result) {
                    let obj = JSON.parse(result)
                    $("#recipient_fname").val(obj.recipient_fname)
                    $("#recipient_lname").val(obj.recipient_lname)
                    if (obj.recipient_fname != "") {
                        $("#recipient_name").val(obj.recipient_fname + " " + obj.recipient_lname)
                    } else {
                        $("#recipient_name").val("")
                    }
                }
            }
        });
    }
</script>