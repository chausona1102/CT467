<?php
// echo "This login page is under construction.";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
    <div id="header">
        <div id="banner"></div>
        <h1 class="">Quản lí kí túc xá</h1>
        <div id="logo">
            <img src="/images/logo.png" alt="Logo"> <br>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center w-20">
            <form method="POST" action="/login">
                <legend>Đăng nhập</legend>
                <div class="form-group">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" name="username"
                        required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>

</html>