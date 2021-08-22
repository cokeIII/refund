<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="#">ระบบลงทะเบียนขอรับเงินเยียวยา</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            เมนู
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <?php if (!empty($_SESSION["user_status"])) { ?>
                    <?php if ($_SESSION["user_status"] == "student") { ?>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="enroll_2000V2.php"><i class="fas fa-address-book"></i> ลงทะเบียนรับเงิน</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="listEnroll_std.php"><i class="fas fa-clipboard-list"></i> รายการที่ลงทะเบียน</a></li>
                    <?php } else if ($_SESSION["user_status"] == "staff") { ?>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="listEnroll.php"><i class="fas fa-home"></i> หน้าแรก</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="form_report.php"><i class="fas fa-list-alt"></i> พิมพ์รายงาน</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="change_name_list.php"><i class="fas fa-list"></i> รายการที่แก้ไขชื่อ</a></li>
                    <?php } ?>
                    <li class="nav-item"><a href="logout.php"><button class="btn btn-primary rounded-pill">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="">ออกจากระบบ</span>
                        </button></a></li>
                <?php } else {?>
                    <li class="nav-item" data-toggle="modal" data-target="#manual" ><a class="nav-link me-lg-3" href="#"><i class="fas fa-clipboard-list"></i> คู่มือ</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="q_a.php"><i class="fas fa-question"></i> ถามตอบ Q&A</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="index.php"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a></li>
                <!-- <li class="nav-item"><a class="nav-link me-lg-3" href="https://youtu.be/7UqigLgab18"><i class="fas fa-video"></i> วิดิโอคู่มือ</a></li> -->
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-clipboard-list"></i> คู่มือ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="imageZoom" src="img/manual2000.jpeg" alt="">
                <h3><a target="_blank" href="https://youtu.be/7UqigLgab18" ><i class="fas fa-video"></i> วิดีโอคู่มือ</a></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>