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
        $this->render('admin/student_manage', $data);
    }

    public function addStudent()
    {
        // Logic to add a new student
        // This could involve saving data to a database
        echo "Add Student functionality not implemented yet.";
    }

    public function editStudent($id)
    {
        // Logic to edit an existing student by ID
        // This could involve fetching data from a database and updating it
        echo "Edit Student functionality not implemented yet for student ID: $id";
    }
    public function filter_student($mssv, $name, $row = 5) {
        $mssv = isset($_GET['student_id']) ? $_GET['student_id'] : '';
        $name = isset($_GET['student_name']) ? $_GET['student_name'] : '';
        $row = isset($_GET['student_line']) ? (int)$_GET['student_line'] : 5;

        $studentMdl = new \App\models\StudentModel();
        $filteredStudents = $studentMdl->filter($mssv, $name, $row);
        $data = [
            'filter_result' => $filteredStudents
        ];
        $this->render('admin/student_manage', $data);
    }

}