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
            $n = 10;
            $data['roomsL10'] = $roomMdl->selectLimit($n);
        } else {
            header('Location: /login');
            exit();
        }
        $this->render('admin/room_manage', $data);
    }

    public function addRoom()
    {
        // Logic to add a new room
        // This could involve saving data to a database
        echo "Add Room functionality not implemented yet.";
    }

    public function editRoom($id)
    {
        // Logic to edit an existing room by ID
        // This could involve fetching data from a database and updating it
        echo "Edit Room functionality not implemented yet for room ID: $id";
    }
    public function filter_function() {
        // Logic to filter rooms based on criteria
        // This could involve fetching filtered data from a database
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $member = $_GET['member'] ?? '';
            $sex = $_GET['sex'] ?? '';
            $status = $_GET['status'] ?? '';
    
            $roomMdl = new \App\models\RoomModel();
            $filter_result= $roomMdl->filter($member, $sex, $status);
            $data = [
                'filter_result' => $filter_result
            ];
            $this->render('admin/room_manage', $data);
        }else {
            echo "<script>alert('Lỗi method')</script>";
            return;
        }
    }
}