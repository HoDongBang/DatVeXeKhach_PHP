-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 09, 2020 lúc 03:28 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datvexe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `tendangnhap` varchar(30) NOT NULL,
  `matkhau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`tendangnhap`, `matkhau`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenxe`
--

CREATE TABLE `chuyenxe` (
  `macx` char(4) NOT NULL,
  `tenchuyen` varchar(100) NOT NULL,
  `khoangcach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chuyenxe`
--

INSERT INTO `chuyenxe` (`macx`, `tenchuyen`, `khoangcach`) VALUES
('CX01', 'Cà Mau - An Giang', 201),
('CX02', 'Cà Mau - Tp.Cần Thơ', 149),
('CX03', 'Cà Mau - Tp.HCM', 308),
('CX04', 'An Giang - Cà Mau', 201),
('CX05', 'An Giang - Tp.Cần Thơ', 108),
('CX06', 'An Giang - Tp.HCM', 233),
('CX07', 'Tp.Cần Thơ - Cà Mau', 149),
('CX08', 'Tp.Cần Thơ - An Giang', 108),
('CX09', 'Tp.Cần Thơ - Tp.HCM', 170),
('CX10', 'Tp.HCM - Cà Mau', 308),
('CX11', 'Tp.HCM - An Giang', 233),
('CX12', 'Tp.HCM - Tp.Cần Thơ', 170);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `sdt` char(10) NOT NULL,
  `tenkh` varchar(30) NOT NULL,
  `ngaysinh` date NOT NULL,
  `matkhau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`sdt`, `tenkh`, `ngaysinh`, `matkhau`) VALUES
('1234567891', 'Nguyễn Văn A', '2000-01-01', '123'),
('1234567892', 'Nguyễn Văn B', '2000-01-01', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaixe`
--

CREATE TABLE `loaixe` (
  `malx` int(11) NOT NULL,
  `tenlx` varchar(30) NOT NULL,
  `giatrenkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaixe`
--

INSERT INTO `loaixe` (`malx`, `tenlx`, `giatrenkm`) VALUES
(1, 'Xe ghế ngồi', 1000),
(2, 'Xe giường nằm', 1200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taixe`
--

CREATE TABLE `taixe` (
  `matx` char(4) NOT NULL,
  `tentx` varchar(30) NOT NULL,
  `sdt` char(10) NOT NULL,
  `cmnd` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taixe`
--

INSERT INTO `taixe` (`matx`, `tentx`, `sdt`, `cmnd`) VALUES
('TX01', 'Nguyễn Thành A', '1234567890', '366323251'),
('TX02', 'Nguyễn Thành B', '1234567890', '366323252'),
('TX03', 'Nguyễn Thành C', '1234567890', '366323253'),
('TX04', 'Nguyễn Thành D', '1234567890', '366323254'),
('TX05', 'Nguyễn Thành E', '1234567890', '366323255'),
('TX06', 'Nguyễn Thành F', '1234567890', '366323256'),
('TX07', 'Nguyễn Thành G', '1234567890', '366323257'),
('TX08', 'Nguyễn Thành I', '1234567890', '366323258'),
('TX09', 'Nguyễn Thành J', '1234567890', '366323259'),
('TX10', 'Nguyễn Thành K', '1234567890', '366323260'),
('TX11', 'Nguyễn Thành L', '1234567890', '366323261'),
('TX12', 'Nguyễn Thành M', '1234567890', '366323262'),
('TX13', 'Nguyễn Thành N', '1234567890', '366323263'),
('TX14', 'Nguyễn Thành O', '1234567890', '366323264'),
('TX15', 'Nguyễn Thành P', '1234567890', '366323265'),
('TX16', 'Nguyễn Thành Q', '1234567890', '366323266');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbaotrang`
--

CREATE TABLE `thongbaotrang` (
  `ghichu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vexe`
--

CREATE TABLE `vexe` (
  `mavx` char(5) NOT NULL,
  `vitrighe` char(3) NOT NULL,
  `sdt` char(10) NOT NULL,
  `ngaydat` datetime NOT NULL,
  `datchongay` date NOT NULL,
  `bienso` varchar(10) NOT NULL,
  `macx` char(4) NOT NULL,
  `matx` char(4) NOT NULL,
  `gio` int(11) NOT NULL,
  `ghichu` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xe`
--

CREATE TABLE `xe` (
  `bienso` varchar(10) NOT NULL,
  `soluongghe` int(11) NOT NULL,
  `malx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `xe`
--

INSERT INTO `xe` (`bienso`, `soluongghe`, `malx`) VALUES
('36B-00711', 28, 1),
('36B-00712', 28, 2),
('36B-00713', 30, 1),
('36B-00714', 28, 2),
('36B-00715', 32, 1),
('36B-00716', 32, 2),
('36B-00717', 34, 1),
('36B-00718', 32, 2),
('36B-00719', 36, 1),
('36B-00720', 36, 2),
('36B-00721', 38, 1),
('36B-00722', 36, 2),
('36B-00723', 40, 1),
('36B-00724', 40, 2),
('36B-00725', 42, 1),
('36B-00726', 40, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xe_chuyenxe`
--

CREATE TABLE `xe_chuyenxe` (
  `bienso` varchar(10) NOT NULL,
  `macx` char(4) NOT NULL,
  `matx` char(4) NOT NULL,
  `gio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `xe_chuyenxe`
--

INSERT INTO `xe_chuyenxe` (`bienso`, `macx`, `matx`, `gio`) VALUES
('36B-00711', 'CX01', 'TX01', 6),
('36B-00711', 'CX04', 'TX01', 0),
('36B-00712', 'CX01', 'TX02', 6),
('36B-00712', 'CX04', 'TX02', 0),
('36B-00713', 'CX01', 'TX03', 9),
('36B-00713', 'CX04', 'TX03', 3),
('36B-00714', 'CX01', 'TX04', 9),
('36B-00714', 'CX04', 'TX04', 3),
('36B-00715', 'CX01', 'TX05', 12),
('36B-00715', 'CX04', 'TX05', 6),
('36B-00716', 'CX01', 'TX06', 12),
('36B-00716', 'CX04', 'TX06', 6),
('36B-00717', 'CX01', 'TX07', 15),
('36B-00717', 'CX04', 'TX07', 9),
('36B-00718', 'CX01', 'TX08', 15),
('36B-00718', 'CX04', 'TX08', 9),
('36B-00719', 'CX01', 'TX09', 18),
('36B-00719', 'CX04', 'TX09', 12),
('36B-00720', 'CX01', 'TX10', 18),
('36B-00720', 'CX04', 'TX10', 12),
('36B-00721', 'CX01', 'TX11', 21),
('36B-00721', 'CX04', 'TX11', 15),
('36B-00722', 'CX01', 'TX12', 21),
('36B-00722', 'CX04', 'TX12', 15),
('36B-00723', 'CX01', 'TX13', 0),
('36B-00723', 'CX04', 'TX13', 18),
('36B-00724', 'CX01', 'TX14', 0),
('36B-00724', 'CX04', 'TX14', 18),
('36B-00725', 'CX01', 'TX15', 3),
('36B-00725', 'CX04', 'TX15', 21),
('36B-00726', 'CX01', 'TX16', 3),
('36B-00726', 'CX04', 'TX16', 21);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`tendangnhap`);

--
-- Chỉ mục cho bảng `chuyenxe`
--
ALTER TABLE `chuyenxe`
  ADD PRIMARY KEY (`macx`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`sdt`);

--
-- Chỉ mục cho bảng `loaixe`
--
ALTER TABLE `loaixe`
  ADD PRIMARY KEY (`malx`);

--
-- Chỉ mục cho bảng `taixe`
--
ALTER TABLE `taixe`
  ADD PRIMARY KEY (`matx`);

--
-- Chỉ mục cho bảng `vexe`
--
ALTER TABLE `vexe`
  ADD PRIMARY KEY (`mavx`),
  ADD KEY `vexe_ibfk_1` (`sdt`),
  ADD KEY `vexe_ibfk_2` (`bienso`,`macx`,`matx`,`gio`);

--
-- Chỉ mục cho bảng `xe`
--
ALTER TABLE `xe`
  ADD PRIMARY KEY (`bienso`),
  ADD KEY `kn1` (`malx`);

--
-- Chỉ mục cho bảng `xe_chuyenxe`
--
ALTER TABLE `xe_chuyenxe`
  ADD PRIMARY KEY (`bienso`,`macx`,`matx`,`gio`),
  ADD KEY `kn3` (`macx`),
  ADD KEY `kn4` (`matx`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `vexe`
--
ALTER TABLE `vexe`
  ADD CONSTRAINT `vexe_ibfk_1` FOREIGN KEY (`sdt`) REFERENCES `khachhang` (`sdt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vexe_ibfk_2` FOREIGN KEY (`bienso`,`macx`,`matx`,`gio`) REFERENCES `xe_chuyenxe` (`bienso`, `macx`, `matx`, `gio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `xe`
--
ALTER TABLE `xe`
  ADD CONSTRAINT `kn1` FOREIGN KEY (`malx`) REFERENCES `loaixe` (`malx`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `xe_chuyenxe`
--
ALTER TABLE `xe_chuyenxe`
  ADD CONSTRAINT `kn2` FOREIGN KEY (`bienso`) REFERENCES `xe` (`bienso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kn3` FOREIGN KEY (`macx`) REFERENCES `chuyenxe` (`macx`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kn4` FOREIGN KEY (`matx`) REFERENCES `taixe` (`matx`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
