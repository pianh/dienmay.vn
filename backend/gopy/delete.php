<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Xóa góp ý</title>

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
            <h2>Xóa góp ý</h2>
<?php
            // Hiển thị tất cả lỗi trong PHP
            // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
            // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $maMuonXoa = $_GET['gy_ma'];
            //1. Mở kết nối
            include_once __DIR__ . '/../../dbconnect.php';
            //2. Chuẩn bị câu lệnh
            $sqlSelect = <<<EOT
            SELECT gy_ma, gy_noidung
            FROM gopy
            WHERE gy_ma = $maMuonXoa;
EOT;
            //3. Thực thi
            $result = mysqli_query($conn, $sqlSelect);
            $dataDongMuonXoa = mysqli_fetch_array($result, MYSQLI_ASSOC)
            ?>

            <form name="frmCreate" id="frmCreate" method="post" action="">
                Mã góp ý (*):
                <br/>
                <input type="text" name="gy_ma" id="gy_ma" class="form-control" readonly
                value="<?= $maMuonXoa ?>"
                />
                <br />
                Tên góp ý (*):
                <br/>
                <input type="text" name="gy_noidung" id="gy_noidung"
                    value="<?= $dataDongMuonXoa['gy_noidung'] ?>"
                    readonly class="form-control"
                />
                <br />

                <button class="btn btn-danger" name="btnSave" id="btnSave">
                Xóa góp ý
                </button>
            </form>

            <?php
            // Khi người dùng bấm lưu thì xử lý
            if(isset($_POST['btnSave'])) {
                //1. Mở kết nối
                //2. chuẩn bị câu lệnh
                $ma = $_POST['gy_ma'];
                $sql = "DELETE FROM gopy WHERE gy_ma = $ma;";

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