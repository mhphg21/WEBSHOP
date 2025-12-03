<?php
class Notification
{
    // Lấy danh sách thông báo của user
    public function get_notifications($user_id, $limit = 20, $offset = 0)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $query = "SELECT * FROM notifications 
                  WHERE user_id = ? 
                  ORDER BY created_at DESC 
                  LIMIT $limit OFFSET $offset";
        return pdo_query($query, $user_id);
    }

    // Đếm số thông báo chưa đọc
    public function count_unread_notifications($user_id)
    {
        $query = "SELECT COUNT(*) AS count FROM notifications 
                  WHERE user_id = ? AND is_read = 0";
        $result = pdo_query_one($query, $user_id);
        return $result ? (int)$result['count'] : 0;
    }

    // Đánh dấu thông báo đã đọc
    public function mark_as_read($notification_id, $user_id)
    {
        $query = "UPDATE notifications 
                  SET is_read = 1 
                  WHERE id = ? AND user_id = ?";
        pdo_execute($query, $notification_id, $user_id);
    }

    // Đánh dấu tất cả thông báo đã đọc
    public function mark_all_as_read($user_id)
    {
        $query = "UPDATE notifications 
                  SET is_read = 1 
                  WHERE user_id = ? AND is_read = 0";
        pdo_execute($query, $user_id);
    }

    // Tạo thông báo mới
    public function create_notification($user_id, $message, $type = 'system')
    {
        $query = "INSERT INTO notifications (user_id, message, type, is_read) 
                  VALUES (?, ?, ?, 0)";
        pdo_execute($query, $user_id, $message, $type);
    }

    // Lấy chi tiết thông báo
    public function get_notification_detail($notification_id, $user_id)
    {
        $query = "SELECT * FROM notifications 
                  WHERE id = ? AND user_id = ?";
        return pdo_query_one($query, $notification_id, $user_id);
    }

    // Xóa thông báo
    public function delete_notification($notification_id, $user_id)
    {
        $query = "DELETE FROM notifications 
                  WHERE id = ? AND user_id = ?";
        pdo_execute($query, $notification_id, $user_id);
    }

    // Đếm tổng số thông báo
    public function count_total_notifications($user_id)
    {
        $query = "SELECT COUNT(*) AS count FROM notifications WHERE user_id = ?";
        $result = pdo_query_one($query, $user_id);
        return $result ? (int)$result['count'] : 0;
    }

    public function list_category()
    {
        $query = "SELECT * FROM `categories`";
        $result = pdo_query($query);
        return $result;
    }
}
