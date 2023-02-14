<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../../layouts/meta.php'; ?>

    <title>Báo cáo khách hàng</title>

    <?php include_once __DIR__ . '/../../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                </br>
                <h1 class="text-center">Xuất báo cáo danh sách khách hàng</h1>
                </br>
                <?php
                    // Hiển thị tất cả lỗi trong PHP
                    // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                    // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối đến database
                    include_once __DIR__ . '/../../../dbconnect.php';
                    //2. Chuan bi cau lenh
                ?>   
                <table class="table table-bordered table-hover ">
                    <thead class="table-info text-center">
                        <tr>
                            <th>Xuất Excel</th>
                            <th>Xuất Word</th>
                            <th>Xuất PDF</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>
                            <a href="/dienmay.vn/backend/xuatbaocao/khachhang/excel-vendor.php" class="btn btn-success" target="_blank">Xuất Excel</a>
                            <br /><br />
                            <!-- <a href="/dienmay.vn/backend/xuatbaocao/khachhang/danhsachkhachhang.xlsx" class="btn btn-success" target="_blank">Xuất Excel</a> -->
                            
                            <a href="/dienmay.vn/assets/templates/excels/danhsachkhachhang.xlsx">Tải File Excel danh sách khách hàng</a>
                        </td>
                        <td>
                            <a href="/dienmay.vn/backend/xuatbaocao/khachhang/word-vendor.php" class="btn btn-success" target="_blank">Xuất Word</a>
                            <br /><br />
                            <a href="/dienmay.vn/assets/templates/words/danhsachkhachhang.docx">Tải File Word danh sách khách hàng</a>
                        </td>
                        <td>
                            <a href="/dienmay.vn/backend/xuatbaocao/khachhang/mpdf-vendor.php" class="btn btn-success" target="_blank">Xuất PDF</a>
                            <br /><br />
                            <a href="/dienmay.vn/assets/templates/pdfs/danhsachkhachhang.pdf" target="_blank">Tải File PDF danh sách khách hàng</a>
                        </td>

                    </tr>
                </table>    


            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../../layouts/scripts.php' ?>
</body>
</html>