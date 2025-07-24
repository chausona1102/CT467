<?php

namespace App\models;

use PDO;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BillModel extends Model
{
    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM HoaDon");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBillById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM HoaDon WHERE MaHoaDon = :MaHoaDon");
        $stmt->bindParam(':MaHoaDon', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isMaSDDVUsed($maSDDV): bool
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM HoaDon WHERE MaSDDV = :MaSDDV");
        $stmt->bindParam(':MaSDDV', $maSDDV, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function add($data): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO HoaDon (MaHoaDon, MaSDDV, NgayLap, NgayHetHan) 
        VALUES (:MaHoaDon, :MaSDDV, :NgayLap, :NgayHetHan)");
        $stmt->bindParam(':MaHoaDon', $data['MaHoaDon'], PDO::PARAM_STR);
        $stmt->bindParam(':MaSDDV', $data['MaSDDV'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayLap', $data['NgayLap'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayHetHan', $data['NgayHetHan'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function exists($maHoaDon)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM HoaDon WHERE MaHoaDon = ?");
        $stmt->execute([$maHoaDon]);
        return $stmt->fetchColumn() > 0;
    }

    public function update($data): bool
    {
        $stmt = $this->conn->prepare("
        UPDATE HoaDon
        SET
            MaHoaDon = :MaHoaDon,
            MaSDDV = :MaSDDV,
            NgayLap = :NgayLap,
            NgayHetHan = :NgayHetHan,
            TongTien = :TongTien,
            TrangThai = :TrangThai
        WHERE MaHoaDon = :old_id
        ");
        $stmt->bindParam(':old_id', $data['old_id'], PDO::PARAM_STR);
        $stmt->bindParam(':MaHoaDon', $data['MaHoaDon'], PDO::PARAM_STR);
        $stmt->bindParam(':MaSDDV', $data['MaSDDV'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayLap', $data['NgayLap'], PDO::PARAM_STR);
        $stmt->bindParam(':NgayHetHan', $data['NgayHetHan'], PDO::PARAM_STR);
        $stmt->bindParam(':TongTien', $data['TongTien']);
        $stmt->bindParam(':TrangThai', $data['TrangThai']);
        return $stmt->execute();
    }

    public function delete($id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM HoaDon WHERE MaHoaDon = :MaHoaDon");
        $stmt->bindParam(':MaHoaDon', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllMaSDDV()
    {
        $stmt = $this->conn->prepare("SELECT MaSDDV FROM SuDungDV");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exportToExcel($filename = 'danh_sach_hoa_don.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã hóa đơn');
        $sheet->setCellValue('B1', 'Mã SDDV');
        $sheet->setCellValue('C1', 'Ngày lập');
        $sheet->setCellValue('D1', 'Ngày hết hạn');
        $sheet->setCellValue('E1', 'Tổng tiền');
        $sheet->setCellValue('F1', 'Trạng thái');

        $data = $this->all();
        $row = 2;
        foreach ($data as $dv) {
            $sheet->setCellValue("A{$row}", $dv['MaHoaDon']);
            $sheet->setCellValue("B{$row}", $dv['MaSDDV']);
            $sheet->setCellValue("C{$row}", $dv['NgayLap']);
            $sheet->setCellValue("D{$row}", $dv['NgayHetHan']);
            $sheet->setCellValue("E{$row}", $dv['TongTien']);
            $sheet->setCellValue("F{$row}", $dv['TrangThai']);
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
