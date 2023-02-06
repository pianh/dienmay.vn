<?php

include_once (__DIR__ . '/../../dbconnect.php');

$sqlsoluongdondathang = "select count(*) as SoLuong from `dondathang`";

$result = mysqli_query($conn, $sqlsoluongdondathang);

$datasoluongdonhang = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $datasoluongdonhang[] = array(
        'SoLuong' => $row['SoLuong']
    );
}
//5. Chuyển đổi dữ liệu về định dạng JSON
//Dữ liệu JSON, từ arry PHP ->JSON
echo json_encode($datasoluongdonhang[0]);

