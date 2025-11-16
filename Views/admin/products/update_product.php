<div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-gradient bg-primary text-white rounded-top-4 py-3 px-4">
            <h5 class="mb-0 fw-semibold">Chỉnh sửa biến thể sản phẩm</h5>
        </div>
        <div class="card-body p-4">
            <form action="index.php?route=admin&action=update_product_action&id=<?= $product['id'] ?>" method="POST"
                enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control rounded-3"
                                value="<?= $product['name'] ?>" required>
                        </div>

                        <!-- Checkbox: hot, mới -->
                        <div class="mb-3 d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_hot" value="1" id="isHot"
                                    <?= $product['is_hot'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="isHot">Sản phẩm hot</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_new" value="1" id="isNew"
                                    <?= $product['is_new'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="isNew">Sản phẩm mới</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="product-description" class="form-label">Mô tả sản phẩm</label>
                            <textarea name="description" id="product-description" class="form-control rounded-3"
                                rows="4"><?= $product['description'] ?></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Giá gốc</label>
                                <input type="number" name="price" class="form-control rounded-3"
                                    value="<?= $product['price'] ?>" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Giá khuyến mãi</label>
                                <input type="number" name="sale_price" class="form-control rounded-3"
                                    value="<?= $product['sale_price'] ?>" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" name="status">
                                    <option value="active" >Hiển thị</option>
                                    <option value="inactive" >Ẩn đi</option>
                                    option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3 col">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="category_id">
                                <?php foreach ($get_categories as $value): ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <!-- Ảnh đại diện -->
                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện (nếu muốn thay)</label>
                            <input type="file" name="image_url" class="form-control rounded-3">
                        </div>

                        <!-- Ảnh hiện tại -->
                        <div class="text-center">
                            <img src="./Public/Img/uploads/<?= $product['thumbnail'] ?>" alt="Ảnh sản phẩm"
                                class="img-fluid rounded-3 shadow-sm"
                                style="max-width: 100%; max-height: 200px; object-fit: cover;" name="image">
                            <input type="hidden" name="current_image" value="<?= $product['thumbnail'] ?>">
                        </div>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="mt-4 text-center">
                    <!-- <button type="submit" name="save" class="btn btn-success px-5 rounded-pill me-2" onclick="return confirm('Bạn có chắc muốn lưu lại cập nhật?')">Cập nhật</button> -->
                    <input type="submit" name="save" class="btn btn-success px-5 rounded-pill me-2"
                        onclick="return confirm('Bạn có chắc muốn lưu lại cập nhật?')" value="Lưu">
                    <a href="index.php?route=admin&action=list_product" class="btn btn-outline-secondary px-5 rounded-pill">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>