<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Quản lý Danh mục</h2>
        <?php if (!empty($message))
            echo $message; ?>
        <!-- Form Thêm / Cập nhật -->
        <form method="post" action="index.php?route=admin&action=list_categories">
            <input type="hidden" name="id" value=""> <!-- Ẩn, dùng khi cập nhật -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <button type="submit" class="btn btn-primary" name="action" value="save">Lưu</button>
            <button type="reset" class="btn btn-secondary">Làm mới</button>
        </form>

        <hr>

        <!-- Danh sách danh mục -->
        <h4>Danh sách danh mục</h4>
        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <!-- <th>Mô tả</th> -->
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ví dụ dữ liệu, thay bằng dữ liệu từ PHP -->
                <?php foreach ($categories as $value): ?>
                    <tr>

                        <td><?= $value['id'] ?></td>
                        <td><?= $value['name'] ?></td>

                        <td>
                            <a href="index.php?route=admin&action=update_category&id=<?= $value['id']?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="index.php?route=admin&action=list_categories&delete_id=<?= $value['id']?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa danh mục này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                <!-- Lặp thêm các dòng danh mục khác -->
            </tbody>
        </table>
    </div>
</body>

</html>