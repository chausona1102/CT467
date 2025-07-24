<?php 
    namespace App\models;

    use PDO;
    
    class StudentModel extends Model
    {
        public function select()
        {
            $stmt = $this->conn->prepare("SELECT * FROM SinhVien");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function n_select($n)
        {
            $stmt = $this->conn->prepare("SELECT * FROM SinhVien ORDER BY MaSV ASC LIMIT :n ");
            $stmt->bindParam(":n", $n, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById($id)
        {
            $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addStudent($masv, $hoten, $sex, $sdt)
        {
            $stmt = $this->conn->prepare("CALL ThemSinhVien(:masv, :hoten, :sex, :sdt)");
            $stmt->bindParam(':masv', $masv);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':sdt', $sdt);
            $stmt->execute();
            return 1;
        }
        public function delete($id) {
            $stmt = $this->conn->prepare("CALL XoaSinhVien(:id)");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            return 1;
        }


        public function updateStudent($old_masv, $masv, $hoten, $sex, $sdt)
        {
            $stmt = $this->conn->prepare("CALL CapNhatSinhVien(:old_ma, :id, :name, :sex, :phone);");
            $stmt->bindParam(":old_ma", $old_masv, PDO::PARAM_STR);
            $stmt->bindParam(":id", $masv, PDO::PARAM_STR);
            $stmt->bindParam(":name", $hoten, PDO::PARAM_STR);
            $stmt->bindParam(":sex", $sex, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $sdt, PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function filter($mssv, $name, $row = 5)
        {
            $query = "SELECT * FROM SinhVien WHERE 1=1";
            $params = [];
            if ($mssv) {
                $query .= " AND MaSV LIKE :mssv";
                $params[':mssv'] = '%' . $mssv . '%';
            }
            if ($name) {
                $query .= " AND HoTen LIKE :name";
                $params[':name'] = '%' . $name . '%';
            }
            if ($row) {
                $query .= " LIMIT {$row}";
            }

            $stmt = $this->conn->prepare($query);
            foreach ($params as $key => &$val) {
                if (is_string($val)) {
                    $stmt->bindValue($key, $val, PDO::PARAM_STR);
                } else {    
                    $stmt->bindParam($key, $val);
                }
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
