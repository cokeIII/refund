<!DOCTYPE html>
<html lang="en">
<?php require_once "setHead.php"; ?>

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
                                        <h1 class="h4 mb-4">ระบบคืนเงิน</h1>
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
                            window.location.replace("enroll.php");
                        } else if(result.trim() == "ok staff"){
                            window.location.replace("listEnroll.php");
                        }else {
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