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
                    <table class="table " id="enrollTable">
                        <thead>
                            <tr>
                                <th>รหัสลงทะเบียน</th>
                                <th width="20%">ผู้รับเงิน</th>
                                <th>เลขบัญชี</th>
                                <th>เบอร์โทรศัพท์ที่รับ SMS</th>
                                <th>สถานะ</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo $row["id"]; $enrollId = $row["id"];?></td>
                                    <td><?php echo $row["recipient_fname"] . " " . $row["recipient_lname"]; ?></td>
                                    <td><?php echo $row["recipient_bank_number"]; ?></td>
                                    <td><?php echo $row["phone"]; ?></td>
                                    <td class="<?php if ($row["status"] == "ยกเลิก" || $row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์") {
                                                    echo "text-danger";
                                                } else {
                                                    echo "text-success";
                                                } ?>">
                                        <?php echo $row["status"]; ?>
                                    </td>
                                    <?php if ($row["status"] == "ส่งเอกสารแล้ว" || $row["status"] == "เอกสารไม่ถูกต้องสมบูรณ์") { ?>
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-info btnPrint"><i class="fas fa-print"></i>แสดงข้อมูล</button></td>
                                        <!-- <td><button enrollId="<?php //echo $row["id"]; 
                                                                    ?>" class="btn btn-primary btnSig" data-toggle="modal" data-target="#modalEditSig"><i class="fas fa-file-signature"></i>แก้ไขลายเซ็น</button></td> -->
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-primary btnTel" data-toggle="modal" data-target="#modalEditTel"><i class="fas fa-phone"></i>แก้ไขเบอร์โทรศัพท์</button></td>
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-danger btnCancel"><i class="fas fa-window-close"></i> ยกเลิก</button></td>
                                    <?php } else { ?>
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-info btnPrint"><i class="fas fa-print"></i>แสดงข้อมูล</button></td>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
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
<!-- Modal -->
<!-- <div class="modal fade" id="modalEditSig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขลายเซ็น นักเรียน/นักศึกษา/ผู้ปกครอง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="signatureparent">
                    <div id="signature"></div>
                </div>
                <div class="mt-2">
                    <button class="btn btn-secondary" id="clear" type="button">ลบลายเซ็น</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div> -->
<div class="modal fade" id="modalEditTel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขเบอร์โทรศัพท์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPhone" method="post">
                    <label for="phone">หมายเลขโทรศัพท์ที่ใช้รับ SMS</label>
                    <input type="tel" id="phone" class="form-control" maxlength="10" minlength="10" required>
                    <button type="submit" class="btn btn-info mt-3">แก้ไขข้อมูล</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {
        $("#editPhone").on("submit", function() {
            $.ajax({
                type: "POST",
                url: "editPhone.php",
                data: {
                    enrollId: "<?php echo $enrollId;?>",
                    phone: $("#phone").val()
                },
                success: function(result) {
                    if(result == "ok"){
                        alert("แก้ไขสำเร็จ กรุณาตรวจสอบข้อมูลอีกรอบ")
                    } else {
                        alert("แก้ไขไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่")
                    }
                }
            });
            return false;
        })
        ///////////////////////////signatureparent
        $(document).on('change', "#signatureparent", function() {
            signed2 = true
            if (signed && signed2 && !btn_id_card_pic_std && !btn_id_card_pic && !btn_account_book_pic) {
                $("#btnEnroll").attr('disabled', false)
            }
            $("#signed").val("image/svg+xml;base64," + $("#signatureparent").jSignature('getData', "image/svg+xml;base64")[1])
        })
        $("#clear").click(function() {
            $("#signatureparent").jSignature('reset')
            signed2 = false
            if (!signed || !signed2) {
                $("#btnEnroll").attr('disabled', true)
            }
        })

        $(".btnCancel").click(function() {
            if (confirm("you want to cancel the item ?")) {
                $.redirect("cancelEnroll.php", {
                    id: $(this).attr("enrollId"),
                }, "POST");
            }
        })
        $(".btnPrint").click(function() {
            $.redirect("report_2.php", {
                id: $(this).attr("enrollId"),

            }, "POST", '_blank', );
        })
    })
</script>