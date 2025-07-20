-- Tạo database
CREATE DATABASE IF NOT EXISTS ct467_database;
USE ct467_database;

-- Đặt chế độ cho phép CHECK hoạt động
SET sql_mode = '';

-- 1. Bảng account
CREATE TABLE IF NOT EXISTS account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type_account ENUM('admin', 'guest') DEFAULT 'guest',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Bảng Loại Phòng
CREATE TABLE IF NOT EXISTS LoaiPhong (
    MaLoaiPhong VARCHAR(10) PRIMARY KEY,
    TenLoaiPhong VARCHAR(50),
    GiaThue DECIMAL(10,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Bảng Phòng
CREATE TABLE IF NOT EXISTS Phong (
    MaPhong VARCHAR(10) PRIMARY KEY,
    MaLoaiPhong VARCHAR(10),
    SoPhong INT,
    GioiTinh VARCHAR(5),
    SoLuongToiDa INT,
    SoLuongHienTai INT DEFAULT 0,
    TinhTrang TINYINT(1) CHECK (TinhTrang IN (1, 0)), -- 1: Trống, 0: Đầy
    FOREIGN KEY (MaLoaiPhong) REFERENCES LoaiPhong(MaLoaiPhong)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Bảng Sinh Viên
CREATE TABLE IF NOT EXISTS SinhVien (
    MaSV VARCHAR(10) PRIMARY KEY,
    HoTen VARCHAR(100),
    GioiTinh VARCHAR(5),
    SoDienThoai VARCHAR(15)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Bảng Hợp Đồng
CREATE TABLE IF NOT EXISTS HopDong (
    MaHD VARCHAR(10) PRIMARY KEY,
    MaSV VARCHAR(10),
    MaPhong VARCHAR(10),
    NgayBatDau DATE,
    NgayKetThuc DATE,
    FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
    FOREIGN KEY (MaPhong) REFERENCES Phong(MaPhong)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Bảng Dịch Vụ
CREATE TABLE IF NOT EXISTS DichVu (
    MaDV VARCHAR(10) PRIMARY KEY,
    TenDV VARCHAR(100),
    DonGia DECIMAL(10,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Bảng Sử Dụng Dịch Vụ
CREATE TABLE IF NOT EXISTS SuDungDV (
    MaSDDV VARCHAR(10) PRIMARY KEY,
    MaHD VARCHAR(10),
    MaDV VARCHAR(10),
    SoLuongSuDung INT,
    Thang INT CHECK (Thang BETWEEN 1 AND 12),
    Nam INT,
    FOREIGN KEY (MaHD) REFERENCES HopDong(MaHD),
    FOREIGN KEY (MaDV) REFERENCES DichVu(MaDV)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Bảng Hóa Đơn
CREATE TABLE IF NOT EXISTS HoaDon (
    MaHoaDon VARCHAR(10) PRIMARY KEY,
    MaSDDV VARCHAR(10),
    NgayLap DATE,
    NgayHetHan DATE,
    TongTien DECIMAL(12,2),
    TrangThai TINYINT(1) CHECK (TrangThai IN (0, 1)), -- 0: Chưa thanh toán, 1: Đã thanh toán
    FOREIGN KEY (MaSDDV) REFERENCES SuDungDV(MaSDDV)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================
-- Tạo FUNCTION kiểm tra quá hạn
-- =========================
DROP FUNCTION IF EXISTS KiemTraQuaHan;

DELIMITER //
CREATE FUNCTION KiemTraQuaHan(MaSinhVien VARCHAR(10))
RETURNS TINYINT(1)
DETERMINISTIC
BEGIN
    DECLARE NgayKetThuc DATE;

    SELECT NgayKetThuc INTO NgayKetThuc
    FROM HopDong
    WHERE MaSV = MaSinhVien
    ORDER BY NgayKetThuc DESC
    LIMIT 1;

    IF NgayKetThuc IS NULL THEN
        RETURN 0;
    END IF;

    IF NgayKetThuc < CURDATE() THEN
        RETURN 1; -- quá hạn
    ELSE
        RETURN 0; -- còn hạn
    END IF;
END//
DELIMITER ;

-- =========================
-- Tạo TRIGGER kiểm tra phòng đầy
-- =========================
DROP TRIGGER IF EXISTS KiemTraPhongTruocKhiThem;

DELIMITER //
CREATE TRIGGER KiemTraPhongTruocKhiThem
BEFORE INSERT ON HopDong
FOR EACH ROW
BEGIN
    DECLARE SoLuongHienTai INT;
    DECLARE SoLuongToiDa INT;

    SELECT COUNT(*) INTO SoLuongHienTai
    FROM HopDong
    WHERE MaPhong = NEW.MaPhong AND CURDATE() BETWEEN NgayBatDau AND NgayKetThuc;

    SELECT SoLuongToiDa INTO SoLuongToiDa
    FROM Phong
    WHERE MaPhong = NEW.MaPhong;

    IF SoLuongHienTai >= SoLuongToiDa THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Phòng đã đầy, không thể thêm sinh viên.';
    END IF;
END//
DELIMITER ;

-- =========================
-- Tạo PROCEDURE danh sách SV
-- =========================
DROP PROCEDURE IF EXISTS DanhSachSVTrongPhong;

DELIMITER //
CREATE PROCEDURE DanhSachSVTrongPhong(IN ma_phong VARCHAR(10))
BEGIN
    SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.SoDienThoai
    FROM SinhVien sv
    JOIN HopDong hd ON sv.MaSV = hd.MaSV
    WHERE hd.MaPhong = ma_phong
      AND CURDATE() BETWEEN hd.NgayBatDau AND hd.NgayKetThuc;
END//
DELIMITER ;

-- =========================
-- Truy vấn thống kê doanh thu
-- =========================
-- (Viết dưới dạng view hoặc truy vấn trực tiếp)
CREATE OR REPLACE VIEW ThongKeDoanhThu AS
SELECT
    MONTH(NgayLap) AS Thang,
    YEAR(NgayLap) AS Nam,
    CASE TrangThai
        WHEN 0 THEN 'Chưa thanh toán'
        WHEN 1 THEN 'Đã thanh toán'
    END AS TrangThai,
    SUM(TongTien) AS TongDoanhThu
FROM HoaDon
GROUP BY Nam, Thang, TrangThai;