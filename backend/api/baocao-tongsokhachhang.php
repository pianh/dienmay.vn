<?php

include_once (__DIR__ . '/../../dbconnect.php');
//Chuẩn bị câu lệnh truy vấn $sql
$sqlsoluongkhachhang = "select count(*) as SoLuong from `khachhang`";
//Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlsoluongkhachhang);

$sqlsoluongkhachhang = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $sqlsoluongkhachhang[] = array(
        'SoLuong' => $row['SoLuong']
    );
}
//Chuyển đổi dữ liệu về định dạng JSON
//Dữ liệu JSON, từ arry PHP ->JSON
echo json_encode($sqlsoluongkhachhang[0]);
