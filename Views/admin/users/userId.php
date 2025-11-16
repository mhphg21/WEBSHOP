<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Cập nhật thông tin người dùng</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="is_new" value="0">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tên người dùng</label>
                        <input type="text" name="name" class="form-control" value="<?= $renderUserId['name'] ?>" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $renderUserId['email'] ?>" readonly>
                    </div>

                    <!-- <div class="col-md-12 text-center">
                        <label class="form-label d-block">Ảnh đại diện</label>
                        <img src="<?= $renderUserId['avatar'] ?? 'https://via.placeholder.com/100' ?>" alt="avatar" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px;">
                    </div> -->

                    <div class="col-md-6">
                        <label class="form-label">Số điện thoại</label>
                        <input type="number" name="phone" class="form-control" value="<?= $renderUserId['phone'] ?>" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="<?= $renderUserId['address'] ?>" readonly>
                    </div>

                    <?php
                    switch ($renderUserId['status']) {
                        case 'active':
                            $renderStatus = 'Hoạt động';
                            break;
                        case 'inactive':
                            $renderStatus = 'Ngừng hoạt động';
                            break;
                        case 'banned':
                            $renderStatus = 'Bị khóa';
                            break;
                    }
                    ?>

                    <div class="col-md-6">
                        <label class="form-label">Trạng thái - <span class="text-danger fw-bold"><?= $renderStatus ?></span></label>

                        <?php if ($renderUserId['role_id'] === 3) { ?>
                            <select class="form-select" name="status">
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ngừng hoạt động</option>
                                <option value="banned">Bị khóa</option>
                            </select>
                        <?php } else { ?>
                            <input type="text" name="created_at" class="form-control" value="<?= $renderStatus ?>" readonly>
                        <?php } ?>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Chức năng - <span class="text-danger fw-bold"><?= $renderUserId['role_name'] ?></span></label>
                        <?php if ($renderUserId['role_id'] === 3) { ?>
                            <select class="form-select" name="role">

                                <?php foreach ($renderRole as $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php } else { ?>
                            <input type="text" name="created_at" class="form-control"  readonly>
                        <?php } ?>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ngày tạo</label>
                        <input type="datetime-local" name="created_at" class="form-control" value="<?= $renderUserId['created_at'] ?>" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ngày sửa</label>
                        <?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
                        <input type="datetime-local" name="updated_at" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" readonly>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <button type="submit" name="save" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn muốn cập nhật không?');">Cập nhật</button>
                    <a href="index.php?route=admin&action=list_user_page&page=<?= $page ?>&act=handleUser1" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>