<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/Clients/list_profile.css">
    <title>Document</title>
</head>

<body>
    <?php if ($user): ?>
        <!-- FORM HỒ SƠ -->
        <form id="profileForm"
            action="index.php?route=clients&action=profile&action_acc=updateProfile"
            method="post" enctype="multipart/form-data" novalidate>
            <div class="profile-container">
                <div class="profile-wrapper">
                    <div class="profile-left">
                        <h1>Hồ Sơ Của Tôi</h1>
                        <h2>Quản lý thông tin hồ sơ để bảo mật tài khoản</h2>

                        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input class="readonly" type="text" name="name" id="name"
                                value="<?= htmlspecialchars($user['name']) ?>" readonly>
                            <div class="error-message" id="error-name"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="readonly" type="text" name="email" id="email"
                                value="<?= htmlspecialchars($user['email']) ?>" readonly>
                            <div class="error-message" id="error-email"></div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input class="readonly" type="text" name="phone" id="phone"
                                value="<?= htmlspecialchars($user['phone']) ?>" readonly>
                            <div class="error-message" id="error-phone"></div>
                        </div>

                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input class="readonly" type="text" name="address" id="address"
                                value="<?= htmlspecialchars($user['address']) ?>" readonly>
                            <div class="error-message" id="error-address"></div>
                        </div>

                        <div class="btn-row">
                            <button type="button" class="btn btn-primary" id="editBtn">Chỉnh sửa thông tin</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" style="display:none;">Lưu</button>
                            <button type="button" class="btn btn-secondary" id="changePassBtn">Đổi mật khẩu</button>
                        </div>
                    </div>

                    <div class="profile-avatar">
                        <label>Ảnh đại diện</label><br>
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="Public/Img/profileIMG/<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar">
                        <?php endif; ?>
                        <input type="file" name="avatar" id="avatar" disabled>
                        <p class="note">Dung lượng tối đa: 1MB<br>Định dạng: JPEG, PNG</p>
                    </div>
                </div>
            </div>
        </form>

        <!-- POPUP ĐỔI MẬT KHẨU -->
        <div class="popup-overlay" id="passwordPopup">
            <div class="popup-content">
                <div class="popup-header">
                    <div class="popup-title">Đổi mật khẩu</div>
                    <button type="button" class="popup-close" id="closePopupBtn" aria-label="Đóng">&times;</button>
                </div>

                <!-- Form đổi mật khẩu POST về cùng route updateProfile.
                 LƯU Ý: Gửi kèm các field hồ sơ hiện tại (hidden) để backend không ghi đè rỗng. -->
                <form id="passwordForm"
                    action="index.php?route=clients&action=profile&action_acc=updateProfile"
                    method="post" novalidate>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($user['name']) ?>">
                    <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                    <input type="hidden" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                    <input type="hidden" name="address" value="<?= htmlspecialchars($user['address']) ?>">

                    <div class="form-group">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" id="current_password">
                        <div class="error-message" id="error-current_password"></div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Mật khẩu mới</label>
                        <input type="password" name="new_password" id="new_password">
                        <div class="error-message" id="error-new_password"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Xác nhận mật khẩu mới</label>
                        <input type="password" name="confirm_password" id="confirm_password">
                        <div class="error-message" id="error-confirm_password"></div>
                    </div>

                    <div class="popup-actions">
                        <button type="button" class="btn btn-secondary" id="cancelPassBtn">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function setReadonly(selector, isReadonly) {
                document.querySelectorAll(selector).forEach(el => {
                    if (isReadonly) {
                        el.setAttribute('readonly', 'readonly');
                        el.classList.add('readonly');
                    } else {
                        el.removeAttribute('readonly');
                        el.classList.remove('readonly');
                    }
                });
            }

            function clearErrors(scope) {
                (scope || document).querySelectorAll('.error-message').forEach(e => e.textContent = '');
            }

            /* Chỉnh sửa hồ sơ (readonly -> editable)*/
            const editBtn = document.getElementById('editBtn');
            const saveBtn = document.getElementById('saveBtn');
            const avatarInput = document.getElementById('avatar');
            const profileForm = document.getElementById('profileForm');

            editBtn.addEventListener('click', () => {
                setReadonly('#profileForm input[type="text"], #profileForm input[type="email"]', false);
                avatarInput.removeAttribute('disabled');
                saveBtn.style.display = 'inline-block';
                editBtn.style.display = 'none';
            });

            /*Validate hồ sơ trước khi submit*/
            profileForm.addEventListener('submit', function(e) {
                clearErrors(profileForm);
                let valid = true;

                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const phone = document.getElementById('phone').value.trim();
                const address = document.getElementById('address').value.trim();

                if (!name) {
                    document.getElementById('error-name').textContent = 'Vui lòng nhập tên.';
                    valid = false;
                }

                if (!email) {
                    document.getElementById('error-email').textContent = 'Vui lòng nhập email.';
                    valid = false;
                } else {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        document.getElementById('error-email').textContent = 'Email không đúng định dạng.';
                        valid = false;
                    }
                }

                if (!phone) {
                    document.getElementById('error-phone').textContent = 'Vui lòng nhập số điện thoại.';
                    valid = false;
                } else {
                    const phoneRegex = /^[0-9]{9,15}$/;
                    if (!phoneRegex.test(phone)) {
                        document.getElementById('error-phone').textContent = 'Số điện thoại phải 9–15 chữ số.';
                        valid = false;
                    }
                }

                if (!address) {
                    document.getElementById('error-address').textContent = 'Vui lòng nhập địa chỉ.';
                    valid = false;
                }

                if (!valid) e.preventDefault();
            });

            /*Popup đổi mật khẩu*/
            const passwordPopup = document.getElementById('passwordPopup');
            const changePassBtn = document.getElementById('changePassBtn');
            const closePopupBtn = document.getElementById('closePopupBtn');
            const cancelPassBtn = document.getElementById('cancelPassBtn');
            const passwordForm = document.getElementById('passwordForm');

            function openPopup() {
                passwordPopup.style.display = 'flex';
            }

            function closePopup() {
                passwordPopup.style.display = 'none';
            }

            changePassBtn.addEventListener('click', openPopup);
            closePopupBtn.addEventListener('click', closePopup);
            cancelPassBtn.addEventListener('click', closePopup);

            // đóng khi click ra ngoài
            passwordPopup.addEventListener('click', (e) => {
                if (e.target === passwordPopup) closePopup();
            });

            /*Validate đổi mật khẩu trước khi submit*/
            passwordForm.addEventListener('submit', function(e) {
                clearErrors(passwordForm);
                let valid = true;

                const currentPass = document.getElementById('current_password').value.trim();
                const newPass = document.getElementById('new_password').value.trim();
                const confirmPass = document.getElementById('confirm_password').value.trim();

                if (!currentPass) {
                    document.getElementById('error-current_password').textContent = 'Vui lòng nhập mật khẩu hiện tại.';
                    valid = false;
                }

                if (!newPass) {
                    document.getElementById('error-new_password').textContent = 'Vui lòng nhập mật khẩu mới.';
                    valid = false;
                } else if (newPass.length < 6) {
                    document.getElementById('error-new_password').textContent = 'Mật khẩu mới phải ít nhất 6 ký tự.';
                    valid = false;
                }

                if (!confirmPass) {
                    document.getElementById('error-confirm_password').textContent = 'Vui lòng xác nhận mật khẩu mới.';
                    valid = false;
                } else if (newPass && newPass !== confirmPass) {
                    document.getElementById('error-confirm_password').textContent = 'Mật khẩu xác nhận không khớp.';
                    valid = false;
                }

                if (!valid) e.preventDefault();
            });
        </script>
    <?php else: ?>
        <p>Không tìm thấy thông tin người dùng.</p>
    <?php endif; ?>
</body>

</html>