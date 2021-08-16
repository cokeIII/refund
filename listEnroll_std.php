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
                                <th>รหัสลงทะเบียน</th>
                                <th width="20%">ผู้รับเงิน</th>
                                <th>เลขบัญชี</th>
                                <th>สถานะ</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["recipient_fname"] . " " . $row["recipient_lname"]; ?></td>
                                    <td><?php echo $row["recipient_bank_number"]; ?></td>
                                    <td class="<?php if ($row["status"] == "ยกเลิก") {
                                                    echo "text-danger";
                                                } else {
                                                    echo "text-success";
                                                } ?>">
                                        <?php echo $row["status"]; ?>
                                    </td>
                                    <?php if ($row["status"] == "ลงทะเบียนสำเร็จ") { ?>
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-info btnPrint"><i class="fas fa-print"></i>พิมพ์</button></td>
                                        <td><button enrollId="<?php echo $row["id"]; ?>" class="btn btn-danger btnCancel"><i class="fas fa-window-close"></i> ยกเลิก</button></td>
                                    <?php } else { ?>
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
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {
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
            }, "POST");
        })
    })
</script>