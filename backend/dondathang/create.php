<!DOCTYPE html>
<html>

<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Thêm đơn đặt hàng</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>

<body>
    <!-- header -->
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid pb-150">
        <div class="row">
            <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
            <div class="col-md-10">
                <h2 class="text-center border-bottom pt-3 pb-2 mb-3">Thêm mới đơn thanh toán</h2>
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    include_once(__DIR__ . '/../../dbconnect.php');

                    //Truy vấn dữ liệu khách hàng
                    $sqlSelectkhachhang = "select * from `khachhang`";
                    $resultkhachhang = mysqli_query($conn, $sqlSelectkhachhang);
                    $datakhachhang = [];
                    while ($rowkhachhang = mysqli_fetch_array($resultkhachhang, MYSQLI_ASSOC)) {
                        // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
                        $kh_TomTat = sprintf(
                            "Họ tên %s, số điện thoại: %s",
                            $rowkhachhang['kh_ten'],
                            $rowkhachhang['kh_dienthoai'],
                        );
                        $datakhachhang[] = array(
                            'kh_tendangnhap' => $rowkhachhang['kh_tendangnhap'],
                            'kh_tomtat' => $kh_TomTat,
                        );
                    }
                    // var_dump($datakhachhang);die;

                    //Truy vấn dữ liệu hình thức thanh toán
                    $sqlSelecthinhthucthanhtoan = "select * from `hinhthucthanhtoan`";
                    $resulthinhthucthanhtoan = mysqli_query($conn, $sqlSelecthinhthucthanhtoan);
                    $datahinhthucthanhtoan = [];
                    while ($rowhinhthucthanhtoan = mysqli_fetch_array($resulthinhthucthanhtoan, MYSQLI_ASSOC)) {
                    $datahinhthucthanhtoan[] = array(
                        'httt_ma' => $rowhinhthucthanhtoan['httt_ma'],
                        'httt_ten' => $rowhinhthucthanhtoan['httt_ten'],
                    );
                    }
                    // var_dump($datahinhthucthanhtoan);die;

                    //Truy vấn dữ liệu sản phẩm
                    $sqlSelectsanpham = "select * from `sanpham`";
                    $resultsanpham = mysqli_query($conn, $sqlSelectsanpham);
                    $datasanpham = [];
                    while ($rowsanpham = mysqli_fetch_array($resultsanpham, MYSQLI_ASSOC)) {
                        $datasanpham[] = array(
                            'sp_ma' => $rowsanpham['sp_ma'],
                            'sp_gia' => $rowsanpham['sp_gia'],
                            'sp_ten' => $rowsanpham['sp_ten'],
                        );
                    }
                    // var_dump($datasanpham);die;
                ?>

                <form action=""name="frmdondathang" id="frmdondathang" method="post" enctype="multipart/form-data">
                    <fieldset name="donhangContainer" id="donhangContainer">
                        <legend>Thông tin Đơn hàng</legend>
                        <!-- Khách hàng -->
                        <div class="form-row">
                            <div class="col-md-12 form-group">
                                <label>Khách hàng</label>
                                    <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                        <option value="">Vui lòng chọn khách hàng</option>
                                        <?php foreach ($datakhachhang as $khachhang):?>
                                            <option value="<?=$khachhang['kh_tendangnhap']?>"><?=$khachhang['kh_tomtat']?></option>
                                        <?php endforeach;?>
                                    </select>
                            </div>
                        </div>
                        <!-- End khách hàng -->
                        <!-- Ngày lập, ngày giao, nơi giao đơn-->
                        <div class="form-row">
                            <div class="col-sm-4 form-group">
                                <label>Ngày lập</label>
                                <input type="datetime-local" name="dh_ngaylap" id="dh_ngaylap" class="form-control" />
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Ngày giao</label>
                                <input type="datetime-local" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control" />
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Nơi giao</label>
                                <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control" />
                            </div>

                        </div>
                        <!-- End Ngày lập, ngày giao, nơi giao đơn--->
                        <!-- Trạng thái và hình thức thanh toán -->
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label>Trạng thái thanh toán</label>
                                <br />
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
                                    <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Hình thức thanh toán</label>
                                <br />
                                <select name="httt_ma" id="httt_ma" class="form-control">
                                    <option value="">Vui lòng chọn Hình thức thanh toán</option>
                                    <?php foreach ($datahinhthucthanhtoan as $httt) : ?>
                                        <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- End Trạng thái và hình thức thanh toán -->
                    </fieldset>

                    <fieldset name="chiTietDonHangContainer" id="chiTietDonHangContainer">
                        <legend>Thông tin Chi tiết Đơn thanh toán</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <!-- sản phẩm -->
                                <label for="sp_ma">Sản phẩm</label>
                                <select class="form-control" id="sp_ma" name="sp_ma">
                                    <option value="">Vui lòng chọn sản phẩm</option>
                                    <?php foreach ($datasanpham as $sanpham) : ?>
                                        <option value="<?= $sanpham['sp_ma'] ?>" data-sp_gia="<?= $sanpham['sp_gia']?>"> <?= $sanpham['sp_ten'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- end sản phẩm -->
                            </div>
                            <div class="form-group col-md-3">
                                <label>Số lượng</label><br />
                                <input type="text" name="soluong" id="soluong" class="form-control" />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Xử lý</label><br />
                                <button type="button" id="btnThemsanpham" class="btn btn-success">Thêm vào đơn đặt hàng</button>
                            </div>
                        </div>
                        <!-- Table chi tiết đơn hàng -->
                        <div class="form-group col-md-12" style="padding: 0;">
                            <table id="tblChiTietDonHang" class="table table-bordered">
                                <thead>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Hành động</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table chi tiết đơn hàng -->
                    </fieldset>
                    <button class="btn btn-primary" name="btnSave">Lưu</button>
                    <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
                </form>

                <?php
                if (isset($_POST['btnSave'])) {
                    //Phân tách lấy dữ liệu người dùng gởi từ REQUEST POST
                    $kh_tendangnhap = $_POST['kh_tendangnhap'];
                    $dh_ngaylap = $_POST['dh_ngaylap'];
                    $dh_ngaygiao = $_POST['dh_ngaygiao'];
                    $dh_noigiao = $_POST['dh_noigiao'];
                    $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                    $httt_ma = $_POST['httt_ma'];
                    
                    // Thông tin các dòng chi tiết đơn hàng
                    $arr_sp_ma = $_POST['sp_ma'];                   // mảng array do đặt tên name="sp_ma[]"
                    $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];
                    $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];     // mảng array do đặt tên name="sp_dh_dongia[]"
                    

                    $sqlInsertdondathang = "INSERT INTO `dondathang` (`dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `dh_trangthaithanhtoan`, `httt_ma`, `kh_tendangnhap`) VALUES ('$dh_ngaylap', '$dh_ngaygiao', N'$dh_noigiao', '$dh_trangthaithanhtoan', '$httt_ma', '$kh_tendangnhap')";
                    // print_r($sqlInsertdondathang); die;

                    // Thực thi INSERT Đơn hàng
                    mysqli_query($conn, $sqlInsertdondathang);

                    // 3. Lấy ID Đơn hàng mới nhất vừa được thêm vào database
                    // Do ID là tự động tăng (PRIMARY KEY và AUTO INCREMENT), nên chúng ta không biết được ID đă tăng đến số bao nhiêu?
                    // Cần phải sử dụng biến `$conn->insert_id` để lấy về ID mới nhất
                    // Nếu thực thi câu lệnh INSERT thành công thì cần lấy ID mới nhất của Đơn hàng để làm khóa ngoại trong Chi tiết đơn hàng
                    $dh_ma = $conn->insert_id;

                    // 4. Duyệt vòng lặp qua mảng các dòng Sản phẩm của chi tiết đơn hàng được gởi đến qua request POST
                    for($i = 0; $i < count($arr_sp_ma); $i++) {
                        // 4.1. Chuẩn bị dữ liệu cho câu lệnh INSERT vào table
                        $sp_ma = $arr_sp_ma[$i];
                        $sp_dh_soluong = $arr_sp_dh_soluong[$i];
                        $sp_dh_dongia = $arr_sp_dh_dongia[$i];

                        // 4.2. Câu lệnh INSERT
                        $sqlInsertsanphamdondathang = "INSERT INTO `sanpham_dondathang` (`sp_ma`, `dh_ma`, `sp_dh_soluong`, `sp_dh_dongia`) VALUES ($sp_ma, $dh_ma, $sp_dh_soluong, $sp_dh_dongia)";
                        
                        // 4.3. Thực thi INSERT
                        mysqli_query($conn, $sqlInsertsanphamdondathang);
                    }

                    // 5. Thực thi hoàn tất, điều hướng về trang Danh sách
                    echo '<script>location.href = "index.php";</script>';

                }
                ?>
                

            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

    <script>
        // Đăng ký sự kiện Click nút Thêm Sản phẩm
               // Đăng ký sự kiện Click nút Thêm Sản phẩm
        $('#btnThemsanpham').click(function() {
            // debugger;
            // Lấy thông tin Sản phẩm
            var sp_ma = $('#sp_ma').val();
            var sp_gia = $('#sp_ma option:selected').data('sp_gia');
            var sp_ten = $('#sp_ma option:selected').text();
            var soluong = $('#soluong').val();
            var thanhtien = (soluong * sp_gia);
            
            // Tạo mẫu giao diện HTML Table Row
            var htmlTemplate = '<tr>'; 
            htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '"/></td>';
            htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
            htmlTemplate += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
            htmlTemplate += '<td>' + thanhtien + '</td>';
            htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
            htmlTemplate += '</tr>';

            // Thêm vào TABLE BODY
            $('#tblChiTietDonHang tbody').append(htmlTemplate);

            // Clear
            $('#sp_ma').val('');
            $('#soluong').val('');
        });

        // Đăng ký sự kiện cho tất cả các nút XÓA có sử dụng class .btn-delete-row
        $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
            // Ta có cấu trúc
            // <tr>
            //    <td>
            //        <button class="btn-delete-row"></button>     <--- $(this) chính là đối tượng đang được người dùng click
            //    </td>
            // </tr>
            
            // Từ nút người dùng click -> tìm lên phần tử cha -> phần tử cha
            // Xóa dòng TR
            $(this).parent().parent()[0].remove();
        });
    </script>

</body>

</html>