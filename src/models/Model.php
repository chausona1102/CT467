<?php

namespace App\models;

use PDO;

class Model
{
    protected PDO $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }
}