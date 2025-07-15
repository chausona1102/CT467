<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <?= $this->section('page-css') ?>
    <!-- Bootstrapv5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Quản lí kí túc xá</title>
</head>
<body>
    <nav class="sidebar d-flex flex-column">
        <h4 class="text-center mb-4">Quản lý ký túc xá</h4>
        <a class="nav-link room_manage" href="/room_manage">Quản lý phòng ở</a>
        <a class="nav-link student_manage" href="/student_manage">Quản lý sinh viên</a>
        <a class="nav-link statistical_manage" href="/statistical_manage">Báo cáo và thống kê</a>
        <a class="nav-link cost_manage" href="/cost_manage">Quản lí chi phí và thanh toán</a>
        <a class="nav-link repair_manage" href="/repair_manage">Bảo trì và sửa chữa</a>
    </nav>
    <div class="main-content">
        <?= $this->section('page-content') ?>
    </div>
</body>
</html>