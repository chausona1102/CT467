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
}
//     