<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Sửa chương trình khuyến mãi</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-100">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h1>Sửa chương trình khuyến mãi</h1>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    $khuyenmaiMuonSua = $_GET['km_ma'];
                    //1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuẩn bị câu lệnh
                    $sqlSelect = <<<EOT
                    SELECT km_ma, km_ten, km_noidung, km_tungay, km_denngay
                    FROM khuyenmai
                    WHERE km_ma = $khuyenmaiMuonSua;
EOT;
                    //3. Thực thi
                    $result = mysqli_query($conn, $sqlSelect);
                    $dataDongMuonSua = mysqli_fetch_array($result, MYSQLI_ASSOC)
                ?>

                <form name="frmEdit" id="frmEdit" method="post" action="">
                        Mã khuyến mãi (*):
                        <br/>
                        <input type="text" name="km_ma" id="km_ma"
                            value="<?= $dataDongMuonSua['km_ma']?>"
                        class="form-control"
                        readonly/>
                        <br />
                    
                        Tên khuyến mãi (*):
                        <br/>
                        <input type="text" name="km_ten" id="km_ten"
                            value="<?= $dataDongMuonSua['km_ten'] ?>"
                        class="form-control"
                        />
                        <br />

                        Nội dung khuyến mãi:
                        <textarea name="km_noidung" id="km_noidung" class="form-control"><?= $dataDongMuonSua['km_noidung'] ?></textarea>

                        </br>
                        Khuyễn mãi từ ngày:
                        <input type="date" name="km_tungay" id="km_tungay"
                            value="<?= $dataDongMuonSua['km_tungay'] ?>"
                        class="form-control"
                        />

                        </br>
                        Khuyễn mãi đến ngày:
                        <input type="date" name="km_denngay" id="km_denngay"
                            value="<?= $dataDongMuonSua['km_denngay'] ?>"
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
                        $ma = $_POST['km_ma'];
                        $ten = $_POST['km_ten'];
                        $noidung = $_POST['km_noidung'];
                        $tungay = $_POST['km_tungay'];
                        $denngay = $_POST['km_denngay'];
                        //Heredoc
                        $sql = <<<EOT
                        UPDATE khuyenmai
                        SET km_ten='$ten', km_noidung='$noidung', km_tungay='$tungay', km_denngay='$denngay'
                        WHERE km_ma= $ma;
EOT;
                        //debug
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