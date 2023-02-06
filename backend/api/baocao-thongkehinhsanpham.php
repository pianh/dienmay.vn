<?php

include_once (__DIR__ . '/../../dbconnect.php');

$sql = <<<EOT
    SELECT hsp.hsp_tentaptin, sp.sp_ten, COUNT(*) AS SoLuong
    FROM `hinhsanpham` hsp
    JOIN `sanpham` sp ON sp.sp_ma = hsp.sp_ma
    GROUP BY hsp.sp_ma
EOT;

$result = mysqli_query($conn, $sql);

$data  = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $data[] = array (
        'TenSanPham' => $row['sp_ten'],
        'SoLuong' => $row['SoLuong']
    );
}

echo json_encode($data);
