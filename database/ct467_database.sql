-- Tạo database
CREATE DATABASE IF NOT EXISTS ct467_database;
USE ct467_database;

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
        ON DELETE CASCADE ON UPDATE CASCADE
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
    FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (MaPhong) REFERENCES Phong(MaPhong)
        ON DELETE CASCADE ON UPDATE CASCADE
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
    FOREIGN KEY (MaHD) REFERENCES HopDong(MaHD)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (MaDV) REFERENCES DichVu(MaDV)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Bảng Hóa Đơn
CREATE TABLE IF NOT EXISTS HoaDon (
    MaHoaDon VARCHAR(10) PRIMARY KEY,
    MaSDDV VARCHAR(10),
    NgayLap DATE,
    NgayHetHan DATE,
    TongTien DECIMAL(12,2),
    TrangThai ENUM('1', '0') DEFAULT '0', -- 1:  Đã thanh toán, 0: Chưa thanh toán
    FOREIGN KEY (MaSDDV) REFERENCES SuDungDV(MaSDDV)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================
-- Tạo FUNCTION kiểm tra quá hạn
-- =========================
DELIMITER $$
CREATE FUNCTION KiemTraQuaHan(maSV_input VARCHAR(10))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE hanCuoi DATE;

    -- Lấy ngày kết thúc hợp đồng mới nhất của sinh viên
    SELECT MAX(NgayKetThuc) INTO hanCuoi
    FROM HopDong
    WHERE MaSV = maSV_input;

    -- Nếu chưa có hợp đồng, coi như không quá hạn
    IF hanCuoi IS NULL THEN
        RETURN 0;
    END IF;

    -- So sánh với ngày hiện tại
    IF hanCuoi < CURDATE() THEN
        RETURN 1; -- Quá hạn
    ELSE
        RETURN 0; -- Chưa quá hạn
    END IF;
END$$
DELIMITER ;



-- Tạo PROCEDURE danh sách SV
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

-- Procedure insert LoaiPhong 
DELIMITER //

CREATE PROCEDURE ThemLoaiPhong(
    IN ma_loai VARCHAR(10),
    IN ten_loai VARCHAR(50),
    IN gia DECIMAL(10, 2)
)
BEGIN
    INSERT INTO loaiphong (MaLoaiPhong, TenLoaiPhong, GiaThue)
    VALUES (ma_loai, ten_loai, gia);
END//

DELIMITER ;

-- Procedure del row
DELIMITER //

CREATE PROCEDURE XoaLoaiPhong(
    IN ma_loai VARCHAR(10)
)
BEGIN
    DELETE FROM loaiphong
    WHERE MaLoaiPhong = ma_loai;
END//
DELIMITER ;

DELIMITER //

CREATE PROCEDURE ThemPhong(
    IN ma_phong VARCHAR(10),
    IN ma_loai_phong varchar(10),
    IN so_phong int,
    IN gioi_tinh varchar(5),
    IN so_luong_toi_da int,
    IN so_luong_hien_tai int,
    In tinh_trang tinyint
)
BEGIN
    INSERT INTO Phong(MaPhong, MaLoaiPhong, SoPhong, GioiTinh, SoLuongToiDa, SoLuongHienTai, TinhTrang)
    VALUES (ma_phong, ma_loai_phong, so_phong, gioi_tinh, so_luong_toi_da, so_luong_hien_tai, tinh_trang);
END//
DELIMITER ;


-- PROCEDURE INSERT INTO SINHVIEN 
DELIMITER //
CREATE PROCEDURE ThemSinhVien(
		IN ma_sv varchar(10),
        IN ho_ten varchar(100),
        IN gioi_tinh varchar(5),
        IN sdt varchar(15)
)
BEGIN
	INSERT INTO SinhVien(MaSV,HoTen,GioiTinh,SoDienThoai)
    VALUES(ma_sv, ho_ten, gioi_tinh, sdt);
END
//
DELIMITER ;

-- Procedure del row
DELIMITER //

CREATE PROCEDURE XoaSinhVien(
    IN ma_sv VARCHAR(10)
)
BEGIN
    DELETE FROM SinhVien
    WHERE MaSV like ma_sv;
END//
DELIMITER ;



-- Procedure edit row
DELIMITER //
CREATE PROCEDURE CapNhatSinhVien(
		IN old_ma varchar(10),
		IN ma_sv varchar(10),
        IN ho_ten varchar(100),
        IN gioi_tinh varchar(5),
        IN sdt varchar(15)
)
BEGIN
	UPDATE SinhVien
    SET MaSV = ma_sv, HoTen = ho_ten, GioiTinh = gioi_tinh, SoDienThoai = sdt
    WHERE MaSV = old_ma;
END
//
DELIMITER ; 

DELIMITER $$
CREATE TRIGGER tinh_tong_tien_dich_vu
BEFORE INSERT ON HoaDon
FOR EACH ROW
BEGIN
    DECLARE soLuong INT;
    DECLARE donGia DECIMAL(10,2);

    -- Lấy số lượng dịch vụ và đơn giá từ MaSDDV được chọn
    SELECT sd.SoLuongSuDung, dv.DonGia
    INTO soLuong, donGia
    FROM SuDungDV sd
    JOIN DichVu dv ON sd.MaDV = dv.MaDV
    WHERE sd.MaSDDV = NEW.MaSDDV;

    -- Gán tổng tiền = số lượng * đơn giá
    SET NEW.TongTien = (soLuong * donGia);
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER cap_nhat_tong_tien
AFTER UPDATE ON SuDungDV
FOR EACH ROW
BEGIN
    DECLARE soLuong INT;
    DECLARE donGia DECIMAL(10,2);

    -- Lấy lại số lượng và đơn giá mới
    SELECT SoLuongSuDung, dv.DonGia
    INTO soLuong, donGia
    FROM SuDungDV sd
    JOIN DichVu dv ON sd.MaDV = dv.MaDV
    WHERE sd.MaSDDV = NEW.MaSDDV;

    -- Cập nhật tổng tiền trong bảng HoaDon
    UPDATE HoaDon
    SET TongTien = soLuong * donGia
    WHERE MaSDDV = NEW.MaSDDV;
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER trg_room_after_insert
BEFORE INSERT ON HopDong
FOR EACH ROW
BEGIN
    DECLARE currentCount INT;
    DECLARE maxCount INT;
    DECLARE phongGender VARCHAR(5);
    DECLARE svGender VARCHAR(5);

    IF EXISTS (
        SELECT 1 FROM HopDong
        WHERE MaSV = NEW.MaSV
          AND CURDATE() BETWEEN NgayBatDau AND NgayKetThuc
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Sinh viên đã có hợp đồng còn hiệu lực!';
    END IF;


    -- Lấy giới tính của phòng và số lượng
    SELECT GioiTinh, SoLuongHienTai, SoLuongToiDa
    INTO phongGender, currentCount, maxCount
    FROM Phong WHERE MaPhong = NEW.MaPhong;

    -- Lấy giới tính của sinh viên
    SELECT GioiTinh INTO svGender
    FROM SinhVien WHERE MaSV = NEW.MaSV;

    -- Kiểm tra giới tính
    IF phongGender <> svGender THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Giới tính sinh viên không phù hợp với phòng!';
    END IF;

    -- Kiểm tra phòng đầy
    IF currentCount >= maxCount THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Phòng đã đầy, không thể thêm hợp đồng!';
    END IF;

    -- Tăng số lượng phòng
    UPDATE Phong SET SoLuongHienTai = SoLuongHienTai + 1 WHERE MaPhong = NEW.MaPhong;

    -- Nếu phòng vừa đủ chỗ sau khi tăng, cập nhật trạng thái = 0 (đầy)
    IF (currentCount + 1) >= maxCount THEN
        UPDATE Phong SET TinhTrang = 0 WHERE MaPhong = NEW.MaPhong;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER trg_room_after_delete
AFTER DELETE ON HopDong
FOR EACH ROW
BEGIN
    DECLARE currentCount INT;
    DECLARE maxCount INT;

    -- Giảm số lượng hiện tại của phòng
    UPDATE Phong SET SoLuongHienTai = SoLuongHienTai - 1
    WHERE MaPhong = OLD.MaPhong;

    -- Lấy lại thông tin phòng
    SELECT SoLuongHienTai, SoLuongToiDa INTO currentCount, maxCount
    FROM Phong WHERE MaPhong = OLD.MaPhong;

    -- Nếu phòng còn chỗ (chưa đầy), cập nhật trạng thái = 1 (trống)
    IF currentCount < maxCount THEN
        UPDATE Phong SET TinhTrang = 1 WHERE MaPhong = OLD.MaPhong;
    END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER trg_room_after_update
AFTER UPDATE ON HopDong
FOR EACH ROW
BEGIN
    DECLARE oldCount INT;
    DECLARE oldMax INT;
    DECLARE newCount INT;
    DECLARE newMax INT;
    DECLARE phongGender VARCHAR(5);
    DECLARE svGender VARCHAR(5);

    -- Chỉ thực hiện nếu mã phòng thay đổi
    IF OLD.MaPhong <> NEW.MaPhong THEN
        -- Lấy giới tính của phòng mới
        SELECT GioiTinh, SoLuongHienTai, SoLuongToiDa
        INTO phongGender, newCount, newMax
        FROM Phong WHERE MaPhong = NEW.MaPhong;

        -- Lấy giới tính sinh viên
        SELECT GioiTinh INTO svGender FROM SinhVien WHERE MaSV = NEW.MaSV;

        -- Kiểm tra giới tính
        IF phongGender <> svGender THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Giới tính sinh viên không phù hợp với phòng mới!';
        END IF;

        -- Giảm số lượng phòng cũ
        UPDATE Phong SET SoLuongHienTai = SoLuongHienTai - 1 WHERE MaPhong = OLD.MaPhong;

        -- Lấy thông tin phòng cũ
        SELECT SoLuongHienTai, SoLuongToiDa INTO oldCount, oldMax FROM Phong WHERE MaPhong = OLD.MaPhong;

        -- Nếu phòng cũ còn chỗ, cập nhật trạng thái = 1
        IF oldCount < oldMax THEN
            UPDATE Phong SET TinhTrang = 1 WHERE MaPhong = OLD.MaPhong;
        END IF;

        -- Kiểm tra phòng mới có chỗ
        IF newCount >= newMax THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Phòng mới đã đầy, không thể chuyển!';
        END IF;

        -- Tăng số lượng phòng mới
        UPDATE Phong SET SoLuongHienTai = SoLuongHienTai + 1 WHERE MaPhong = NEW.MaPhong;

        -- Nếu phòng mới đầy sau khi tăng
        IF (newCount + 1) >= newMax THEN
            UPDATE Phong SET TinhTrang = 0 WHERE MaPhong = NEW.MaPhong;
        END IF;
    END IF;
END$$
DELIMITER ;
