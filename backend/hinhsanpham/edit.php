<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Chỉnh sửa hình sản phẩm</title>

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
              <h2 class="text-center">Chỉnh sửa hình sản phẩm</h2> 
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    //TRUY VẤN TÌM DỮ LIỆU CỦA DÒNG MUỐN SỬA
                    $hsp_ma = $_GET['hsp_ma'];
                    //Chuẩn bị câu lệnh
                    $sqlSelecthsp_MuonSua = "
                    SELECT *
                    FROM hinhsanpham
                    WHERE hsp_ma = $hsp_ma;
                    ";
                    //Thực thi câu lệnh
                    $resulthsp_MuonSua = mysqli_query($conn, $sqlSelecthsp_MuonSua);
                    //Phan tách dữ liệu thành array PHP
                    $datahsp_MuonSua = mysqli_fetch_array($resulthsp_MuonSua, MYSQLI_ASSOC);



                    //Chuẩn bị câu lệnh
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

              <form name="frmEdit" id="frmEdit" method="post"  action="" enctype="multipart/form-data">
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
                        <img src="/dienmay.vn/assets/uploads/images/<?= $datahsp_MuonSua['hsp_tentaptin'] ?>" class="img-fluid hinh-sp">
                    <br /><br />
                    <input type="file" name="hsp_tentaptin" id="hsp_tentaptin" />
                </div>
                <button name="btnLuu" class="btn btn-primary">Lưu dữ liệu</button>
              </form>

                <?php

   
                    //2.Chuẩn bị câu lệnh
                    if(isset($_POST['btnLuu'])) {
                        $sp_ma = $_POST['sp_ma'];
                        //3. Xử lý file
                        if( isset($_FILES['hsp_tentaptin'] )) {
                            $upload_dir = __DIR__ . "/../../assets/uploads/images/";
                            // 3.1. Chuyển file từ thư mục tạm vào thư mục Uploads
                            // Nếu file upload bị lỗi, tức là thuộc tính error > 0
                            if ($_FILES['hsp_tentaptin']['error'] > 0) {
                                echo 'File Upload Bị Lỗi'; die;
                            } else {
                                    //5. XÓA FILE ẢNH ĐỂ TRÁNH RÁC
                                    $filePath = __DIR__ . '/../../assets/uploads/images/' .$datahsp_MuonSua['hsp_tentaptin'];
                                    unlink($filePath);
                                // Để tránh trường hợp có 2 người dùng cùng lúc upload tập tin trùng tên nhau
                                // Cách giải quyết đơn giản là chúng ta sẽ ghép thêm ngày giờ vào tên file
                                $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                                $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin; //20200530154922_hoahong.jpg
                
                                // Tiến hành di chuyển file từ thư mục tạm trên server vào thư mục chúng ta muốn chứa các file uploads
                
                                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $tentaptin);
                            }
                            $sql = "
                            UPDATE hinhsanpham
                            SET hsp_tentaptin = '$tentaptin',
                                sp_ma = $sp_ma
                            WHERE hsp_ma = $hsp_ma;
                            "; 
                            //4. Thực thi
                            mysqli_query($conn, $sql);
                            //5. Điều hướng trang danh sách
                            echo '<script>location.href ="index.php";</script>';
                            
                        } 
                    }
                ?>

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
</body>
</html>