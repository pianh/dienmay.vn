<!DOCTYPE html>
<html>

<head>
    <?php include_once __DIR__ . '/../layouts/meta.php'; ?>
    <title>Đăng nhập Backend | dienmay.vn</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once __DIR__ . '/../layouts/styles.php'?>
</head>

<body>
    <!-- header -->
    <?php include_once __DIR__ . '/../layouts/partials/header.php' ?>
    <!-- end header -->

    <div class="container-fluid pb-150">
        <div id="main_container" class="row" style="padding-top:80px;">
            <div class="col-md-2"></div>
            <div class="col-md-8 col-sm-8 main-column">
                <div class="grid-members row rounded">
                    <!-- left -->
                    <div class="grid-item col-md-6 " style="background-color: #eee; padding:0;">
                        <img src="/dienmay.vn/assets/backend/imgs/log.svg" alt="" class="img-responsive">
                        <p>Quyền lợi thành viên</p>
                        <ul style="list-style-type: none;" >
                            <li class="pr-4">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6663 7.38668V8.00001C14.6655 9.43763 14.2 10.8365 13.3392 11.9879C12.4785 13.1393 11.2685 13.9817 9.88991 14.3893C8.51129 14.7969 7.03785 14.7479 5.68932 14.2497C4.3408 13.7515 3.18944 12.8307 2.40698 11.6247C1.62452 10.4187 1.25287 8.99205 1.34746 7.55755C1.44205 6.12305 1.99781 4.75756 2.93186 3.66473C3.86591 2.57189 5.1282 1.81027 6.53047 1.49344C7.93274 1.17662 9.39985 1.32157 10.713 1.90668" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6667 2.66669L8 9.34002L6 7.34002" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                  Mua hàng khắp thế giới cực dễ dàng, nhanh chóng
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6663 7.38668V8.00001C14.6655 9.43763 14.2 10.8365 13.3392 11.9879C12.4785 13.1393 11.2685 13.9817 9.88991 14.3893C8.51129 14.7969 7.03785 14.7479 5.68932 14.2497C4.3408 13.7515 3.18944 12.8307 2.40698 11.6247C1.62452 10.4187 1.25287 8.99205 1.34746 7.55755C1.44205 6.12305 1.99781 4.75756 2.93186 3.66473C3.86591 2.57189 5.1282 1.81027 6.53047 1.49344C7.93274 1.17662 9.39985 1.32157 10.713 1.90668" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6667 2.66669L8 9.34002L6 7.34002" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                  Theo dõi chi tiết đơn hàng, địa chỉ thanh toán dễ dàng
                            </li>
                            <li>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.6663 7.38668V8.00001C14.6655 9.43763 14.2 10.8365 13.3392 11.9879C12.4785 13.1393 11.2685 13.9817 9.88991 14.3893C8.51129 14.7969 7.03785 14.7479 5.68932 14.2497C4.3408 13.7515 3.18944 12.8307 2.40698 11.6247C1.62452 10.4187 1.25287 8.99205 1.34746 7.55755C1.44205 6.12305 1.99781 4.75756 2.93186 3.66473C3.86591 2.57189 5.1282 1.81027 6.53047 1.49344C7.93274 1.17662 9.39985 1.32157 10.713 1.90668" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6667 2.66669L8 9.34002L6 7.34002" stroke="#20863D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                  Nhận nhiều chương trình ưu đãi hấp dẫn từ chúng tôi
                            </li>
                        </ul>
                    </div>
                    <!-- end left -->
                    <!-- right -->
                    <div class="grid-item col-md-6 "style="background-color: #fff;" >
                        <div class="top-title ">
                            <a href="/dienmay.vn/backend/login.php" title="Đăng nhập" class="active">Đăng nhập</a>
                            <a href="/dienmay.vn/backend/register.php" title="Đăng ký" class="top-title--register">Đăng ký</a>
                        </div>
                        <form action="" class="frmLogin" id="frmLogin">
                            <div class="box box-username">
                                <input type="email" name="" id="username" class="form-control" placeholder="Email đăng nhập*">
                            </div>
                            <div class="box box-password">
                                <input type="password" name="" id="password" class="form-control" placeholder="Mật khẩu*" ></input>
                            </div>
                            <div class="box-forgot">
                                <div class="box-remember">
                                    <input type="checkbox" id="remember-me" class="ml-3">
                                    <label for="remember-me" >Ghi nhớ tôi</label> 
                                </div>
                                <a href="https://didongthongminh.vn/quen-mat-khau" title="Quên mật khẩu?" class="forgot-password mr-2">
                                Quên mật khẩu?
                                </a>
                            </div>
                            <div class="box">
                                <a href="" class="submitLogin submit-btn">Đăng nhập</a>
                            </div>
                        </form>
                        <div class="wrapper">
                            <span></span>
                            Hoặc đăng nhập bằng
                            <span></span>
                        </div>
                        <a href="" class="login-google login-social">Google</a>
                        <a href="" class="login-facebook login-social">Facebook</a>
                        <div class="note text-center">
                            <p>Điện máy Cần Thơ cam kết bảo mật và sẽ không bao giờ đăng hay chia sẻ thông tin mà chưa có được sự đồng ý của bạn!</p>
                        </div>
                    </div>
                    <!-- end right border border-info-->
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>


        
   



    
    </div>






    <!-- footer -->
    <?php include_once __DIR__ . '/../layouts/partials/footer.php' ?>
    <!-- end footer -->
    <?php include_once __DIR__ . '/../layouts/scripts.php' ?>



</body>

</html>