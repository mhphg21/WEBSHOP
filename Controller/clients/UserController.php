<?php

//xử lý form đăng nhập, đăng ký, đăng xuất
require_once './Model/clients/UserClients.php';

class UserController
{
    public function showLoginForm()
    {
        include './Views/clients/users/login.php';
    }

    public function showRegisterForm()
    {
        include './Views/clients/users/register.php';
    }
    //login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new UserClients();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $user_id = $user['id'];
                $role = $user['role_id'];
                $_SESSION['role_admin'] = 0; // mặc định không phải admin
                //Phan quyen user va admin
                if ($role === 2) {
                    $_SESSION['role_admin'] = 2;
                    header('Location: index.php?route=admin&action=home');
                    /*  echo '<pre>';
                    print_r($role);
                    echo '</pre>';
                    die(); */
                } elseif ($role === 3) {
                    header('Location: index.php?route=clients&action=home&user_id=' . $user['id']);
                } else {
                    echo "Không xác định được quyền truy cập.";
                }
                exit;
            } else {
                $error = "Sai email hoặc mật khẩu";
                include './Views/clients/users/login.php';
            }
        } else {
            $this->showLoginForm();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $avatar = ''; // giữ chỗ nếu sau này xử lý upload

            $error = ''; // chỉ 1 thông báo duy nhất

            // 1. Kiểm tra bắt buộc (empty)
            if ($name === '' || $email === '' || $password === '' || $phone === '' || $address === '') {
                $error = "Phải điền đầy đủ tất cả các trường.";
                include './Views/clients/users/register.php';
                return;
            }

            // 2. Kiểm tra định dạng email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không đúng định dạng.";
                include './Views/clients/users/register.php';
                return;
            }

            // 3. Kiểm tra độ dài mật khẩu
            if (strlen($password) < 6) {
                $error = "Mật khẩu phải có ít nhất 6 ký tự.";
                include './Views/clients/users/register.php';
                return;
            }

            // 4. (Tuỳ chọn) Kiểm tra định dạng số điện thoại (chỉ chữ số, 9-15 chữ số)
            if (!preg_match('/^0\d{9,11}$/', $phone)) {
                $error = "Số điện thoại phải bắt đầu bằng số 0 và có độ dài từ 10-12 chữ số";
                include './Views/clients/users/register.php';
                return;
            }

            // 5. Kiểm tra email trùng trong DB
            $userModel = new UserClients();
            if ($userModel->checkEmail($email)) {
                $error = "Email đã tồn tại. Vui lòng sử dụng email khác!";
                include './Views/clients/users/register.php';
                return;
            }

            // 6. Nếu đến đây là hợp lệ -> lưu vào DB
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $userModel->addUser($name, $email, $hashPassword, $avatar, $phone, $address);

            header("Location: index.php?route=user&action=login");
            exit;
        } else {
            // nếu truy cập bằng GET thì khởi tạo biến để view không báo lỗi undefined
            $error = '';   
            include './Views/clients/users/register.php';
        }
    }


    public function forgotPassword()
    {
        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            // 1. Kiểm tra bắt buộc
            if ($email === '') {
                $error = "Phải nhập email.";
                include './Views/clients/users/forgotPassword.php';
                return;
            }

            // 2. Kiểm tra định dạng
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không đúng định dạng.";
                include './Views/clients/users/forgotPassword.php';
                return;
            }

            // 3. Gọi model -> LƯU Ý: chỉnh đường dẫn include theo project
            include_once './Model/clients/UserClients.php';
            $userModel = new UserClients(); // 
            $user = $userModel->getUserByEmail($email);

            // 4. Kiểm tra tồn tại
            if (!$user) {
                $error = "Email không tồn tại trong hệ thống.";
                include './Views/clients/users/forgotPassword.php';
                return;
            }

            // 5. Tạo mật khẩu mới và cập nhật
            $newPassword = substr(str_shuffle('0123456789'), 0, 6);
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $userModel->updatePassword($email, $passwordHash);

            $message = "Mật khẩu mới của bạn là: <strong>$newPassword</strong><br>Hãy đăng nhập và đổi mật khẩu.";
        }

        include './Views/clients/users/forgotPassword.php';
    }
    public function viewProfile($user_id)
    {

        if (!$user_id) {
            header("Location: index.php?route=user&action=login");
            exit;
        }

        $userModel = new UserClients();
        //$user = null;
        $categories = $userModel->list_category();
        $user = $userModel->getUserById($user_id);


        include './Views/clients/layouts/header1.php';
        include './Views/clients/layouts/profile_header.php';
        include './Views/clients/orders/list_profile.php';
        include './Views/clients/layouts/profile_footer.php';
        include './Views/clients/layouts/footer.php';
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            $userModel = new UserClients();
            $userData = $userModel->getUserById($id);

            // Xử lý đổi mật khẩu nếu có nhập
            if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {
                if (!password_verify($current_password, $userData['password'])) {
                    echo "<script>alert('Mật khẩu hiện tại không đúng.'); history.back();</script>";
                    exit;
                }
                if (strlen($new_password) < 6) {
                    echo "<script>alert('Mật khẩu mới phải có ít nhất 6 ký tự.'); history.back();</script>";
                    exit;
                }
                if ($new_password !== $confirm_password) {
                    echo "<script>alert('Mật khẩu mới và xác nhận không khớp.'); history.back();</script>";
                    exit;
                }
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                $userModel->updatePasswordById($id, $hashedPassword);
            }

            // Xử lý upload ảnh
            $avatar = '';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $images = 'Public/Img/profileIMG/';
                $filename = basename($_FILES["avatar"]["name"]);
                $imagesFile = $images . time() . "_" . $filename;
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $imagesFile)) {
                    $avatar = basename($imagesFile);
                }
            } else {
                $avatar = $userData['avatar'];
            }

            $userModel->updateUserProfile($id, $name, $email, $avatar, $phone, $address);

            $_SESSION['user'] = $userModel->getUserById($id);

            if (isset($_POST['update_profile'])) {
                $_SESSION['gender'] = $_POST['gender'] ?? '';
                $_SESSION['dob'] = $_POST['dob'] ?? '';
            }

            echo "<script>alert('Cập nhật thông tin thành công'); window.location.href='index.php?route=clients&action=profile&action_acc=viewProfile&user_id=$id';</script>";
            exit;
        }
    }



    public function logout()
    {
        session_destroy();
        header("Location: index.php?route=clients&action=home");
        exit;
    }
}
