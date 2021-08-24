<!DOCTYPE html>
<html lang="en">
<?php require_once "setHead.php"; ?>
<style>
    .note {
        color: #3b127c;
    }
</style>

<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body">
                    <form action="login.php">
                        <div class="row">
                            <div class="col-md-5 d-none d-md-block logo-login">

                            </div>
                            <div class="col-md-7">
                                <div class="border-left p-5  mb-3">
                                    <div class="text-center">
                                        <h6 class="h6 mb-4">กรุณาใส่ชื่อผู้ใช้และรหัสผ่านเพื่อเข้าสู่ระบบ</h6>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="std_id" placeholder="รหัสนักเรียนนักศึกษา">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="รหัสผ่าน">
                                        </div>
                                        <a href="#" class="btn btn-primary btn-user btn-block mt-2" id="btnLogin">
                                            Login
                                        </a>
                                        <div class="mt-5 h-alert">
                                            <p class="text-danger text-center" id="alertLogin">รหัสนักศึกษาหรือรหัสผ่านไม่ถูกต้อง</p>
                                        </div>
                                        <div class="note">
                                            <p>หมายเหตุ:</p>
                                            <p> - เข้าสู่ระบบโดยใช้ ชื่อผู้ใช้งานคือ รหัสประจำตัวนักเรียน นักศึกษา
                                            <div>รหัสผ่านคือ วัน/เดือน/ปีเกิด เช่น 30/12/2540</div></p>
                                            <p>
                                            <div> - หากเข้าสู่ระบบไม่ได้ให้ทำการติดต่อที่เบอร์ 0863831380</div>
                                            </p>                                            <p>
                                            <div> - เจ้าหน้าที่ดูแลเว็บไซต์ติดต่อเบอร์ 0918325709</div>
                                            </p>
                                            <a class="nav-link me-lg-3" href="#" data-toggle="modal" data-target="#manual"><i class="fas fa-clipboard-list"></i> คู่มือ</a></li>

                                            <a class="nav-link me-lg-3" href="q_a.php"><i class="fas fa-question"></i> ถามตอบ Q&A</a>
                                            <!-- <p>
- ค่าธรรมเนียมการโอนเงิน หักจากยอดเงินที่โอนไปยังผู้รับโอน
</p> -->
                                        </div>
                                    </form>
                                </div>
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
        $("#alertLogin").hide()
        $("#btnLogin").click(function() {
            if ($("#std_id").val()) {
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: {
                        std_id: $("#std_id").val(),
                        password: $("#password").val()
                    },
                    success: function(result) {
                        if (result.trim() == "ok") {
                            window.location.replace("enroll_2000V2.php");
                        } else if (result.trim() == "ok teacher") {
                            window.location.replace("listEnroll.php");
                        } else if (result.trim() == "ok checker") {
                            window.location.replace("listEnroll_checker.php");
                        } else if (result.trim() == "ok admin") {
                            window.location.replace("listEnroll.php");
                        } else if (result.trim() == "ok finance") {
                            window.location.replace("listEnroll_finance.php");
                        } else if (result.trim() == "ok registration") {
                            window.location.replace("change_name_list.php");
                        } else {
                            $("#alertLogin").fadeIn(1000, function() {
                                $("#alertLogin").fadeOut(5000)
                            })
                        }
                    }
                });
            } else {
                $("#alertLogin").fadeIn(1000, function() {
                    $("#alertLogin").fadeOut(5000)
                })
            }
        })
    })
</script>