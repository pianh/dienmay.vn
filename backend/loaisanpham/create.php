<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Thêm mới loại sản phẩm</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>

</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h2 class="text-center">Thêm mới loại sản phẩm</h2>
                <form name="frmCreate" id="frmCreate" method="post" action="">
                    Tên loại sản phẩm (*):
                    <br/>
                    <input type="text" name="lsp_ten" id="lsp_ten" class="form-control"/>
                    <br />

                    Mô tả loại sản phẩm:
                    <textarea name="lsp_mota" id="lsp_mota" class="form-control"></textarea>
                    <br/>
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
                    $ten = htmlentities ($_POST['lsp_ten']);
                    $mota = htmlentities ($_POST['lsp_mota']);
                    $sql = "INSERT INTO loaisanpham(lsp_ten, lsp_mota) VALUES ('$ten', '$mota');";
                    //debug
                    var_dump($sql);
                    die;

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