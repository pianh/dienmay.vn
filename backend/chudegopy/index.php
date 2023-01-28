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
                        <thead class="table-info">
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
                                <!-- <a href="delete.php?cdgy_ma=<?= $cdgy['cdgy_ma']?>" class="btn btn-danger">Xóa</a> -->
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
       
</body>
</html>