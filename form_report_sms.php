<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
require_once "connect.php";

?>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-5 align-self-end">
                            <button class="btn btn-info" id="exportPhone"><i class="fas fa-print"></i> ส่งออกเบอร์โทร</button>
                        </div>
                    </div>
                    <table class="table" id="listPhone" style="width:100%">
                        <thead>
                            <tr>
                                <th><button class="btn btn-primary">เลือกทั้งหมด</button></th>
                                <th>ที่</th>
                                <th>หมายเลขลงทะเบียน</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-สกุล</th>
                                <th>หมายเลขโทรศัพท์</th>
                                <th>กลุ่มเรียน</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $group_name="";
                            if (!empty($_POST["group_name"])) {
                                $group_name = $_POST["group_name"];
                                $sql = "SELECT enroll.* FROM enroll 
                                INNER JOIN student on student.student_id=enroll.student_id
                                AND enroll.status='พิมพ์แล้ว'
                                and student.group_id != '632090103' and student.group_id !='632090104'
                                and student.group_id not LIKE '62202%'
                                and enroll.grade_name = '$group_name'
                                and enroll.sms = ''
                                ";
                            } else {
                                $sql = "SELECT enroll.* FROM enroll 
                                INNER JOIN student on student.student_id=enroll.student_id
                                AND enroll.status='พิมพ์แล้ว'
                                and student.group_id != '632090103' and student.group_id !='632090104'
                                and student.group_id not LIKE '62202%'
                                and enroll.sms = ''
                                ";
                            }
                            $listSamePhone = [];
                            $listErrAndSamePhone = [];
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($res)) {
                                $phone = $row["phone"];
                                if (preg_match("/^[0-9]{10}$/", $phone)) {

                            ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["student_id"]; ?></td>
                                        <td><?php echo $row["prefix_name"] . $row["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                        <td><?php echo $row["phone"]; ?></td>
                                        <td><?php echo $row["student_group_short_name"]; ?></td>
                                        <!-- <td><input type="checkbox" name="phone" id="phone" class="checkbox"></td> -->
                                    </tr>
                            <?php } else {
                                    $listErrAndSamePhone[] = $row;
                                }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ที่</th>
                                <th>หมายเลขลงทะเบียน</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-สกุล</th>
                                <th>หมายเลขโทรศัพท์</th>
                                <th>กลุ่มเรียน</th>
                                <!-- <th></th> -->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /////////////// phone error //////////////// -->
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <h3 class="text-danger">รายการเบอร์โทรที่ไม่ถูกต้อง</h3>
                    </div>
                    <table class="table" id="listPhoneErr" style="width:100%">
                        <thead>
                            <tr>
                                <th>ที่</th>
                                <th>หมายเลขลงทะเบียน</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-สกุล</th>
                                <th>หมายเลขโทรศัพท์</th>
                                <th>กลุ่มเรียน</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 0;
                            foreach ($listErrAndSamePhone as $key => $value) {
                                if (!preg_match("/^[0-9]{10}$/", $value["phone"])) {
                            ?>
                                    <tr>
                                        <td><?php echo ++$j; ?></td>
                                        <td><?php echo $value["id"]; ?></td>
                                        <td><?php echo $value["student_id"]; ?></td>
                                        <td><?php echo $value["prefix_name"] . $value["stu_fname"] . " " . $row["stu_lname"]; ?></td>
                                        <td><?php echo $value["phone"]; ?></td>
                                        <td><?php echo $value["student_group_short_name"]; ?></td>
                                        <!-- <td><input type="checkbox" name="phone" id="phone" class="checkbox"></td> -->
                                    </tr>
                            <?php } else {
                                    $listSamePhone[] = $value;
                                }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ที่</th>
                                <th>หมายเลขลงทะเบียน</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-สกุล</th>
                                <th>หมายเลขโทรศัพท์</th>
                                <th>กลุ่มเรียน</th>
                                <!-- <th></th> -->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /////////////// end phone error //////////////// -->
            <!-- /////////////// phone same //////////////// -->
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- <h3 class="text-warning">รายการเบอร์โทรที่ซ้ำ</h3> -->
                    </div>
                    <table class="table" id="listPhoneSame" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>ที่</th>
                                <th>หมายเลขลงทะเบียน</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-สกุล</th>
                                <th>หมายเลขโทรศัพท์</th>
                                <th>กลุ่มเรียน</th> -->
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $k = 0;
                            // foreach ($listSamePhone as $key => $value2) {
                            ?>
                            <tr>
                                <!-- <td><?php //echo ++$k; 
                                            ?></td>
                                    <td><?php //echo $value2["id"]; 
                                        ?></td>
                                    <td><?php //echo $value2["student_id"]; 
                                        ?></td>
                                    <td><?php //echo $value2["prefix_name"] . $value2["stu_fname"] . " " . $value2["stu_lname"]; 
                                        ?></td>
                                    <td><?php //echo $value2["phone"]; 
                                        ?></td>
                                    <td><?php //echo $value2["student_group_short_name"]; 
                                        ?></td> -->
                                <!-- <td><input type="checkbox" name="phone" id="phone" class="checkbox"></td> -->
                            </tr>
                            <?php
                            //} 
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- <th>ที่</th>
                                <th>หมายเลขลงทะเบียน</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-สกุล</th>
                                <th>หมายเลขโทรศัพท์</th>
                                <th>กลุ่มเรียน</th> -->
                                <!-- <th></th> -->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /////////////// end phone same //////////////// -->


        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>
<?php
function checkSamePhone($phone)
{
    $sql = "select phone from enroll where phone = '$phone' and status = 'พิมพ์แล้ว'";
    $res = mysqli_query($GLOBALS['conn'], $sql);
    $rowcount = mysqli_num_rows($res);
    if ($rowcount > 1) {
        return false;
    } else {
        return true;
    }
}
?>

</html>
<script>
    $(document).ready(function() {
        // $("#listPhoneSame").DataTable()
        $("#listPhoneErr").DataTable()
        var table = $('#listPhone').DataTable({
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ]
        })
        let phoneNumber = ""
        $("#exportPhone").click(function() {
            if (confirm("ยืนยันการส่งออก สถานะจะเปลี่ยนเป็น 'ส่งแล้ว'")) {
                phoneNumber = ""
                let i = 1;
                let no = 1;
                let dataArr = table.rows('.selected').data()
                let numberFile = dataArr.length / 200
                Object.entries(dataArr).forEach(entry => {
                    const [key, value] = entry
                    if (key <= dataArr.length) {
                        updateSMS(value[2], value[5])

                        var d = new Date()
                        let month = '' + (d.getMonth() + 1)
                        let day = '' + d.getDate()
                        let year = d.getFullYear()
                        if (phoneNumber.search(value[5]) < 0) {
                            phoneNumber += value[5] + ","
                        }
                        if (i % 200 == 0) {
                            exportFile(day + "/" + month + "/" + year + "_" + no, phoneNumber.slice(0, -1))
                            phoneNumber = ""
                            i = 0
                            no++
                            numberFile = numberFile - 1
                        } else if (numberFile < 1 && i == dataArr.length - 200 * (Math.floor(dataArr.length / 200))) {
                            exportFile(day + "/" + month + "/" + year + "_" + no, phoneNumber.slice(0, -1))
                        }
                        i++;
                    }
                });
            }
        })

        function exportFile(d, phoneNumber) {
            let group_name = "<?php echo $group_name;?>";
            download("phone_" + d + "_"+group_name+".txt", phoneNumber)
        }

        function download(filename, text) {
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
            element.setAttribute('download', filename);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }

        function updateSMS(valId, valPhone) {
            $.ajax({
                type: "POST",
                url: "updateSMS.php",
                data: {
                    id: valId,
                    phone: valPhone
                },
                success: function(result) {
                    if (result == "ok") {
                        console.log(result)
                    }
                }
            });
        }

        let check = false

        table.on("click", "th.select-checkbox", function() {
            if ($("th.select-checkbox").hasClass("selected")) {
                table.rows().deselect();
                $("th.select-checkbox").removeClass("selected");
            } else {
                table.rows().select();
                $("th.select-checkbox").addClass("selected");
            }
        }).on("select deselect", function() {
            ("Some selection or deselection going on")
            if (table.rows({
                    selected: true
                }).count() !== table.rows().count()) {
                $("th.select-checkbox").removeClass("selected");
            } else {
                $("th.select-checkbox").addClass("selected");
            }
        });

    })
</script>