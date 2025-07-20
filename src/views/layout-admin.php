<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <?= $this->section('page-css') ?>
    <!-- Bootstrapv5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Quản lí kí túc xá</title>
</head>

<body>
    <nav class="sidebar d-flex flex-column">
        <h4 class="text-center mb-4">Quản lý ký túc xá</h4>
        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseServices">
            Quản lý phòng
        </a>
        <div id="collapseServices" class="collapse" data-bs-parent="#sidebarAccordion">
            <div class="accordion-body">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="/room_manage" class="nav-link">➤ Phòng</a></li>
                    <li class="nav-item"><a href="/room_type_manage" class="nav-link">➤ Loại phòng</a></li>
                </ul>
            </div>
        </div>
        <a class="nav-link student_manage" href="/student_manage">Quản lý sinh viên</a>
        <a class="nav-link statistical_manage" href="/statistical_manage">Báo cáo và thống kê</a>
        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseServices1">
            Quản lý dịch vụ và hóa đơn
        </a>
        <div id="collapseServices1" class="collapse" data-bs-parent="#sidebarAccordion">
            <div class="accordion-body">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="/service_manage" class="nav-link">➤ Dịch vụ</a></li>
                    <li class="nav-item"><a href="/use_service" class="nav-link">➤ Sử dụng dịch vụ</a></li>
                    <li class="nav-item"><a href="/bill_manage" class="nav-link">➤ Hóa đơn</a></li>
                </ul>
            </div>
        </div>
        <form action="/logout" method="POST">
            <button type="submit" class="btn btn-primary m-4">Đăng xuất</button>
        </form>

    </nav>
    <div class="main-content">
        <?= $this->section('page-content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="/js/nav.js"></script>
</body>

</html>