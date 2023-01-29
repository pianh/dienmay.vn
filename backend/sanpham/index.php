<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Danh sách các sản phẩm hiện có</title>

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
                <h1 class="text-center">Danh sách các sản phẩm hiện có</h1>
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
                    $sql = "SELECT * FROM sanpham sp INNER JOIN loaisanpham lsp ON sp.sp_ma=lsp.lsp_ma
                    group by sp_ten
                    order by sp_ma asc ;";

                    //3. Thuc thi
                    $result = mysqli_query($conn, $sql);

                    //4. Phân tách thành mảng array
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array (
                            'sp_ma' => $row['sp_ma'],
                            'sp_ten' => $row['sp_ten'],
                            'lsp_ten' => $row['lsp_ten'],
                            'sp_gia' => $row['sp_gia'],
                            'sp_mota_ngan' => $row['sp_mota_ngan'],
                            'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                            'sp_ngaycapnhat' => $row['sp_ngaycapnhat']
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
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Loại</th>
                                <th>Giá</th>
                                <th>Mô tả ngắn</th>
                                <th>Mô tả chi tiết</th>
                                <th>Ngày cập nhật</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                    <?php foreach($data as $sp): ?>
                        <tr>
                            <td><?= $sp['sp_ma']  ?>  </td>
                            <td><?php echo $sp['sp_ten']  ?></td>
                            <td><?php echo $sp['lsp_ten']  ?></td>
                            <td><?php echo $sp['sp_gia']  ?></td>
                            <td><?php echo $sp['sp_mota_ngan']  ?></td>
                            <td><?php echo $sp['sp_mota_chitiet']  ?></td>
                            <td><?php echo $sp['sp_ngaycapnhat']  ?></td>
                            <td>
                                <!-- Nút sửa -->
                                <a href="edit.php?sp_ma=<?= $sp['sp_ma']?>" class="btn btn-warning">Sửa</a>
                                </br></br>
                                <!-- Nút xóa -->
                                <!-- <a href="delete.php?kh_makhoahoc=<?= $kh['sp_ma']?>" class="btn btn-danger">Xóa</a> -->
                                <button type="button" class="btn btn-danger btnDelete" data-sp_ma="<?= $sp['sp_ma'] ?>">
                                    Xóa
                                </button>
                                <div style="padding-top: 10px;"></div>
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
                   var sp_ma = $(this).data('sp_ma');
                   var url = "delete.php?sp_ma=" + sp_ma;

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