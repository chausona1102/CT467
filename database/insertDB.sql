

-- Phòng nam 
CALL ThemLoaiPhong('B002','Phòng nam 2 người ở', 800000);
CALL ThemLoaiPhong('B004','Phòng nam 4 người ở', 600000);
CALL ThemLoaiPhong('B008','Phòng nam 8 người ở', 400000);
-- Phòng nữ
CALL ThemLoaiPhong('G002','Phòng nữ 2 người ở', 800000);
CALL ThemLoaiPhong('G004','Phòng nữ 4 người ở', 600000);
CALL ThemLoaiPhong('G008','Phòng nữ 8 người ở', 400000);


-- Thêm phòng
-- B002
CALL ThemPhong('B00201', 'B002', 1, 'nam', 2, 0, 1);
CALL ThemPhong('B00202', 'B002', 2, 'nam', 2, 0, 1);
CALL ThemPhong('B00203', 'B002', 3, 'nam', 2, 0, 1);
CALL ThemPhong('B00204', 'B002', 4, 'nam', 2, 0, 1);

-- B004
CALL ThemPhong('B00401', 'B004', 1, 'nam', 4, 0, 1);
CALL ThemPhong('B00402', 'B004', 2, 'nam', 4, 0, 1);
CALL ThemPhong('B00403', 'B004', 3, 'nam', 4, 0, 1);
CALL ThemPhong('B00404', 'B004', 4, 'nam', 4, 0, 1);

-- B008
CALL ThemPhong('B00801', 'B008', 1, 'nam', 8, 0, 1);
CALL ThemPhong('B00802', 'B008', 2, 'nam', 8, 0, 1);
CALL ThemPhong('B00803', 'B008', 3, 'nam', 8, 0, 1);
CALL ThemPhong('B00804', 'B008', 4, 'nam', 8, 0, 1);

-- G002
CALL ThemPhong('G00201', 'G002', 1, 'nữ', 2, 0, 1);
CALL ThemPhong('G00202', 'G002', 2, 'nữ', 2, 0, 1);
CALL ThemPhong('G00203', 'G002', 3, 'nữ', 2, 0, 1);
CALL ThemPhong('G00204', 'G002', 4, 'nữ', 2, 0, 1);

-- G004
CALL ThemPhong('G00401', 'G004', 1, 'nữ', 4, 0, 1);
CALL ThemPhong('G00402', 'G004', 2, 'nữ', 4, 0, 1);
CALL ThemPhong('G00403', 'G004', 3, 'nữ', 4, 0, 1);
CALL ThemPhong('G00404', 'G004', 4, 'nữ', 4, 0, 1);

-- G008
CALL ThemPhong('G00801', 'G008', 1, 'nữ', 8, 0, 1);
CALL ThemPhong('G00802', 'G008', 2, 'nữ', 8, 0, 1);
CALL ThemPhong('G00803', 'G008', 3, 'nữ', 8, 0, 1);
CALL ThemPhong('G00804', 'G008', 4, 'nữ', 8, 0, 1);

-- Thêm sinh viên
-- 50 sinh viên nam
CALL ThemSinhVien('B2000001', 'Nguyễn Văn An', 'Nam', '0912345001');
CALL ThemSinhVien('C2000002', 'Trần Quốc Bảo', 'Nam', '0912345002');
CALL ThemSinhVien('B2000003', 'Phạm Hữu Cường', 'Nam', '0912345003');
CALL ThemSinhVien('C2000004', 'Lê Minh Dũng', 'Nam', '0912345004');
CALL ThemSinhVien('B2000005', 'Đỗ Văn Đức', 'Nam', '0912345005');
CALL ThemSinhVien('C2000006', 'Ngô Hữu Khánh', 'Nam', '0912345006');
CALL ThemSinhVien('B2000007', 'Vũ Thanh Long', 'Nam', '0912345007');
CALL ThemSinhVien('C2000008', 'Bùi Hoàng Nam', 'Nam', '0912345008');
CALL ThemSinhVien('B2000009', 'Đặng Quang Phúc', 'Nam', '0912345009');
CALL ThemSinhVien('C2000010', 'Hoàng Nhật Quân', 'Nam', '0912345010');
CALL ThemSinhVien('B2000011', 'Nguyễn Tiến Đạt', 'Nam', '0912345011');
CALL ThemSinhVien('C2000012', 'Phan Văn Khoa', 'Nam', '0912345012');
CALL ThemSinhVien('B2000013', 'Đinh Mạnh Hùng', 'Nam', '0912345013');
CALL ThemSinhVien('C2000014', 'Tạ Hữu Toàn', 'Nam', '0912345014');
CALL ThemSinhVien('B2000015', 'Trịnh Minh Trí', 'Nam', '0912345015');
CALL ThemSinhVien('C2000016', 'Lý Thanh Tùng', 'Nam', '0912345016');
CALL ThemSinhVien('B2000017', 'Mai Đức Thắng', 'Nam', '0912345017');
CALL ThemSinhVien('C2000018', 'Châu Hữu Nghĩa', 'Nam', '0912345018');
CALL ThemSinhVien('B2000019', 'Đoàn Quốc Vinh', 'Nam', '0912345019');
CALL ThemSinhVien('C2000020', 'Kiều Minh Sơn', 'Nam', '0912345020');
CALL ThemSinhVien('B2000021', 'Nguyễn Văn Hiếu', 'Nam', '0912345021');
CALL ThemSinhVien('C2000022', 'Trần Hữu Phước', 'Nam', '0912345022');
CALL ThemSinhVien('B2000023', 'Phạm Minh Hoàng', 'Nam', '0912345023');
CALL ThemSinhVien('C2000024', 'Lê Đình Quân', 'Nam', '0912345024');
CALL ThemSinhVien('B2000025', 'Đỗ Thành Luân', 'Nam', '0912345025');
CALL ThemSinhVien('C2000026', 'Ngô Văn Tài', 'Nam', '0912345026');
CALL ThemSinhVien('B2000027', 'Vũ Anh Tuấn', 'Nam', '0912345027');
CALL ThemSinhVien('C2000028', 'Bùi Quang Duy', 'Nam', '0912345028');
CALL ThemSinhVien('B2000029', 'Đặng Văn Bình', 'Nam', '0912345029');
CALL ThemSinhVien('C2000030', 'Hoàng Văn Lộc', 'Nam', '0912345030');
CALL ThemSinhVien('B2000031', 'Nguyễn Văn Khánh', 'Nam', '0912345031');
CALL ThemSinhVien('C2000032', 'Trần Anh Khoa', 'Nam', '0912345032');
CALL ThemSinhVien('B2000033', 'Phạm Tuấn Anh', 'Nam', '0912345033');
CALL ThemSinhVien('C2000034', 'Lê Minh Nhật', 'Nam', '0912345034');
CALL ThemSinhVien('B2000035', 'Đỗ Quang Vinh', 'Nam', '0912345035');
CALL ThemSinhVien('C2000036', 'Ngô Thanh Hải', 'Nam', '0912345036');
CALL ThemSinhVien('B2000037', 'Vũ Đức Anh', 'Nam', '0912345037');
CALL ThemSinhVien('C2000038', 'Bùi Hữu Phát', 'Nam', '0912345038');
CALL ThemSinhVien('B2000039', 'Đặng Quốc Khánh', 'Nam', '0912345039');
CALL ThemSinhVien('C2000040', 'Hoàng Văn Hậu', 'Nam', '0912345040');
CALL ThemSinhVien('B2000041', 'Nguyễn Thành Đạt', 'Nam', '0912345041');
CALL ThemSinhVien('C2000042', 'Trần Minh Đức', 'Nam', '0912345042');
CALL ThemSinhVien('B2000043', 'Phạm Hoàng Sơn', 'Nam', '0912345043');
CALL ThemSinhVien('C2000044', 'Lê Anh Duy', 'Nam', '0912345044');
CALL ThemSinhVien('B2000045', 'Đỗ Minh Quang', 'Nam', '0912345045');
CALL ThemSinhVien('C2000046', 'Ngô Quang Huy', 'Nam', '0912345046');
CALL ThemSinhVien('B2000047', 'Vũ Hữu Đạt', 'Nam', '0912345047');
CALL ThemSinhVien('C2000048', 'Bùi Minh Hoàng', 'Nam', '0912345048');
CALL ThemSinhVien('B2000049', 'Đặng Thanh Tùng', 'Nam', '0912345049');
CALL ThemSinhVien('C2000050', 'Nguyễn Văn An', 'Nam', '0912345050');

-- 50 sinh viên nữ
CALL ThemSinhVien('B2000051', 'Nguyễn Thị Ánh', 'Nữ', '0912345051');
CALL ThemSinhVien('C2000052', 'Trần Thảo Chi', 'Nữ', '0912345052');
CALL ThemSinhVien('B2000053', 'Phạm Minh Hằng', 'Nữ', '0912345053');
CALL ThemSinhVien('C2000054', 'Lê Thu Hà', 'Nữ', '0912345054');
CALL ThemSinhVien('B2000055', 'Đỗ Thị Hạnh', 'Nữ', '0912345055');
CALL ThemSinhVien('C2000056', 'Ngô Diệu Hiền', 'Nữ', '0912345056');
CALL ThemSinhVien('B2000057', 'Vũ Bích Ngọc', 'Nữ', '0912345057');
CALL ThemSinhVien('C2000058', 'Bùi Thanh Tuyền', 'Nữ', '0912345058');
CALL ThemSinhVien('B2000059', 'Đặng Thị Vân', 'Nữ', '0912345059');
CALL ThemSinhVien('C2000060', 'Hoàng Lan Vy', 'Nữ', '0912345060');
CALL ThemSinhVien('B2000061', 'Nguyễn Thị Mai', 'Nữ', '0912345061');
CALL ThemSinhVien('C2000062', 'Trần Thu Trang', 'Nữ', '0912345062');
CALL ThemSinhVien('B2000063', 'Phạm Ngọc Bích', 'Nữ', '0912345063');
CALL ThemSinhVien('C2000064', 'Lê Kim Oanh', 'Nữ', '0912345064');
CALL ThemSinhVien('B2000065', 'Đỗ Thị Yến', 'Nữ', '0912345065');
CALL ThemSinhVien('C2000066', 'Ngô Thị Hoa', 'Nữ', '0912345066');
CALL ThemSinhVien('B2000067', 'Vũ Thu Thảo', 'Nữ', '0912345067');
CALL ThemSinhVien('C2000068', 'Bùi Thị Lan', 'Nữ', '0912345068');
CALL ThemSinhVien('B2000069', 'Đặng Thị Hương', 'Nữ', '0912345069');
CALL ThemSinhVien('C2000070', 'Hoàng Thu Quỳnh', 'Nữ', '0912345070');
CALL ThemSinhVien('B2000071', 'Nguyễn Thị Hồng', 'Nữ', '0912345071');
CALL ThemSinhVien('C2000072', 'Trần Thị Phương', 'Nữ', '0912345072');
CALL ThemSinhVien('B2000073', 'Phạm Thị Nhung', 'Nữ', '0912345073');
CALL ThemSinhVien('C2000074', 'Lê Thị Thu', 'Nữ', '0912345074');
CALL ThemSinhVien('B2000075', 'Đỗ Thị Thanh', 'Nữ', '0912345075');
CALL ThemSinhVien('C2000076', 'Ngô Thị Minh', 'Nữ', '0912345076');
CALL ThemSinhVien('B2000077', 'Vũ Thị Hà', 'Nữ', '0912345077');
CALL ThemSinhVien('C2000078', 'Bùi Thị Ngọc', 'Nữ', '0912345078');
CALL ThemSinhVien('B2000079', 'Đặng Thị Kim', 'Nữ', '0912345079');
CALL ThemSinhVien('C2000080', 'Hoàng Thị Tuyết', 'Nữ', '0912345080');
CALL ThemSinhVien('B2000081', 'Nguyễn Thị Linh', 'Nữ', '0912345081');
CALL ThemSinhVien('C2000082', 'Trần Thị Giang', 'Nữ', '0912345082');
CALL ThemSinhVien('B2000083', 'Phạm Thị Vân', 'Nữ', '0912345083');
CALL ThemSinhVien('C2000084', 'Lê Thị Mai', 'Nữ', '0912345084');
CALL ThemSinhVien('B2000085', 'Đỗ Thị Huyền', 'Nữ', '0912345085');
CALL ThemSinhVien('C2000086', 'Ngô Thị Bích', 'Nữ', '0912345086');
CALL ThemSinhVien('B2000087', 'Vũ Thị Trang', 'Nữ', '0912345087');
CALL ThemSinhVien('C2000088', 'Bùi Thị Hạnh', 'Nữ', '0912345088');
CALL ThemSinhVien('B2000089', 'Đặng Thị Thảo', 'Nữ', '0912345089');
CALL ThemSinhVien('C2000090', 'Hoàng Thị Yến', 'Nữ', '0912345090');
CALL ThemSinhVien('B2000091', 'Nguyễn Thị Quỳnh', 'Nữ', '0912345091');
CALL ThemSinhVien('C2000092', 'Trần Thị Thu', 'Nữ', '0912345092');
CALL ThemSinhVien('B2000093', 'Phạm Thị Lan', 'Nữ', '0912345093');
CALL ThemSinhVien('C2000094', 'Lê Thị Hương', 'Nữ', '0912345094');
CALL ThemSinhVien('B2000095', 'Đỗ Thị Ngọc', 'Nữ', '0912345095');
CALL ThemSinhVien('C2000096', 'Ngô Thị Hạnh', 'Nữ', '0912345096');
CALL ThemSinhVien('B2000097', 'Vũ Thị Oanh', 'Nữ', '0912345097');
CALL ThemSinhVien('C2000098', 'Bùi Thị Kim', 'Nữ', '0912345098');
CALL ThemSinhVien('B2000099', 'Đặng Thị Hoa', 'Nữ', '0912345099');
CALL ThemSinhVien('C2000100', 'Nguyễn Thị Ánh', 'Nữ', '0912345100'); 


-- Them Hopdong
CALL ThemHopDong('HD001', 'B2000001', 'B00201', '2025-01-10', '2025-07-10');
CALL ThemHopDong('HD002', 'B2000003', 'B00201', '2025-01-12', '2025-07-12');

CALL ThemHopDong('HD003', 'B2000005', 'B00202', '2025-02-01', '2025-08-01');
CALL ThemHopDong('HD004', 'B2000007', 'B00202', '2025-02-01', '2025-08-01');

CALL ThemHopDong('HD005', 'B2000009', 'B00401', '2025-01-20', '2025-07-20');
CALL ThemHopDong('HD006', 'B2000011', 'B00401', '2025-01-20', '2025-07-20');
CALL ThemHopDong('HD007', 'B2000013', 'B00401', '2025-01-20', '2025-07-20');
CALL ThemHopDong('HD008', 'B2000015', 'B00401', '2025-01-20', '2025-07-20');

CALL ThemHopDong('HD009', 'B2000017', 'B00402', '2025-03-01', '2025-09-01');
CALL ThemHopDong('HD010', 'B2000019', 'B00402', '2025-03-01', '2025-09-01');
CALL ThemHopDong('HD011', 'B2000021', 'B00402', '2025-03-01', '2025-09-01');
CALL ThemHopDong('HD012', 'B2000023', 'B00402', '2025-03-01', '2025-09-01');

CALL ThemHopDong('HD013', 'B2000025', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD014', 'B2000027', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD015', 'B2000029', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD016', 'B2000031', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD017', 'B2000033', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD018', 'B2000035', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD019', 'B2000037', 'B00801', '2025-02-15', '2025-08-15');
CALL ThemHopDong('HD020', 'B2000039', 'B00801', '2025-02-15', '2025-08-15');

CALL ThemHopDong('HD021', 'C2000002', 'G00201', '2025-01-10', '2025-07-10');
CALL ThemHopDong('HD022', 'C2000004', 'G00201', '2025-01-10', '2025-07-10');

CALL ThemHopDong('HD023', 'C2000006', 'G00202', '2025-02-01', '2025-08-01');
CALL ThemHopDong('HD024', 'C2000008', 'G00202', '2025-02-01', '2025-08-01');

CALL ThemHopDong('HD025', 'C2000010', 'G00401', '2025-01-20', '2025-07-20');
CALL ThemHopDong('HD026', 'C2000012', 'G00401', '2025-01-20', '2025-07-20');
CALL ThemHopDong('HD027', 'C2000014', 'G00401', '2025-01-20', '2025-07-20');
CALL ThemHopDong('HD028', 'C2000016', 'G00401', '2025-01-20', '2025-07-20');

CALL ThemHopDong('HD029', 'C2000018', 'G00801', '2025-03-01', '2025-09-01');
CALL ThemHopDong('HD030', 'C2000020', 'G00801', '2025-03-01', '2025-09-01');
