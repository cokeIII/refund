<!DOCTYPE html>
<html lang="en">
<?php require_once "setHead.php"; ?>
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/css/uikit.min.css">
<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/js/uikit-icons.min.js"></script>
<link href="https://unpkg.com/sanitize.css" rel="stylesheet">
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

    .image-previewer {
        height: 250px;
        width: 400px;
        display: flex;
        border-radius: 10px;
        border: 1px solid lightgrey;
    }
</style>

<body>
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
                        <input type="hidden" id="id_card_pic_std_h" name="id_card_pic_std_h" value="">
                        <input type="hidden" id="id_card_pic_h" name="id_card_pic_h" value="">
                        <input type="hidden" id="account_book_pic_h" name="account_book_pic_h" value="">
                        <input type="hidden" id="signed" name="signed" value="">
                        <input type="hidden" id="signed2" name="signed2" value="">
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
                                        <option value="บิดา">บิดา</option>
                                        <option value="มารดา">มารดา</option>
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
                                    <label>รูปบัตรประชาชนนักเรียน/นักศึกษา <a href="#" data-toggle="modal" data-target="#exampleModalCard">ตัวอย่าง</a></label>
                                    <input type="file" name="id_card_pic_std" id="id_card_pic_std" class="form-control" accept="image/*" required>
                                </div>
                                <label for="id_card_pic_std" class="image-previewer" data-cropzee="id_card_pic_std"></label>
                                <button id="btn_id_card_pic_std" type="button" class="btn btn-secondary" onclick="set_id_card_pic_std(cropzeeGetImage('id_card_pic_std'))">ยืนยันรูปภาพ</button>

                                <div class="form-group p-1">
                                    <label>รูปบัตรประชาชน<span class="re_status"></span><a href="#" data-toggle="modal" data-target="#exampleModalCard">ตัวอย่าง</a></label>
                                    <input type="file" name="id_card_pic" id="id_card_pic" class="form-control" accept="image/*" required>
                                </div>
                                <label for="id_card_pic" class="image-previewer" data-cropzee="id_card_pic"></label>
                                <button id="btn_id_card_pic" type="button" class="btn btn-secondary" onclick="set_id_card_pic(cropzeeGetImage('id_card_pic'))">ยืนยันรูปภาพ</button>
                                <div class="form-group p-1">
                                    <label>รูปหน้าสมุดบัญชี<span class="re_status"></span> <a href="#" data-toggle="modal" data-target="#exampleModalAcc">ตัวอย่าง</a></label>
                                    <input type="file" name="account_book_pic" id="account_book_pic" class="form-control" accept="image/*" required>
                                </div>
                                <label for="account_book_pic" class="image-previewer" data-cropzee="account_book_pic"></label>
                                <button id="btn_account_book_pic" type="button" class="btn btn-secondary" onclick="set_account_book_pic(cropzeeGetImage('account_book_pic'))">ยืนยันรูปภาพ</button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="d-flex justify-content-center text-center">
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>ลายเซ็นนักเรียนนักศึกษา</label>
                                        <div id="signatureparent">
                                            <div id="signature"></div>
                                        </div>
                                        <!-- <div class="wrapper">
                                            <div id="sig"></div>
                                            <textarea id="signature64" name="signed" style="display: none" required></textarea>
                                        </div>
                                        <div class="mt-2">
                                            <button id="clear" type="button">Clear</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="d-flex justify-content-center text-center">
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>ลายเซ็น<span class="re_status"></span></label>
                                        <div id="signatureparent2">
                                            <div id="signature2"></div>
                                        </div>
                                        <!-- <div class="wrapper">
                                            <div id="sig2"></div>
                                            <textarea id="signature65" name="signed2" style="display: none" required></textarea>
                                        </div>
                                        <div class="mt-2">
                                            <button id="clear2" type="button">Clear</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="d-flex justify-content-center text-center">
                                <button id="btnEnroll" class="btn btn-primary"><i class="fas fa-clipboard-list"></i> ลงทะเบียนรับเงิน</button>
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
    $("#signatureparent").jSignature({

        // line color
        color: "black",

        // line width
        lineWidth: 5,

        // width/height of signature pad
        width: 300,
        height: 200,

        // background color
        "background-color": "##AEB4B2"
    });
    $("#btnEnroll").attr('disabled', true)
    let signed = false
    let signed2 = false
    $("#signatureparent").mouseup(function(){
        signed = true
        if(signed && signed2){
            $("#btnEnroll").attr('disabled', false)
        }
        $("#signed").val("image/svg+xml;base64,"+$("#signatureparent").jSignature('getData', "image/svg+xml;base64")[1])
        $("#signed2").val("image/svg+xml;base64,"+$("#signatureparent2").jSignature('getData', "image/svg+xml;base64")[1])

    })
    $("#signatureparent2").mouseup(function(){
        signed2 = true
        if(signed && signed2){
            $("#btnEnroll").attr('disabled', false)
        }
        $("#signed").val("image/svg+xml;base64,"+$("#signatureparent").jSignature('getData', "image/svg+xml;base64")[1])
        $("#signed2").val("image/svg+xml;base64,"+$("#signatureparent2").jSignature('getData', "image/svg+xml;base64")[1])

    })
    $("#btnEnroll").submit(function(){
    })
    $("#signatureparent2").jSignature({
        // line color
        color: "black",

        // line width
        lineWidth: 5,

        // width/height of signature pad
        width: 300,
        height: 200,

        // background color
        "background-color": "##AEB4B2"
    });
    
    $(".re_status").html($("#recipient").val())
    let btn_id_card_pic_std = true;
    let btn_id_card_pic = true;
    let btn_account_book_pic = true;

    function set_id_card_pic_std(val) {
        btn_id_card_pic_std = !btn_id_card_pic_std;
        if (btn_id_card_pic_std) {
            $("#btn_id_card_pic_std").removeClass("btn-success");
            $("#btn_id_card_pic_std").addClass("btn-secondary");
        } else {
            $("#btn_id_card_pic_std").removeClass("btn-secondary");
            $("#btn_id_card_pic_std").addClass("btn-success");
        }

        if (val == "") {
            alert("เกิดข้อผิดพลาดในการตัดรูป กรุณาเลือกรูปใหม่")
        } else {
            $("#id_card_pic_std_h").val(val)
        }
    }

    function set_id_card_pic(val) {
        btn_id_card_pic = !btn_id_card_pic;
        if (btn_id_card_pic) {
            $("#btn_id_card_pic").removeClass("btn-success");
            $("#btn_id_card_pic").addClass("btn-secondary");
        } else {
            $("#btn_id_card_pic").removeClass("btn-secondary");
            $("#btn_id_card_pic").addClass("btn-success");
        }

        if (val == "") {
            alert("เกิดข้อผิดพลาดในการตัดรูป กรุณาเลือกรูปใหม่")
        } else {
            $("#id_card_pic_h").val(val)
        }
    }

    function set_account_book_pic(val) {
        btn_account_book_pic = !btn_account_book_pic;
        if (btn_account_book_pic) {
            $("#btn_account_book_pic").removeClass("btn-success");
            $("#btn_account_book_pic").addClass("btn-secondary");
        } else {
            $("#btn_account_book_pic").removeClass("btn-secondary");
            $("#btn_account_book_pic").addClass("btn-success");
        }
        if (val == "") {
            alert("เกิดข้อผิดพลาดในการตัดรูป กรุณาเลือกรูปใหม่")
        } else {
            $("#account_book_pic_h").val(val)
        }

    }
    $(document).ready(function() {
        $("#id_card_pic_std").cropzee({
            returnImageMode: 'data-url',
            startSize: [60, 60, '%']
        })
        $("#id_card_pic").cropzee({
            returnImageMode: 'data-url',
            startSize: [60, 60, '%']
        })
        $("#account_book_pic").cropzee({
            returnImageMode: 'data-url',
            startSize: [60, 60, '%']
        })
        $(".readonly").on('keydown paste focus mousedown', function(e) {
            if (e.keyCode != 9) // ignore tab
                e.preventDefault();
        });
        get_recipient("ผู้ปกครอง")
        // var sig = $('#sig').signature({
        //     syncField: '#signature64',
        //     syncFormat: 'PNG'
        // });
        // $('#clear').click(function(e) {
        //     e.preventDefault();
        //     sig.signature('clear');
        //     $("#signature64").val('');
        // });
        // var sig2 = $('#sig2').signature({
        //     syncField: '#signature65',
        //     syncFormat: 'PNG'
        // });
        // $('#clear2').click(function(e) {
        //     e.preventDefault();
        //     sig2.signature('clear');
        //     $("#signature65").val('');
        // });
        $("#recipient").change(function() {
            let status = $("#recipient").val()
            get_recipient(status)
            $(".re_status").html(status)
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