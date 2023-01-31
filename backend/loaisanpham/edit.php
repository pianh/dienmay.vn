<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Sửa loại sản phẩm</title>

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
                <h1>Sửa loại sản phẩm</h1>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    $maMuonSua = $_GET['lsp_ma'];
                    //1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuẩn bị câu lệnh
                    $sqlSelect = <<<EOT
                    SELECT lsp_ma, lsp_ten, lsp_mota
                    FROM loaisanpham
                    WHERE lsp_ma = $maMuonSua;
EOT;
                    //3. Thực thi
                    $result = mysqli_query($conn, $sqlSelect);
                    $dataDongMuonSua = mysqli_fetch_array($result, MYSQLI_ASSOC)
                ?>

                <form name="frmEdit" id="frmEdit" method="post" action="">
                        Mã loại sản phẩm (*):
                        <br/>
                        <input type="text" name="lsp_ma" id="lsp_ma"
                            value="<?= $dataDongMuonSua['lsp_ma']?>"
                        class="form-control"
                        readonly/>
                        <br />
                    
                        Tên loại sản phẩm (*):
                        <br/>
                        <input type="text" name="lsp_ten" id="lsp_ten"
                            value="<?= $dataDongMuonSua['lsp_ten'] ?>"
                        class="form-control"
                        />
                        <br />

                        Mô tả loại sản phẩm:
                        <textarea name="lsp_mota" id="lsp_mota" class="form-control"><?= $dataDongMuonSua['lsp_mota'] ?></textarea>
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
                        $ma = $_POST['lsp_ma'];
                        $ten = $_POST['lsp_ten'];
                        $mota = $_POST['lsp_mota'];
                        //Heredoc
                        $sql = <<<EOT
                        UPDATE loaisanpham
                        SET lsp_ten='$ten', lsp_mota='$mota'
                        WHERE lsp_ma= $ma;
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