-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 28, 2026 lúc 02:46 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `can_bo`
--

CREATE TABLE `can_bo` (
  `ID` int(11) NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `NgaySinh` varchar(255) NOT NULL,
  `DanToc` varchar(255) NOT NULL,
  `SoHieu_CAND` varchar(255) DEFAULT NULL,
  `GioiTinh` varchar(255) NOT NULL,
  `QueQuan` varchar(255) NOT NULL,
  `TrinhDo_VH` varchar(255) DEFAULT NULL,
  `CapBac` varchar(255) NOT NULL,
  `ChucVu` varchar(255) NOT NULL,
  `ChucDanh` varchar(255) DEFAULT NULL,
  `QuyHoach` varchar(255) DEFAULT NULL,
  `NgayVao_Dang` varchar(255) DEFAULT NULL,
  `ChinhThuc_Dang` varchar(255) DEFAULT NULL,
  `NgayVao_CA` varchar(255) DEFAULT NULL,
  `Anh` varchar(255) DEFAULT NULL,
  `DiaChi` varchar(455) DEFAULT NULL,
  `Sdt` varchar(255) DEFAULT NULL,
  `NgayNhan_CT` varchar(255) DEFAULT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `LanhDao` varchar(255) NOT NULL DEFAULT 'Không',
  `Vang` tinyint(1) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Doi_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `can_bo`
--

INSERT INTO `can_bo` (`ID`, `HoTen`, `NgaySinh`, `DanToc`, `SoHieu_CAND`, `GioiTinh`, `QueQuan`, `TrinhDo_VH`, `CapBac`, `ChucVu`, `ChucDanh`, `QuyHoach`, `NgayVao_Dang`, `ChinhThuc_Dang`, `NgayVao_CA`, `Anh`, `DiaChi`, `Sdt`, `NgayNhan_CT`, `GhiChu`, `LanhDao`, `Vang`, `TrangThai`, `created_at`, `updated_at`, `Doi_ID`) VALUES
(2, 'Nguyễn Trường Giang', '01/01/1982', 'Kinh', NULL, 'Nam', 'Vĩnh Phúc', NULL, 'Thiếu tá', 'Phó Trưởng Phòng', 'GĐV', NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, NULL, 'Phòng', 0, 1, '2024-06-11 02:46:14', '2026-04-07 03:11:29', NULL),
(3, 'Nguyễn Lộc Vương', '01/01/1977', 'Kinh', NULL, 'Nam', 'Quảng Ngãi', NULL, 'Trung tá', 'Đội Trưởng', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Đội', 0, 1, '2024-06-11 02:47:16', '2025-09-11 02:16:19', 2),
(4, 'Hoàng Công Hiếu', '01/01/1982', 'Kinh', NULL, 'Nam', 'Quảng Bình', NULL, 'Trung tá', 'Phó Trưởng phòng', 'GĐV', NULL, NULL, NULL, NULL, '1778387479_avatar.png', NULL, NULL, NULL, NULL, 'Phòng', 0, 1, '2024-06-11 02:48:01', '2024-06-11 02:51:13', NULL),
(5, 'Nguyễn Tuấn Đạt', '01/01/1989', 'Kinh', NULL, 'Nam', 'Gia Lai', NULL, 'Đại uý', 'Cán bộ', 'TLGĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2024-06-11 02:52:40', '2025-09-10 08:53:22', 1),
(6, 'Trần Trọng Tăng', '01/01/1985', 'Kinh', NULL, 'Nam', 'Hà Tĩnh', NULL, 'Thiếu tá', 'Phó Đội trưởng', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Đội', 0, 1, '2024-06-11 02:55:59', '2025-09-10 08:47:33', 1),
(7, 'Trương Quốc Huy', '01/01/1990', 'Kinh', NULL, 'Nam', 'Gia Lai', NULL, 'Đại uý', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Đội', 0, 1, '2024-06-11 02:58:26', '2025-09-10 08:51:26', 1),
(8, 'Đỗ Công Hưng', '15/02/1996', 'Kinh', NULL, 'Nam', 'Thái Bình', NULL, 'Trung uý', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2024-06-11 02:58:59', '2024-12-12 07:51:48', 3),
(9, 'Nguyễn Thành Duy', '01/01/1988', 'Kinh', NULL, 'Nam', 'Hưng Yên', NULL, 'Thiếu tá', 'Cán bộ', 'TLGĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2024-06-11 07:02:58', '2025-09-10 08:50:18', 1),
(10, 'Nguyễn Phương Nam', '01/01/1993', 'Kinh', NULL, 'Nam', 'Nam Định', NULL, 'Đại uý', 'Cán bộ', 'TLGĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2024-06-17 01:29:10', '2025-09-10 08:53:59', 1),
(11, 'Nguyễn Hàn Ni', '01/01/1987', 'Kinh', NULL, 'Nữ', 'Quảng Ngãi', NULL, 'Thiếu tá', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, 'avatar2.png', NULL, NULL, NULL, NULL, 'Không', 0, 1, '2024-07-01 06:57:06', '2026-04-07 02:52:08', 2),
(12, 'Tô Thị Kim Anh', '01/01/1984', 'Kinh', NULL, 'Nữ', 'Thái Bình', NULL, 'Trung tá', 'Phó Đội Trưởng', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Đội', 0, 1, '2024-12-12 03:00:17', '2025-09-11 02:20:10', 2),
(13, 'Phạm Trung Đức', '01/01/1999', 'Kinh', NULL, 'Nam', 'Bắc Ninh', NULL, 'Trung uý', 'Cán bộ', 'TLGĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2024-12-12 03:01:02', '2024-12-12 07:52:34', 3),
(14, 'Lê Duy Tiến', '01/01/1993', 'Kinh', NULL, 'Nam', 'Thanh Hoá', NULL, 'Đại uý', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2025-08-22 07:52:04', '2025-09-10 08:51:58', 1),
(15, 'Nguyễn Đắc Cảnh', '01/01/1983', 'Kinh', NULL, 'Nam', 'Bắc Ninh', NULL, 'Trung tá', 'Đội Trưởng', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Đội', 0, 1, '2025-09-11 02:22:05', '2025-09-11 02:50:06', 3),
(16, 'Nguyễn Đình Vũ', '01/01/1996', 'Kinh', NULL, 'Nam', 'Quảng Bình', NULL, 'Thượng úy', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-04-05 08:57:26', NULL, 2),
(17, 'Phùng Văn Quế', '01/01/1987', 'Kinh', NULL, 'Nam', 'Nghệ An', NULL, 'Thiếu tá', 'Phó Đội Trưởng', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Đội', 0, 1, '2026-04-05 09:00:34', NULL, 2),
(18, 'Võ Hoàng Nam', '01/01/1993', 'Kinh', NULL, 'Nam', 'Quảng Ngãi', NULL, 'Đại úy', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-04-05 09:01:28', NULL, 3),
(21, 'Từ Hữu Tài', '01/01/1993', 'Kinh', NULL, 'Nam', 'Bình Định', NULL, 'Thượng úy', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-04-07 02:39:11', NULL, 1),
(22, 'Tống Văn Văn', '01/01/1986', 'Kinh', NULL, 'Nam', 'Thái Bình', NULL, 'Đại úy', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-04-07 02:52:54', NULL, 1),
(23, 'Triệu Quang Chinh', '01/01/1996', 'Kinh', NULL, 'Nam', 'Điện Biên', NULL, 'Thượng úy', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-04-07 02:53:50', NULL, 1),
(24, 'Phan Đình Hoàng', '01/01/1995', 'Kinh', NULL, 'Nam', 'Nghệ An', NULL, 'Trung úy', 'Cán bộ', 'GĐV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-04-07 02:55:15', NULL, 2),
(25, 'Ngô Văn Thăng', '01/01/1992', 'Kinh', NULL, 'Nam', 'Bình Định', NULL, 'Đại úy', 'Cán bộ', 'KNHT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Không', 0, 1, '2026-05-19 08:08:42', NULL, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cham_cong`
--

CREATE TABLE `cham_cong` (
  `ID` int(11) NOT NULL,
  `TuNgay` varchar(255) NOT NULL,
  `DenNgay` varchar(255) NOT NULL,
  `Ngay` varchar(255) DEFAULT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `NgayCham` datetime NOT NULL,
  `CanBo_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cham_cong`
--

INSERT INTO `cham_cong` (`ID`, `TuNgay`, `DenNgay`, `Ngay`, `TieuDe`, `NoiDung`, `NgayCham`, `CanBo_ID`) VALUES
(2, '2024-06-12', '2024-06-13', NULL, 'Giám định', 'SKSM', '2024-06-17 08:54:59', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cong_van`
--

CREATE TABLE `cong_van` (
  `ID` int(11) NOT NULL,
  `SoCV` varchar(255) NOT NULL,
  `NoiGui` varchar(255) NOT NULL,
  `NgayGui` varchar(255) NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `NgayTiepNhan` datetime NOT NULL,
  `GhiChu` varchar(255) NOT NULL,
  `LoaiCV` varchar(255) NOT NULL,
  `CanBo_ID` int(11) NOT NULL,
  `LoaiCV_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_lichtruc`
--

CREATE TABLE `ct_lichtruc` (
  `ID` int(11) NOT NULL,
  `NgayTruc` datetime NOT NULL,
  `LichTruc_ID` int(11) NOT NULL,
  `CanBo_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dang_nhap`
--

CREATE TABLE `dang_nhap` (
  `ID` int(11) NOT NULL,
  `TaiKhoan` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `ThoiGian_DN` datetime NOT NULL,
  `CanBo_ID` int(11) NOT NULL,
  `Quyen_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doi`
--

CREATE TABLE `doi` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `SoCB` int(11) NOT NULL,
  `NhiemVu` varchar(255) DEFAULT NULL,
  `Doi_Truong` int(11) DEFAULT NULL,
  `Doi_Pho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `doi`
--

INSERT INTO `doi` (`ID`, `Ten`, `SoCB`, `NhiemVu`, `Doi_Truong`, `Doi_Pho`) VALUES
(1, 'Khám nghiệm hiện trường', 9, 'Khám nghiệm hiện trường', 3, 6),
(2, 'Giám định', 8, 'Giám định', 3, NULL),
(3, 'Kỹ thuật phòng chống tội phạm', 5, 'Kỹ thuật phòng chống tội phạm', 15, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvi_tc`
--

CREATE TABLE `donvi_tc` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `TrangThai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donvi_tc`
--

INSERT INTO `donvi_tc` (`ID`, `Ten`, `GhiChu`, `TrangThai`) VALUES
(1, 'CATP Kon Tum', 'Công an thành phố Kon Tum', 0),
(2, 'CAH Kon Rẫy', 'Công an huyện Kon Rẫy', 0),
(3, 'CAH Ngọc Hồi', 'Công an huyện Ngọc Hồi', 0),
(4, 'CAH Đăk Glei', 'Công an huyện Đăk Glei', 0),
(5, 'PC01', 'Văn phòng Cơ quan CSĐT, Công an tỉnh', 1),
(6, 'PC02', 'Phòng Cảnh sát ĐTTP về trật tự xã hội, Công an tỉnh', 1),
(8, 'CAH Đăk Hà', 'Công an huyện Đăk Hà', 0),
(9, 'PC04', 'Phòng Cảnh sát ĐTTP về ma tuý, Công an tỉnh', 1),
(10, 'PC03 GL', 'Phòng CS ĐTTP về Kinh tế, tham nhũng, buôn lậu, môi trường, CA tỉnh Gia Lai', 0),
(12, 'CAH Sa Thầy', 'Công an huyện Sa Thầy', 0),
(13, 'CATX An Khê', 'Công an thị xã An Khê, tỉnh Gia Lai', 0),
(14, 'PA09', 'Cơ quan An ninh điều tra, Công an tỉnh', 1),
(15, 'PC03', 'Phòng Cảnh sát ĐTTP về kinh tế, tham nhũng, buôn lậu và môi trường', 1),
(16, 'CAH Ia H\'Drai', 'Công an huyện Ia H\'Drai', 0),
(17, 'CAH Đăk Tô', 'Công an huyện Đăk Tô', 0),
(18, 'PA08', 'Phòng Quản lý xuất nhập cảnh, Công an tỉnh Kon Tum', 0),
(19, 'PC08', 'Phòng Cảnh sát giao thông Công an tỉnh', 1),
(20, 'CQCSĐT, CAT Gia Lai', 'Cơ quan CSĐT, Công an tỉnh Gia Lai', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `knht`
--

CREATE TABLE `knht` (
  `ID` int(11) NOT NULL,
  `TenVuViec` varchar(255) NOT NULL,
  `NgayTiepNhan` datetime NOT NULL,
  `DonVi_TC` varchar(255) NOT NULL,
  `DiaDiem` varchar(255) NOT NULL,
  `DonVi_ID` int(255) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL,
  `NoiDung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `knht`
--

INSERT INTO `knht` (`ID`, `TenVuViec`, `NgayTiepNhan`, `DonVi_TC`, `DiaDiem`, `DonVi_ID`, `TrangThai`, `NoiDung`) VALUES
(1, 'Trộm cắp tài sản', '2025-08-13 00:00:00', 'Tổ điều tra KV 4', 'Thôn Kon Đào, xã Kon Đào, tỉnh Quảng Ngãi', NULL, 0, NULL),
(2, 'Tàng trữ, sử dụng trái phép chất ma tuý', '2025-08-07 00:00:00', 'PC04', '80 Phan Đình Giót, phường Đắk Cấm, tỉnh Quảng Ngãi', NULL, 0, NULL),
(3, 'Thực nghiệm điều tra vụ \"Giết người\"', '2025-09-08 00:00:00', 'PC02', 'thôn Kon Hia 2, xã Đăk Tờ Kan (Tu Mơ Rông)', NULL, 0, NULL),
(4, 'Vụ cháy trụ điện', '2025-09-10 00:00:00', 'CAP Kon Tum', 'Ngã tư Mạc Đĩnh Chi – Lê Quý Đôn, phường Kon Tum', NULL, 0, NULL),
(5, 'Tổ chức sử dụng trái phép  chất ma tuý', '2025-09-03 00:00:00', 'PC04', 'phường Kon Tum, tỉnh Quảng Ngãi', NULL, 0, NULL),
(6, 'Tàng trữ và Tổ chức sử dụng trái phép chất ma túy', '2025-08-23 00:00:00', 'CAP Đăk Cấm', 'thôn 6, phường Đăk Cấm', NULL, 0, NULL),
(7, 'Mua bán trái phép chất ma tuý', '2025-08-23 00:00:00', 'PC04', 'nhà nghỉ Bốn Mùa, thuộc thôn Chiên Chiết, xã Bờ Y', NULL, 0, NULL),
(8, 'Cố ý gây thương tích', '2025-09-18 00:00:00', 'PC02', 'thôn Măng Rương, xã Kon Đào', NULL, 0, NULL),
(9, 'Tai nạn giao thông đường bộ', '2025-09-19 00:00:00', 'CAX Kon Braih', 'thôn 2, xã Kon Braih', NULL, 0, NULL),
(10, 'Tàng trữ trái phép chất ma túy, ngày 12/8/2025', '2025-10-15 00:00:00', 'PC04', 'Đăk Tô 7, xã Đăk Tô, tỉnh Quảng Ngãi', NULL, 0, NULL),
(11, 'Tàng trữ trái phép chất ma tuý', '2025-10-24 00:00:00', 'CAX Đăk Rơ Wa', 'Thôn 4, xã Đăk Rơ Wa, tỉnh Quảng Ngãi', NULL, 0, NULL),
(12, 'Tổ chức sử dụng trái phép chất ma tuý', '2025-11-06 00:00:00', 'PC04', 'Thôn Plei Klech, xã Ngọk Bay, tỉnh Quảng Ngãi', NULL, 0, NULL),
(13, 'Hiếp dâm người dưới 16 tuổi', '2025-11-06 00:00:00', 'PC02', '107 Lê Lai và hẻm 2 Nguyễn Viết Xuân, phường Kon Tum, tỉnh Quảng Ngãi', NULL, 0, NULL),
(14, 'Tai nạn giao thông', '2026-01-01 00:00:00', 'PC01', 'Km 79+450 đường quốc lộ 14C, xã Ia Tơi, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 15 giờ 30 phút, ngày 31/12/2025 tại km số 79+450 đường Quốc lộ 14C đoạn qua xã Ia Tơi, tỉnh Quảng Ngãi xảy ra vụ tai nạn giao thông giữa xe ô tô biển số 81A - 427.01 do anh Hoàng Minh Hậu (sinh ngày: 16/02/1997, thường trú: Tổ dân phố 9, xã Đức Cơ, tỉnh Gia Lai) điều khiển chở theo anh Lê Văn Tâm (sinh năm 1993; Trú tại: Tổ dân phố 9, xã Đức Cơ, tỉnh Gia Lai) lưu thông theo hướng từ xã Ia Tơi đến xã Mô Rai, tỉnh Quảng Ngãi va chạm với xe mô tô biển số 28D1 - 118.84 do anh Đinh Văn Hùng (Sinh năm: 2001; Trú tại: Thôn Ia Dom, xã Ia Tơi, tỉnh Quảng Ngãi) lưu thông theo hướng ngược lại. Hậu quả: Đinh Văn Hùng bị thương nặng được đưa đi cấp cứu tại bệnh viện 211 tỉnh Gia Lai, xe mô tô biển số 28D1 - 118.84 và xe ô tô biển số 81A - 427.01 hư hỏng.\r\nKết quả khám nghiệm hiện trường xác định dấu vết va chạm đầu tiên giữa hai phương tiện, xác định các dấu vết va chạm giữa hai xe và ghi nhận các dấu vết trên mặt đường.'),
(15, 'Vụ cháy nhà dân', '2026-01-01 00:00:00', 'CAX Ngọc Tem', 'Thôn Điek Chè, xã Kon Plông, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 15h 00 phút ngày 31/12/2025 ông Đinh Xuân Biên (sinh năm 1977) có nhóm bếp lửa để nấu ăn và sưởi ấm. Trong quá trình ông Biên ăn cơm có uống rượu một mình sau đó đi ngủ trong lúc nằm ngủ khoảng 18h thì người dân phát hiện nhà ông Đinh Xuân Biên có khói bốc lên. Vì vậy đã phá cửa đưa ông Biên ra ngoài. Hậu quả: không có thiệt hại về người, cháy hoàn toàn một ngôi nhà gỗ. Kết quả khám nghiệm ghi nhận toàn bộ hiện trường vụ cháy, dấu vết than hóa. Nhận định: Do trong quá trình đốt lửa để nấu ăn và sưởi ấm trong nhà, khi ông Biên say rượu ngủ lửa đã bắt cháy vào vách tre nứa và lan rộng.'),
(17, 'Chế tạo, tàng trữ trái phép vũ khí quân dụng', '2026-02-03 00:00:00', 'PA09', 'thôn 3, xã Ia Đal, tỉnh Quảng Ngãi.', NULL, 0, 'Tiến hành xác định hiện trường 01 vụ “Chế tạo, tàng trữ trái phép vũ khí quân dụng” xảy ra ngày 23/11/2025 tại thôn 3, xã Ia Đal, tỉnh Quảng Ngãi. Quá trình làm việc, xác định vị trí Hoàng Văn Ngôn (SN: 1964; trú tại: thôn 3, xã Ia Đal, tỉnh Quảng Ngãi) chế tạo, để bộ dụng cụ chế tạo và vị trí cất giấu súng tại nhà của mình.'),
(18, 'Tai nạn giao thông', '2026-02-04 00:00:00', 'PC01', 'đường liên thôn thuộc thôn Ia Ho, xã Mô Rai, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 14 giờ 55 phút ngày 03/02/2026 tại đường liên thôn thuộc thôn Ia Ho, xã Mô Rai, tỉnh Quảng Ngãi xảy ra vụ tai nạn giao thông do anh Moong Văn Mun (SN: 07/04/2003; CCCD: 040203013277; TT: Bản Huồi Lê, Keng Đu, Kỳ Sơn, Nghệ An) điều khiển xe mô tô biển số: 37AE-005.06 chở theo con gái là Moong Thị Huỳnh Như (SN: 09/5/2023; chưa rõ số định danh cá nhân) đi từ hướng làng Le, xã Mô Rai vào thôn Ia Ho, xã Mô Rai thì ngã xuống mương thoát nước. Hậu quả Moong Thị Huỳnh Như tử vong tại bệnh viện đa khoa tỉnh Quảng Ngãi 2'),
(19, 'Án mạng', '2026-05-06 00:00:00', 'PC02', 'xã Dục Nông, tỉnh Quảng Ngãi', NULL, 0, 'Báo cáo lãnh đạo, chỉ huy đơn vị, ngày 06/2/2026 tổ KTHS gồm KNHT (Duy, Nam, Hương) và PY (Văn, Tài, Chinh, Vũ) tiến hành KNHT KNTT GĐPY vụ Án mạng tại xã Dục Nông, tỉnh Quảng Ngãi. Nội dung vụ việc: Vào khoảng 17 giờ 00 phút ngày 05/02/2026 A Nhạc (sinh ngày 5/4/2008, cư trú thôn Chả Nhầy, xã Dục Nông, tỉnh Quảng Ngãi), A Duy (sinh năm 2007, cư trú thôn Nông Kon, xã Dục Nông, tỉnh Quảng Ngãi), Kring Sang (sinh năm 1989, cư trú thôn Dục Nội, Xã Dục Nông, tỉnh Quảng Ngãi), A Khâu (sinh năm 1999, cư trú thôn Dục Nội, tỉnh Quảng Ngãi), Y CheL (sinh năm 2001, cư trú thôn Dục Nội, tỉnh Quảng Ngãi) và Kring Sơn (sinh năm 1979, cư trú thôn Dục Nội, tỉnh Quảng Ngãi) cùng ăn nhậu tại chòi rẫy của ông Kring Sơn, sau khi uống hết khoảng 3 lít rượu, thì A Khâu có cự cãi lời qua tiếng lại với Kring Sang thì A Nhạc dùng tay phải đấm vào mặt của A Khâu làm A Khâu ngả nằm bất động xuống mặt đất, A Nhạc dùng chân bên phải đạp liên tiếp hai cái vào vùng thái dương bên phải của A Khâu làm A Khâu nằm bất động khoảng 3 đến 5 phút tỉnh lại, sau đó Y CheL là vợ của A Khâu đưa A Khâu về chòi rẫy của A Khâu hai vợ chồng cùng ngủ nghỉ, đến khoảng 22 giờ 30 phút cùng ngày thì Y CheL phát hiện A Khâu nôn ói ra máu, sau đó A Khâu tiếp tục đi ngủ đến khoảng 01 giờ 00 phút ngày 06/02/2026 thì vợ A Khâu là Y CheL phát hiện A Khâu đã tử vong.'),
(20, 'Tai nạn giao thông', '2026-01-31 00:00:00', 'PC01', 'Quốc lộ 14, thuộc thôn Đăk Bo, xã Đăk Môn, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 15 giờ 20 phút, ngày 31/01/2026, tại Km 1450+300, đường Quốc lộ Hồ Chí Minh, thuộc thôn Đăk Bo, xã Đăk Môn, tỉnh Quảng Ngãi giữa xe mô tô mang biển kiểm soát 82N1 – 110.66 do anh A Nao (sinh năm 1998, nơi thường trú: thôn Đăk Bo, xã Đăk Môn, tỉnh Quảng Ngãi) điều khiển chở theo anh A Xơ Bưởi (sinh năm 2001) lưu thông theo hướng xã Đăk Môn đi xã Đăk Pét va chạm với xe máy cày (không gắn biển kiểm soát) do anh A Lịu (sinh năm 1988, nơi thường trú: thôn Đăk Túc, xã Đăk Môn, tỉnh Quảng Ngãi ) lưu thông theo hướng ngược lại. Hậu quả: anh A Nao tử vong trên đường đi cấp cứu, anh A Xơ Bưởi bị thương; 02 phuơng tiện bị hư hỏng. Quá trình KNHT ghi nhận vị trí vết cà, vết máu và vị trí va chạm'),
(21, 'Chế tạo, tàng trữ trái phép vũ khí quân dụng', '2026-04-03 00:00:00', 'PA09', 'thôn 3, xã Ia Đal, tỉnh Quảng Ngãi', NULL, 0, 'Xác định hiện trường 01 vụ “Chế tạo, tàng trữ trái phép vũ khí quân dụng” xảy ra ngày 23/11/2025 tại thôn 3, xã Ia Đal, tỉnh Quảng Ngãi. Quá trình làm việc, xác định vị trí Hoàng Văn Ngôn (SN: 1964; trú tại: thôn 3, xã Ia Đal, tỉnh Quảng Ngãi) chế tạo, để bộ dụng cụ chế tạo và vị trí cất giấu súng tại nhà của mình'),
(22, 'Tàng trữ trái phép chất ma túy', '2026-02-03 00:00:00', 'CAX Đăk Rơ Wa', 'xã Đăk Rơ Wa, tỉnh Quảng Ngãi', NULL, 0, 'Xác định hiện trường vụ tàng trữ trái phép chất ma túy xảy ra ngày 28/11/2025 tại thôn 2, xã Đăk Rơ Wa, tỉnh Quảng Ngãi. Quá trình xác định vị trí Nguyễn Minh Sang (sinh năm: 1994; HKTT: thôn 2, xã Đăk Rơ Wa, tỉnh Quảng Ngãi) bị phát hiện tàng trữ chất ma túy và vị trí lấy chất ma túy.'),
(23, 'Cố ý gây thương tích', '2026-02-03 00:00:00', 'CAX Ngọk Tụ', 'Xã Ngọk Tụ, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 19 giờ 30 phút ngày 01/02/2026 A Đão (sinh năm 2005, trú tại thôn Đăk Dé, xã Ngọk Tụ) đến nhà ông A Đrát (trú cùng thôn) để uống rượu thì gặp A Hậu (sinh năm 1999, cùng trú thôn Đăk Dé). Vừa gặp thì A Hậu hỏi A Đão: “Mày láo lắm đúng không?”. A Đão trả lời “Không” thì liền bị A Hậu lao vào dùng tay đánh vào vùng đầu, mặt. Bực tức vì bị đánh nên A Đão đã gọi điện thoại cho anh ruột là A Nẻo (sinh năm 1999) biết sự việc, sau đó về nhà kể cho anh ruột khác là A Đường. Sau đó, A Đão cầm hai con dao cùng hai anh là A Nẻo và A Đường đi tìm A Hậu. Khi thấy A Hậu đang uống rượu tại nhà Y Đào thì cả ba người vào gặp Hậu. Hậu thấy 03 người đi vào thì rút ra một con dao (loại dao thái lan), thấy vậy A Đường lao vào ôm, giữ Hậu thì bị Hậu đâm vào sườn trái gây sây sát da. Thấy A Đường đang ôm giữ Hậu thì A Đão lao vào cầm 02 con dao chém liên tiếp 03 nhát vào vùng đầu, mặt của Hậu. Tiếp đó A Đường vật ngã Hậu xuống nền nhà, được mọi người can ngăn nên A Đường buông ra. Thấy A Hậu vừa đứng dậy thì A Nẻo chạy vào cầm cán dao đánh vào ngực phải A Hậu. Sau khi được mọi người can ngăn thì cả ba người bỏ về. Hậu quả: A Hậu bị thương tích chảy nhiều máu vùng đầu, mặt và được đưa đi cấp cứu tại Trung tâm y tế Đăk Tô. Các hung khí gây án đã được Công an xã Ngọk Tụ thu giữ. Qua khám nghiệm hiện trường ghi nhận vị trí, tư thế của các đối tượng khi thực hiện hành vi phạm tội. Ghi nhận và thu các mẫu chất màu nâu đỏ trên vách tường nhà bà Y Đào'),
(24, 'Tai nạn giao thông', '2026-02-04 00:00:00', 'PC01', 'thôn Ia Ho, xã Mô Rai, tỉnh Quảng Ngãi.', NULL, 0, 'Vào khoảng 14 giờ 55 phút ngày 03/02/2026 tại đường liên thôn thuộc thôn Ia Ho, xã Mô Rai, tỉnh Quảng Ngãi xảy ra vụ tai nạn giao thông do anh Moong Văn Mun (SN: 07/04/2003; CCCD: 040203013277; TT: Bản Huồi Lê, Keng Đu, Kỳ Sơn, Nghệ An) điều khiển xe mô tô biển số: 37AE-005.06 chở theo con gái là Moong Thị Huỳnh Như (SN: 09/5/2023; chưa rõ số định danh cá nhân) đi từ hướng làng Le, xã Mô Rai vào thôn Ia Ho, xã Mô Rai thì ngã xuống mương thoát nước. Hậu quả Moong Thị Huỳnh Như tử vong tại bệnh viện đa khoa tỉnh Quảng Ngãi 2'),
(25, 'Án mạng', '2026-02-06 00:00:00', 'PC02', 'xã Dục Nông, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 17 giờ 00 phút ngày 05/02/2026 A Nhạc (sinh ngày 5/4/2008, cư trú thôn Chả Nhầy, xã Dục Nông, tỉnh Quảng Ngãi), A Duy (sinh năm 2007, cư trú thôn Nông Kon, xã Dục Nông, tỉnh Quảng Ngãi), Kring Sang (sinh năm 1989, cư trú thôn Dục Nội, Xã Dục Nông, tỉnh Quảng Ngãi), A Khâu (sinh năm 1999, cư trú thôn Dục Nội, tỉnh Quảng Ngãi), Y CheL (sinh năm 2001, cư trú thôn Dục Nội, tỉnh Quảng Ngãi) và Kring Sơn (sinh năm 1979, cư trú thôn Dục Nội, tỉnh Quảng Ngãi) cùng ăn nhậu tại chòi rẫy của ông Kring Sơn, sau khi uống hết khoảng 3 lít rượu, thì A Khâu có cự cãi lời qua tiếng lại với Kring Sang thì A Nhạc dùng tay phải đấm vào mặt của A Khâu làm A Khâu ngả nằm bất động xuống mặt đất, A Nhạc dùng chân bên phải đạp liên tiếp hai cái vào vùng thái dương bên phải của A Khâu làm A Khâu nằm bất động khoảng 3 đến 5 phút tỉnh lại, sau đó Y CheL là vợ của A Khâu đưa A Khâu về chòi rẫy của A Khâu hai vợ chồng cùng ngủ nghỉ, đến khoảng 22 giờ 30 phút cùng ngày thì Y CheL phát hiện A Khâu nôn ói ra máu, sau đó A Khâu tiếp tục đi ngủ đến khoảng 01 giờ 00 phút ngày 06/02/2026 thì vợ A Khâu là Y CheL phát hiện A Khâu đã tử vong'),
(26, 'Tai nạn giao thông', '2026-03-07 00:00:00', 'PC01', 'xã Đăk Ui, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 12h ngày 07/2/2026 tại thôn Kon Tu, xã Đăk Ui xảy ra vụ tại nạn giao thông. Nguyễn Công Đạt (SN: 2006, thường trú tại: Tổ tự quản số 5, Phan Lâm, Bắc Bình, Bình Thuận (nay là Phan Sơn, Lâm Đồng) điều khiển xe mô tô BKS 82B - 01608 chở theo A Tân (SN: 2002) và A Dâng (SN: 2015) cùng trú tại thôn Kon Tu, xã Đăk Ui đi từ đường sản xuất ra đường liên thôn (đoạn đường nhỏ hẹp và có độ dốc lớn khoảng 20 độ); quá trình xuống dốc, Đạt không làm chủ tốc độ lao vào tường nhà ông A Sơ Mon (SN: 1995, trú tại thôn Kon Tu, xã Đăk Ui). Hậu quả: Đạt chết tại chỗ do chấn thương sọ não, A Tân, A Dâng bị thương đưa đi cấp cứu'),
(27, 'Cháy', '2026-03-09 00:00:00', 'CAX Kon Braih', 'làng Kon Brắp Du (thôn 5, xã Kon Braih) tỉnh Quảng Ngãi.', NULL, 0, 'Khoảng 15 giờ 40 phút ngày 8/02/2026, xảy ra vụ cháy nhà rông làng Kon Brắp Du (thôn 5, xã Kon Braih), đám cháy lang rộng dẫn đến cháy nhà ông A Jing Đeng, A Văh, A Yin. Nguyên nhân: Theo lời khai ban đầu của A Sơ Năm (sinh năm: 2011), A Geo (2013), Phạm Văn Hạnh (2010) cùng có HKTT tại thôn 5, xã Kon Braih chơi gần đó thấy A Tiến (sinh năm: 2013; HKTT: thôn 5, xã Kon Braih) châm lửa đốt phần mái nhà rông dẫn đến vụ việc. Hiện A Tiến đã trốn, chưa tìm được. Hậu quả: Nhà Rông làng Kon Brắp Du cháy hoàn toàn (ước tính thiệ hại khoảng 01 tỷ đồng) và nhà ông A Jing Đeng, A Văh, A Yin bị cháy một phần (tổng thiệt hại khoảng 150tr); nổ trạm biến áp (ước tính thiệt hại khoảng 250tr): Quá trình KNHT: Nhà rông bị cháy than hóa hoàn toàn. Xác định vị trí đối tượng châm lửa đốt. thu mẫu than tro tại vị trí đốt. thu mẫu dây điện bị vón cục'),
(28, 'Tai nạn giao thông', '2026-03-10 00:00:00', 'PC01', 'phường Kon Tum, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 19h ngày 09/2/2026 tại đường bờ bao, khu vực trước nhà khách Ngọc linh thuộc phường Kon Tum, tỉnh Quảng Ngãi xảy ra vụ Tai nạn nạn thông giữa xe mô tô BKS: 82B1 - 266.92 do A Sơm (SN: 2001, trú tại: thôn Kon Klo, phường Kon Tum, tỉnh Quảng Ngãi) điều khiển di chuyển theo hướng từ xã Đăk Rơ Wa đi phường Kon Tum với xe đạp do Võ Ngọc Gia Phúc (SN: 2014, trú tại: 05 Nguyễn Trãi, phường Kon Tum, tỉnh Quảng Ngãi). Hậu quả: A Sơm chết trên đường đi cấp cứu, Võ Ngọc Gia Phúc bị thương được đưa đi cấp cứu tại BV Đa khoa tỉnh Quảng Ngãi 2; 02 phương tiện bị hư hỏng. KNHT xác định các điểm va chạm và điểm va chạm đầu tiên giữa 2 phương tiện.'),
(29, 'Tổ chức sử dụng trái phép chất ma túy', '2026-02-19 00:00:00', 'CAP Kon Tum', 'thôn Kon Mơ Nay Sơ Lam 1, phường Kon Tum, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 19 giờ 00 phút ngày 09/02/2026, Công an phường Kon Tum, tỉnh Quảng Ngãi tiến hành kiểm tra nhà A Phát (sinh năm: 2002; trú tại: thôn Kon Mơ Nay Sơ Lam 1) để đưa đối tượng đi cai nghiện bắt buộc. Tại đây, phát hiện A Phát cùng A Huy (sinh năm: 2007; trú tại: thôn Kon Mơ Nay Sơ Lam 1) đang tổ chức sử dụng trái phép chất ma tuý tại phòng ngủ của A Phát, trên nền nhà có 01 bộ dụng cụ sử dụng trái phép chất ma tuý, 01 kéo, 01 quẹt ga. Qua công tác khám nghiệm hiện trường tiến hành xác định vị trí của 2 đối tượng sử dụng ma túy và vị trí bộ dụng cụ sử dụng ma túy.'),
(30, 'Vận chuyển trái phép chất ma túy', '2026-03-20 00:00:00', 'PC04', 'thôn 1B xã Đăk La tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 13h15 ngày 10/02/2026 Tổ công tác PC04 và PC08 dừng xe taxi mang biển kiểm soát 82H-003.44 hãng Mai Linh (đang lưu thông theo hướng từ phường Đăk Cấm đi xã Đăk La) tại đoạn đường Hồ Chí Minh Km1541+500, thôn 1B xã Đăk La tỉnh Quảng Ngãi để kiểm tra thì phát hiện trong túi ngoài bên phải áo khoác màu đen của người ngồi ghế bên phải phía trước có một túi nilon trong suốt bên trong chứa chất tinh thể rắn màu trắng (đối tượng khai nhận là ma túy đá). Qua khai thác thông tin: đối tượng tên là A Tài, sinh ngày 18/05/2003, trú tại thôn KLâu Ngo Ngó, xã Ia Chim, tỉnh Quảng Ngãi. Qua khám nghiệm hiện trường tiến hành xác định vị trí phát hiện, thu giữ chất tinh thể rắn màu trắng'),
(31, 'Cháy', '2026-04-04 00:00:00', 'PC01', 'xã Đăk Plô, tỉnh Quảng Ngãi', NULL, 0, 'Vào lúc 17h05p ngày 09/02/2026, Đội Chữa cháy và CNCH khu vực 5 nhận được tin báo từ Đội chữa cháy và CNCH khu vực 4 xảy ra cháy xe tải chở mỳ tại xã Đăk Plô (đoạn qua đèo Lò Xo). Nhận được tin báo Đội chữa cháy và CNCH khu vực 5 đã điều động 02 xe chữa cháy và 13 cán bộ chiến sĩ, có mặt tại hiện trường lúc 18h12p. Đến khoảng 18 giờ 55 phút đám cháy đã được khống chế và dập tắt hoàn.'),
(32, 'Tai nạn giao thông', '2026-05-10 00:00:00', 'PC01', 'Làng Kà Đừ, xã Sa Thầy, tỉnh Quảng Ngãi', NULL, 0, 'Vào lúc 07 giờ 45 phút, ngày 10/02/2026, Đội CSGT ĐB số 2, Khu vực 4, Phòng Cảnh Sát Giao Thông (PC08), Công an tỉnh Quảng Ngãi, nhận được tin báo từ quần chúng nhân dân báo tin tại ngã ba đường liên thôn làng Kà Đừ với đường Điện Biên Phủ, thuộc Làng Kà Đừ, xã Sa Thầy, tỉnh Quảng Ngãi có xảy ra một vụ Tai nạn giao thông giữa xe ô tô biển số 82C - 074.50 do Cao Thanh Vũ (Sinh ngày: 18/05/1984; Trú tại: Số 367 Phan Chu Trinh, phường Kon Tum, tỉnh Quảng Ngãi) điều khiển chở theo Phạm Văn Tân (Sinh năm: 17/12/1990; Trú tại: phường Kon Tum, tỉnh Quảng Ngãi) va chạm với xe mô tô biển số 82AM1 - 032.34 do Đặng Thái Thị Tuyết (Sinh năm: 1969; Trú tại: Làng Kà Đừ, xã Sa Thầy, tỉnh Quảng Ngãi) điều khiển. Hậu quả: Đặng Thái Thị Tuyết bị thương nặng và đã tử vong tại Bệnh viên Đa khoa tỉnh Quảng Ngãi (Cơ sở 2), 02 xe mô tô và ô tô hư hỏng.'),
(33, 'Tai nạn giao thông', '2026-05-18 00:00:00', 'PC01', 'thôn Đăk Dé, xã Ngọk Tụ, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 18 giờ 00 phút, ngày 13/02/2026, tại đường DH53, thuộc thôn Đăk Dé, xã Ngọc Tụ, tỉnh Quảng Ngãi xảy ra vụ tai nạn giao thông đường bộ giữa xe ô tô mang biển kiểm soát 76A – 47.017 do anh Sa Ly Suýt (sinh năm 1985, nơi thường trú: thôn Đăk Pung, xã Ngọc Tụ, tỉnh Quảng Ngãi) điều khiển lưu thông hướng Thôn Đăk Dé đi UBND xã Ngọc Tụ, tỉnh Quảng Ngãi va chạm với người đi bộ là ông A Chuyên (sinh năm 1980, cư trú thôn Đăk Dé, xã Ngọc Tụ, tỉnh Quảng Ngãi). Hậu quả: ông A Chuyên tử vong, xe ô tô bị hư hỏng. Kết quả khám nghiệm tử thi: nạn nhân gãy chân phải, chấn thương sọ não. Kết quả khám nghiệm hiện trường: khu vực xảy ra va chạm nằm bên phần đường bên trái hướng xã Ngọk Tụ đi xã Bờ Y, ghi nhận 01 cọc tiêu trong lề đường bên trái bị nứt phần chân, đầu trên giữa mặt trụ có vết lõm và cạnh góc trụ có vết vỡ, phần dưới chân trụ và đế trụ có vết nứt. Sát lề đường bên trái vào trong, cách cọc tiêu nêu trên 65cm có dấu vết máu và mảnh nhựa vỡ, các mảnh nhựa vỡ kéo dài từ vết máu dọc theo lề đường bên trái. Ghi nhận vị trí xe ô tô dừng sau va chạm, trên mặt đường từ vị vết máu nêu trên đến cửa sau bên phải xe ô tô có các dấu vết máu nhỏ giọt. Trong xe ô tô trên dãy ghế sau thứ hai có vết máu dạng quệt, dạng vũng diện rộng. Kiểm tra xe ô tô thấy đèn xe trước bên trái bị vỡ theo hướng từ trái sang phải, đèn gầm bên trái bị vỡ, phần trên nắp ca pô phía bên trái có vết lõm, vết trượt và vết nứt sơn.'),
(34, 'Giết người', '2026-01-15 00:00:00', 'PC02', 'Tổ dân phố 2B, xã Đăk Hà, tỉnh Quảng Ngãi', NULL, 0, 'Thực nghiệm điều tra vụ “Giết người” xảy ra ngày 23/10/2025 tại Tổ dân phố 2B, xã Đăk Hà, tỉnh Quảng Ngãi.'),
(35, 'Tàng trữ trái phép chất ma tuý', '2026-01-15 00:00:00', 'CAP Đăk Bla', 'Tổ dân phố Lê Lợi 4, phường Đăk Bla, tỉnh Quảng Ngãi.', NULL, 0, 'Khoảng 14 giờ 30 phút, ngày 15/01/2026, Tổ Cảnh sát phòng chống tội phạm - Công an phường Đăk Bla, tỉnh Quảng Ngãi tuần tra kiểm soát địa bàn. Khi đến hẻm 43 Lê Thời Hiến, tổ dân phố Lê Lợi 4, phường Đăk Bla, tỉnh Quảng Ngãi thì phát hiện Lý Nhật Thiện đang đứng có nhiều biểu hiện nghi vấn nên tiến hành kiểm tra hành chính. Qua kiểm tra phát hiện bên trong túi áo phía trước bên trái của Lý Nhật Thiện đang mặc có 01 (một) bì ni lông trong suốt hàn kín, bên trong có chứa chất tinh thể rắn màu trắng (Nghi là ma túy). Tại đây, Lý Nhật Thiện khai nhận đây là gói chất ma túy đá của Lý Nhật Thiện mua của một người thanh niên tên Bảo (Không rõ nhân thân lai lịch) tại xã Bờ Y, tỉnh Quảng Ngãi vào ngày 14/01/2026 với giá 300.000đ (Ba trăm nghìn đồng) và cất giấu để sử dụng cho bản thân. Công an phường Đăk Bla, tỉnh Quảng Ngãi tiến hành mời người chứng kiến, thu giữ, niêm phong tang vật theo quy định.'),
(36, 'Tai nạn lao động', '2026-01-18 00:00:00', 'CAX Măng Đen', 'xã Măng Đen, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 8 giờ ngày 18/01/2026 tại khu vực công trình khu biệt thự nghỉ dưỡng đồi tree house của công ty cổ phần Măng Đen xảy ra tai nan lao động dẫn đến ông a Ren (sinh năm 1981, trú tại thôn Kon Xủh, xã Măng Đen, tỉnh Quảng Ngãi) tử vong sau khi đưa đến đến bệnh viện Kết quả khám nghiệm tử thi xác định: nguyên nhân tử vong do đa chấn thương. '),
(37, 'Trộm cắp tài sản', '2026-01-18 00:00:00', 'CAX Măng Ri', 'xã Măng Ri, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 11h30 phút ngày 16/01/2026, trong quá trình tuần tra bảo vệ vườn sâm của công ty cổ phần sâm Ngọc Linh Kon Tum tại thôn Đăk Dơn, xã Măng Ri, Tỉnh Quảng Ngãi, Nguyễn Đức Quân cùng với một số nhân viên của công ty sâm Ngọc Linh Kon Tum phát hiện 13 người gồm: Y Dôi (SN: 1991); Đinh Văn Thiêu (SN: 1986); A Nao (SN: 1999); Y Nghe (SN: 1977); Y Koi (SN: 1988); A Chín (SN: 2007); A Giang (SN: 2008); Y Thơ (SN: 2002); Y Đùng (SN: 2001); Y Sáu (SN: 1997); Y Xéo (SN: 2001); Y Liễu (SN: 2003); Y Mớ (SN: 2003) (tất cả cùng trú tại Thôn Đăk Dơn, xã Măng Ri, tỉnh Quảng Ngãi) đã có hành vi trộm cắp sâm Ngọc Linh của Công ty cổ phần sâm Ngọc Linh Kon Tum tại khoảnh 03, tiểu khu 220 thuộc thôn Đăk Dơn, xã Măng Ri, Tỉnh Quãng Ngãi nên đến công an xã Măng ri trình báo'),
(38, 'Tai nạn giao thông', '2026-02-10 00:00:00', 'PC01', 'Làng Kà Đừ, xã Sa Thầy, tỉnh Quảng Ngãi', NULL, 0, 'Vào lúc 07 giờ 45 phút, ngày 10/02/2026, Đội CSGT ĐB số 2, Khu vực 4, Phòng Cảnh Sát Giao Thông (PC08), Công an tỉnh Quảng Ngãi, nhận được tin báo từ quần chúng nhân dân báo tin tại ngã ba đường liên thôn làng Kà Đừ với đường Điện Biên Phủ, thuộc Làng Kà Đừ, xã Sa Thầy, tỉnh Quảng Ngãi có xảy ra một vụ Tai nạn giao thông giữa xe ô tô biển số 82C - 074.50 do Cao Thanh Vũ (Sinh ngày: 18/05/1984; Trú tại: Số 367 Phan Chu Trinh, phường Kon Tum, tỉnh Quảng Ngãi) điều khiển chở theo Phạm Văn Tân (Sinh năm: 17/12/1990; Trú tại: phường Kon Tum, tỉnh Quảng Ngãi) va chạm với xe mô tô biển số 82AM1 - 032.34 do Đặng Thái Thị Tuyết (Sinh năm: 1969; Trú tại: Làng Kà Đừ, xã Sa Thầy, tỉnh Quảng Ngãi) điều khiển. Hậu quả: Đặng Thái Thị Tuyết bị thương nặng và đã tử vong tại Bệnh viên Đa khoa tỉnh Quảng Ngãi (Cơ sở 2), 02 xe mô tô và ô tô hư hỏng'),
(39, 'Cháy', '2026-02-10 00:00:00', 'PC01', 'xã Đăk Plô, tỉnh Quảng Ngãi', NULL, 0, ' Vào lúc 17h05p ngày 09/02/2026, Đội Chữa cháy và CNCH khu vực 5 nhận được tin báo từ Đội chữa cháy và CNCH khu vực 4 xảy ra cháy xe tải chở mỳ tại xã Đăk Plô (đoạn qua đèo Lò Xo). Nhận được tin báo Đội chữa cháy và CNCH khu vực 5 đã điều động 02 xe chữa cháy và 13 cán bộ chiến sĩ, có mặt tại hiện trường lúc 18h12p. Đến khoảng 18 giờ 55 phút đám cháy đã được khống chế và dập tắt hoàn'),
(40, 'Tàng trữ trái phép chất ma tuý xảy ra', '2026-03-04 00:00:00', 'CAP Đăk Cấm', '06 Đinh Công Tráng, phường Đăk Cấm, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 23 giờ 00 phút ngày 03/03/2026, Đỗ Ngọc Tuấn (Sinh năm: 1993, trú tại 06 Đinh Công Tráng, phường Đăk Cấm, tỉnh Quảng Ngãi) do quen biết ngoài xã hội người tên là Thịnh (Chưa rõ nhân thân lai lịch) đến nhà Tuấn tại địa chỉ trên chơi, trong lúc ngồi chơi Tuấn hỏi Thịnh biết chỗ nào mua được ma tuý không mua giúp Tuấn ma tuý về sử dụng, Thịnh nói biết và nói Tuấn đưa tiền, Tuấn đưa tiền cho Thịnh 1.700.000 đồng và nói Thịnh mua cho Tuấn 700.000 đồng ma tuý loại heroin và 1.000.000 đồng ma tuý loại ma tuý đá, Thịnh cầm tiền đi đến khoảng 02 giờ 00 phút ngày 04/03/2026, Thịnh quay lại nhà Tuấn và đưa cho Tuấn 01 (một) bì ni lông dán kín bên trong có chứa chất bột màu trắng (heroin) và 01 (một) bì ni lông dán kin bên trong có chứa chất tinh thể rắn màu trắng (ma tuý đá) rồi Thịnh đi về, Tuấn cất dấu ma tuý tại phòng ngủ. Sáng ngày 04/03/2026, Tuấn lấy một phần ma tuý (heroin) ra dùng bơm kim tiêm và nước cất sử dụng một mình tại phòng ngủ. Sau khi sử dụng xong, Tuấn lấy một phần ma tuý đá ra bỏ lên giấy bạc dùng hộp quẹt gas đốt cho khói bốc lên và hút hết, sau khi sử dụng xong, Tuấn vứt dụng cụ sử dụng ma tuý vào thùng rác và cất dấu số ma tuý còn lại tại phòng ngủ của Tuấn. Đến khoảng 09 giờ 00 phút ngày 04/03/2026, bị Công an phường Đăk Cấm phát hiện và mời người chứng kiến tới lập biên bản bắt người phạm tội quả tang'),
(41, 'Trộm cắp tài sản', '2026-03-04 00:00:00', 'CAP Đăk Cấm', 'Hội trường thôn Thanh Trung, phường Đăk Cấm, tỉnh Quảng Ngãi', NULL, 0, 'Tối ngày 28/2/2026, A Teo (SN: 2008, HK: Kon Rơ bàng 1, xã Ngọk Bay, tỉnh Quảng Ngãi) điều khiển xe đạp từ nhà tìm nhà có sơ hở để trộm cắp. Khi đến hội trường thôn Thanh Trung, thấy ko có người nên A Teo leo tường vào trong sân hội trường, phá cửa sổ vào bên trong. A Teo dùng kéo cắt toàn bộ hệ thống dây điện của hội trường mang ra ngoài đốt lấy dây đồng, tháo 2 cánh cửa nhôm nhà vệ sinh của hội trường rồi phá thành từng đoạn, bỏ tất cả vào 1 bao xác rắn Teo mang theo, mang đi bán tại tiệm phế liệu tại đường Phan Văn Bảy, P. Đăk Cấm, tỉnh Quảng Ngãi được 180.000đ. Ngoài ra Teo còn lấy 1 cây búa tạ và 1 xà beng bằng sắt với ý định đi bán nhưng do đi xe đạp, đồ vật nặng ko chở được nên Teo vứt lại dọc đường'),
(42, 'Tai nạn giao thông', '2026-03-15 00:00:00', 'PC01', 'thôn Pa Pheng, xã Đăk Pxi, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 16h ngày 15/3/2026, tại đường Tỉnh lộ 677 thuộc thôn Pa Cheng xảy ra vụ va chạm giao thông giữa xe máy kéo nông nghiệp không có BKS do ông A Vương (Sn: 1979, trú tại: thôn Pa Cheng, xã Đăk Pxi, tỉnh Quảng Ngãi) điều khiển lưu thông theo hướng từ đường bê tông thôn Pa Cheng ra đường Tỉnh lộ 677 với xe mô tô (82B1-60146) lưu thông theo hướng tỉnh lộ 677 đi vào đường bê tông thôn Pa Cheng do Y Mai Phượng (31/3/2004) điều khiển chở theo Nguyễn Linh Đan (2017), Y Quỳnh Nhi (2023) cùng trú tại xã Đăk Pxi. Hậu quả: Nguyễn Linh Đan và Y Quỳnh Nhi tử vong.'),
(43, 'Tàng trữ trái phép chất ma tuý', '2026-03-19 00:00:00', 'CAP Kon Tum', 'thôn Kon Tum Kơ Pơng, phường Kon Tum, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 15 giờ 00 phút ngày 19/03/2026, Công an phường Kon Tum, tỉnh Quảng Ngãi tiến hành kiểm tra hành chính nhà Y Hiên (Sinh năm 2007, trú tại thôn Kon Tum Kơ Pơng, phường Kon Tum, tỉnh Quảng Ngãi) tại thôn Kon Tum Kơ Pơng, phường Kon Tum, tỉnh Quảng Ngãi, phát hiện tại phòng ngủ của Y Hiên có đối tượng Nguyễn Hữu Đan (Sinh năm 1996, Nơi thường trú: 381 Đào Duy Từ, phường Kon Tum, tỉnh Quảng Ngãi), là đối tượng đã có Quyết định Áp dụng biện pháp xử lý hành chính đưa vào cơ sở cai nghiện bắt buộc của Tòa án nhân dân khu vực 7, tỉnh Quảng Ngãi. Ngoài ra, kiểm tra trong phòng ngủ của Y Hiên phát hiện 01 (một) bì ni lông trong suốt được thắt nút một đầu, bên trong có chứa chất tinh thể rắn màu trắng (nghi là ma túy) trên nền nhà. Đối tượng Nguyễn Hữu Đan và Y Hiên không nhận 01 bì ni lông trong suốt được thắt nút một đầu, bên trong có chứa chất tinh thể rắn màu trắng (nghi là ma túy) trên là của mình'),
(44, 'Cháy', '2026-04-08 00:00:00', 'PC01', 'thôn Đăk Tiêng Klah, xã Đăk Hà, tỉnh Quảng Ngãi', NULL, 0, 'Vụ cháy nhà rông xảy ra ngày 07/04/2026 tại thôn Đăk Tiêng Klah, xã Đăk Hà, tỉnh Quảng Ngãi. Quá trình khám nghiệm ghi nhận vùng xuất phát cháy, than hóa; bộ phận đầu bật lửa; các đoạn dây kim loại; các mẫu cỏ khô (cỏ tranh lợp mái) bị cháy một phần.'),
(45, 'Tai nạn giao thông', '2026-04-09 00:00:00', 'PC01', 'thôn Virin, xã Măng Đen, tỉnh Quảng Ngãi.', NULL, 0, 'Khoảng 15 giờ 15 phút, ngày 08/4/2026, tại Km 23, Tỉnh lộ 676 thuộc địa phận thôn Virin, xã Măng Đen, tỉnh Quảng Ngãi xảy ra vụ Tai nạn giao thông giữa xe ô tô tải BKS 82C-043.58 đang thi công công trình nâng cấp tỉnh lộ 676 do Nguyễn Thế Phong (Sn1982; HKTT xã Sa Thầy, tỉnh Quảng Ngãi) điều khiển theo hướng từ xã Măng Đen đi xã Măng Bút, khi đến Km 23, tỉnh lộ 676 xe ô tô rẽ phải vào đường kỹ thuật của công trình nâng cấp tỉnh lộ 676 thì xảy ra va chạm với xe mô tô BKS 82LA-002.79 do A Mân (SN 1976; trú tại thôn Đắk Tăng, Măng Đen) điều khiển đi cùng chiều chở theo vợ phía sau là Y Khanh (sn 1975 trú cùng địa chỉ). Hậu quả về người: Y Khanh bị gãy dập cánh tay phải, được đưa đi cấp cứu tại Bệnh viện đa khoa Quảng Ngãi 2. Sau đó, đưa đi TPHCM điều trị nhưng khi đến địa phận tỉnh Bình Dương (cũ) thì chuyển biến xấu, được đưa vào Bệnh viện đa khoa Bình Dương để cấp cứu và tử vong tại đây, xe mô tô bị hư hỏng.'),
(46, 'Tai nạn giao thông', '2026-04-22 00:00:00', 'PC01', 'trước nhà khách 702, đường Phan Đình Phùng, phường Kon Tum, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 17:40 ngày 22/4/2026 cháu Nguyễn Ngọc Anh Thư (sinh năm 2013; trú tại phường Kon Tum, tỉnh Quảng Ngãi) điều khiển chở theo cháu Đặng Nguyễn Vân Anh (sinh năm 2015; trú tại tổ 8, phường Kon Tum, tỉnh Quảng Ngãi) lưu thông trên đường Phan đình Phùng hướng từ vòng xoay Duy Tân đi đến cầu Đăk Bla. Khi đến đoạn trước cổng nhà khách 702 thuộc Bộ chỉ huy Quân sự tỉnh Quảng Ngãi thì va chạm vào cánh cửa trước bên tài của xe ô tô bán tải BKS 82C-051.30 do A Mai Dương (Sn 26/10/1999; trú tại: xã Đăk tô, tỉnh Quảng Ngãi) đang mở cửa xe để đi ra ngoài (xe đang dừng). Hậu quả: cháu Đặng Nguyễn Vân Anh tử vong khi đang cấp cứu tại bệnh viện, cháu Nguyễn Ngọc Anh Thư bị thương được đưa đi cấp cứu tại Bệnh viện Đa khoa tỉnh Quảng Ngãi 2. 02 phương tiện hư hỏng'),
(47, 'Tai nạn giao thông', '2026-04-29 00:00:00', 'PC01', 'tại xã Kon Braih, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 18h 05 phút ngày 29/ 04/2026 tại km132+100 QL24 thuộc thôn 4 xã konbraih tỉnh quảng ngãi xảy ra vụ tai nạn giao thông giữa xe mô tô BKS: 82KA- 01378 do A Trong (SN: 2004 địa chỉ: thôn kon săm lũ, Xã KonBraih, tỉnh Quảng Ngãi ) điều khiển chở theo A Hậu sn: 2005 trú tại thôn kon xăm lũ, xã Konbraih, tỉnh Quảng Ngãi lưu thông theo hướng xã Măng đen đi xã Konbraih sau đó va chạm với xe ba gác ( không có biển số ) đậu cùng chiều di chuyển với xe mô tô, cùng thời điểm va chạm xe ô tô khách BKS 82H_ 00444 do anh Nguyễn Hoàng Bảo (sinh năm 1978, địa chỉ : 04 lê hoàng phường kon tum tỉnh quảng ngãi) điều khiển lưu thông theo hướng ngược lại, tránh xe mô tô BKS: 82KA _01378, sau đó va chạm với xe ô tô con BKS 76A-39809 đang dừng đỗ bên phải theo hướng xã konbraih đi xã măng đen. Hậu quả về người : a Trong tử vong; A Hậu bị đa chấn thương phương tiện ; về phương tiện : 02 xe ô tô hư hỏng, 01 xe mô tô và xe ba gác hư hỏng.'),
(48, 'Tai nạn giao thông', '2026-05-02 00:00:00', 'PC01', 'Km 1535+900 Đường Hồ Chí Minh đoạn qua Thôn Đăk La 3, xã Đăk Hà, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 14 giờ 05 phút, ngày 02/05/2026 tại Km 1535+900 Đường Hồ Chí Minh đoạn qua Thôn Đăk La 3, xã Đăk Hà, tỉnh Quảng Ngãi xảy ra vụ tai nạn giao thông giữa xe ô tô khách giường nằm (24 chỗ) BKS: 36H-089.05 do Võ Cơ Thạch (Sn: 1981; HKTT: xã Triệu Sơn, tỉnh Thanh Hóa) điều khiển lưu thông trên đường Hồ Chí Minh hướng phường Kon Tum đi xã Đăk Hà với xe mô tô BKS: 76AA-684.13 do A Hoàng (Sn: 13/02/1988) điều khiển chở theo vợ là Y Xân (Sn:01/01/1989) và con A Hợp (Sn: 2021) cùng trú tại Thôn Kon Rngân, xã Đăk Ui, tỉnh Quảng Ngãi lưu thông cùng chiều phía bên phải. Hậu quả: Về người: Y Xân được đưa đi cấp cứu tại Bệnh viện Đa khoa tỉnh Quảng Ngãi 2 thì tử vong. Về tài sản: 01 xe mô tô hư hỏng nặng ước tính thiệt hại khoảng 01 triệu đồng'),
(49, 'Chết chưa rõ nguyên nhân', '2026-05-11 00:00:00', 'PC02', 'xã Sa Loong, tỉnh Quảng Ngãi', NULL, 0, 'Khoảng 14 giờ ngày 11/5/2026, ông Nguyễn Sỹ Trọng Phong (Sn: 1995, trú tại: TDP2, xã Bờ Y, QN) đi làm rẫy phát hiện thi thể nam giới đã chết tại khu vực rẫy cao su thuộc thôn Giang Lố 1, xã Sa Loong, tỉnh Quảng Ngãi. Nạn nhân được xác định là A Tạo (Sn: 01/01/1995, HKTT: xã Măng Ri, tỉnh Quảng Ngãi) là người làm thuê cho ông Nguyễn Trung Kiên ở thôn Giang Lố 1, xã Sa Loong, tỉnh Quảng Ngãi. Vị trí nạn nhân chết cách vị trí khu vực rẫy thường làm 2Km'),
(50, 'Tai nạn giao thông', '2026-05-16 00:00:00', 'PC01', 'xã Ia Tơi, tỉnh Quảng Ngãi', NULL, 0, 'Vào khoảng 00 giờ 10 phút ngày 16/05/2026 ông Nguyễn Văn Thuận (Sinh năm 2001; trú tại thôn Ia Đơr, xã Ia Tơi, tỉnh Quảng Ngãi) điều khiển xe mô tô hai bánh BKS 81L1 - 070.95 chở theo Tơ Đức Nghĩa (Sinh năm 2010; trú tại thôn Ia Đơr, xã Ia Tơi, tỉnh Quảng Ngãi) và chị Y Khuya (Sinh năm 2010; trú tại thôn Ia Đơr, xã Ia Tơi, tỉnh Quảng Ngãi) đi trên Tỉnh lộ 675A theo hướng từ thôn Ia Đơr đến xã Ia Tơi, tỉnh Quảng Ngãi đến đoạn Km 42 + 305 Tỉnh lộ 675A thuộc Điểm dân cư 66 thôn Ia Đơr, xã Ia Tơi, tỉnh Quảng Ngãi thì mất lái, tự va chạm vào cọc tiêu bê tông bên trái đường. Hậu quả Tơ Đức Nghĩa chết trên đường đi cấp cứu , Nguyễn Văn Thuận bị thương đi cấp cứu tại bệnh viện 211 tỉnh Gia Lai; Y Khuya bị thương được đưa đi cấp cứu tại bệnh viện Đa Khoa tỉnh Quảng Ngãi cơ sở 2. Hậu quả: Về người: Tơ Đức Nghĩa chết trên đường đi cấp cứu; Nguyễn Văn Thuận bị thương đi cấp cứu tại bệnh viện 211 tỉnh Gia Lai; Y Khuya bị thương được đưa đi cấp cứu tại bệnh viện Đa Khoa tỉnh Quảng Ngãi cơ sở 2. Về tài sản: 01 mô tô bị hư hưởng, thiệt hại tài sản ước tính 02 triệu đồng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsu_hd`
--

CREATE TABLE `lichsu_hd` (
  `ID` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `DangNhap_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_truc`
--

CREATE TABLE `lich_truc` (
  `ID` int(11) NOT NULL,
  `TuNgay` varchar(255) NOT NULL,
  `DenNgay` varchar(255) NOT NULL,
  `LoaiTruc` varchar(255) NOT NULL,
  `NgayCapNhat` datetime NOT NULL,
  `Truc_LD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_cv`
--

CREATE TABLE `loai_cv` (
  `ID` int(11) NOT NULL,
  `TenLoai` varchar(255) NOT NULL,
  `GhiChu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_vuviec`
--

CREATE TABLE `loai_vuviec` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `GhiChu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_vuviec`
--

INSERT INTO `loai_vuviec` (`ID`, `Ten`, `GhiChu`) VALUES
(1, 'Kỹ thuật số - điện tử', 'GĐ'),
(3, 'Ma tuý', 'GĐ'),
(4, 'Dấu vết cơ học', 'GĐ'),
(5, 'Âm thanh', 'GĐ'),
(6, 'Dấu vết cơ học', 'GĐ'),
(7, 'Pháp y tử thi', 'GĐ'),
(8, 'Vũ khí', 'GĐ'),
(9, 'Tài liệu', 'GĐ'),
(10, 'Dấu vết đường vân', 'Giám định'),
(11, 'Sinh học', 'Giám định');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luong`
--

CREATE TABLE `luong` (
  `ID` int(11) NOT NULL,
  `Nam` varchar(255) NOT NULL,
  `MoTa` varchar(255) NOT NULL,
  `NgayCapNhat` datetime NOT NULL,
  `CanBo_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_02_28_062607_create_can_bo_table', 1),
(3, '2022_02_28_063455_create_doi_table', 1),
(4, '2022_02_28_063728_create_trinh_do_table', 1),
(5, '2022_02_28_064235_create_luong_table', 1),
(6, '2022_02_28_064407_create_lich_truc_table', 1),
(7, '2022_02_28_064932_create_ct_lichtruc_table', 1),
(8, '2022_02_28_065151_create_cham_cong_table', 1),
(9, '2022_02_28_065650_create_vu_viec_table', 1),
(10, '2022_02_28_070134_create_phu_trach_table', 1),
(11, '2022_02_28_070331_create_cong_van_table', 1),
(12, '2022_02_28_070516_create_dang_nhap_table', 1),
(13, '2022_02_28_070651_create_quyen_dn_table', 1),
(14, '2022_02_28_070812_create_lichsu_hd_table', 1),
(15, '2022_03_28_081632_create_loai_cv_table', 1),
(16, '2022_06_30_015608_create_loai_vuviec_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phu_trach`
--

CREATE TABLE `phu_trach` (
  `ID` int(11) NOT NULL,
  `NgayHT` datetime DEFAULT NULL,
  `VuViec_ID` int(11) DEFAULT NULL,
  `KNHT_ID` int(11) DEFAULT NULL,
  `CanBo_ID` int(11) NOT NULL,
  `ChucDanh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen_dn`
--

CREATE TABLE `quyen_dn` (
  `ID` int(11) NOT NULL,
  `Ten_Quyen` varchar(255) NOT NULL,
  `MoTa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `su_kien`
--

CREATE TABLE `su_kien` (
  `ID` int(11) NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `TuNgay` datetime NOT NULL,
  `DenNgay` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `su_kien`
--

INSERT INTO `su_kien` (`ID`, `NoiDung`, `TuNgay`, `DenNgay`) VALUES
(1, 'Đại hội Đảng bộ KTHS lần I', '2025-07-10 00:00:00', '2025-07-11 00:00:00'),
(2, 'Sáp nhập tỉnh Quảng Ngãi - Kon Tum làm 1', '2025-07-01 00:00:00', '2025-07-01 00:00:00'),
(3, 'Đại hội chi đoàn KTHS', '2025-10-09 00:00:00', '2025-10-09 00:00:00'),
(4, 'Giao ban tháng 4', '2026-04-15 00:00:00', '2026-04-16 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trinh_do`
--

CREATE TABLE `trinh_do` (
  `ID` int(11) NOT NULL,
  `NghiepVu_CA` varchar(255) DEFAULT NULL,
  `TN_NganhNgoai` varchar(255) DEFAULT NULL,
  `LyLuan_CT` varchar(255) DEFAULT NULL,
  `NgoaiNgu` varchar(255) DEFAULT NULL,
  `TinHoc` varchar(255) DEFAULT NULL,
  `NgayCapNhat` datetime NOT NULL,
  `CanBo_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `trinh_do`
--

INSERT INTO `trinh_do` (`ID`, `NghiepVu_CA`, `TN_NganhNgoai`, `LyLuan_CT`, `NgoaiNgu`, `TinHoc`, `NgayCapNhat`, `CanBo_ID`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, '2026-04-07 10:11:29', 2),
(2, NULL, NULL, NULL, NULL, NULL, '2025-09-11 09:16:19', 3),
(3, NULL, NULL, NULL, NULL, NULL, '2024-06-11 09:51:13', 4),
(4, NULL, NULL, NULL, NULL, NULL, '2025-09-10 15:53:22', 5),
(5, NULL, NULL, NULL, NULL, NULL, '2025-09-10 15:47:33', 6),
(6, NULL, NULL, NULL, NULL, NULL, '2025-09-10 15:51:26', 7),
(7, NULL, NULL, NULL, NULL, NULL, '2024-06-11 09:58:59', 8),
(8, NULL, NULL, NULL, NULL, NULL, '2025-09-10 15:50:18', 9),
(9, NULL, NULL, NULL, NULL, NULL, '2025-09-10 15:53:59', 10),
(10, NULL, NULL, NULL, NULL, NULL, '2026-04-07 09:52:08', 11),
(11, NULL, NULL, NULL, NULL, NULL, '2025-09-11 09:20:11', 12),
(12, NULL, NULL, NULL, NULL, NULL, '2024-12-12 14:52:34', 13),
(13, NULL, NULL, NULL, NULL, NULL, '2025-09-10 15:51:59', 14),
(14, NULL, NULL, NULL, NULL, NULL, '2025-09-11 09:50:06', 15),
(15, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:57:26', 16),
(16, NULL, NULL, NULL, NULL, NULL, '2026-04-05 16:00:34', 17),
(17, NULL, NULL, NULL, NULL, NULL, '2026-04-05 16:01:28', 18),
(20, NULL, NULL, NULL, NULL, NULL, '2026-04-07 09:39:11', 21),
(21, NULL, NULL, NULL, NULL, NULL, '2026-04-07 09:52:54', 22),
(22, NULL, NULL, NULL, NULL, NULL, '2026-04-07 09:53:50', 23),
(23, NULL, NULL, NULL, NULL, NULL, '2026-04-07 09:55:15', 24),
(24, NULL, NULL, NULL, NULL, NULL, '2026-05-19 15:08:42', 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vu_viec`
--

CREATE TABLE `vu_viec` (
  `ID` int(11) NOT NULL,
  `TenVuViec` varchar(255) NOT NULL,
  `SoCV` varchar(255) DEFAULT NULL,
  `NgayTC` datetime DEFAULT NULL,
  `DonVi_TC` varchar(255) NOT NULL,
  `SoYC` int(11) DEFAULT NULL,
  `SoHoSo` varchar(255) DEFAULT NULL,
  `NgayTiepNhan` datetime NOT NULL,
  `CanBo_ID` int(11) DEFAULT NULL,
  `LanhDao_ID` int(11) DEFAULT NULL,
  `NgayGD` datetime DEFAULT NULL,
  `NgayKT` datetime DEFAULT NULL,
  `GiamDinh` varchar(255) DEFAULT NULL,
  `LoaiVuViec_ID` int(11) DEFAULT NULL,
  `DonVi_ID` int(11) DEFAULT NULL,
  `NoiDung` varchar(255) DEFAULT NULL,
  `ThoiGian` varchar(255) DEFAULT NULL,
  `DiaDiem` varchar(255) DEFAULT NULL,
  `ThoiHan_GD` varchar(255) DEFAULT NULL,
  `ThanhToan` tinyint(1) NOT NULL DEFAULT 0,
  `TrangThai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `can_bo`
--
ALTER TABLE `can_bo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `can_bo_doi_id_foreign` (`Doi_ID`);

--
-- Chỉ mục cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cham_cong_canbo_id_foreign` (`CanBo_ID`);

--
-- Chỉ mục cho bảng `cong_van`
--
ALTER TABLE `cong_van`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cong_van_canbo_id_foreign` (`CanBo_ID`),
  ADD KEY `cong_van_loaicv_id_foreign` (`LoaiCV_ID`);

--
-- Chỉ mục cho bảng `ct_lichtruc`
--
ALTER TABLE `ct_lichtruc`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ct_lichtruc_lichtruc_id_foreign` (`LichTruc_ID`),
  ADD KEY `ct_lichtruc_canbo_id_foreign` (`CanBo_ID`);

--
-- Chỉ mục cho bảng `dang_nhap`
--
ALTER TABLE `dang_nhap`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dang_nhap_canbo_id_foreign` (`CanBo_ID`),
  ADD KEY `dang_nhap_quyen_id_foreign` (`Quyen_ID`);

--
-- Chỉ mục cho bảng `doi`
--
ALTER TABLE `doi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `doi_doi_truong_foreign` (`Doi_Truong`),
  ADD KEY `doi_doi_pho_foreign` (`Doi_Pho`);

--
-- Chỉ mục cho bảng `donvi_tc`
--
ALTER TABLE `donvi_tc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `knht`
--
ALTER TABLE `knht`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_donvitc_id_knht` (`DonVi_ID`);

--
-- Chỉ mục cho bảng `lichsu_hd`
--
ALTER TABLE `lichsu_hd`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lichsu_hd_dangnhap_id_foreign` (`DangNhap_ID`);

--
-- Chỉ mục cho bảng `lich_truc`
--
ALTER TABLE `lich_truc`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lich_truc_truc_ld_foreign` (`Truc_LD`);

--
-- Chỉ mục cho bảng `loai_cv`
--
ALTER TABLE `loai_cv`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `loai_vuviec`
--
ALTER TABLE `loai_vuviec`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `luong_canbo_id_foreign` (`CanBo_ID`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phu_trach`
--
ALTER TABLE `phu_trach`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `phu_trach_vuviec_id_foreign` (`VuViec_ID`),
  ADD KEY `phu_trach_canbo_id_foreign` (`CanBo_ID`),
  ADD KEY `fk_pt_id_knht` (`KNHT_ID`);

--
-- Chỉ mục cho bảng `quyen_dn`
--
ALTER TABLE `quyen_dn`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `su_kien`
--
ALTER TABLE `su_kien`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `trinh_do`
--
ALTER TABLE `trinh_do`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `trinh_do_canbo_id_foreign` (`CanBo_ID`);

--
-- Chỉ mục cho bảng `vu_viec`
--
ALTER TABLE `vu_viec`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `vu_viec_canbo_id_foreign` (`CanBo_ID`),
  ADD KEY `vu_viec_lanhdao_id_foreign` (`LanhDao_ID`),
  ADD KEY `vu_viec_loaivuviec_id_foreign` (`LoaiVuViec_ID`),
  ADD KEY `fk_vuviec_donvi` (`DonVi_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `can_bo`
--
ALTER TABLE `can_bo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `cong_van`
--
ALTER TABLE `cong_van`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ct_lichtruc`
--
ALTER TABLE `ct_lichtruc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dang_nhap`
--
ALTER TABLE `dang_nhap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `doi`
--
ALTER TABLE `doi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `donvi_tc`
--
ALTER TABLE `donvi_tc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `knht`
--
ALTER TABLE `knht`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `lichsu_hd`
--
ALTER TABLE `lichsu_hd`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_truc`
--
ALTER TABLE `lich_truc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_cv`
--
ALTER TABLE `loai_cv`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_vuviec`
--
ALTER TABLE `loai_vuviec`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `luong`
--
ALTER TABLE `luong`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phu_trach`
--
ALTER TABLE `phu_trach`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=716;

--
-- AUTO_INCREMENT cho bảng `quyen_dn`
--
ALTER TABLE `quyen_dn`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `su_kien`
--
ALTER TABLE `su_kien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `trinh_do`
--
ALTER TABLE `trinh_do`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `vu_viec`
--
ALTER TABLE `vu_viec`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `can_bo`
--
ALTER TABLE `can_bo`
  ADD CONSTRAINT `can_bo_doi_id_foreign` FOREIGN KEY (`Doi_ID`) REFERENCES `doi` (`ID`);

--
-- Các ràng buộc cho bảng `cham_cong`
--
ALTER TABLE `cham_cong`
  ADD CONSTRAINT `cham_cong_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`);

--
-- Các ràng buộc cho bảng `cong_van`
--
ALTER TABLE `cong_van`
  ADD CONSTRAINT `cong_van_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `cong_van_loaicv_id_foreign` FOREIGN KEY (`LoaiCV_ID`) REFERENCES `loai_cv` (`ID`);

--
-- Các ràng buộc cho bảng `ct_lichtruc`
--
ALTER TABLE `ct_lichtruc`
  ADD CONSTRAINT `ct_lichtruc_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `ct_lichtruc_lichtruc_id_foreign` FOREIGN KEY (`LichTruc_ID`) REFERENCES `lich_truc` (`ID`);

--
-- Các ràng buộc cho bảng `dang_nhap`
--
ALTER TABLE `dang_nhap`
  ADD CONSTRAINT `dang_nhap_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `dang_nhap_quyen_id_foreign` FOREIGN KEY (`Quyen_ID`) REFERENCES `quyen_dn` (`ID`);

--
-- Các ràng buộc cho bảng `doi`
--
ALTER TABLE `doi`
  ADD CONSTRAINT `doi_doi_pho_foreign` FOREIGN KEY (`Doi_Pho`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `doi_doi_truong_foreign` FOREIGN KEY (`Doi_Truong`) REFERENCES `can_bo` (`ID`);

--
-- Các ràng buộc cho bảng `knht`
--
ALTER TABLE `knht`
  ADD CONSTRAINT `fk_donvitc_id_knht` FOREIGN KEY (`DonVi_ID`) REFERENCES `donvi_tc` (`ID`);

--
-- Các ràng buộc cho bảng `lichsu_hd`
--
ALTER TABLE `lichsu_hd`
  ADD CONSTRAINT `lichsu_hd_dangnhap_id_foreign` FOREIGN KEY (`DangNhap_ID`) REFERENCES `dang_nhap` (`ID`);

--
-- Các ràng buộc cho bảng `lich_truc`
--
ALTER TABLE `lich_truc`
  ADD CONSTRAINT `lich_truc_truc_ld_foreign` FOREIGN KEY (`Truc_LD`) REFERENCES `can_bo` (`ID`);

--
-- Các ràng buộc cho bảng `luong`
--
ALTER TABLE `luong`
  ADD CONSTRAINT `luong_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`);

--
-- Các ràng buộc cho bảng `phu_trach`
--
ALTER TABLE `phu_trach`
  ADD CONSTRAINT `fk_pt_id_knht` FOREIGN KEY (`KNHT_ID`) REFERENCES `knht` (`ID`),
  ADD CONSTRAINT `phu_trach_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `phu_trach_vuviec_id_foreign` FOREIGN KEY (`VuViec_ID`) REFERENCES `vu_viec` (`ID`);

--
-- Các ràng buộc cho bảng `trinh_do`
--
ALTER TABLE `trinh_do`
  ADD CONSTRAINT `trinh_do_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`);

--
-- Các ràng buộc cho bảng `vu_viec`
--
ALTER TABLE `vu_viec`
  ADD CONSTRAINT `fk_vuviec_donvi` FOREIGN KEY (`DonVi_ID`) REFERENCES `donvi_tc` (`ID`),
  ADD CONSTRAINT `vu_viec_canbo_id_foreign` FOREIGN KEY (`CanBo_ID`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `vu_viec_lanhdao_id_foreign` FOREIGN KEY (`LanhDao_ID`) REFERENCES `can_bo` (`ID`),
  ADD CONSTRAINT `vu_viec_loaivuviec_id_foreign` FOREIGN KEY (`LoaiVuViec_ID`) REFERENCES `loai_vuviec` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
