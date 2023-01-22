<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>

    <title>Bản tin Dashboard</title>

    <?php include_once __DIR__ . '/../layouts/style.php'?>
    <style>
        /* .pd-500{
            padding-bottom: 500px;
        } */
    </style>
</head>
<body >
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    
    <div class="container-fluid pd-350">
        <div class="row">
            <?php include_once __DIR__ . '/../layouts/partials/sidebar.php' ?>


            <div class="col-md-10">
                <h1>Bản tin Dashboard</h1>


            </div>
        
        </div>
    </div>

    
    <!-- Footer -->
    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <!-- Nhúng file quản lý phần SCRIP JAVASCRIP -->
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>

</body>
</html>