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
    public function filter_room_type($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        if (!empty($id)) {
            $query .= " AND MaLoaiPhong LIKE :id";
            $params[':id'] = $id . '%';
        }
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
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
    public function add($id, $name, $cost)
    {
        $stmt = $this->conn->prepare("CALL ThemLoaiPhong(:id, :name, :cost); ");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function delete($id)
    {
        $stmt = $this->conn->prepare("CALL XoaLoaiPhong(:id)");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        return $stmt->execute();
    }
}