<a href="index.php?route=admin&action=create_variant&product_id=<?= $id ?>" class="btn btn-success mb-3">
    <i class="fas fa-plus me-1"></i> Thêm biến thể cho sản phẩm
</a>
<br>
<a href="index.php?route=admin&action=list_product" class="btn btn-outline-secondary px-5 rounded-pill mb-2">Quay lại</a>
<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                
                <th>ID</th>
                <th>Mã SKU</th>
                <th>Giá gốc</th>
                <th>Khuyến mãi</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Màu</th>
                <th>Kích cỡ</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                       
                        <td><?= $product["id"] ?></td>
                        <td><?= $product["sku"] ?></td>
                        <td><?= number_format($product["price"], 0, ',', '.') ?> ₫</td>
                        <td><?= number_format($product["sale_price"], 0, ',', '.') ?> ₫</td>
                        <td><?= $product["stock_quantity"] ?></td>
                        <td>
                            <?php if ($product["status"] == "active"): ?>
                                <span class="badge bg-success">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Ẩn</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $product["color"] ?></td>
                        <td><?= $product["size"] ?></td>
                        <td><?= $product["created_at"] ?></td>
                        <td class="d-flex justify-content-center gap-1">
                            <a href="index.php?route=admin&action=show_update_variant&id=<?= $product["id"] ?>"
                                class="btn btn-sm btn-warning text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- <form method="POST" action="" onsubmit="return confirm('Bạn có chắc muốn xóa biến thể này?')"
                                class="m-0 p-0">
                                <input type="hidden" name="delete_variant_id" value="$product["id"] ?>">
                                <button type="submit" name="delete_variant" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form> -->
                            
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center text-muted">Chưa có biến thể nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
       
    </table>
     
</div>