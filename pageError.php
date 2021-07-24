<!DOCTYPE html>
<html lang="en">
<?php require_once "setHead.php"; ?>
<style>
    h1{
        color: red;
        text-align: center;
    }
</style>
<body id="page-top">
    <!-- Navigation-->
    <?php require_once "menu.php"; ?>
    <div class="masthead">
        <div class="container px-5">
            <div class="card">
                <div class="card-body">
                    <?php if(!empty($_GET)){ ?>
                        <h1>
                            <?php echo $_GET["text_err"]?>
                        </h1>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once "setFoot.php"; ?>

</html>
<script>
    $(document).ready(function() {

    })
</script>