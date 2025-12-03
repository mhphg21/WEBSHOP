<style>
.notification-detail-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #2196F3;
    text-decoration: none;
    font-size: 14px;
    margin-bottom: 20px;
    padding: 8px 12px;
    border-radius: 4px;
    transition: all 0.3s;
}

.back-button:hover {
    background: #e3f2fd;
    color: #1976d2;
}

.notification-detail-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    padding: 30px;
}

.notification-detail-header {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 20px;
    margin-bottom: 24px;
}

.notification-detail-type {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.notification-detail-type.order {
    background: #e3f2fd;
    color: #1976d2;
}

.notification-detail-type.system {
    background: #f3e5f5;
    color: #7b1fa2;
}

.notification-detail-type.promotion {
    background: #fff3e0;
    color: #f57c00;
}

.notification-detail-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 12px;
    line-height: 1.4;
}

.notification-detail-meta {
    display: flex;
    gap: 24px;
    color: #666;
    font-size: 14px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
}

.notification-detail-content {
    font-size: 15px;
    line-height: 1.8;
    color: #444;
    margin-bottom: 24px;
    white-space: pre-line;
}

.notification-detail-footer {
    display: flex;
    gap: 12px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.btn-primary-action {
    padding: 12px 24px;
    background: #2196F3;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-primary-action:hover {
    background: #1976d2;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.btn-danger-action {
    padding: 12px 24px;
    background: #f44336;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-danger-action:hover {
    background: #d32f2f;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.error-message {
    background: #ffebee;
    border-left: 4px solid #f44336;
    padding: 16px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.error-message h3 {
    color: #d32f2f;
    margin: 0 0 8px 0;
    font-size: 16px;
}

.error-message p {
    color: #666;
    margin: 0;
    font-size: 14px;
}

.read-badge {
    display: inline-block;
    padding: 4px 12px;
    background: #4CAF50;
    color: white;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
    margin-left: 12px;
}
</style>

<div class="notification-detail-container">
    <a href="index.php?route=clients&action=notifications&user_id=<?= $user_id ?>" class="back-button">
        ← Quay lại danh sách thông báo
    </a>

    <?php if (!empty($error)): ?>
        <div class="error-message">
            <h3>❌ Không thể tải thông báo</h3>
            <p><?= htmlspecialchars($error) ?></p>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?route=clients&action=notifications&user_id=<?= $user_id ?>" class="btn-primary-action">
                Về danh sách thông báo
            </a>
        </div>
    <?php else: ?>
        <div class="notification-detail-card">
            <div class="notification-detail-header">
                <span class="notification-detail-type <?= strtolower($notification['type']) ?>">
                    <?php
                    $type_labels = [
                        'order' => '📦 Đơn hàng',
                        'system' => '⚙️ Hệ thống',
                        'promotion' => '🎁 Khuyến mãi'
                    ];
                    echo $type_labels[$notification['type']] ?? '📢 Thông báo';
                    ?>
                </span>
                <?php if ($notification['is_read'] == 1): ?>
                    <span class="read-badge">✓ Đã đọc</span>
                <?php endif; ?>
                
                <div class="notification-detail-meta">
                    <div class="meta-item">
                        <span>🕐</span>
                        <span>
                            <?php
                            $time = strtotime($notification['created_at']);
                            echo date('H:i - d/m/Y', $time);
                            ?>
                        </span>
                    </div>
                    <div class="meta-item">
                        <span>📅</span>
                        <span>
                            <?php
                            $diff = time() - $time;
                            if ($diff < 3600) {
                                echo floor($diff / 60) . " phút trước";
                            } elseif ($diff < 86400) {
                                echo floor($diff / 3600) . " giờ trước";
                            } elseif ($diff < 604800) {
                                echo floor($diff / 86400) . " ngày trước";
                            } else {
                                echo floor($diff / 604800) . " tuần trước";
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="notification-detail-content">
                <?= nl2br(htmlspecialchars($notification['message'])) ?>
            </div>

            <div class="notification-detail-footer">
                <button class="btn-primary-action" onclick="window.location.href='index.php?route=clients&action=notifications&user_id=<?= $user_id ?>'">
                    📋 Về danh sách
                </button>
                <button class="btn-danger-action" onclick="deleteThisNotification()">
                    🗑️ Xóa thông báo này
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
function deleteThisNotification() {
    if (confirm('Bạn có chắc muốn xóa thông báo này?')) {
        window.location.href = 'index.php?route=clients&action=notification_delete&notification_id=<?= $notification['id'] ?? '' ?>&user_id=<?= $user_id ?>';
    }
}
</script>
