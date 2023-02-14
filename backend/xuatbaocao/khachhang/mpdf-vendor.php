<?php
include_once __DIR__ . '/../../../vendor/autoload.php';


/* Note: any element you append to a document must reside inside of a Section. */

//Lấy dữ liệu
//1. Mở kết nối
include_once __DIR__ . '/../../../dbconnect.php';
//2. Chuẩn bị câu lệnh
$sqlSelectkhachhang = "SELECT * FROM viewDanhSachKhachHang";

$result = mysqli_query($conn, $sqlSelectkhachhang);
//4. Phân tách thành array PHP
$datakhachhang= [] ;

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $datakhachhang[] = array(
         'kh_tendangnhap' => $row['kh_tendangnhap'],
         'kh_ten' => $row['kh_ten'],
         'kh_gioitinh' => $row['kh_gioitinh'],
         'kh_diachi' => $row['kh_diachi'],
         'kh_dienthoai' => $row['kh_dienthoai'],
         'kh_email' => $row['kh_email']
     );
 }  

 $html = "<table border='1' width='100%'>"
 . "<tr>"
     . "<th>Tên đăng nhập</th>"
     . "<th>Họ tên</th>"
     . "<th>Địa chỉ</th>"
     . "<th>Điện thoại</th>"
     . "<th>Email</th>"
 . "</tr>";

foreach($datakhachhang as $khachhang) {
 $html .= "<tr>"
     . "<td>" . $khachhang['kh_tendangnhap'] . "</td>"
     . "<td>" . $khachhang['kh_ten'] . "</td>"
     . "<td>" . $khachhang['kh_diachi']. "</td>"
     . "<td>" . $khachhang['kh_dienthoai']. "</td>"
     . "<td>" . $khachhang['kh_email']. "</td>"
     . "</tr>";
}

$html .= "</table>";
 $mpdf = new \Mpdf\Mpdf();

// $mpdf = new \mPDF('utf-8','A4','');
//  $mpdf = new mPDF();


// $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../assets/templates/pdfs/danhsachkhachhang.pdf']);
 $mpdf->WriteHTML('<h1 style="color: red; text-align: center;"> Danh sách khách hàng </h1>');
 $mpdf->WriteHTML($html);
 $mpdf->WriteHTML('<h3 style="text-align: center;">Hệ thống cửa hàng điện máy</h3>');


 $filePath = __DIR__ . '/../../../assets/templates/pdfs/danhsachkhachhang.pdf';
 $mpdf->Output($filePath);
 $mpdf->Output();
 //cmd update composer json mpdf v8.1.3
 //Alternatively, you can run Composer with `--ignore-platform-req=ext-gd` to temporarily ignore these required extensions.

 //composer update --ignore-platform-req=ext-gd