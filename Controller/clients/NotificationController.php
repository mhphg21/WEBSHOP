<?php
class NotificationController
{
    // Hiển thị danh sách thông báo
    public function index($user_id)
    {
        if (!$user_id) {
            header("Location: index.php?route=user&action=login");
            exit;
        }

        $notification_model = new Notification();
        $categories = $notification_model->list_category();
        
        // Lấy danh sách thông báo
        $notifications = $notification_model->get_notifications($user_id, 20, 0);
        $count_unread = $notification_model->count_unread_notifications($user_id);
        $total_notifications = $notification_model->count_total_notifications($user_id);
        
        // Đếm số lượng giỏ hàng
        $count_cart = 0;
        if ($user_id) {
            $cart_model = new Cart();
            $cart_id = $cart_model->get_or_create_cart_id($user_id);
            $count_cart = $cart_model->count_cart_items($cart_id);
        }

        include './Views/clients/layouts/header1.php';
        include './Views/clients/layouts/profile_header.php';
        include './Views/clients/notifications/list_notifications.php';
        include './Views/clients/layouts/profile_footer.php';
        include './Views/clients/layouts/footer.php';
    }

    // Xem chi tiết thông báo và đánh dấu đã đọc
    public function view($user_id)
    {
        if (!$user_id) {
            header("Location: index.php?route=user&action=login");
            exit;
        }

        $notification_id = $_GET['notification_id'] ?? null;
        
        if (!$notification_id) {
            header("Location: index.php?route=clients&action=notifications&user_id=" . $user_id);
            exit;
        }

        $notification_model = new Notification();
        
        // Lấy chi tiết thông báo
        $notification = $notification_model->get_notification_detail($notification_id, $user_id);
        
        if (!$notification) {
            echo "<script>alert('Thông báo không tồn tại!'); window.location.href='index.php?route=clients&action=notifications&user_id=" . $user_id . "';</script>";
            exit;
        }

        // Đánh dấu đã đọc nếu chưa đọc
        if ($notification['is_read'] == 0) {
            $notification_model->mark_as_read($notification_id, $user_id);
        }

        $categories = $notification_model->list_category();
        
        // Đếm số lượng giỏ hàng
        $count_cart = 0;
        if ($user_id) {
            $cart_model = new Cart();
            $cart_id = $cart_model->get_or_create_cart_id($user_id);
            $count_cart = $cart_model->count_cart_items($cart_id);
        }

        include './Views/clients/layouts/header1.php';
        include './Views/clients/layouts/profile_header.php';
        include './Views/clients/notifications/notification_detail.php';
        include './Views/clients/layouts/profile_footer.php';
        include './Views/clients/layouts/footer.php';
    }

    // Đánh dấu tất cả đã đọc
    public function mark_all_read($user_id)
    {
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
            exit;
        }

        $notification_model = new Notification();
        $notification_model->mark_all_as_read($user_id);

        // Nếu là AJAX request
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Đã đánh dấu tất cả đã đọc']);
            exit;
        }

        header("Location: index.php?route=clients&action=notifications&user_id=" . $user_id);
        exit;
    }

    // API lấy số lượng thông báo chưa đọc
    public function get_unread_count()
    {
        header('Content-Type: application/json');
        
        $user_id = $_SESSION['user']['id'] ?? '';
        $count = 0;
        
        if ($user_id) {
            $notification_model = new Notification();
            $count = $notification_model->count_unread_notifications($user_id);
        }
        
        echo json_encode(['success' => true, 'count' => $count]);
        exit;
    }

    // Xóa thông báo
    public function delete($user_id)
    {
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
            exit;
        }

        $notification_id = $_GET['notification_id'] ?? null;
        
        if (!$notification_id) {
            echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
            exit;
        }

        $notification_model = new Notification();
        $notification_model->delete_notification($notification_id, $user_id);

        header("Location: index.php?route=clients&action=notifications&user_id=" . $user_id);
        exit;
    }
}
