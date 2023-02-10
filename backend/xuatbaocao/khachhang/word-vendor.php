<?php
include_once __DIR__ . '/../../../vendor/autoload.php';

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

//Lấy dữ liệu
//1. Mở kết nối
include_once __DIR__ . '/../../../dbconnect.php';
//2. Chuẩn bị câu lệnh
$sql = "SELECT * FROM khachhang";

$result = mysqli_query($conn, $sql);
//4. Phân tách thành array PHP
$datakhachhang= [] ;

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
   $datakhachhang[] = array(
        'kh_tendangnhap' => $row['kh_tendangnhap'],
        'kh_ten' => $row['kh_ten'],
        'kh_gioitinh' => $row['kh_gioitinh'],
        'kh_diachi' => $row['kh_diachi'],
        'kh_dienthoai' => $row['kh_dienthoai'],
        'kh_email' => $row['kh_email'],

    );

}

/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
$section->addText(
    'Danh sách thành viên',
    array('name' => 'Times New Roman', 'size' => 14, 'align'=>'center', 'bold' => true, )
);

foreach($datakhachhang as $khachhang) {
    $section->addText(
        'Họ tên: ' .$khachhang['kh_ten'] 
        // . ' - Giới tính: ' .$khachhang['kh_gioitinh']
        . ' - SĐT: ' .$khachhang['kh_dienthoai']
        . ' - Địa chỉ: ' .$khachhang['kh_diachi']
        . ' - Email: ' .$khachhang['kh_email'],
        array('name' => 'Times New Roman', 'size' => 10)
    );
}

/*
 * Note: it's possible to customize font style of the Text element you add in three ways:
 * - inline;
 * - using named font style (new font style object will be implicitly created);
 * - using explicitly created font style object.
 */

// Adding Text element with font customized inline...
$section->addText(
);
$section->addText(
    '"Kết thúc file danh sách"',
    array('name' => 'Times New Roman', 'size' => 10)
);

// Adding Text element with font customized using named font style...
$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Times New Roman', 'size' => 10, 'color' => '1B2232', 'bold' => true)
);
// $section->addText(
//     '"The greatest accomplishment is not in never falling, '
//         . 'but in rising again after you fall." '
//         . '(Vince Lombardi)',
//     $fontStyleName
// );

// Adding Text element with font customized using explicitly created font style object...
$fontStyle = new \PhpOffice\PhpWord\Style\Font();
$fontStyle->setBold(true);
$fontStyle->setName('Tahoma');
$fontStyle->setSize(10);
$myTextElement = $section->addText('"Hệ thống cửa hàng điện máy Cần Thơ." (Dienmay.vn)');
$myTextElement->setFontStyle($fontStyle);

// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$filePath = __DIR__ . '/../../../assets/templates/words/danhsachkhachhang.docx';
$objWriter->save($filePath);

// Saving the document as ODF file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
// $objWriter->save('helloWorld.odt');

// Saving the document as HTML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
// $objWriter->save('helloWorld.html');

/* Note: we skip RTF, because it's not XML-based and requires a different example. */
/* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */