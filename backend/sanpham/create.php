<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Thêm mới sản phẩm</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>

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
                    $sqlSelectloaisanpham = "
                        SELECT *
                        FROM loaisanpham;
                    ";
                    //Thực thi
                    $resultloaisanpham = mysqli_query($conn, $sqlSelectloaisanpham);
                    //Phan tách thành mảng array PHP
                    $dataloaisanpham = [];
                    while ($rowloaisanpham = mysqli_fetch_array($resultloaisanpham, MYSQLI_ASSOC)) {
                        $dataloaisanpham[] = array(
                            'lsp_ma' => $rowloaisanpham['lsp_ma'],
                            'lsp_ten' => $rowloaisanpham['lsp_ten'],
                        );
                    }
  
                    // var_dump($data);die;
                ?>


            <div class="col-md-10">
                </br>
                <h2 class="text-center">Thêm mới sản phẩm</h2>
                <form name="frmEdit" id="frmEdit" method="post" action="">
                    Tên sản phẩm (*):
                    <br/>
                    <input type="text" name="sp_ten" id="sp_ten" class="form-control"/>
                    <br />

                    <label for="">Loại sản phẩm:</label>
                    <select name="lsp_ma" id="lsp_ma" class="form-control">
                        <option value="">Vui lòng chọn loại sản phẩm</option>
                        <?php foreach($dataloaisanpham as $lsp): ?>
                            <option value="<?= $lsp['lsp_ma'] ?>"><?= $lsp['lsp_ten'] ?></option>
                            <!-- <option value=""><?= $nkh['nkh_tomtat'] ?></option> -->
                        <?php endforeach; ?>

                    </select>

                    </br>
                    Giá:
                    <input type="text" name="sp_gia" id="sp_gia" class="form-control"></input>
                    <br/>

                    Mô tả ngắn:
                    <textarea name="sp_mota_ngan" id="sp_mota_ngan" class="form-control"></textarea>
                    <br/>

                    Mô tả chi tiết:
                    <textarea name="sp_mota_chitiet" id="sp_mota_chitiet" class="form-control"></textarea>
                    <br/>
                    

                    Ngày cập nhật:
                    <input type="datetime-local" name="sp_ngaycapnhat" id="sp_ngaycapnhat" class="form-control"></input>
                    <br/>



                    <button name="btnSave" id="btnSave" class="btn btn-primary">
                    Lưu dữ liệu
                    </button>
                    <br/><br/>
                </form>
                <?php

                // Khi người dùng bấm lưu thì xử lý
                if(isset($_POST['btnSave'])) {
                    //1. Mở kết nối đến database
                    // include_once __DIR__ . '/../../dbconnect.php';
                    //2. chuẩn bị câu lệnh
                    $ten = htmlentities ($_POST['sp_ten']);
                    $maloai = ($_POST['lsp_ma']);
                    $gia = htmlentities ($_POST['sp_gia']);
                    $motangan = htmlentities ($_POST['sp_mota_ngan']);
                    $motachitiet = htmlentities ($_POST['sp_mota_chitiet']);
                    $ngaycapnhat = htmlentities ($_POST['sp_ngaycapnhat']);
                    $sql = "INSERT INTO sanpham(sp_ten, sp_ma, sp_gia, sp_mota_ngan, sp_mota_chitiet,sp_ngaycapnhat  ) VALUES ('$ten', $maloai, $gia, '$motangan', '$motachitiet', '$ngaycapnhat' );";
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