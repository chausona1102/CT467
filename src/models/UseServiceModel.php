<?php

namespace App\models;

use PDO;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UseServiceModel extends Model
{
    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM SuDungDV");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUseServiceById()
    {
        $stmt = $this->conn->prepare("SELECT * FROM SuDungDV WHERE MaSDDV = :MaSDDV");
        $stmt->bindParam(':MaSDDV', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO SuDungDV (MaSDDV, MaHD, MaDV, SoLuongSuDung, Thang, Nam) 
                VALUES (:MaSDDV, :MaHD, :MaDV, :SoLuongSuDung, :Thang, :Nam)");
        $stmt->bindParam(':MaSDDV', $data['MaSDDV'], PDO::PARAM_STR);
        $stmt->bindParam(':MaHD', $data['MaHD'], PDO::PARAM_STR);
        $stmt->bindParam(':MaDV', $data['MaDV'], PDO::PARAM_STR);
        $stmt->bindParam(':SoLuongSuDung', $data['SoLuongSuDung']);
        $stmt->bindParam(':Thang', $data['Thang']);
        $stmt->bindParam(':Nam', $data['Nam']);
        return $stmt->execute();
    }

    public function exists($maSDDV)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM SuDungDV WHERE MaSDDV = ?");
        $stmt->execute([$maSDDV]);
        return $stmt->fetchColumn() > 0;
    }

    public function update($data): bool
    {
        $stmt = $this->conn->prepare("
        UPDATE DichVu
        SET 
            MaSDDV = :MaSDDV,
            MaHD = :MaHD,
            MaDV = :MaDV,
            SoLuongSuDung = :SoLuongSuDung,
            Thang = :Thang,
            Nam = :Nam
        WHERE MaSDDV = :old_id
    ");
        $stmt->bindParam(':old_id', $data['old_id'], PDO::PARAM_STR);
        $stmt->bindParam(':MaSDDV', $data['MaSDDV'], PDO::PARAM_STR);
        $stmt->bindParam(':MaHD', $data['MaHD'], PDO::PARAM_STR);
        $stmt->bindParam(':MaDV', $data['MaDV'], PDO::PARAM_STR);
        $stmt->bindParam(':SoLuongSuDung', $data['SoLuongSuDung']);
        $stmt->bindParam(':Thang', $data['Thang']);
        $stmt->bindParam(':Nam', $data['Nam']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM SuDungDV WHERE MaSDDV = :MaSDDV");
        $stmt->bindParam(':MaSDDV', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllMaDV()
    {
        $stmt = $this->conn->prepare("SELECT MaDV, TenDV FROM DichVu");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllMaHD()
    {
        $stmt = $this->conn->prepare("SELECT MaHD FROM HopDong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exportToExcel($filename = 'danh_sach_sddv.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tiêu đề cột
        $sheet->setCellValue('A1', 'Mã SDDV');
        $sheet->setCellValue('B1', 'Mã hợp đồng');
        $sheet->setCellValue('C1', 'Mã dịch vụ');
        $sheet->setCellValue('D1', 'Số lượng');
        $sheet->setCellValue('E1', 'Tháng');
        $sheet->setCellValue('F1', 'Năm');

        // Dữ liệu
        $data = $this->all();
        $row = 2;
        foreach ($data as $dv) {
            $sheet->setCellValue("A{$row}", $dv['MaSDDV']);
            $sheet->setCellValue("B{$row}", $dv['MaHD']);
            $sheet->setCellValue("C{$row}", $dv['MaDV']);
            $sheet->setCellValue("D{$row}", $dv['SoLuongSuDung']);
            $sheet->setCellValue("E{$row}", $dv['Thang']);
            $sheet->setCellValue("F{$row}", $dv['Nam']);
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
