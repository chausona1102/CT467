Create database ct467_database;
use ct467_database;

-- Lưu tài khoản quản trị viên
CREATE TABLE `account` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 1. Bảng Loại Phòng
CREATE TABLE LoaiPhong (
    MaLoaiPhong VARCHAR(10) PRIMARY KEY,
    TenLoaiPhong NVARCHAR(50),
    GiaThue DECIMAL(10,2)
);

-- 2. Bảng Phòng
CREATE TABLE Phong (
    MaPhong VARCHAR(10) PRIMARY KEY,
    MaLoaiPhong VARCHAR(10),
    SoPhong INT,
    GioiTinh varchar(5),
    SoLuongToiDa INT,
    SoLuongHienTai INT,
    TinhTrang NVARCHAR(10) CHECK (TinhTrang IN (1, 0)), -- 1: Trống, 0: Đầy
    FOREIGN KEY (MaLoaiPhong) REFERENCES LoaiPhong(MaLoaiPhong)
);

-- 3. Bảng Sinh Viên
CREATE TABLE SinhVien (
    MaSV VARCHAR(10) PRIMARY KEY,
    HoTen VARCHAR(100),
    GioiTinh VARCHAR(5),
    SoDienThoai VARCHAR(15)
);

-- 4. Bảng Hợp Đồng
CREATE TABLE HopDong (
    MaHD VARCHAR(10) PRIMARY KEY,
    MaSV VARCHAR(10),
    MaPhong VARCHAR(10),
    NgayBatDau DATE,
    NgayKetThuc DATE,
    FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
    FOREIGN KEY (MaPhong) REFERENCES Phong(MaPhong)
);

-- 5. Bảng Dịch Vụ
CREATE TABLE DichVu (
    MaDV VARCHAR(10) PRIMARY KEY,
    TenDV NVARCHAR(100),
    DonGia DECIMAL(10,2)
);

-- 6. Bảng Sử Dụng Dịch Vụ
CREATE TABLE SuDungDV (
    MaSDDV VARCHAR(10) PRIMARY KEY,
    MaHD VARCHAR(10),
    MaDV VARCHAR(10),
    SoLuongSuDung INT,
    Thang INT CHECK (Thang BETWEEN 1 AND 12),
    Nam INT,
    FOREIGN KEY (MaHD) REFERENCES HopDong(MaHD),
    FOREIGN KEY (MaDV) REFERENCES DichVu(MaDV)
);

-- 7. Bảng Hóa Đơn
CREATE TABLE HoaDon (
    MaHoaDon VARCHAR(10) PRIMARY KEY,
    MaSDDV VARCHAR(10),
    NgayLap DATE,
    NgayHetHan DATE,
    TongTien DECIMAL(12,2),
    TrangThai NVARCHAR(10) CHECK (TinhTrang IN (0, 1)), -- 0: Chưa thanh toán, 1: Đã tnet hanh toán
    FOREIGN KEY (MaSDDV) REFERENCES SuDungDV(MaSDDV)
);

-- Kiem tra sinh vien
DELIMITER //

CREATE FUNCTION KiemTraQuaHan(MaSinhVien VARCHAR(10))
RETURNS BOOLEAN
DETERMINISTIC
BEGIN
    DECLARE NgayKetThuc DATE;

    SELECT NgayKetThuc INTO NgayKetThuc
    FROM HopDong
    WHERE MaSV = MaSinhVien
    ORDER BY NgayKetThuc DESC
    LIMIT 1;

    IF NgayKetThuc < CURDATE() THEN
        RETURN 1; -- quá hạn
    ELSE
        RETURN 0; -- còn hạn
    END IF;
END;
//

DELIMITER ;

-- không cho thêm sinh viên vào phòng nếu đã đầy
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
END;
//

DELIMITER ;

-- Liệt kê danh sách sinh viên trong 1 phòng
DELIMITER //

CREATE PROCEDURE DanhSachSVTrongPhong(IN ma_phong VARCHAR(10))
BEGIN
    SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.SoDienThoai
    FROM SinhVien sv
    JOIN HopDong hd ON sv.MaSV = hd.MaSV
    WHERE hd.MaPhong = ma_phong
      AND CURDATE() BETWEEN hd.NgayBatDau AND hd.NgayKetThuc;
END;
//

DELIMITER ;

-- Doanh thu hóa đơn theo tháng và trạng thái
SELECT
    MONTH(NgayLap) AS Thang,
    YEAR(NgayLap) AS Nam,
    TrangThai,
    SUM(TongTien) AS TongDoanhThu
FROM HoaDon
GROUP BY Thang, Nam, TrangThai
ORDER BY Nam DESC, Thang DESC;
