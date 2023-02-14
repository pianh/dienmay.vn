<?php
include_once __DIR__ . '/../../../vendor/autoload.php';


/* Note: any element you append to a document must reside inside of a Section. */

//Lấy dữ liệu
//1. Mở kết nối
include_once __DIR__ . '/../../../dbconnect.php';
//2. Chuẩn bị câu lệnh
$sqlSelectsanpham = "SELECT * FROM viewDanhSachSanPham";

$result = mysqli_query($conn, $sqlSelectsanpham);
//4. Phân tách thành array PHP
$datasanpham= [] ;

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $datasanpham[] = array(
         'sp_ma' => $row['sp_ma'],
         'sp_ten' => $row['sp_ten'],
         'sp_gia' => $row['sp_gia'],
         'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
         'sp_soluong' => $row['sp_soluong'],
         'lsp_ten' => $row['lsp_ten']
     );
 }  

 $html = "<table border='1' width='100%'>"
 . "<tr>"
     . "<th>Mã</th>"
     . "<th>Họ tên</th>"
     . "<th>Địa chỉ</th>"
     . "<th>Điện thoại</th>"
     . "<th>Số lượng</th>"
     . "<th>Loại sản phẩm</th>"
 . "</tr>";

foreach($datasanpham as $sanpham) {
 $html .= "<tr>"
     . "<td>" . $sanpham['sp_ma'] . "</td>"
     . "<td>" . $sanpham['sp_ten'] . "</td>"
     . "<td>" . $sanpham['sp_gia']. "</td>"
     . "<td>" . $sanpham['sp_ngaycapnhat']. "</td>"
     . "<td>" . $sanpham['sp_soluong']. "</td>"
     . "<td>" . $sanpham['lsp_ten']. "</td>"
     . "</tr>";
}

$html .= "</table>";
 $mpdf = new \Mpdf\Mpdf();

// $mpdf = new \mPDF('utf-8','A4','');
//  $mpdf = new mPDF();


// $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../assets/templates/pdfs/danhsachsanpham.pdf']);
 $mpdf->WriteHTML('<h1 style="color: red; text-align: center;"> Danh sách sản phẩm </h1>');
 $mpdf->WriteHTML($html);
 $mpdf->WriteHTML('<h3 style="text-align: center;">Hệ thống cửa hàng điện máy</h3>');


 $filePath = __DIR__ . '/../../../assets/templates/pdfs/danhsachsanpham.pdf';
 $mpdf->Output($filePath);
 $mpdf->Output();
 //cmd update composer json mpdf v8.1.3
 //Alternatively, you can run Composer with `--ignore-platform-req=ext-gd` to temporarily ignore these required extensions.

 //composer update --ignore-platform-req=ext-gd