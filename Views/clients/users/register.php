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

                <div class="input-box" style="position: relative;">
                    <input type="password" name="password" id="password" placeholder="Mật khẩu" required>
                    <span class="icon">🔒</span>
                    <span class="toggle-password" onclick="togglePassword('password')" style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">👁️</span>
                </div>
                <small style="display: block; margin: -10px 0 15px 0; color: #666; font-size: 12px;">
                    Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt
                </small>

                <div class="input-box" style="position: relative;">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Xác nhận mật khẩu" required>
                    <span class="icon">🔒</span>
                    <span class="toggle-password" onclick="togglePassword('confirm_password')" style="position: absolute; right: 40px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">👁️</span>
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

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.textContent = '🙈';
            } else {
                field.type = 'password';
                icon.textContent = '👁️';
            }
        }

        // Validate form trước khi submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            // Kiểm tra mật khẩu khớp
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Mật khẩu và xác nhận mật khẩu không khớp!');
                return false;
            }
            
            // Kiểm tra độ mạnh mật khẩu
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                e.preventDefault();
                alert('Mật khẩu phải có ít nhất 8 ký tự, bao gồm:\n- Chữ hoa (A-Z)\n- Chữ thường (a-z)\n- Số (0-9)\n- Ký tự đặc biệt (@$!%*?&)');
                return false;
            }
        });
    </script>
</body>

</html>