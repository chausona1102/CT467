<?php

namespace App\models;
use PDO;

class RoomTypeModel extends Model
{
    public function getAllRoomTypes()
    {
        $stmt = $this->conn->prepare("SELECT * FROM LoaiPhong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoomTypeById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE MaLoaiPhong = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}