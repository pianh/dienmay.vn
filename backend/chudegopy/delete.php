<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Xóa chủ đề góp ý</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
            </br>
            <h2>Xóa chủ đề góp ý</h2>
<?php
            // Hiển thị tất cả lỗi trong PHP
            // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
            // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $maMuonXoa = $_GET['cdgy_ma'];
            //1. Mở kết nối
            include_once __DIR__ . '/../../dbconnect.php';
            //2. Chuẩn bị câu lệnh
            $sqlSelect = <<<EOT
            SELECT cdgy_ma, cdgy_ten
            FROM chudegopy
            WHERE cdgy_ma = $maMuonXoa;
EOT;
            //3. Thực thi
            $result = mysqli_query($conn, $sqlSelect);
            $dataDongMuonXoa = mysqli_fetch_array($result, MYSQLI_ASSOC)
            ?>
            <form name="frmCreate" id="frmCreate" method="post" action="">
                Mã chủ đề (*):
                <br/>
                <input type="text" name="cdgy_ma" id="cdgy_ma" readonly class="form-control"
                value="<?= $maMuonXoa ?>"
                />
                <br />
                Tên chủ đề góp ý (*):
                <br/>
                <input type="text" name="cdgy_ten" id="cdgy_ten"
                    value="<?= $dataDongMuonXoa['cdgy_ten'] ?>"
                    readonly class="form-control"
                />
                <br />
                <button class="btn btn-danger" name="btnSave" id="btnSave">
                Xóa chủ đề
                </button>
            </form>

            <?php
            // Khi người dùng bấm xóa thì xử lý
            if(isset($_POST['btnSave'])) {
                //1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                //2. chuẩn bị câu lệnh
                $ma = $_POST['cdgy_ma'];
                $sql = "DELETE FROM chudegopy WHERE cdgy_ma = $ma;";

                //debug
                // var_dump($sql);
                // die;

                //3. Thực thi
                mysqli_query($conn, $sql);

                //4
                echo '<script>location.href = "index.php"; </script>';


            }

            ?>

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
</body>
</html>