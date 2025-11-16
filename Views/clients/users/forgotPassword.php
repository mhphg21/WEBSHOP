<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="Public/Css/Clients/forgotPassword.css" />
    <title>Quên mật khẩu</title>
</head>

<body>

    <div class="container">

        <div class="welcome-section">
            <h2>Chào mừng!</h2>
            <p>Đã nhớ mật khẩu?</p>
            <a href="index.php?route=user&action=login" class="login-btn">Đăng nhập</a>
        </div>

        <div class="form-section">
            <h2>Quên mật khẩu</h2>

            <?php if (!empty($error)) : ?>
                <div class="message error"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($message)) : ?>
                <div class="message success"><?= $message ?></div>
            <?php endif; ?>

            <form action="index.php?route=user&action=forgotPassword" method="post">
                <div class="input-box">
                    <input type="text" name="email" placeholder="Nhập email của bạn"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
                    <span class="icon">📧</span>
                </div>

                <input type="submit" class="submit-btn" value="Gửi yêu cầu khôi phục" />
            </form>
        </div>

    </div>

</body>

</html>