<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Danh sách video sản phẩm</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
        .video-sp {
            height: 150px;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h1 class="text-center">Danh sách video sản phẩm</h1>
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                //1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                //2. Chuẩn bị câu lệnh
                $sql = "
                SELECT vsp.vsp_ma, vsp.vsp_tentaptin, sp.sp_ten
                FROM videosanpham vsp
                JOIN sanpham sp ON vsp.sp_ma = sp.sp_ma;";
                //3. Thuc thi
                $result = mysqli_query($conn, $sql);
                //4. Phân tách thành mảng array
                $data = [];
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array (
                        'vsp_ma' => $row['vsp_ma'],
                        'vsp_tentaptin' => $row['vsp_tentaptin'],
                        'sp_ten' => $row['sp_ten'],
                    );
                }

                //  var_dump($data);
                //  die;
                ?>
                <a href="create.php" class="btn btn-success">Thêm video cho sản phẩm</a>
                <br />
                <br />
                <table class="table table-bordered table-hover">
                    <thead class="table-info text-center">
                        <tr>
                            <th>Mã video</th>
                            <th>Tập tin video</th>
                            <th>Tên sản phẩm</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <?php foreach($data as $video): ?>
                        <tr>
                            <td><?= $video['vsp_ma'] ?></td>
                            <td>
                                <video src="/dienmay.vn/assets/uploads/videos/<?= $video['vsp_tentaptin']?>" controls class="video-sp">  </video>
                            </td>
                            <td><?= $video['sp_ten'] ?></td>
                            <td>
                                <a href="edit.php?vsp_ma=<?= $video['vsp_ma'] ?>" class="btn btn-warning">Sửa</a>
                                <!-- <a href="delete.php?hsp_ma=<?= $video['vsp_ma'] ?>" class="btn btn-danger">Xóa</a> -->
                                <button type="button" class="btn btn-danger btnDelete" data-hsp_ma="<?= $video['vsp_ma'] ?>">
                                    Xóa
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>




            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
    <!-- SweetAlert -->
    <script>
   
   // Cảnh báo khi xóa
   // 1. Đăng ký sự kiện click cho các phần tử (element) đang áp dụng class .btnDelete
   $('.btnDelete').click(function() {
       // Click hanlder
       // 2. Sử dụng thư viện SweetAlert để hiện cảnh báo khi bấm nút xóa
       swal({
               title: "Bạn có chắc chắn muốn xóa?",
               text: "Một khi đã xóa, không thể phục hồi....",
               icon: "warning",
               buttons: true,
               dangerMode: true,
           })
           .then((willDelete) => {
               if (willDelete) { // Nếu đồng ý xóa

                   // 3. Lấy giá trị của thuộc tính (custom attribute HTML) 'km_ma'
                   // var km_ma = $(this).attr('data-km_ma');
                   var hsp_ma = $(this).data('hsp_ma');
                   var url = "delete.php?hsp_ma=" + hsp_ma;

                   // Điều hướng qua trang xóa với REQUEST GET, có tham số km_ma=...
                   location.href = url;
               } else { // Nếu không đồng ý xóa
                   swal("Cẩn thận hơn nhé!");
               }
           });

   });
   </script>
</body>
</html>