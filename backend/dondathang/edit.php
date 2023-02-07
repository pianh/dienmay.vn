<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Sửa đơn đặt hàng</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>
            <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    //Chuẩn bị câu lệnh
                    $sqlSelecthttt = "
                        SELECT *
                        FROM hinhthucthanhtoan;
                    ";
                    //Thực thi
                    $resulthttt = mysqli_query($conn, $sqlSelecthttt);
                    //Phan tách thành mảng array PHP
                    $dataHTTT = [];
                    while ($row = mysqli_fetch_array($resulthttt, MYSQLI_ASSOC)) {
                        $dataHTTT[] = array(
                            'httt_ma' => $row['httt_ma'],
                            'httt_ten' => $row['httt_ten'],
                        );
                    }

                       
                    // var_dump($data);die;
                ?>

            <div class="col-md-10 pb-150">
                <h1>Sửa đơn thanh toán</h1>
                <?php
                    $dondathangMuonSua = $_GET['dh_ma'];
                    //1. Mở kết nối
                    // include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuẩn bị câu lệnh
                    $sqlSelect = <<<EOT
                    SELECT dh_ma, dh_ngaylap, dh_trangthaithanhtoan, httt_ma, kh_tendangnhap
                    FROM dondathang
                    WHERE dh_ma = $dondathangMuonSua;
EOT;
                    //3. Thực thi
                    $result = mysqli_query($conn, $sqlSelect);
                    $dataDongMuonSua = mysqli_fetch_array($result, MYSQLI_ASSOC)
                ?>

                <form name="frmEdit" id="frmEdit" method="post" action="">
                        Mã đơn (*):
                        <br/>
                        <input type="text" name="dh_ma" id="dh_ma"
                            value="<?= $dataDongMuonSua['dh_ma']?>"
                        class="form-control" readonly
                        />
                        <br />
                    
                        Ngày lập:
                        <br/>
                        <input type="datetime-local" name="dh_ngaylap" id="dh_ngaylap"
                            value="<?= $dataDongMuonSua['dh_ngaylap'] ?>"
                        class="form-control"
                        />
                        <br />

                        <label for="">Trạng thái:</label>
                        <select name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan" class="form-control">
                            <option value="">Chọn trạng thái cho đơn</option>
                                <option value="1">Thành công</option>
                                <option value="0">Chưa xử lý</option>
                        </select>
                        </br>

                        <label for="">Hình thức thanh toán:</label>
                        <select name="httt_ma" id="httt_ma" class="form-control">
                            <option value="">Vui lòng chọn hình thức thanh toán</option>
                            <?php foreach($dataHTTT as $httt): ?>
                                <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                               
                            <?php endforeach; ?>

                        </select>

                        </br>
                        Tài khoản thanh toán:
                        <input type="text" name="kh_tendangnhap" id="kh_tendangnhap"
                            value="<?= $dataDongMuonSua['kh_tendangnhap'] ?>"
                        class="form-control"
                        />

                        </br>
                        <button name="btnSave" id="btnSave" class="btn btn-primary">
                        Lưu dữ liệu
                        </button>
                        </br></br>
                </form>

                <?php
                    // Khi người dùng bấm lưu thì xử lý
                    if(isset($_POST['btnSave'])) {
                        //1. Mở kết nối
                        include_once __DIR__ . '/../../dbconnect.php';
                        //2. chuẩn bị câu lệnh
                        $ma = $_POST['dh_ma'];
                        $ngaylap = $_POST['dh_ngaylap'];
                        $trangthai = $_POST['dh_trangthaithanhtoan'];
                        $hinhthucthanhtoan = $_POST['httt_ma'];
                        $taikhoan = $_POST['kh_tendangnhap'];
                        //Heredoc
                        $sql = <<<EOT
                        UPDATE dondathang
                        SET dh_ma= $ma, dh_ngaylap='$ngaylap', dh_trangthaithanhtoan= $trangthai, httt_ma='$hinhthucthanhtoan', kh_tendangnhap='$taikhoan'
                        WHERE dh_ma= $ma;
EOT;
                        //debug
                        var_dump($sql);
                        die;

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