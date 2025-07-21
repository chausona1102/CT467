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

}
//     