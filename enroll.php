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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group p-1">
                                    <label>รหัสนักศึกษา</label>
                                    <input value="<?php echo $_SESSION["student_id"]; ?>" type="number" name="student_id" id="student_id" class="form-control" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>รหัสบัตรประชาชน</label>
                                    <input value="<?php echo $_SESSION["people_id"]; ?>" type="number" name="people_id" id="people_id" class="form-control" maxlength="13" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>ชื่อ</label>
                                    <input value="<?php echo $_SESSION["stu_fname"]; ?>" type="text" name="stu_fname" id="f_name_th" class="form-control" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>สกุล</label>
                                    <input value="<?php echo $_SESSION["stu_lname"]; ?>" type="text" name="stu_lname" id="l_name_th" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 border-left">
                                <div class="form-group p-1">
                                    <label>รหัสกลุ่ม</label>
                                    <input value="<?php echo $_SESSION["group_id"]; ?>" type="text" name="group_id" id="group_id" class="form-control" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>สาขาวิชา</label>
                                    <input value="<?php echo $_SESSION["major_name"]; ?>" type="text" name="major_name" id="major_name" class="form-control" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>สาขางาน</label>
                                    <input value="<?php echo $_SESSION["minor_name"]; ?>" type="text" name="minor_name" id="minor_name" class="form-control" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>ระดับชั้น</label>
                                    <input value="<?php echo $_SESSION["grade_name"]; ?>" type="text" name="grade_name" id="grade_name" class="form-control" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>รูปสำเนาบัตรประชาชนนักเรียน</label>
                                    <input type="file" name="id_card_pic" id="id_card_pic" class="form-control" accept="image/*" required>
                                </div>
                                <div class="form-group p-1">
                                    <label>รูปสำเนาหน้าสมุดบัญชี</label>
                                    <input type="file" name="account_book_pic" id="account_book_pic" class="form-control" accept="image/*" required>
                                </div>
                                <input type="hidden" name="student_group_short_name" value="<?php echo $_SESSION["student_group_short_name"]; ?>">
                                <input type="hidden" name="student_group_no" value="<?php echo $_SESSION["student_group_no"]; ?>">
                                <input type="hidden" name="prefix_name" value="<?php echo $_SESSION["prefix_name"]; ?>">
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

</html>
<script>
    $(document).ready(function() {
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    })
</script>