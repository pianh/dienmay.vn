-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dienmayct
CREATE DATABASE IF NOT EXISTS `dienmayct` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `dienmayct`;

-- Dumping structure for table dienmayct.chudegopy
CREATE TABLE IF NOT EXISTS `chudegopy` (
  `cdgy_ma` int(11) NOT NULL,
  `cdgy_ten` varchar(255) NOT NULL,
  PRIMARY KEY (`cdgy_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.chudegopy: ~0 rows (approximately)

-- Dumping structure for table dienmayct.dondathang
CREATE TABLE IF NOT EXISTS `dondathang` (
  `dh_ma` int(11) NOT NULL AUTO_INCREMENT,
  `dh_ngaylap` datetime NOT NULL,
  `dh_ngaygiao` datetime DEFAULT NULL,
  `dh_noigiao` varchar(255) DEFAULT NULL,
  `dh_trangthaithanhtoan` int(11) NOT NULL,
  `httt_ma` int(11) NOT NULL,
  `kh_tendangnhap` varchar(50) NOT NULL,
  PRIMARY KEY (`dh_ma`),
  KEY `FK_dondathang_hinhthucthanhtoan` (`httt_ma`),
  KEY `FK_dondathang_khachhang` (`kh_tendangnhap`),
  CONSTRAINT `FK_dondathang_hinhthucthanhtoan` FOREIGN KEY (`httt_ma`) REFERENCES `hinhthucthanhtoan` (`httt_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_dondathang_khachhang` FOREIGN KEY (`kh_tendangnhap`) REFERENCES `khachhang` (`kh_tendangnhap`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.dondathang: ~0 rows (approximately)

-- Dumping structure for table dienmayct.gopy
CREATE TABLE IF NOT EXISTS `gopy` (
  `gy_ma` int(11) NOT NULL,
  `gy_hoten` varchar(45) DEFAULT NULL,
  `gy_email` varchar(45) DEFAULT NULL,
  `gy_diachi` varchar(100) DEFAULT NULL,
  `gy_dienthoai` varchar(45) DEFAULT NULL,
  `gy_tieude` varchar(255) DEFAULT NULL,
  `gy_noidung` text DEFAULT NULL,
  `gy_ngaygopy` datetime DEFAULT NULL,
  `cdgy_ma` int(11) DEFAULT NULL,
  PRIMARY KEY (`gy_ma`),
  KEY `FK_gopy_chudegopy` (`cdgy_ma`),
  CONSTRAINT `FK_gopy_chudegopy` FOREIGN KEY (`cdgy_ma`) REFERENCES `chudegopy` (`cdgy_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.gopy: ~0 rows (approximately)

-- Dumping structure for table dienmayct.hinhsanpham
CREATE TABLE IF NOT EXISTS `hinhsanpham` (
  `hsp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `hsp_tentaptin` varchar(255) DEFAULT NULL,
  `sp_ma` int(11) NOT NULL,
  PRIMARY KEY (`hsp_ma`),
  KEY `FK_hinhsanpham_sanpham` (`sp_ma`),
  CONSTRAINT `FK_hinhsanpham_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.hinhsanpham: ~0 rows (approximately)

-- Dumping structure for table dienmayct.hinhthucthanhtoan
CREATE TABLE IF NOT EXISTS `hinhthucthanhtoan` (
  `httt_ma` int(11) NOT NULL AUTO_INCREMENT,
  `httt_ten` varchar(100) NOT NULL,
  PRIMARY KEY (`httt_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.hinhthucthanhtoan: ~0 rows (approximately)

-- Dumping structure for table dienmayct.khachhang
CREATE TABLE IF NOT EXISTS `khachhang` (
  `kh_tendangnhap` varchar(50) NOT NULL,
  `kh_matkhau` varchar(255) NOT NULL,
  `kh_ten` varchar(50) NOT NULL,
  `kh_gioitinh` int(11) NOT NULL,
  `kh_diachi` varchar(100) NOT NULL,
  `kh_dienthoai` varchar(50) NOT NULL,
  `kh_email` varchar(50) NOT NULL,
  `kh_ngaysinh` int(11) DEFAULT NULL,
  `kh_thangsinh` int(11) DEFAULT NULL,
  `kh_namsinh` int(11) NOT NULL,
  `kh_cmnd` varchar(50) DEFAULT NULL,
  `kh_makichhoat` varchar(100) DEFAULT NULL,
  `kh_trangthai` int(11) NOT NULL,
  `kh_quantri` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`kh_tendangnhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.khachhang: ~0 rows (approximately)

-- Dumping structure for table dienmayct.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `km_ma` int(11) NOT NULL,
  `km_ten` varchar(255) DEFAULT NULL,
  `km_noidung` text DEFAULT NULL,
  `km_tungay` date DEFAULT NULL,
  `km_denngay` date DEFAULT NULL,
  PRIMARY KEY (`km_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.khuyenmai: ~0 rows (approximately)

-- Dumping structure for table dienmayct.loaisanpham
CREATE TABLE IF NOT EXISTS `loaisanpham` (
  `lsp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `lsp_ten` varchar(100) NOT NULL,
  `lsp_mota` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lsp_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.loaisanpham: ~0 rows (approximately)

-- Dumping structure for table dienmayct.nhasanxuat
CREATE TABLE IF NOT EXISTS `nhasanxuat` (
  `nsx_ma` int(11) NOT NULL,
  `nsx_ten` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nsx_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.nhasanxuat: ~0 rows (approximately)

-- Dumping structure for table dienmayct.sanpham
CREATE TABLE IF NOT EXISTS `sanpham` (
  `sp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `sp_ten` varchar(50) NOT NULL,
  `sp_gia` decimal(12,2) DEFAULT NULL,
  `sp_giacu` decimal(12,2) DEFAULT NULL,
  `sp_mota_ngan` varchar(1000) NOT NULL,
  `sp_mota_chitiet` text DEFAULT NULL,
  `sp_ngaycapnhat` datetime DEFAULT NULL,
  `sp_soluong` int(11) DEFAULT NULL,
  `lsp_ma` int(11) NOT NULL,
  `nsx_ma` int(11) NOT NULL,
  `km_ma` int(11) DEFAULT NULL,
  PRIMARY KEY (`sp_ma`),
  KEY `FK_sanpham_loaisanpham` (`lsp_ma`),
  KEY `FK_sanpham_nhasanxuat` (`nsx_ma`),
  KEY `FK_sanpham_khuyenmai` (`km_ma`),
  CONSTRAINT `FK_sanpham_khuyenmai` FOREIGN KEY (`km_ma`) REFERENCES `khuyenmai` (`km_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sanpham_loaisanpham` FOREIGN KEY (`lsp_ma`) REFERENCES `loaisanpham` (`lsp_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sanpham_nhasanxuat` FOREIGN KEY (`nsx_ma`) REFERENCES `nhasanxuat` (`nsx_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.sanpham: ~0 rows (approximately)

-- Dumping structure for table dienmayct.sanpham_dondathang
CREATE TABLE IF NOT EXISTS `sanpham_dondathang` (
  `sp_ma` int(11) NOT NULL,
  `dh_ma` int(11) NOT NULL,
  `sp_dh_soluong` int(11) NOT NULL,
  `sp_dh_dongia` decimal(12,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`sp_ma`,`dh_ma`),
  KEY `FK_sanpham_dondathang_dondathang` (`dh_ma`),
  CONSTRAINT `FK_sanpham_dondathang_dondathang` FOREIGN KEY (`dh_ma`) REFERENCES `dondathang` (`dh_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sanpham_dondathang_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dienmayct.sanpham_dondathang: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
