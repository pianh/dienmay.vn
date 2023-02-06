<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Danh sách sản phẩm - đơn đặt hàng</title>

    <?php include_once __DIR__ . '/../layouts/styles.php'?>
    <style>
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid" style="padding-bottom: 250px;">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
            </br>
            <h1>Danh sách sản phẩm - đơn đặt hàng</h1>
            <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    //1. Mở kết nối đến database
                    include_once __DIR__ . '/../../dbconnect.php';
                    //2. Chuan bi cau lenh
                    $sql = "SELECT * FROM sanpham_dondathang sp_ddh 
                            JOIN sanpham sp ON  sp_ddh.sp_ma = sp.sp_ma
                            JOIN dondathang ddh ON ddh.dh_ma = sp_ddh.dh_ma
                            group by sp_ddh.sp_ma
                            order by sp_ddh.sp_ma asc;";

                    //3. Thuc thi
                    $result = mysqli_query($conn, $sql);

                    //4. Phân tách thành mảng array
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data[] = array (
                            'sp_ma' => $row['sp_ma'],
                            'dh_ma' => $row['dh_ma'],
                            'sp_dh_soluong' => $row['sp_dh_soluong'],
                            'sp_dh_dongia' => $row['sp_dh_dongia']
                        );
                    }

                    //  var_dump($data);
                    //  die;
                ?>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                </br>
                </br>
                    <table class="table table-bordered table-hover ">
                        <thead class="table-info">
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Mã đơn hàng</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                            </tr>
                        </thead>
                    <?php foreach($data as $sp_ddh): ?>
                        <tr>
                            <td><?= $sp_ddh['sp_ma']  ?>  </td>
                            <td><?php echo $sp_ddh['dh_ma']  ?></td>
                            <td><?php echo $sp_ddh['sp_dh_soluong']  ?></td>
                            <td><?php echo $sp_ddh['sp_dh_dongia']  ?></td>
                            <!-- <td>
                                
                                <a href="edit.php?tv_kh_ma=<?= $sp_ddh['tv_kh_ma']?>" class="btn btn-warning">Sửa</a>
                               
                                <button type="button" class="btn btn-danger btnDelete" data-tv_kh_ma="<?= $sp_ddh['tv_kh_ma'] ?>">
                                    Xóa
                                </button>                                
                                </form>
                            </td> -->


                        </tr>
                    <?php endforeach; ?>
                    </table>

            </div>
        
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>

</body>
</html>