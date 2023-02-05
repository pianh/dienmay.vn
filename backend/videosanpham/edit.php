<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Chỉnh sửa video sản phẩm</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
        .video-sp {
            height: 300px;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>
            <div class="col-md-10">
              <h2 class="text-center">Chỉnh sửa video sản phẩm</h2> 
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    //TRUY VẤN TÌM DỮ LIỆU CỦA DÒNG MUỐN SỬA
                    $vsp_ma = $_GET['vsp_ma'];
                    //Chuẩn bị câu lệnh
                    $sqlSelectvideo_MuonSua = "
                    SELECT *
                    FROM videosanpham
                    WHERE vsp_ma = $vsp_ma;
                    ";
                    //Thực thi câu lệnh
                    $resultvideo_Muonsua = mysqli_query($conn, $sqlSelectvideo_MuonSua);
                    //Phan tách dữ liệu thành array PHP
                    $datavideo_MuonSua = mysqli_fetch_array($resultvideo_Muonsua, MYSQLI_ASSOC);



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
                            <?php if( $datavideo_MuonSua['sp_ma'] == $sp['sp_ma']): ?>
                                <option selected value="<?= $sp['sp_ma'] ?>"><?= $sp['sp_ten'] ?></option>
                            <?php else: ?>
                                <option value="<?= $sp['sp_ma'] ?>"><?= $sp['sp_ten'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Video sản phẩm</label>
                    <br />
                        <video src="/dienmay.vn/assets/uploads/videos/<?= $datavideo_MuonSua['vsp_tentaptin']?>" controls class="video-sp">  </video>
                    <br /><br />
                    <input type="file" name="vsp_tentaptin" id="vsp_tentaptin" />
                </div>
                <button name="btnLuu" class="btn btn-primary">Lưu dữ liệu</button>
            </form>

                <?php

   
                    //2.Chuẩn bị câu lệnh
                    if(isset($_POST['btnLuu'])) {
                        $sp_ma = $_POST['sp_ma'];
                        
                        //3. Xử lý file
                        if( isset($_FILES['vsp_tentaptin'] )) {

                            $upload_dir = __DIR__ . "/../../assets/uploads/videos/";
                            // 3.1. Chuyển file từ thư mục tạm vào thư mục Uploads
                            // Nếu file upload bị lỗi, tức là thuộc tính error > 0
                            if ($_FILES['vsp_tentaptin']['error'] > 0) {
                                echo 'File Upload Bị Lỗi'; die;
                            } else {
                                    //5. XÓA FILE ẢNH ĐỂ TRÁNH RÁC
                                    $filePath = __DIR__ . '/../../assets/uploads/videos/' .$datavideo_MuonSua['vsp_tentaptin'];
                                    unlink($filePath);

                                $video_tentaptin = $_FILES['vsp_tentaptin']['name'];
                                $tentaptin = date('YmdHis') . '_' . $video_tentaptin; //20200530154922_hoahong.jpg
                
                                move_uploaded_file($_FILES['vsp_tentaptin']['tmp_name'], $upload_dir . $tentaptin);
                            }
                            $sql = "
                            UPDATE videosanpham
                            SET vsp_tentaptin = '$tentaptin', sp_ma = $sp_ma
                            WHERE vsp_ma = $vsp_ma;
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