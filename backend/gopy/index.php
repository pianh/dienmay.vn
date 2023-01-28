<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Danh sách các góp ý</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>

</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10 pb-450">
            </br>
            <h1 class="text-center">Danh sách các góp ý</h1>
            <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối đến database
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuan bi cau lenh
                    $sql = "SELECT * FROM gopy
                    order by gy_ma asc;";

                    //3. Thuc thi
                    $result = mysqli_query($conn, $sql);

                    //4. Phân tách thành mảng array
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array (
                            'gy_ma' => $row['gy_ma'],
                            'gy_hoten' => $row['gy_hoten'],
                            'gy_email' => $row['gy_email'],
                            'gy_dienthoai' => $row['gy_dienthoai'],
                            'gy_noidung' => $row['gy_noidung'],
                            'cdgy_ma' => $row['cdgy_ma']
                        );
                    }

                    //  var_dump($data);
                    //  die;
                ?>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                </br>
                </br>
                    <table class="table table-bordered table-hover">
                        <thead class="table-info">
                            <tr>
                                <th>Mã góp ý</th>
                                <th>Họ tên người góp ý</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Nội dung</th>
                                <th>Chủ đề</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                    <?php foreach($data as $gy): ?>
                        <tr>
                            <td><?= $gy['gy_ma']  ?>  </td>
                            <td><?php echo $gy['gy_hoten']  ?></td>
                            <td><?php echo $gy['gy_email']  ?></td>
                            <td><?php echo $gy['gy_dienthoai']  ?></td>
                            <td><?php echo $gy['gy_noidung']  ?></td>
                            <td><?php echo $gy['cdgy_ma']  ?></td>
                            <td>
                                <!-- Nút sửa -->
                                <a href="edit.php?gy_ma=<?= $gy['gy_ma']?>" class="btn btn-warning">Sửa</a>
                                <!-- Nút xóa -->
                                <!-- <a href="delete.php?gy_ma=<?= $gy['gy_ma']?>" class="btn btn-danger">Xóa</a> -->
                                <button type="button" class="btn btn-danger btnDelete" data-gy_ma="<?= $gy['gy_ma'] ?>">
                                    Xóa
                                </button>
                                </form>
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
                   var gy_ma = $(this).data('gy_ma');
                   var url = "delete.php?gy_ma=" + gy_ma;

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