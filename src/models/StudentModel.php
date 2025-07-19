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

        public function findById($id)
        {
            $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addStudent($data)
        {
            $stmt = $this->conn->prepare("INSERT INTO SinhVien (name, mssv, class) VALUES (:name, :mssv, :class)");
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':mssv', $data['mssv']);
            $stmt->bindParam(':class', $data['class']);
            return $stmt->execute();
        }

        public function updateStudent($id, $data)
        {
            $stmt = $this->conn->prepare("UPDATE students SET name = :name, mssv = :mssv, class = :class WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':mssv', $data['mssv']);
            $stmt->bindParam(':class', $data['class']);
            return $stmt->execute();
        }

        public function filter($mssv, $name, $row = 5)
        {
            $query = "SELECT * FROM students WHERE 1=1";
            $params = [];
            if ($mssv) {
                $query .= " AND mssv LIKE :mssv";
                $params[':mssv'] = '%' . $mssv . '%';
            }
            if ($name) {
                $query .= " AND name LIKE :name";
                $params[':name'] = '%' . $name . '%';
            }
            if ($row) {
                $query .= " LIMIT :row";
                $params[':row'] = $row;
            }

            $stmt = $this->conn->prepare($query);
            foreach ($params as $key => &$val) {
                if (is_string($val)) {
                    // Use bindValue for string parameters
                    $stmt->bindValue($key, $val, PDO::PARAM_STR);
                } else {    
                    // Use bindParam for other types
                    $stmt->bindParam($key, $val);
                }
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
