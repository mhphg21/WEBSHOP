<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thêm biến thể sản phẩm</h5>
        </div>
        <div class="card-body">
            <form action="index.php?route=admin&action=create_variant_action" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="product_id" value="<?= $_GET['product_id'] ?>">

                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Mã SKU</label>
                        <input type="text" name="sku" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Giá gốc</label>
                        <input type="number" name="price" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="sale_price" class="form-control" min="0">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Số lượng trong kho</label>
                        <input type="number" name="stock_quantity" class="form-control" min="0">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="active" selected>Hiển thị</option>
                            <option value="hidden">Ẩn</option>
                            <option value="out_of_stock">Hết hàng</option>
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="mb-2 col-md-2">
                        <label class="form-label">Màu sắc</label>
                        <select name="variant_color" class="form-select" multiple>
                            <?php foreach ($get_color as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2 col-md-2">
                        <label class="form-label">Size</label>
                        <select name="variant_size" class="form-select" multiple>
                            <?php foreach ($get_size as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2 col-md-2">
                        <label class="form-label">Chất liệu</label>
                        <select name="variant_material" class="form-select" multiple>
                            <?php foreach ($get_material as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['value'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" name="save" class="btn btn-success">Cập nhật</button>
                <a href="admin_product_list.php" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>