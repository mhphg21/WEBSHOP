<style>
.notifications-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
}

.notifications-header h2 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin: 0;
}

.notifications-stats {
    display: flex;
    gap: 20px;
    font-size: 14px;
    color: #666;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

.stat-badge {
    background: #ff0000;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
}

.notifications-actions {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.btn-mark-all {
    padding: 8px 16px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s;
}

.btn-mark-all:hover {
    background: #45a049;
}

.notification-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
    transition: all 0.3s;
    cursor: pointer;
    position: relative;
}

.notification-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.notification-item.unread {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
}

.notification-item.unread::before {
    content: "MỚI";
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff0000;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: bold;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 8px;
}

.notification-type {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.notification-type.order {
    background: #e3f2fd;
    color: #1976d2;
}

.notification-type.system {
    background: #f3e5f5;
    color: #7b1fa2;
}

.notification-type.promotion {
    background: #fff3e0;
    color: #f57c00;
}

.notification-time {
    font-size: 12px;
    color: #999;
}

.notification-message {
    color: #333;
    font-size: 14px;
    line-height: 1.6;
    margin-top: 8px;
}

.notification-actions-btn {
    display: flex;
    gap: 10px;
    margin-top: 12px;
}

.btn-view, .btn-delete {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-view {
    background: #2196F3;
    color: white;
}

.btn-view:hover {
    background: #1976d2;
}

.btn-delete {
    background: #f44336;
    color: white;
}

.btn-delete:hover {
    background: #d32f2f;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state img {
    width: 120px;
    opacity: 0.5;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #666;
    font-size: 18px;
    margin-bottom: 10px;
}

.empty-state p {
    color: #999;
    font-size: 14px;
}
</style>

<div class="notifications-container">
    <div class="notifications-header">
        <h2>📬 Thông báo của tôi</h2>
        <div class="notifications-stats">
            <div class="stat-item">
                <span>Tổng:</span>
                <strong><?= $total_notifications ?></strong>
            </div>
            <div class="stat-item">
                <span>Chưa đọc:</span>
                <span class="stat-badge"><?= $count_unread ?></span>
            </div>
        </div>
    </div>

    <?php if ($count_unread > 0): ?>
    <div class="notifications-actions">
        <button class="btn-mark-all" onclick="markAllAsRead()">
            ✓ Đánh dấu tất cả đã đọc
        </button>
    </div>
    <?php endif; ?>

    <?php if (empty($notifications)): ?>
        <div class="empty-state">
            <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <h3>Bạn không có thông báo nào</h3>
            <p>Các thông báo về đơn hàng và khuyến mãi sẽ xuất hiện tại đây</p>
        </div>
    <?php else: ?>
        <?php foreach ($notifications as $notification): ?>
            <div class="notification-item <?= $notification['is_read'] == 0 ? 'unread' : '' ?>" 
                 onclick="viewNotification(<?= $notification['id'] ?>)">
                <div class="notification-header">
                    <span class="notification-type <?= strtolower($notification['type']) ?>">
                        <?php
                        $type_labels = [
                            'order' => '📦 Đơn hàng',
                            'system' => '⚙️ Hệ thống',
                            'promotion' => '🎁 Khuyến mãi'
                        ];
                        echo $type_labels[$notification['type']] ?? '📢 Thông báo';
                        ?>
                    </span>
                    <span class="notification-time">
                        <?php
                        $time = strtotime($notification['created_at']);
                        $diff = time() - $time;
                        
                        if ($diff < 60) {
                            echo "Vừa xong";
                        } elseif ($diff < 3600) {
                            echo floor($diff / 60) . " phút trước";
                        } elseif ($diff < 86400) {
                            echo floor($diff / 3600) . " giờ trước";
                        } elseif ($diff < 604800) {
                            echo floor($diff / 86400) . " ngày trước";
                        } else {
                            echo date('d/m/Y H:i', $time);
                        }
                        ?>
                    </span>
                </div>
                <div class="notification-message">
                    <?= htmlspecialchars(mb_substr($notification['message'], 0, 150)) ?>
                    <?= mb_strlen($notification['message']) > 150 ? '...' : '' ?>
                </div>
                <div class="notification-actions-btn" onclick="event.stopPropagation();">
                    <button class="btn-view" onclick="viewNotification(<?= $notification['id'] ?>)">
                        📖 Xem chi tiết
                    </button>
                    <button class="btn-delete" onclick="deleteNotification(<?= $notification['id'] ?>)">
                        🗑️ Xóa
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
function viewNotification(notificationId) {
    window.location.href = `index.php?route=clients&action=notification_detail&notification_id=${notificationId}&user_id=<?= $user_id ?>`;
}

function markAllAsRead() {
    if (confirm('Đánh dấu tất cả thông báo đã đọc?')) {
        window.location.href = `index.php?route=clients&action=notification_mark_all&user_id=<?= $user_id ?>`;
    }
}

function deleteNotification(notificationId) {
    event.stopPropagation();
    if (confirm('Bạn có chắc muốn xóa thông báo này?')) {
        window.location.href = `index.php?route=clients&action=notification_delete&notification_id=${notificationId}&user_id=<?= $user_id ?>`;
    }
}
</script>
