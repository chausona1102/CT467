<?php
namespace App\Controllers;

class RoomTypeControllers extends Controller
{
    public function renderRoomType()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $roomTypeMdl = new \App\models\RoomTypeModel();
            $data = [
                'roomTypes' => $roomTypeMdl->getAllRoomTypes()
            ];
        } else {
            header('Location: /login');
            exit();
        }
        $this->render('admin/room_type_manage', $data);
    }

    public function filter() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['codeRoom'] ?? '';
        $mdl = new \App\models\RoomTypeModel();
        $result = $mdl->filter_room_type($id);

        if ($result) {
            $data = [
                'roomTypes' => $mdl->getAllRoomTypes(),
                'result' => $result
            ];
            $this->render('admin/room_type_manage', $data);
        } else {
            echo "<script>alert('Không tìm thấy kết quả'); window.history.back();</script>";
        }
    }
}
    public function getRoomTypeByID($MaLoaiPhong)
    {
        $roomTypeMdl = new \App\models\RoomTypeModel();
        $roomType = $roomTypeMdl->getRoomTypeById($MaLoaiPhong);
        if ($roomType) {
            return $roomType;
        } else {
            // Handle the case where the room type is not found
            return null;
        }
    }
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maphong     = $_POST['MaLoaiPhong'] ?? '';
            $maphongmoi  = $_POST['MaLoaiPhongMoi'] ?? '';
            $tenloai     = $_POST['TenLoaiPhong'] ?? '';
            $gia         = $_POST['GiaThue'] ?? '';

            if (!$maphong || !$maphongmoi || !$tenloai || !$gia) {
                echo "<script>alert('Thiếu dữ liệu')</script>";
                return;
            }

            $roomTypeMdl = new \App\models\RoomTypeModel();
            $roomType = $roomTypeMdl->editRoomType($maphong, $maphongmoi, $tenloai, $gia);
            if($roomType) {
                header('Location: /room_type_manage');
            }else {
                echo "<script>alert('faild')</script>";
            }
        }
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maphong     = $_POST['MaLoaiPhong'] ?? '';
            $tenloai     = $_POST['TenLoaiPhong'] ?? '';
            $gia         = $_POST['GiaThue'] ?? '';

            if (!$maphong || !$tenloai || !$gia) {
                echo "<script>alert('Thiếu dữ liệu')</script>";
                return;
            }

            $roomTypeMdl = new \App\models\RoomTypeModel();
            $roomType = $roomTypeMdl->add($maphong,$tenloai, $gia);
            if($roomType) {
                header('Location: /room_type_manage');
            }else {
                echo "<script>alert('faild')</script>";
            }
        }
    }
    public function delete() {
        if($_SERVER['REQUEST_METHOD']  === 'POST') {
            $maloaiphong = $_POST['MaLoaiPhong'] ?? '';
            if(!$maloaiphong) {
                echo "<script>alert('Thiếu dữ liệu')</script>";
                return;
            }
            $roomTypeMdl = new \App\models\RoomTypeModel();
            $roomType = $roomTypeMdl->delete($maloaiphong);
            if($roomType) {
                header('Location: /room_type_manage');
            }else {
                echo "<script>alert('faild')</script>";
            }
        }
    }
}
//     