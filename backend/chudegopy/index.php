<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>
    <title>Danh sách các chủ đề góp ý</title>
    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h1 class="text-center">Danh sách các chủ đề góp ý</h1>
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
                    $sql = "SELECT * FROM chudegopy
                    order by cdgy_ma asc;";

                    //3. Thuc thi
                    $result = mysqli_query($conn, $sql);

                    //4. Phân tách thành mảng array
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array (
                            'cdgy_ma' => $row['cdgy_ma'],
                            'cdgy_ten' => $row['cdgy_ten']
                            
                        );
                    }
                    //  var_dump($data);
                    //  die;
                ?>
                <a href="create.php" class="btn btn-success">Thêm mới</a>
                </br></br>
                <table class="table table-bordered table-hover">
                        <thead class="table-info text-center">
                            <tr>
                                <th>Mã chủ đề góp ý</th>
                                <th>Tên chủ đề góp ý</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                    <?php foreach($data as $cdgy): ?>
                        <tr>
                            <td><?= $cdgy['cdgy_ma']  ?>  </td>
                            <td><?php echo $cdgy['cdgy_ten']  ?></td>
                            <td>
                                <!-- Nút sửa -->
                                <a href="edit.php?cdgy_ma=<?= $cdgy['cdgy_ma']?>" class="btn btn-warning ">Sửa</a>
                                <!-- Nút xóa -->
                                <!-- <a href="delete.php?cdgy_ma=<?= $cdgy['cdgy_ma']?>" class="btn btn-danger btnDelete">Xóa</a> -->
                                <button type="button" class="btn btn-danger btnDelete" data-cdgy_ma="<?= $cdgy['cdgy_ma'] ?>">
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
                        var cdgy_ma = $(this).data('cdgy_ma');
                        var url = "delete.php?cdgy_ma=" + cdgy_ma;

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