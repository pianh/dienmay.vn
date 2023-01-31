<!-- Chỉ quản trị mới vào được -->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Thêm mới khách hàng</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>

</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-100">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10 ">
                </br>
                <h1>Thêm mới khách hàng</h1>
                <form name="frmCreate" id="frmCreate" method="post" action="">
                    Tên đăng nhập (*):
                    <br/>
                    <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" class="form-control"/>
                    <br />

                    Tên khách hàng:

                    <input type="text" name="kh_ten" id="kh_ten" class="form-control"/>
                    <br/>

                    Mật khẩu:
                    <input type="password" name="kh_matkhau" id="kh_matkhau" class="form-control"/>
                    <br/>


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
                            <option value="0">Khách hàng</option>
                            <option value="1">Quản lý</option>
                            
                    </select>
                    </br>

                    <button name="btnSave" id="btnSave" class="btn btn-primary">
                    Lưu dữ liệu
                    </button>
                    </br></br>
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
                    //1. Mở kết nối đến database
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. chuẩn bị câu lệnh
                    $tendangnhap = htmlentities ($_POST['kh_tendangnhap']);
                    $ten = htmlentities ($_POST['kh_ten']);
                    $matkhau = htmlentities ($_POST['kh_matkhau']);
                    $gioitinh = htmlentities ($_POST['kh_gioitinh']);
                    $trangthai = htmlentities ($_POST['kh_trangthai']);
                    $quanly = htmlentities ($_POST['kh_quanly']);
                    $sql = "INSERT INTO khachhang(kh_tendangnhap, kh_ten, kh_matkhau, kh_gioitinh, kh_trangthai, kh_quanly) VALUES ('$tendangnhap', '$ten', '$matkhau',  $gioitinh, $trangthai, $quanly);";
                    //debug
                    // var_dump($sql);
                    // die;

                    //3. Thực thi
                    mysqli_query($conn, $sql);

                    //4. Điều hướng
                    //Điều hướng bằng JavaScrip
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