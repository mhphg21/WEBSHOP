<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="Public/Css/Clients/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="welcome-section">
            <h2>Hello, Welcome!</h2>
            <p>Bạn chưa có tài khoản?</p>
            <a href="index.php?route=user&action=register" class="register-btn">Đăng ký</a>
        </div>

        <div class="login-section">
            <h2>Login</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

            <form action="index.php?route=user&action=login" method="POST">
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <span class="icon">👤</span>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Mật khẩu" required>
                    <span class="icon">🔒</span>
                </div>

                <a href="index.php?route=user&action=forgotPassword" class="forgot">Quên mật khẩu?</a>

                <button type="submit" class="login-btn">Đăng nhập</button>
            </form>


            <p class="or">Hoặc đăng nhập bằng nền tảng khác!</p>
            <div class="social-icons">
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="G" /></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="F" /></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733553.png" alt="GitHub" /></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn" /></a>
            </div>
        </div>
    </div>
</body>

</html>