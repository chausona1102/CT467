<?php

namespace App\models;

use PDO;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ServiceModel extends Model
{
    // Lấy tất cả dịch vụ
    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM DichVu");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy dịch vụ theo mã
    public function getServiceById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM DichVu WHERE MaDV = :MaDV");
        $stmt->bindParam(':MaDV', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO DichVu (MaDV, TenDV, DonGia) 
                VALUES (:MaDV, :TenDV, :DonGia)");
        $stmt->bindParam(':MaDV', $data['MaDV'], PDO::PARAM_STR);
        $stmt->bindParam(':TenDV', $data['TenDV'], PDO::PARAM_STR);
        $stmt->bindParam(':DonGia', $data['DonGia']);
        return $stmt->execute();
    }

    public function exists($maDV)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM DichVu WHERE MaDV = ?");
        $stmt->execute([$maDV]);
        return $stmt->fetchColumn() > 0;
    }

    public function update($data): bool
    {
        $stmt = $this->conn->prepare("
        UPDATE DichVu
        SET 
            MaDV = :MaDV,
            TenDV = :TenDV,
            DonGia = :DonGia
        WHERE MaDV = :old_id
    ");
        $stmt->bindParam(':old_id', $data['old_id'], PDO::PARAM_STR);
        $stmt->bindParam(':MaDV', $data['MaDV'], PDO::PARAM_STR);
        $stmt->bindParam(':TenDV', $data['TenDV'], PDO::PARAM_STR);
        $stmt->bindParam(':DonGia', $data['DonGia']);
        return $stmt->execute();
    }


    // Xóa dịch vụ
    public function delete($id): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM DichVu WHERE MaDV = :MaDV");
        $stmt->bindParam(':MaDV', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Xuất danh sách dịch vụ ra file Excel
    public function exportToExcel($filename = 'danh_sach_dich_vu.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tiêu đề cột
        $sheet->setCellValue('A1', 'Mã DV');
        $sheet->setCellValue('B1', 'Tên DV');
        $sheet->setCellValue('C1', 'Đơn giá');

        // Dữ liệu
        $data = $this->all();
        $row = 2;
        foreach ($data as $dv) {
            $sheet->setCellValue("A{$row}", $dv['MaDV']);
            $sheet->setCellValue("B{$row}", $dv['TenDV']);
            $sheet->setCellValue("C{$row}", $dv['DonGia']);
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
