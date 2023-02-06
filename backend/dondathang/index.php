<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>
    <title>Danh sách các đơn đặt hàng</title>
    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h1 class="text-center">Danh sách các đơn đặt hàng</h1>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối đến database
                    include_once __DIR__ . '/../../dbconnect.php';
                    // 2. Chuẩn bị câu truy vấn $sql
                    // Sử dụng HEREDOC của PHP để tạo câu truy vấn SQL với dạng dễ đọc, thân thiện với việc bảo trì code
                    $sql = <<<EOT
    SELECT  ddh.dh_ma, ddh.dh_ngaylap, ddt.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten,  
    FROM dondathang ddh
    JOIN hinhthucthanhtoan httt ON httt.httt_ma = ddh.httt_ma
    JOIN khachhang kh ON kh.kh_tendangnhap = ddh.kh_tendangnhap
EOT;
                ?>
 

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