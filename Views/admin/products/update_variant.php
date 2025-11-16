<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Chỉnh sửa biến thể sản phẩm</h5>
        </div>
        <div class="card-body">
            <form action="index.php?route=admin&action=update_variant&id=<?= $product['id'] ?>" 
                  method="POST" enctype="multipart/form-data">
                  
                <!-- ID biến thể -->
                <input type="hidden" name="id" value="<?= $product['id'] ?>"> 

                <!-- Mã SKU & Sản phẩm hot -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Mã SKU</label>
                        <input type="text" name="sku" class="form-control" 
                               value="<?= $product['sku'] ?>" readonly>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="is_hot" value="1" class="form-check-input" 
                                   id="is_hot" <?= $product['is_hot'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_hot">Sản phẩm hot</label>
                        </div>
                    </div>
                </div>

                <!-- Giá gốc & Giá khuyến mãi -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Giá gốc</label>
                        <input type="number" name="price" class="form-control" 
                               value="<?= $product['price'] ?>" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="sale_price" class="form-control" 
                               value="<?= $product['sale_price'] ?>" min="0">
                    </div>
                </div>

                <!-- Số lượng & Trạng thái -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Số lượng trong kho</label>
                        <input type="number" name="stock_quantity" class="form-control" 
                               value="<?= $product['stock_quantity'] ?>" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="active" <?= $product['status'] == 'active' ? 'selected' : '' ?>>Hiển thị</option>
                            <option value="hidden" <?= $product['status'] == 'hidden' ? 'selected' : '' ?>>Ẩn</option>
                            <option value="out_of_stock" <?= $product['status'] == 'out_of_stock' ? 'selected' : '' ?>>Hết hàng</option>
                        </select>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="d-flex gap-2">
                    <button type="submit" name="save" class="btn btn-success" 
                            onclick="return confirm('Bạn có chắc muốn lưu lại cập nhật?')">
                        <i class="fas fa-save me-1"></i> Cập nhật
                    </button>
                    <a href="index.php?route=admin&action=list_product" 
                       class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
