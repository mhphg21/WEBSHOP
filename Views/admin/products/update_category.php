<div class="container">
    <h4>Sửa danh mục</h4>
    <form method="post" action="index.php?route=admin&action=update_category">
        <input type="hidden" name="id" value="<?= $category['id'] ?>"> <!-- Ẩn, dùng khi cập nhật -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="action" value="update">Cập nhật</button>
        <button type="reset" class="btn btn-secondary">Làm mới</button>
    </form>
</div>