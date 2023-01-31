<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Sửa khách hàng</title>

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
                <h2 class="text-center">Sửa khách hàng</h2>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    $idmuonsua = $_GET['kh_tendangnhap'];
                    //1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuẩn bị câu lệnh
                    $sqlSelect = <<<EOT
                    SELECT kh_tendangnhap, kh_ten, kh_gioitinh, kh_trangthai, kh_quanly
                    FROM khachhang
                    WHERE kh_tendangnhap = '$idmuonsua';
EOT;
                    //3. Thực thi
                    $result = mysqli_query($conn, $sqlSelect);
                    $dataDongMuonSua = mysqli_fetch_array($result, MYSQLI_ASSOC)
                ?>

                <form name="frmEdit" id="frmEdit" method="post" action="">
                        Tên đăng nhập (*):
                        <br/>
                        <input type="text" name="kh_tendangnhap" id="kh_tendangnhap"
                            value="<?= $dataDongMuonSua['kh_tendangnhap']?>"
                        class="form-control"
                        readonly/>
                        <br />
                    
                        Tên thành viên (*):
                        <br/>
                        <input type="text" name="kh_ten" id="kh_ten"
                            value="<?= $dataDongMuonSua['kh_ten'] ?>"
                        class="form-control"
                        />
                        <br />

                        <label for="">Giới tính:</label>
                        <select name="kh_gioitinh" id="kh_gioitinh" class="form-control">
                            <option value="">Vui lòng chọn giới tính</option>
                                <option value="0">Nữ</option>
                                <option value="1">Nam</option>
                        </select>
                        </br>


                        <label for="">Trạng thái:</label>
                        <select name="kh_trangthai" id="kh_trangthai" class="form-control">
                            <option value="">Vui lòng chọn trạng thái cho tài khoản</option>
                                <option value="0">Kích hoạt</option>
                                <option value="1">Khóa</option>
                        </select>
                        </br>


                        <label for="">Vai trò:</label>
                        <select name="kh_quanly" id="kh_quanly" class="form-control">
                            <option value="">Vui lòng chọn vai trò cho tài khoản</option>
                                <option value="0">Quản lý</option>
                                <option value="1">Khách hàng bình thường</option>
                                
                        </select>
                        </br>


                        <button name="btnSave" id="btnSave" class="btn btn-primary">
                        Lưu dữ liệu
                        </button>
                        </br> </br>
                </form>

                <?php
                    // Khi người dùng bấm lưu thì xử lý
                    if(isset($_POST['btnSave'])) {
                        //1. Mở kết nối
                        include_once __DIR__ . '/../../dbconnect.php';
                        //2. chuẩn bị câu lệnh
                        $tendangnhap = $_POST['kh_tendangnhap'];
                        $ten = $_POST['kh_ten'];
                        $gioitinh = $_POST['kh_gioitinh'];
                        $trangthai = $_POST['kh_trangthai'];
                        $quanly = $_POST['kh_quanly'];
                        //Heredoc
                        $sql = <<<EOT
                        UPDATE khachhang
                        SET  kh_ten='$ten', kh_gioitinh= $gioitinh,
                        kh_trangthai= $trangthai, kh_quanly= $quanly
                        WHERE kh_tendangnhap= '$tendangnhap';
EOT;
                        // debug
                        // var_dump($sql);
                        // die;

                        //3. Thực thi
                        mysqli_query($conn, $sql);

                        //4. Điều hướng
                        echo '<script>location.href = "index.php";</script>';
                    }

                ?>

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
</body>
</html>