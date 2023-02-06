<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Bản tin Dashboard</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
</head>
<body >
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pb-450">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                <h1 class="text-center">Bản tin Dashboard</h1>
                <br/>
                <div class="container-fluid">
                    <!-- Start báo cáo thống kê -->
                    <div class="row text-center">
                            <div class="col-md-3">
                                <div class="card text-white bg-primary " >
                                    <div class="card-header">Tổng số sản phẩm</div>
                                    <div class="card-body">
                                    <div id="BaoCaosanpham_soluong"></div> 
                                    </div>
                                    <button type="button" class="btn btn-danger" id="btnRefeshsanpham_soluong">
                                        Refesh dữ liệu
                                    </button>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary " >
                                    <div class="card-header">Tổng số khách hàng</div>
                                    <div class="card-body">
                                    <div id="BaoCaokhachhang_soluong"></div> 
                                    </div>
                                    <button type="button" class="btn btn-danger" id="btnRefeshkhachhang_soluong">
                                        Refesh dữ liệu
                                    </button>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary " >
                                    <div class="card-header">Tổng số góp ý</div>
                                    <div class="card-body">
                                    <div id="BaoCaoGopY_soluong"></div> 
                                    </div>
                                    <button type="button" class="btn btn-danger" id="btnRefeshGopY_soluong">
                                        Refesh dữ liệu
                                    </button>
                                </div>                            
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary " >
                                    <div class="card-header">Tổng số đơn đặt hàng</div>
                                    <div class="card-body">
                                    <div id="BaoCaodonDatHang_soluong"></div> 
                                    </div>
                                    <button type="button" class="btn btn-danger" id="btnRefeshdonDatHang_soluong">
                                        Refesh dữ liệu
                                    </button>
                                </div>                            
                            </div>
                    </div>
                    <!-- End báo cáo thống kê -->
                    
                    <!-- Start vẽ biểu đồ -->
                    <div class="row text-center justify-content-center">
                        <div class="col-md-6 ">
                            <canvas id="chartOfobjChartThongKeloaisanpham"></canvas>
                            <button id="refreshThongKeloaisanpham" class="btn btn-primary">
                                Refresh biểu đồ thống kê loại sản phẩm
                            </button>
                        </div>

                        <div class="col-md-6">
                            <canvas id="chartOfobjChartThongKehinhsanpham"></canvas>
                            <button id="refreshThongKehinhsanpham" class="btn btn-primary">
                                Refresh biểu đồ thống kê hình sản phẩm
                            </button>
                        </div>
                    </div>  
                    <!-- End vẽ biểu đồ -->

                </div>

                

            </div>
        
        </div>
    </div>

    
    <!-- Footer -->
    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <!-- Nhúng file quản lý phần SCRIP JAVASCRIP -->
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>
    <script>
        $(function() {

            //START BÁO CÁO TỔNG SỐ 
            $('#btnRefeshsanpham_soluong').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/dienmay.vn/backend/api/baocao-tongsosanpham.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#BaoCaosanpham_soluong').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#BaoCaosanpham_soluong').html(htmlString);
                    }
                });
            });

            $('#btnRefeshkhachhang_soluong').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/dienmay.vn/backend/api/baocao-tongsokhachhang.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#BaoCaokhachhang_soluong').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#BaoCaokhachhang_soluong').html(htmlString);
                    }
                });
            });

            $('#btnRefeshGopY_soluong').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/dienmay.vn/backend/api/baocao-tongsogopy.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#BaoCaoGopY_soluong').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#BaoCaoGopY_soluong').html(htmlString);
                    }
                });
            });
            
            $('#btnRefeshdonDatHang_soluong').click(function() {
                //Nhờ AJAX gởi request đến APT
                $.ajax('/dienmay.vn/backend/api/baocao-tongsodondathang.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#BaoCaodonDatHang_soluong').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var htmlString = '<h1>Không thể xử lý. Lỗi ${errorThrown}</h1>';
                        $('#BaoCaodonDatHang_soluong').html(htmlString);
                    }
                });
            });
            //END BÁO CÁO TỔNG SỐ 

            // START VẼ BIỂU ĐỒ
            var $objChartThongKeloaisanpham;
            var $chartOfobjChartThongKeloaisanpham =
            document.getElementById("chartOfobjChartThongKeloaisanpham").getContext("2d");

                $('#refreshThongKeloaisanpham').click(function() {
                    $.ajax('/dienmay.vn/backend/api/baocao-thongkeloaisanpham.php', {
                        success: function(response) {
                            var data = JSON.parse(response);
                            var myLabels = [];
                            var myData = [];
                            $(data).each(function() {
                                myLabels.push((this.TenLoaiSanPham));  // Giống dữ liệu API trả về
                                myData.push(this.SoLuong);
                            });
                            myData.push(0); // tạo dòng số liệu 0
                            if (typeof $objChartThongKeloaisanpham !== "undefined") {
                                $objChartThongKeloaisanpham.destroy();
                            }
                            $objChartThongKeloaisanpham = new Chart($chartOfobjChartThongKeloaisanpham, {
                            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                            type: "bar",
                            data: {
                                labels: myLabels,
                                datasets: [{
                                data: myData,
                                borderColor: "#b99204",
                                backgroundColor: "#9bbb58",
                                borderWidth: 1
                                }]
                            },
                            // Cấu hình dành cho biểu đồ của ChartJS
                            options: {
                                legend: {
                                    display: false,
                                    text: "Tên loại sản phẩm"
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: "Thống kê loại sản phẩm"
                                    },
                                    subtitle: {
                                        display: true,
                                        text: "Biểu đồ thống kê loại sản phẩm tại dienmay.vn"
                                    }
                                },
                                responsive: true
                            }
                            });
                        }
                    });
                });


            var $objChartThongKehinhsanpham;
            var $chartOfobjChartThongKehinhsanpham =
            document.getElementById("chartOfobjChartThongKehinhsanpham").getContext("2d");

                $('#refreshThongKehinhsanpham').click(function() {
                    $.ajax('/dienmay.vn/backend/api/baocao-thongkehinhsanpham.php', {
                        success: function(response) {
                            var data = JSON.parse(response);
                            var myLabels = [];
                            var myData = [];
                            $(data).each(function() {
                                myLabels.push((this.TenSanPham));  // Giống dữ liệu API trả về
                                myData.push(this.SoLuong);
                            });
                            myData.push(0); // tạo dòng số liệu 0
                            if (typeof $objChartThongKehinhsanpham !== "undefined") {
                                $objChartThongKehinhsanpham.destroy();
                            }
                            $objChartThongKehinhsanpham = new Chart($chartOfobjChartThongKehinhsanpham, {
                            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                            type: "bar",
                            data: {
                                labels: myLabels,
                                datasets: [{
                                data: myData,
                                borderColor: "#b99204",
                                backgroundColor: "#9bbb58",
                                borderWidth: 1
                                }]
                            },
                            // Cấu hình dành cho biểu đồ của ChartJS
                            options: {
                                legend: {
                                    display: false,
                                    text: "Tên sản phẩm"
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        text: "Thống kê hình sản phẩm"
                                    },
                                    subtitle: {
                                        display: true,
                                        text: "Biểu đồ thống kê hình sản phẩm tại dienmay.vn"
                                    }
                                },
                                responsive: true
                            }
                            });


                        }
                    });
                });
            // END VẼ BIỂU ĐỒ

        });


    </script>
</body>
</html>