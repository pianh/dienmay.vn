<?php
include_once __DIR__ . '/../../../vendor/autoload.php';

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

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
        'lsp_ten' => $row['lsp_ten'],

    );

}

/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
$section->addText(
    'Danh sách sản phẩm',
    array('name' => 'Times New Roman', 'size' => 14, 'align'=>'center', 'bold' => true, )
);

foreach($datasanpham as $sanpham) {
    $section->addText(
        'Mã sản phẩm: ' .$sanpham['sp_ma'] 
        . ' - Tên sản phẩm: ' .$sanpham['sp_ten']
        . ' - Giá sản phẩm: ' .$sanpham['sp_gia']
        . ' - Ngày cập nhật: ' .$sanpham['sp_ngaycapnhat']
        . ' - Số lượng: ' .$sanpham['sp_soluong']
        . ' - Loại sản phẩm: ' .$sanpham['lsp_ten'],
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
    '"Kết thúc file danh sách sản phẩm"',
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
$filePath = __DIR__ . '/../../../assets/templates/words/danhsachsanpham.docx';
$objWriter->save($filePath);

// Saving the document as ODF file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
// $objWriter->save('helloWorld.odt');

// Saving the document as HTML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
// $objWriter->save('helloWorld.html');

/* Note: we skip RTF, because it's not XML-based and requires a different example. */
/* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */