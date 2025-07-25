<?php

namespace App\controllers;

class RoomControllers extends Controller
{
    public function renderRoom()
    {
        // Logic to render the room management page
        // This could involve fetching room data from a database
        $data = [
            // 'rooms' => $roomMdl->select() // Example of fetching rooms
        ];
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $roomMdl = new \App\models\RoomModel();
            $rmTypeMdl = new \App\models\RoomTypeModel();
            $n = 10;
            $data['roomsL10'] = $roomMdl->selectLimit($n);
            $data['roomType'] = $rmTypeMdl->getAllRoomTypes();
        } else {
            header('Location: /login');
            exit();
        }
        $this->render('admin/room_manage', $data);
    }

    public function addRoom()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maphong = $_POST['MaPhong'] ?? '';
            $maloaiphong = $_POST['MaLoaiPhong'] ?? '';
            $sophong = $_POST['SoPhong'] ?? '';
            $soluongtoida = $_POST['SoLuongToiDa'] ?? '';
            $gioitinh = $_POST['GioiTinh'] ?? '';
            echo $maphong, $maloaiphong, $sophong, $soluongtoida, $gioitinh;
            $mdl = new \App\models\RoomModel();
            $addMdl =  $mdl->addRoom($maphong, $maloaiphong, $sophong, $soluongtoida, $gioitinh);
            if($addMdl) {
                echo "thanh cong";
            }else echo "that bai";
        }
    }

    public function editRoom($id)
    {
        // Logic to edit an existing room by ID
        // This could involve fetching data from a database and updating it
        echo "Edit Room functionality not implemented yet for room ID: $id";
    }
    public function filter_function()
    {
        // Logic to filter rooms based on criteria
        // This could involve fetching filtered data from a database
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $member = $_GET['member'] ?? '';
            $sex = $_GET['sex'] ?? '';
            $status = $_GET['status'] ?? '';
            $rmTypeMdl = new \App\models\RoomTypeModel();
            $roomMdl = new \App\models\RoomModel();
            $filter_result = $roomMdl->filter($member, $sex, $status);
            $roomType = $rmTypeMdl->getAllRoomTypes();
            $data = [
                'filter_result' => $filter_result,
                'roomType' => $roomType
            ];
            $this->render('admin/room_manage', $data);
        } else {
            echo "<script>alert('Lỗi method')</script>";
            return;
        }
    }
    public function laySinhVienTrongPhong()
    {
        //     $sql = "
        //     SELECT sv.MaSV, sv.HoTen
        //     FROM HopDong hd
        //     JOIN SinhVien sv ON sv.MaSV = hd.MaSV
        //     WHERE hd.MaPhong = ?
        // ";
        // echo "Success";
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maphong = $_POST['MaPhong'] ?? '';
            $rmTypeMdl = new \App\models\RoomTypeModel();
            $mdl = new \App\models\RoomModel();
            $n = 10;
            $roomsL10 = $mdl->selectLimit($n);
            $rmMdl = $mdl->laySinhVienTrongPhong($maphong);
            $roomType = $rmTypeMdl->getAllRoomTypes();
            $data = [
                'memberRoom' => $rmMdl,
                'roomID' => $maphong,
                'roomsL10' => $roomsL10,
                'roomType' => $roomType
            ];
            $this->render('admin/room_manage', $data);
        }

    }

}