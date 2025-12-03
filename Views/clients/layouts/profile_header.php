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
            position: relative;
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

        .notification-count {
            position: absolute;
            top: 8px;
            right: 15px;
            background-color: #ff0000;
            color: white;
            border-radius: 10px;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }
    </style>
    <div class="admin-wrapper">
        <nav class="admin-sidebar">
            <div class="dropdown">
                <a class="admin-sidebar-link" href="index.php?route=clients&action=notifications<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>">
                    <i class="fa-solid fa-bell"></i> Thông báo
                    <?php 
                    // Lấy số lượng thông báo chưa đọc
                    if (!isset($notification_count)) {
                        $notification_count = 0;
                        if (isset($_SESSION['user']['id'])) {
                            $temp_notification = new Notification();
                            $notification_count = $temp_notification->count_unread_notifications($_SESSION['user']['id']);
                        }
                    }
                    if ($notification_count > 0):
                    ?>
                        <span class="notification-count"><?= $notification_count > 99 ? '99+' : $notification_count ?></span>
                    <?php endif; ?>
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