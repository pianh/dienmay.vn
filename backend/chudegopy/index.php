<?php
    include_once __DIR__ . '/../../dbconnect.php';
    $id=$_SESSION['tv_tendangnhap_logged'];
    $sql = "SELECT * FROM khachhang WHERE kh_tendangnhap='$id';";

?>