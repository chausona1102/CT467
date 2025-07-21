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

    // Thêm mới hoặc cập nhật dịch vụ
    public function save($data): bool
    {
        if (!isset($data['MaDV'], $data['TenDV'], $data['DonGia'])) {
            return false;
        }

        $exists = $this->getServiceById($data['MaDV']);

        if ($exists) {
            // Cập nhật
            $stmt = $this->conn->prepare("
                UPDATE DichVu 
                SET TenDV = :TenDV, DonGia = :DonGia 
                WHERE MaDV = :MaDV
            ");
        } else {
            // Thêm mới
            $stmt = $this->conn->prepare("
                INSERT INTO DichVu (MaDV, TenDV, DonGia) 
                VALUES (:MaDV, :TenDV, :DonGia)
            ");
        }

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

    // Lấy danh sách dịch vụ có phân trang
    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM DichVu LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số dịch vụ
    public function countAll(): int
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM DichVu");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total'];
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
