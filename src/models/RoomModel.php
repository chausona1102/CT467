<?php
namespace App\models;
use PDO;
class RoomModel extends Model
{
    protected $table = 'phong';
    public function select()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectLimit($n)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} LIMIT :n");
        $stmt->bindParam(":n", $n, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addRoom($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO rooms (name, category, status) VALUES (:name, :category, :status)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':status', $data['status']);
        return $stmt->execute();
    }

    public function updateRoom($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE rooms SET name = :name, category = :category, status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':status', $data['status']);
        return $stmt->execute();
    }
    public function filter($member, $sex, $status)
    {
        $query = "SELECT * FROM phong WHERE 1=1";
        $params = [];

        if ($member) {
            $query .= " AND SoLuongToiDa = :member";
            $params[':member'] = $member;
        }
        if ($sex) {
            $query .= " AND GioiTinh like :sex";
            $params[':sex'] = $sex;
        }
        if ($status !== null && $status !== '') {
            $query .= " AND TinhTrang = :status";
            $params[':status'] = $status;
        }

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function laySinhVienTrongPhong($maphong) {
        $stmt = $this->conn->prepare('SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.SoDienThoai
                            FROM HopDong hd
                            JOIN SinhVien sv ON sv.MaSV = hd.MaSV
                            WHERE hd.MaPhong = :maphong');
        $stmt->bindParam(":maphong", $maphong);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}