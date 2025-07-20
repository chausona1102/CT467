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
            // $roomMdl = new \App\models\RoomModel();
            // $data['rooms'] = $roomMdl->select();
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
        $codeRoom = $_GET['codeRoom'] ?? '';
        $category = $_GET['category'] ?? '';
        $status = $_GET['status'] ?? '';

        $roomMdl = new \App\models\RoomModel();
        $filteredRooms = $roomMdl->filter($codeRoom, $category, $status);
        $data = [
            'filter_result' => $filteredRooms
        ];
        $this->render('admin/room_manage', $data);
    }
}