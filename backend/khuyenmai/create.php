<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Thêm mới chương trình khuyến mãi</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>

</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-100">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10 ">
                </br>
                <h2 class="text-center">Thêm mới chương trình khuyến mãi</h2>
                <form name="frmCreate" id="frmCreate" method="post" action="">
                    Tên chương trình khuyến mãi:
                    <br/>
                    <input type="text" name="km_ten" id="km_ten" class="form-control"/>
                    <br />

                    Nội dung khuyến mãi:
                    <textarea name="km_noidung" id="km_noidung" class="form-control"></textarea>
                    <br/>

                    Từ ngày:
                    <br/>
                    <input type="date" name="km_tungay" id="km_tungay" class="form-control"/>
                    <br />

                    Đến ngày:
                    <br/>
                    <input type="date" name="km_denngay" id="km_denngay" class="form-control"/>
                    <br />

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
                    $ten = htmlentities ($_POST['km_ten']);
                    $noidung = htmlentities ($_POST['km_noidung']);
                    $tungay = htmlentities ($_POST['km_tungay']);
                    $denngay = htmlentities ($_POST['km_denngay']);
                    $sql = "INSERT INTO khuyenmai(km_ten, km_noidung, km_tungay, km_denngay) VALUES ('$ten','$noidung', '$tungay', '$denngay' );";
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