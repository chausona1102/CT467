<?php

namespace App\controllers;

class StudentControllers extends Controller
{
    public function renderStudent()
    {
        // Logic to render the student management page
        // This could involve fetching student data from a database
        $data = [
            // 'students' => $studentMdl->select() // Example of fetching students
        ];
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            $studentMdl = new \App\models\StudentModel();
            $n = 10;
            $data['students'] = $studentMdl->n_select($n);
        } else {
            header('Location: /login');
            exit();
        }
        $this->render('admin/student_manage', $data);
    }

    public function addStudent()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masv = $_POST['MaSV'] ?? '';
            $hoten = $_POST['HoTen'] ?? '';
            $sdt = $_POST['SDT'] ?? '';
            $sex = $_POST['sex'] ?? '';
            $mdl = new \App\models\StudentModel();
            $stMdl = $mdl->addStudent($masv, $hoten, $sex, $sdt);
            if($stMdl) {
                header('Location: /student_manage');
                exit();
            }else {
                echo "<script>Faild</script>";
                return;
            }
        }else {
            echo "<script>Faild</script> window.location.href='/student_manage'";
        }
    }

    public function editStudent()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_masv = $_POST['Old-MaSV'] ?? '';
            $masv = $_POST['MaSV'] ?? '';
            $hoten = $_POST['HoTen'] ?? '';
            $sdt = $_POST['SoDienThoai'] ?? '';
            $sex = $_POST['sex'] ?? '';
            $mdl = new \App\models\StudentModel();
            $check = $mdl->findById($old_masv);
            if(isset($check) && !empty($check)) {
                $editMdl = $mdl->updateStudent($old_masv, $masv, $hoten, $sex, $sdt);
                if($editMdl) {
                    header("Location: /student_manage");
                }else {
                    echo "<script>alert(\"Cập nhật thất bại\")</script>";
                    exit();
                }
            }else {
                echo "<script>alert(\"Không tìm thấy sinh viên\")</script>";
                exit();
            }
        }
    }
    public function deleleStudent() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masv = isset($_POST['MaSV']) ? $_POST['MaSV'] : '';
            $mdl = new \App\models\StudentModel();
            $check = $mdl->findById($masv);
            if(isset($check) && !empty($check)) {
               $mdl->delete($masv);
               header("Location: /student_manage");
            }else {
                echo "<script>alert(\"Không tìm thấy sinh viên\")</script>";
                exit();
            }
        }
    }


    public function filter_student() {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $mssv = isset($_GET['student_id']) ? $_GET['student_id'] : '';
            $name = isset($_GET['student_name']) ? $_GET['student_name'] : '';
            $row = isset($_GET['student_line']) ? (int)$_GET['student_line'] : 5;
    
            $studentMdl = new \App\models\StudentModel();
            $filteredStudents = $studentMdl->filter($mssv, $name, $row);
            $data = [
                'filter_result' => $filteredStudents
            ];
            $this->render('/admin/student_manage', $data);
        }
    }

}