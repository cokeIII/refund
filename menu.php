<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="#">รับเงินเยียวยา</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            เมนู
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <?php if (!empty($_SESSION["user_status"])) { ?>
                    <?php if ($_SESSION["user_status"] == "student") { ?>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="enroll_2000.php">ลงทะเบียนรับเงิน</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="listEnroll_std.php">รายการที่ลงเบียน</a></li>
                    <?php } else if($_SESSION["user_status"] == "staff") {?>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="listEnroll.php"><i class="fas fa-home"></i> หน้าแรก</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="form_report.php"><i class="fas fa-list-alt"></i> พิมพ์รายงาน</a></li>
                    <?php }?>
                    <a href="logout.php"><button class="btn btn-primary rounded-pill">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="">ออกจากระบบ</span>
                        </button></a>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>