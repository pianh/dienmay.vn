<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Danh sách các chương trình khuyến mãi</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <!-- DataTable CSS -->
    <!-- <link href="/learnforever.xyz/assets/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet" /> -->
    <!-- <link href="/learnforever.xyz/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet" /> -->
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450" >
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
            </br>
            <h1 class="text-center">Danh sách các chương trình khuyến mãi</h1>
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
                    $sql = "SELECT * FROM khuyenmai
                    order by km_ma asc;";

                    //3. Thuc thi
                    $result = mysqli_query($conn, $sql);

                    //4. Phân tách thành mảng array
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array (
                            'km_ma' => $row['km_ma'],
                            'km_ten' => $row['km_ten'],
                            'km_noidung' => $row['km_noidung'],
                            'km_tungay' => $row['km_tungay'],
                            'km_denngay' => $row['km_denngay']
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
                                <th>Mã khuyến mãi</th>
                                <th>Tên khuyến mãi</th>
                                <th>Nội dung</th>
                                <th>Từ ngày</th>
                                <th>Đến ngày</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                    <?php foreach($data as $km): ?>
                        <tr>
                            <td><?= $km['km_ma']  ?>  </td>
                            <td><?php echo $km['km_ten']  ?></td>
                            <td><?php echo $km['km_noidung']  ?></td>
                            <td><?php echo $km['km_tungay']  ?></td>
                            <td><?php echo $km['km_denngay']  ?></td>
                            <td>
                                <!-- Nút sửa -->
                                <a href="edit.php?km_ma=<?= $km['km_ma']?>" class="btn btn-warning">Sửa</a>
                                <!-- Nút xóa -->
                                <!-- <a href="delete.php?km_ma=<?= $km['km_ma']?>" class="btn btn-danger">Xóa</a> -->
                                <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `km_ma` -->
                                <button type="button" class="btn btn-danger btnDelete" data-km_ma="<?= $km['km_ma'] ?>">
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
                            var km_ma = $(this).data('km_ma');
                            var url = "delete.php?km_ma=" + km_ma;

                            // Điều hướng qua trang xóa với REQUEST GET, có tham số km_ma=...
                            location.href = url;
                        } else { // Nếu không đồng ý xóa
                            swal("Cẩn thận hơn nhé!");
                        }
                    });

            });

    </script>


        





    </script>

    
</body>
</html>