<?php

include_once (__DIR__ . '/../../dbconnect.php');
//Chuẩn bị câu lệnh truy vấn $sql
$sqlsoluongsanpham = "select count(*) as SoLuong from `sanpham`";
//Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlsoluongsanpham);

$sqlsoluongsanpham = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $sqlsoluongsanpham[] = array(
        'SoLuong' => $row['SoLuong']
    );
}
//5. Chuyển đổi dữ liệu về định dạng JSON
//Dữ liệu JSON, từ arry PHP ->JSON
echo json_encode($sqlsoluongsanpham[0]);
