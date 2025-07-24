<?php

namespace App\models;

use PDO;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ConTractModel extends Model
{
    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM HopDong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMaSV()
    {
        $stmt = $this->conn->prepare("SELECT MaSV FROM SinhVien");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllMaPhong()
    {
        $stmt = $this->conn->prepare("SELECT MaPhong FROM Phong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContractById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM HopDong WHERE MaHD = :MaHD");
        $stmt->bindParam(':MaHD', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO HopDong (MaHD, MaSV, MaPhong, NgayBatDau, NgayKetThuc) 
        VALUES (:MaHD, :MaSV, :MaPhong, :NgayBatDau, :NgayKetThuc)");
        $stmt->bindParam(':MaHD', $data['MaHD'], PDO::PARAM_STR);
        $stmt->bindParam(':MaSV', $data['MaSV'], PDO::PARAM_STR);
        $stmt->bindParam(':MaPhong', $data['MaPhong'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayBatDau', $data['NgayBatDau'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayKetThuc', $data['NgayKetThuc'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function exists($maHD)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM HopDong WHERE MaHD = ?");
        $stmt->execute([$maHD]);
        return $stmt->fetchColumn() > 0;
    }

    public function update($data): bool
    {
        $stmt = $this->conn->prepare("
        UPDATE HopDong
        SET
            MaHD = :MaHD,
            MaSV = :MaSV,
            MaPhong = :MaPhong,
            NgayBatDau = :NgayBatDau,
            NgayKetThuc = :NgayKetThuc
        WHERE MaHD = :old_id
        ");
        $stmt->bindParam(':old_id', $data['old_id'], PDO::PARAM_STR);
        $stmt->bindParam(':MaHD', $data['MaHD'], PDO::PARAM_STR);
        $stmt->bindParam(':MaSV', $data['MaSV'], PDO::PARAM_STR);
        $stmt->bindParam(':MaPhong', $data['MaPhong'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayBatDau', $data['NgayBatDau'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayKetThuc', $data['NgayKetThuc'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM HopDong WHERE MaHD = :MaHD");
        $stmt->bindParam(':MaHD', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function check($id)
    {
        $stmt = $this->conn->prepare("SELECT KiemTraQuaHan(:MaSV) as KetQua");
        $stmt->bindParam(':MaSV', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function exportToExcel($filename = 'danh_sach_hop_dong.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã hợp đồng');
        $sheet->setCellValue('B1', 'Mã sinh viên');
        $sheet->setCellValue('C1', 'Mã phòng');
        $sheet->setCellValue('D1', 'Ngày bắt đầu');
        $sheet->setCellValue('E1', 'Ngày kết thúc');

        $data = $this->all();
        $row = 2;
        foreach ($data as $dv) {
            $sheet->setCellValue("A{$row}", $dv['MaHD']);
            $sheet->setCellValue("B{$row}", $dv['MaSV']);
            $sheet->setCellValue("C{$row}", $dv['MaPhong']);
            $sheet->setCellValue("D{$row}", $dv['NgayBatDau']);
            $sheet->setCellValue("E{$row}", $dv['NgayKetThuc']);
            $row++;
        }

        // Gửi file về trình duyệt
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
