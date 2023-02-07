<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Xóa đơn đặt hàng</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-150">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
            <h1>Xóa đơn đặt hàng</h1>
            <?php
            $maMuonXoa = $_GET['dh_ma'];
            ?>


            <form name="frmDelete" id="frmDelete" method="post" action="">
                Mã đơn đặt hàng (*):
                <br/>
                <input type="number" name="dh_ma" id="dh_ma"  class="form-control"
                value="<?= $maMuonXoa ?>"
                readonly/>
                <br />

                <button name="btnSave" id="btnSave" class="btn btn-danger">
                Xóa dữ liệu
                </button>
            </form>

            <?php
            // Khi người dùng bấm lưu thì xử lý
            if(isset($_POST['btnSave'])) {
                //1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                //2. chuẩn bị câu lệnh
                $ma = $_POST['dh_ma'];
                $sql = "DELETE FROM dondathang WHERE dh_ma = $ma;";
                 // 3. Xóa các dòng con (chi tiết Đơn thanh toan) trước
                 $sqlDeletechitietdondathang = "DELETE FROM `sanpham_dondathang` WHERE dh_ma=" . $ma;

                 // 4 Thực thi câu lệnh DELETE Chi tiết Đơn thanh toan
                 $resultchitietdondathang = mysqli_query($conn, $sqlDeletechitietdondathang);
 
                 // 4. Xóa dòng Đơn hàng
                 $sqlDeletedondathang = "DELETE FROM `dondathang` WHERE dh_ma= $ma;";
 
                 // 3.1. Thực thi câu lệnh DELETE Chi tiết Đơn hàng
                 $resultdondathang = mysqli_query($conn, $sqlDeletedondathang);
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