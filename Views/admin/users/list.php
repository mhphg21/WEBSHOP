<style>
    .admin-table-container {
        overflow-x: auto;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .admin-table th {
        background-color: #f1f3f5;
        color: #495057;
        font-weight: 600;
        white-space: nowrap;
    }

    .admin-table td {
        vertical-align: middle;
        white-space: nowrap;
    }

    .admin-table tr:hover {
        background-color: #f8f9fa;
    }

    .btn-detail {
        padding: 4px 12px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .admin-table-container {
            padding: 10px;
        }

        .btn-detail {
            font-size: 12px;
            padding: 2px 8px;
        }
    }

    .background-wrapper {
        background: #e0f7fa;
        /* Màu nền nhạt dễ chịu */
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        background: #ffffff;
        border-radius: 8px;
        padding: 20px;
        border: 1px solid #dee2e6;
    }

    .form-section h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-export {
        background-color: #28a745;
        color: white;
        margin-left: 10px;
    }

    .btn-export:hover {
        background-color: #218838;
        color: white;
    }
</style>


<div class="container mt-3">
    <div class="d-flex gap-2 flex-wrap mt-3">
        <div class="container">
            <form action="" method="POST" class="form-section">
                <h2>Danh sách người dùng</h2>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">@example.com</span>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Role</span>
                            <select class="form-select" name="role">
                                <option value="" selected>-- Vai trò --</option>
                                <option value="super admin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">SĐT</span>
                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Địa chỉ</span>
                            <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Trạng thái</span>
                            <select class="form-select" name="status">
                                <option value="" selected>-- Trạng thái --</option>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ngừng hoạt động</option>
                                <option value="banned">Bị khóa</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Từ ngày</label>
                        <input type="date" name="from_date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Đến ngày</label>
                        <input type="date" name="to_date" class="form-control">
                    </div>

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button class="btn btn-success" type="submit" name="handleUser">Tìm kiếm</button>
                        <button class="btn btn-export" type="#">Xuất Excel</button>
                    </div>
                </div>
            </form>
        </div>





    </div>
</div>
<?php
$current_page = $_GET['page'] ?? 1;
$current_page = (int)$current_page;
if (!isset($num_page)) {
    $num_page = '';
}
// echo($num_page);
?>
<?php if ($current_page > 1): ?>
    <a href="index.php?route=admin&action=list_user_page&page=<?= $current_page - 1 ?>&act=handleUser"
        class="btn btn-outline-primary">
        ⟵ Trước
    </a>
<?php endif; ?>

<?php for ($i = 1; $i <= $num_page; $i++): ?>
    <a href="index.php?route=admin&action=list_user_page&page=<?= $i ?>&act=handleUser"
        class="btn <?= $current_page == $i ? 'btn-primary' : 'btn-outline-primary' ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>

<?php if ($current_page < $num_page): ?>
    <a href="index.php?route=admin&action=list_user_page&page=<?= $current_page + 1 ?>&act=handleUser"
        class="btn btn-outline-primary">
        Sau ⟶
    </a>
<?php endif; ?>





<div class="admin-table-container mt-4">
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-list-check me-2"></i>
        Tổng số người dùng:<strong class="ms-1"> <?= $total ?? '' ?></strong>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>STT</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Lần sửa cuối</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($arrayUser)): ?>
                    <?php foreach ($arrayUser as $index => $row):
                        $renderStatus = match ($row['status']) {
                            'active' => 'Hoạt động',
                            'inactive' => 'Ngừng hoạt động',
                            'banned' => 'Bị khóa',
                            default => 'Không xác định'
                        };
                    ?>
                        <tr>
                            <td>
                                <a href="index.php?route=admin&action=list_user_page&page=<?= $current_page ?>&actionUser=editUser&idUser=<?= $row['id'] ?>" class="btn btn-sm btn-success btn-detail">☰</a>
                            </td>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td> <?php
                                    $roleColor = match ($row['role_name']) {
                                        'admins' => 'primary',
                                        'customers' => 'info',
                                        'super admins' => 'danger',
                                        default => 'secondary'
                                    };
                                    ?>
                                <span class="button-status badge bg-<?= $roleColor ?>"><?= htmlspecialchars($row['role_name']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($row['phone']) ?? '' ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?php
                                $statusColor = match ($row['status']) {
                                    'banned' => 'danger',
                                    'inactive' => 'warning',
                                    'active' => 'success',
                                    default => 'secondary'
                                };
                                ?>
                                <span class="button-status badge bg-<?= $statusColor ?>"><?= $renderStatus ?></span>
                            </td>
                            <td><?= $row['created_at'] ?></td>
                            <td><?= $row['updated_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">Không có dữ liệu người dùng.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector(".form-section");

        form.addEventListener("submit", function(e) {
            let email = form.querySelector("input[name='email']").value.trim();
            let phone = form.querySelector("input[name='phone']").value.trim();
            let fromDate = form.querySelector("input[name='from_date']").value;
            let toDate = form.querySelector("input[name='to_date']").value;

            // Regex email cơ bản
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            // Regex phone (9–11 số)
            const phoneRegex = /^[0-9]{9,11}$/;

            if (email !== "" && !emailRegex.test(email)) {
                alert("Email không đúng định dạng!");
                e.preventDefault();
                return;
            }

            if (phone !== "" && !phoneRegex.test(phone)) {
                alert("Số điện thoại chỉ gồm 9–11 chữ số!");
                e.preventDefault();
                return;
            }

            if (fromDate !== "" && toDate !== "" && new Date(fromDate) > new Date(toDate)) {
                alert("Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc!");
                e.preventDefault();
                return;
            }

            // Nếu hợp lệ thì cho submit
        });
    });
</script>