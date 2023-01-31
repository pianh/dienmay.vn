<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Xóa nhà sản xuất</title>

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
            <h2 class="text-center">Xóa nhà sản xuất</h2>
            <?php
            $maMuonXoa = $_GET['nsx_ma'];
             //1. Mở kết nối
             include_once __DIR__ . '/../../dbconnect.php';
             //2. Chuẩn bị câu lệnh
             $sqlSelect = <<<EOT
             SELECT nsx_ma, nsx_ten
             FROM nhasanxuat
             WHERE nsx_ma = $maMuonXoa;
 EOT;
             //3. Thực thi
             $result = mysqli_query($conn, $sqlSelect);
             $dataDongMuonXoa = mysqli_fetch_array($result, MYSQLI_ASSOC);
            //  var_dump($dataDongMuonXoa);
            //  die;
            ?>


            <form name="frmDelete" id="frmDelete" method="post" action="">
                Mã/ID nhà sản xuất (*):
                <br/>
                <input type="text" name="nsx_ma" id="nsx_ma" readonly class="form-control"
                value="<?= $maMuonXoa ?>"
                />
                <br />
                Tên nhà sản xuất (*):
                <br/>
                <input type="text" name="nsx_ten" id="nsx_ten"
                    value="<?= $dataDongMuonXoa['nsx_ten'] ?>"
                    readonly class="form-control"/>
                <br />

                <button class="btn btn-danger" name="btnSave" id="btnSave">
                Xóa nhà sản xuất
                </button>
                
            </form>

            <?php
            // Hiển thị tất cả lỗi trong PHP
            // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
            // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            // Khi người dùng bấm lưu thì xử lý
            if(isset($_POST['btnSave'])) {
                //1. Mở kết nối
                // include_once __DIR__ . '/../../dbconnect.php';
                //2. chuẩn bị câu lệnh
                $ma = $_POST['nsx_ma'];
                $sql = "DELETE FROM nhasanxuat WHERE nsx_ma = $ma;";

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