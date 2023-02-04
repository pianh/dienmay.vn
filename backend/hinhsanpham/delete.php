<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>
    
    <title>Xóa hình sản phẩm</title>
    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
        .hinh-sp {
            height: 200px;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>

            <div class="col-md-10 ">
                <h2 class="text-center">Xóa hình sản phẩm</h2>
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                //1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                //TRUY VẤN TÌM DỮ LIỆU CỦA DÒNG MUỐN XÓA
                $hsp_ma = $_GET['hsp_ma'];
                $sqlSelecthsp_MuonXoa = "
                    SELECT *
                    FROM hinhsanpham
                    WHERE hsp_ma = $hsp_ma;
                    ";
                $resulthsp_MuonXoa = mysqli_query($conn, $sqlSelecthsp_MuonXoa);
                //Phan tách dữ liệu thành array PHP
                $datahsp_MuonXoa = mysqli_fetch_array($resulthsp_MuonXoa, MYSQLI_ASSOC);

                //Option select SP
                $sqlSelectsanpham = "
                    SELECT *
                    FROM sanpham;
                ";
                //Thực thi
                $resultsanpham = mysqli_query($conn, $sqlSelectsanpham);
                //Phan tách thành mảng array PHP
                $datasanpham = [];
                while ($row = mysqli_fetch_array($resultsanpham, MYSQLI_ASSOC)) {
                    $datasanpham[] = array(
                        'sp_ma' => $row['sp_ma'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => $row['sp_gia'] 
                    );

                } 
                ?>

            <form name="frmDelete" id="frmDelete" method="post"  action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Sản phẩm</label>
                    <select name="sp_ma" id="sp_ma" class="form-control">
                        <?php foreach($datasanpham as $sp): ?>
                            <?php if( $datahsp_MuonSua['sp_ma'] == $sp['sp_ma']): ?>
                                <option selected value="<?= $sp['sp_ma'] ?>"><?= $sp['sp_ten'] ?></option>
                            <?php else: ?>
                                <option value="<?= $sp['sp_ma'] ?>"><?= $sp['sp_ten'] ?></option>

                            <?php endif; ?>
                        <?php endforeach; ?>

                    </select>

                </div>
                <div class="form-group">
                    <label for="">Hình sản phẩm</label>
                    <br />
                        <img src="/dienmay.vn/assets/uploads/images/<?= $datahsp_MuonXoa['hsp_tentaptin'] ?>" class="img-fluid hinh-sp">
                    <br />
                    
                </div>
                <button name="btnXoa" class="btn btn-danger">Xóa hình</button>
            </form>

            <?php
                //2.Chuẩn bị câu lệnh
                if(isset($_POST['btnXoa'])) {
                    $sp_ma = $_POST['sp_ma'];
                    //3. Xử lý file
                    $filePath = __DIR__ . '/../../assets/uploads/images/' .$datahsp_MuonXoa['hsp_tentaptin'];
                    unlink($filePath);
                    //6. Chuẩn bị câu lệnh DELETE
                    $sqlSelecthsp = "
                        DELETE FROM hinhsanpham
                        WHERE hsp_ma= $hsp_ma and sp_ma= $sp_ma;
                        ";
                    //7. Thực thi
                    mysqli_query($conn, $sqlSelecthsp);
                    //8. Sau khi FILE & xóa dòng dữ liệu DATABASE
                    //Điều hướng về trang index.php
                    echo '<script>location.href = "index.php";</script>';
                }
            ?>

            </div>
        </div>


    </div>

</body>
</html>


