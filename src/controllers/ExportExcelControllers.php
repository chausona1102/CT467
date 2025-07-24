<?php
namespace App\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ExportExcelControllers extends Controller
{
    // File controller hoặc route handler

    public function exportExcelRoom()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Danh sách phòng');
        // Header
        $sheet->setCellValue('A2', 'Mã phòng');
        $sheet->setCellValue('B2', 'Mã loại phòng');
        $sheet->setCellValue('C2', 'Số phòng');
        $sheet->setCellValue('D2', 'Số lượng tối đa');
        $sheet->setCellValue('E2', 'Số lượng hiện tại');
        $sheet->setCellValue('F2', 'Giới tính');
        $sheet->setCellValue('G2', 'Tình trạng phòng');

        $row = 3;
        $mdl = new \App\models\RoomModel();
        $roomMdl = $mdl->select();
        foreach ($roomMdl as $item) {
            $sheet->setCellValue("A$row", $item['MaPhong']);
            $sheet->setCellValue("B$row", $item['MaLoaiPhong']);
            $sheet->setCellValue("C$row", $item['SoPhong']);
            $sheet->setCellValue("D$row", $item['SoLuongToiDa']);
            $sheet->setCellValue("E$row", $item['SoLuongHienTai']);
            $sheet->setCellValue("F$row", $item['GioiTinh']);
            $sheet->setCellValue("G$row", $item['TinhTrang'] ? 'Trống' : 'Đầy');
            $row++;
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Xuất file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="danh_sach_phong.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    public function exportExcelStudent()  {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Danh sách sinh viên');
        // Header 
        $sheet->setCellValue('A2', 'MSSV');
        $sheet->setCellValue('B2', 'Họ Tên');
        $sheet->setCellValue('C2', 'Giới tính');
        $sheet->setCellValue('D2', 'Số điện thoại');

        $row = 3;
        $mdl = new \App\models\StudentModel();
        $studentMdl = $mdl->select();
        foreach ($studentMdl as $item) {
            $sheet->setCellValue("A$row", $item['MaSV']);
            $sheet->setCellValue("B$row", $item['HoTen']);
            $sheet->setCellValue("C$row", $item['GioiTinh']);
            $sheet->setCellValue("D$row", $item['SoDienThoai']);
            $row++;
        }
        foreach(range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Xuat file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="danh_sach_sinh_vien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


}
