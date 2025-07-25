<?php $this->layout('layout-admin'); ?>
<?php $this->start('page-css'); ?>
<link rel="stylesheet" href="/css/admin.css">
<?php $this->stop(); ?>
<?php $this->start("page-content"); ?>
        <h3 style="text-align: center;">Quản lí kí túc xá sinh viên</h3>
<div class="container">
    <div class="row d-flex flex-direction-row justify-content-center mt-5">
        <a href="/room_manage" class="col-2 d-block m-2">
            <div class="card" style="width: 12rem;">
                <img src="https://icon-library.com/images/room-icon/room-icon-2.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Quản lí phòng</h5>
                </div>
            </div>
        </a>
        <a href="/student_manage" class="col-2 d-block m-2">
            <div class="card" style="width: 12rem;">
                <img src="https://th.bing.com/th/id/R.6b0022312d41080436c52da571d5c697?rik=ejx13G9ZroRrcg&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fuser-png-icon-young-user-icon-2400.png&ehk=NNF6zZUBr0n5i%2fx0Bh3AMRDRDrzslPXB0ANabkkPyv0%3d&risl=&pid=ImgRaw&r=0" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Quản lí sinh viên</h5>
                </div>
            </div>
        </a>
        <!-- <a href="/statistical_manage" class="col-2 d-block m-2">
            <div class="card" style="width: 12rem;">
                <img src="https://cdn.iconscout.com/icon/premium/png-512-thumb/audit-pie-chart-5161541-4300944.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Báo cáo thống kê</h5>
                </div>
            </div>
        </a> Sắp có --> 
        <a href="/cost_manage" class="col-2 d-block m-2">
            <div class="card" style="width: 12rem;">
                <img src="https://static.vecteezy.com/system/resources/previews/013/530/940/original/money-money-dollar-icon-sign-money-dollar-icon-money-icon-isolated-on-white-background-money-icon-with-hand-design-illustration-money-icon-flat-money-simple-sign-free-vector.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Quản lí chi phí và thanh toán</h5>
                </div>
            </div>
        </a>
    </div>
</div>
<?php $this->stop(); ?>