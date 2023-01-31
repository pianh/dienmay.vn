<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Xóa thành viên</title>

    <?php include_once __DIR__ . '/../layouts/style.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pd-bottom-380">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h1>Xóa thành viên</h1>
                <?php
                $tvMuonXoa = $_GET['tv_tendangnhap'];
                ?>


                <form name="frmCreate" id="frmCreate" method="post" action="">
                    Mã / tên đăng nhập thành viên (*):
                    <br/>
                    <input type="text" name="tv_tendangnhap" id="tv_tendangnhap" class="form-control"
                    value="<?= $tvMuonXoa ?>"
                    readonly/>
                    <br />
                    <button class="btn btn-danger" name="btnSave" id="btnSave">
                    Xóa thành viên
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
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. chuẩn bị câu lệnh
                    $tv = $_POST['tv_tendangnhap'];
                    $sql = "DELETE FROM thanhvien WHERE tv_tendangnhap = '$tv';";

                    // debug
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