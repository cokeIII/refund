<!DOCTYPE html>
<html lang="en">
<?php
require_once "setHead.php";
if (empty($_SESSION["user_status"])) {
    header("location: index.php");
}
if ($_SESSION["user_status"] != "finance") {
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
                    <table class="table" id="listStd">
                        <thead>
                            <th>รหัสนักศึกษา</th>
                            <th>ชื่อ-สกุล</th>
                            <th>กลุ่ม</th>
                            <th>สถานะผ่อนผัน</th>
                            <th>สถานะยังไม่ได้ลงทะเบียน</th>
                            <th></th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <th>รหัสนักศึกษา</th>
                            <th>ชื่อ-สกุล</th>
                            <th>กลุ่ม</th>
                            <th>สถานะผ่อนผัน</th>
                            <th>สถานะยังไม่ได้ลงทะเบียน</th>
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
<script>
    $(document).ready(function() {
        $(document).on('click', '.status-radio', function() {
            $.ajax({
                type: "POST",
                url: "update_status_std.php",
                data: {
                    student_id: $(this).attr("stdId"),
                    status: $(this).val()
                },
                success: function(result) {
                    console.log(result)
                }
            });
        })
        $(document).on('click', '.btn-clear', function() {
            let id = $(this).attr("stdId")
            $.ajax({
                type: "POST",
                url: "update_status_std.php",
                data: {
                    student_id: id,
                    del: true
                },
                success: function(result) {
                    if (result == "ok") {
                        $('input[name="' + id + '"]').prop('checked', false)
                    }
                }
            });
        })
        $('#listStd').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "bDestroy": true,
            "responsive": true,
            "autoWidth": false,
            "pageLength": 30,
            "ajax": {
                "url": "get_std.php",
                "type": "POST",
                "data": function(d) {
                    d.std = true
                }
            },
            'processing': true,
            "columns": [{
                    "data": "student_id"
                },
                {
                    "data": "stu_name"
                },
                {
                    "data": "student_group_short_name"
                },
                {
                    "data": "status1"
                },
                {
                    "data": "status2"
                },
                {
                    "data": "clear"
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
    })
</script>