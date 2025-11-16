<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="Public/Css/Clients/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="welcome-section">
            <h2>Welcome Back!</h2>
            <p>Bạn đã có tài khoản?</p>
            <a href="index.php?route=user&action=login" class="register-btn">Đăng nhập</a>
        </div>

        <div class="login-section">

            <h2>Đăng ký</h2>

            <?php if (!empty($error)): ?>
                <p class="error" style="color: red; margin-bottom: 10px;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="post" action="index.php?route=user&action=register" enctype="multipart/form-data">
                <div class="input-box">
                    <input type="text" name="name" placeholder="Họ và tên" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    <span class="icon">👤</span>
                </div>

                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <span class="icon">✉️</span>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <span class="icon">🔒</span>
                </div>

                <div class="input-box">
                    <input type="text" name="phone" placeholder="Số điện thoại" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    <span class="icon">☎️</span>
                </div>

                <div class="input-box">
                    <input type="text" name="address" placeholder="Địa chỉ" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                    <span class="icon">🏠</span>
                </div>

                <button type="submit" class="login-btn">Đăng ký</button>
            </form>

        </div>
    </div>
</body>

</html>