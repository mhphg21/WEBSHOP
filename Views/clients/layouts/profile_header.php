    <style>
        .admin-wrapper {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .admin-sidebar {
            /* position: fixed; */
            top: 140px;
            left: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .admin-sidebar::-webkit-scrollbar {
            display: none;
        }

        .admin-sidebar-link {
            display: block;
            color: #333;
            padding: 12px 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 6px;
            margin: 4px 10px;
        }

        .admin-sidebar-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .admin-main-content {
            position: absolute;
            top: 130px;
            left: 250px;
            height: 100vh;
            right: 0;
            bottom: 0;
            padding-left: 20px;
            overflow-y: auto;
        }
    </style>
    <div class="admin-wrapper">
        <nav class="admin-sidebar">
            <div class="dropdown">
                <a class="admin-sidebar-link" href="#" data-bs-toggle="collapse" data-bs-target="#productMenu" aria-expanded="false">
                    <i class="fa-solid fa-bell"></i> Thông báo
                </a>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle admin-sidebar-link" href="index.php?route=clients&action=profile&action_acc=oder<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>"
                    data-bs-toggle="collapse" data-bs-target="#userMenu" aria-expanded="false">
                    <i class="fas fa-shopping-cart me-2"></i> Đơn mua
                </a>
            </div>

            <div class="dropdown">
                <a class="admin-sidebar-link" href="index.php?route=clients&action=profile&action_acc=viewProfile<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>" data-bs-toggle="collapse" data-bs-target="#orderMenu" aria-expanded="false">
                    <i class="fas fa-user me-2"></i> Người dùng
                </a>
            </div>
        </nav>

        <div class="admin-main-content">
            <!-- Main Content here -->