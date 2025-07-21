<?php

namespace App\models;
use PDO;

class RoomTypeModel extends Model
{
    protected $table = 'LoaiPhong';
    public function getAllRoomTypes()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
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
    public function editRoomType($id, $newid, $name, $cost)
    {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET 
                MaLoaiPhong = :newid,
                TenLoaiPhong = :name,
                GiaThue = :cost
            WHERE MaLoaiPhong = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':newid', $newid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
        return $stmt->execute();
    }
}