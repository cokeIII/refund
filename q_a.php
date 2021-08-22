<?php
require_once "setHead.php";
// if (empty($_SESSION["user_status"])) {
//     header("location: index.php");
// }
?>
<style>
    .head{
        /* display: inline-block; */
        background-color:DodgerBlue;
        border: 2px solid blue;
        border-radius: 15px;
        width: 100%;
        height: 70px;
        /* margin: 6px; */
        padding: 7px;
        color:blue;
        text-shadow: 1px 1px white;
        font-weight: bold;
        font-size: 30px;
    }
    .q1 {
        font-size: 25px;
        text-align: left;
        width: 100%;
    }
    .a1{
        font-size: 25px;
    }
</style>
<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead " >
        <div class="container col-sm-8">
            <div class=" align-self-center order-1">
                <h3 class="text-center head" >คำถามที่พบบ่อย</h3>
            </div>
            


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse1">
                        ผมกำลังเรียนอยู่ระดับชั้น ปวช.3 ต้องได้รับเงินเยียวยา 3,000 บาทแต่ผมได้ทำการผ่อนผันค่าเทอมไว้ชำระไปแล้ว 1,000 บาท ค้างชำระ 1,900 บาทจะได้รับเงินเยียวยาเท่าไร 
                        </button>
                    </h4>
                </div>
                <div id="collapse1" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>ได้รับเงิน 2,000 บาทและเงินค้างชำระเหลือ 900 บาท </strong> 
                        แยกเงินเยียวยาเป็น 2 ส่วน ในส่วนของรัฐบาลช่วยเหลือ 2,000 บาทยอดนี้ทางนักเรียนจะได้รับเต็มจำนวน 2,000 บาท 
                        ในส่วนค่าลงทะเบียนจะได้รับ 1,000 บาท ทางวิทยาลัยจะนำไปหักกับส่วนที่ค้างชำระ 1,900 บาท ดังนั้นนักเรียนจะไม่ได้รับเงินในส่วนนี้ และมียอดค้างชำระเหลือ 900 บาท 
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse2">
                        จะทราบได้อย่างไรว่าลงทะเบียนขอรับเงินเยียวยาเรียบร้อยแล้ว 
                        </button>
                    </h4>
                </div>
                <div id="collapse2" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>ได้รับ SMS ยืนยันการลงทะเบียน </strong> 
                        ขณะทำการส่งเอกสารให้ตรวจสอบข้อมูลว่ามีรูปบัตรประชาชนนักเรียน บัตรประชาชนผู้รับเงิน หน้าบัญชีธนาคารของผู้รับเงิน และรายมือชื่อถูกต้อง 
                        หลังจากที่วิทยาลัยตรวจสอบความถูกต้องของหลักฐานเรียบร้อยแล้ว จะมีการส่ง SMS ถึงผู้รับเงินตามหมายเลขโทรศัพท์ที่ให้ไว้ 
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse3">
                        หลังจากวันที่ 27 สิงหาคม 2564 ซึ่งครบกำหนดการลงทะเบียน ยังสามารถลงทะเบียนได้อีกหรือไม่ 
                        </button>
                    </h4>
                </div>
                <div id="collapse3" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>ยังสามารถลงทะเบียนได้ </strong> 
                        เมื่อครบกำหนดเวลาในการลงทะเบียนช่วงแรก วิทยาลัยจะทำการตรวจสอบความถูกต้องของข้อมูลและส่ง SMS ให้กับผู้ที่ลงทะเบียนถูกต้องสมบูรณ์
                        สำหรับผู้ที่ลงทะเบียนหลังจากการตรวจสอบ จะมีรอบในการตรวจสอบอีกครั้งหนึ่ง และจะส่ง SMS ถึงผู้ลงทะเบียนต่อไป 
                        ซึ่งถ้าช่วงเวลานั้นมีการโอนเงินเข้าบัญชีผู้รับเงินแล้ว ผู้ที่ลงทะเบียนล่าช้าจะได้รับเงินในรอบต่อไป 
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse4">
                        ถ้าชื่อหรือนามสกุล ของนักเรียนนักศึกษาหรือผู้ปกครองผิด จะทำอย่างไร 
                        </button>
                    </h4>
                </div>
                <div id="collapse4" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>แจ้งการแก้ไขชื่อผ่านโปรแกรม </strong> 
                        ในกรณีที่ชื่อนักเรียนรายชื่อผู้ปกครองไม่ถูกต้องให้กดปุ่ม "แก้ไขชื่อ" ด้านหลังรายชื่อ แล้วทำการใส่ข้อมูลที่ถูกต้อง 
                        จากนั้นให้ดำเนินการส่งเอกสารตามปกติได้ ชื่อที่แก้ไขแล้วต้องรอให้ระบบปรับปรุงข้อมูลอีกครั้งหนึ่ง ประมาณ 1 วัน 
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse5">
                        ถ้าผู้ปกครองไม่มีบัญชีธนาคารจะทำอย่างไร 
                        </button>
                    </h4>
                </div>
                <div id="collapse5" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>ติดต่อครูที่ปรึกษา </strong> 
                        ผู้ปกครองให้นักเรียนติดต่อครูที่ปรึกษา เพื่อดำเนินการขอรับเงินสด 
                        ครูที่ปรึกษาจะติดต่องานการเงิน เพื่อแจ้งความประสงค์ขอรับเงินสด หางานการเงินจะทำการนัดผู้ปกครองส่งเอกสารพร้อมรับเงินสดอีกครั้งหนึ่ง 
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse6">
                        สามารถเปลี่ยนชื่อผู้ปกครองที่เคยได้แจ้งไว้กับทางวิทยาลัยในวันมอบตัวได้หรือไม่ 
                        </button>
                    </h4>
                </div>
                <div id="collapse6" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>สามารถเปลี่ยนได้  </strong> 
                        ทำการเปลี่ยนชื่อผู้ปกครองโดยมีหนังสือมอบอำนาจจากบิดาหรือมารดา หรือกรณีที่ไม่มีบิดาหรือมารดา ต้องเป็นผู้ปกครองตามศาลสั่ง
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-0 ">
                        <button type="button" class="btn btn-primary q1" data-toggle="collapse" data-target="#collapse7">
                        หากไม่ได้รับ SMS ยืนยันการลงทะเบียน จะดำเนินการอย่างไร
                        </button>
                    </h4>
                </div>
                <div id="collapse7" class="collapse">
                    <div class="card-body " >
                        <p class="mb-0 a1">
                        <strong>แจ้งไปที่ครูที่ปรึกษา</strong> 
                        ก่อนอื่นต้องตรวจสอบข้อมูลจากเอกสารในโปรแกรมว่ามีรูปภาพบัตรประชาชนนักเรียน บัตรประชาชนผู้ปกครอง หน้าสมุดธนาคารผู้ปกครอง
                        และลายมือชื่อ ถูกต้องสมบูรณ์แล้วหรือยัง ถ้าถูกต้องสมบูรณ์แล้ว ยังไม่ได้รับ SMS หลังจากวันที่ 30 สิงหาคม 2564 ให้ติดต่อไปที่ครูที่ปรึกษา
                        ครูที่ปรึกษาจะทำการติดต่อกับผู้ดูแลระบบอีกครั้งหนึ่ง 
                        </p>
                    </div>
                </div>
            </div>





        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    
</script>