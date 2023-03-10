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
    SELECT  ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai,
        SUM(spddh.sp_dh_dongia * spddh.sp_dh_soluong ) AS TongThanhTien
    FROM dondathang ddh
    JOIN hinhthucthanhtoan httt ON httt.httt_ma = ddh.httt_ma
    JOIN khachhang kh ON kh.kh_tendangnhap = ddh.kh_tendangnhap
    JOIN sanpham_dondathang spddh ON spddh.dh_ma = ddh.dh_ma
    GROUP BY ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
EOT;

                    //Thực thi câu truy vấn SQL để lấy về dữ liệu
                    $result = mysqli_query($conn, $sql);
                    // var_dump($result); die;
                    //Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array(
                            'dh_ma' => $row['dh_ma'],
                            'dh_ngaylap' => date('d/m/Y H:i:s', strtotime($row['dh_ngaylap'])),
                            'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                            'httt_ten' => $row['httt_ten'],
                            'kh_ten' => $row['kh_ten'],
                            'kh_dienthoai' => $row['kh_dienthoai'],
                            'TongThanhTien' => number_format($row['TongThanhTien'], 2, ".", ",") . ' vnđ',
                        );
                    }
                ?>
 
                    <a href="create.php" class="btn btn-success">
                        Thêm mới
                    </a>
                    <br/><br/>
                    
                        <table id="tblDanhSach" class="table mt-2 table-hover table-sm  table-bordered ">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày lập</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Tổng thành tiền</th>
                                    <th>Trạng thái thanh toán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $dondathang) : ?>
                                    <tr>
                                        <td><?= $dondathang['dh_ma'] ?></td>
                                        <td><b><?= $dondathang['kh_ten'] ?></b><br />(<?= $dondathang['kh_ten'] ?>)</td>
                                        <td><?= $dondathang['dh_ngaylap'] ?></td>
                                        <td><span class="badge badge-primary"><?= $dondathang['httt_ten'] ?></span></td>
                                        <td><?= $dondathang['TongThanhTien'] ?></td>
                                        <td>
                                            <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                                <span class="badge badge-danger">Chưa xử lý</span>
                                            <?php else : ?>
                                                <span class="badge badge-success">Đã thanh toán</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                            <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                                <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                                                <a href="edit.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-warning">
                                                    Sửa
                                                </a>
                                                <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                                <button type="button" class="btn btn-danger btnDelete" data-dh_ma="<?= $dondathang['dh_ma'] ?>">
                                                    Xóa
                                                </button>
                                            <?php else : ?>
                                                <!-- Đơn hàng nào đã thanh toán rồi thì không cho phép Xóa, Sửa (không hiển thị 2 nút này ra giao diện) 
                                                - Cho phép IN ấn ra giấy
                                                -->
                                                <!-- Nút in, bấm vào sẽ hiển thị mẫu in thông tin dựa vào khóa chính -->
                                                <a href="print.php?ddh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-success">
                                                    In
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        
                        </table>

                    

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
    
    <script>
        $(document).ready(function() {
            // Yêu cầu DataTable quản lý datatable #tblDanhSach
            $('#tblDanhSach').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });

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

                            // 3. Lấy giá trị của thuộc tính (custom attribute HTML) 'dh_ma'
                            // var dh_ma = $(this).attr('data-dh_ma');
                            var dh_ma = $(this).data('dh_ma');
                            var url = "delete.php?dh_ma=" + dh_ma;

                            // Điều hướng qua trang xóa với REQUEST GET, có tham số dh_ma=...
                            location.href = url;
                        } else { // Nếu không đồng ý xóa
                            swal("Cẩn thận hơn nhé!");
                        }
                    });

            });
        });
    </script>




</body>
</html>