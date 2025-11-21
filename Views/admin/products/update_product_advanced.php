<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .nav-pills .nav-link {
        color: #6c757d;
    }
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
    }
    .image-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }
    .image-item {
        position: relative;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }
    .image-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    .image-item .badge {
        position: absolute;
        top: 5px;
        left: 5px;
    }
    .image-item .btn-delete {
        position: absolute;
        top: 5px;
        right: 5px;
    }
    .image-item .btn-group {
        position: absolute;
        bottom: 5px;
        right: 5px;
    }
    .color-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }
</style>

<!-- Modal chỉnh sửa ảnh -->
<div class="modal fade" id="editImageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title"><i class="bi bi-pencil"></i> Chỉnh sửa ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editImageForm" action="index.php?route=admin&action=update_product_image" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="edit_product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="image_id" id="edit_image_id">
                    <input type="hidden" name="tab" value="images">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ảnh hiện tại:</label>
                        <div class="text-center">
                            <img id="current_image_preview" src="" alt="Current" style="max-width: 200px; border: 2px solid #ddd; border-radius: 5px;">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Thay đổi file ảnh (tùy chọn):</label>
                        <input type="file" name="new_image" class="form-control" accept="image/*" onchange="previewNewImage(event)">
                        <small class="text-muted">Để trống nếu chỉ muốn đổi loại ảnh</small>
                        <div class="mt-2" id="new_image_preview_container" style="display: none;">
                            <label class="form-label fw-bold">Ảnh mới:</label>
                            <img id="new_image_preview" src="" alt="New" style="max-width: 200px; border: 2px solid #28a745; border-radius: 5px;">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Loại ảnh:</label>
                        <select name="is_primary" class="form-select" id="edit_is_primary">
                            <option value="1">Ảnh chính</option>
                            <option value="2">Ảnh phụ</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-pencil-square"></i> Quản lý sản phẩm: <?= $product['name'] ?></h3>
        <a href="index.php?route=admin&action=list_product" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-pills mb-4" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="basic-tab" data-bs-toggle="pill" data-bs-target="#basic" type="button">
                <i class="bi bi-info-circle"></i> Thông tin cơ bản
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="images-tab" data-bs-toggle="pill" data-bs-target="#images" type="button">
                <i class="bi bi-images"></i> Quản lý ảnh màu
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="variants-tab" data-bs-toggle="pill" data-bs-target="#variants" type="button">
                <i class="bi bi-grid-3x3"></i> Quản lý biến thể
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="productTabsContent">
        
        <!-- TAB 1: THÔNG TIN CƠ BẢN -->
        <div class="tab-pane fade show active" id="basic" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" id="product_name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea name="description" id="product_description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Giá gốc</label>
                                    <input type="number" name="price" id="product_price" class="form-control" value="<?= $product['price'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Giá khuyến mãi</label>
                                    <input type="number" name="sale_price" id="product_sale_price" class="form-control" value="<?= $product['sale_price'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Danh mục</label>
                                    <select class="form-select" name="category_id" id="product_category">
                                        <?php foreach ($get_categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                                <?= $cat['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label class="form-label">Trạng thái</label>
                                    <select class="form-select" name="status" id="product_status">
                                        <option value="active" <?= $product['status'] == 'active' ? 'selected' : '' ?>>Hiển thị</option>
                                        <option value="inactive" <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>Ẩn</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sản phẩm HOT</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_hot" id="product_is_hot" value="1" <?= $product['is_hot'] ? 'checked' : '' ?>>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sản phẩm MỚI</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_new" id="product_is_new" value="1" <?= $product['is_new'] ? 'checked' : '' ?>>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Ảnh đại diện hiện tại</label>
                                <div class="text-center mb-3">
                                    <img src="./Public/Img/uploads/<?= $product['thumbnail'] ?>" alt="Thumbnail" 
                                         class="img-fluid rounded border" style="max-height: 250px;">
                                </div>
                                <input type="file" name="image_url" id="product_image" class="form-control" accept="image/*">
                                <input type="hidden" name="current_image" id="product_current_image" value="<?= $product['thumbnail'] ?>">
                                <small class="text-muted">Để trống nếu không muốn thay đổi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: QUẢN LÝ ẢNH MÀU -->
        <div class="tab-pane fade" id="images" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4"><i class="bi bi-palette-fill"></i> Ảnh theo màu sắc</h5>
                    
                    <?php 
                    // Nhóm ảnh theo màu
                    $images_by_color = [];
                    foreach ($product_images as $img) {
                        if (!isset($images_by_color[$img['color_id']])) {
                            $images_by_color[$img['color_id']] = [
                                'color_name' => $img['color_name'],
                                'images' => []
                            ];
                        }
                        $images_by_color[$img['color_id']]['images'][] = $img;
                    }
                    ?>

                    <?php if (empty($images_by_color)): ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Chưa có ảnh nào. Vui lòng thêm ảnh cho từng màu bên dưới.
                        </div>
                    <?php else: ?>
                        <?php foreach ($images_by_color as $color_id => $data): ?>
                            <div class="color-section">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-primary mb-0">
                                        <i class="bi bi-circle-fill"></i> Màu: <?= $data['color_name'] ?> (ID: <?= $color_id ?>)
                                    </h6>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="toggleAddImageForm(<?= $color_id ?>)">
                                        <i class="bi bi-plus-circle"></i> Thêm ảnh cho màu này
                                    </button>
                                </div>

                                <!-- Form thêm ảnh cho màu này (ẩn mặc định) -->
                                <div id="addImageForm_<?= $color_id ?>" class="mb-3 p-3 border rounded bg-light" style="display: none;">
                                    <form action="index.php?route=admin&action=add_product_images&id=<?= $product['id'] ?>&tab=images" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="color_id" value="<?= $color_id ?>">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label fw-bold text-success">
                                                    <i class="bi bi-star-fill"></i> Ảnh chính mới
                                                </label>
                                                <input type="file" name="primary_image" class="form-control border-success" accept="image/*" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label fw-bold text-info">
                                                    <i class="bi bi-images"></i> Ảnh phụ (tùy chọn)
                                                </label>
                                                <input type="file" name="secondary_images[]" class="form-control border-info" multiple accept="image/*">
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="bi bi-upload"></i> Upload
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="image-preview-grid">
                                    <?php foreach ($data['images'] as $img): ?>
                                        <div class="image-item">
                                            <img src="./Public/Img/uploads/<?= $img['image_url'] ?>" alt="<?= $data['color_name'] ?>">
                                            <span class="badge <?= $img['is_primary'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= $img['is_primary'] == 1 ? 'Ảnh chính' : 'Ảnh phụ' ?>
                                            </span>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm" 
                                                        onclick="editImage(<?= $img['id'] ?>, '<?= $img['image_url'] ?>', <?= $img['is_primary'] ?>)" 
                                                        title="Chỉnh sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="deleteImage(<?= $img['id'] ?>, '<?= $img['image_url'] ?>')" 
                                                        title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Form thêm ảnh cho màu CHƯA CÓ ảnh -->
                    <div class="mt-4 p-4 border rounded bg-light">
                        <h6 class="mb-3"><i class="bi bi-plus-circle"></i> Thêm ảnh cho màu mới</h6>
                        <form action="index.php?route=admin&action=add_product_images&id=<?= $product['id'] ?>&tab=images" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Chọn màu <span class="text-danger">*</span></label>
                                    <select name="color_id" class="form-select" required>
                                        <option value="">-- Chọn màu --</option>
                                        <?php foreach ($get_color as $color): ?>
                                            <option value="<?= $color['id'] ?>"><?= $color['value'] ?> (ID: <?= $color['id'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ảnh chính <span class="text-danger">*</span></label>
                                    <input type="file" name="primary_image" class="form-control border-success" accept="image/*" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Ảnh phụ (tùy chọn)</label>
                                    <input type="file" name="secondary_images[]" class="form-control border-info" multiple accept="image/*">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-upload"></i> Upload
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: QUẢN LÝ BIẾN THỂ -->
        <div class="tab-pane fade" id="variants" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5><i class="bi bi-grid-3x3"></i> Danh sách biến thể</h5>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVariantModal">
                            <i class="bi bi-plus-circle"></i> Thêm biến thể mới
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>SKU</th>
                                    <th>Màu</th>
                                    <th>Size</th>
                                    <th>Giá</th>
                                    <th>Giá KM</th>
                                    <th>Tồn kho</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($product_variants)): ?>
                                    <?php foreach ($product_variants as $variant): ?>
                                        <tr>
                                            <td><?= $variant['sku'] ?></td>
                                            <td><?= $variant['color'] ?></td>
                                            <td><?= $variant['size'] ?></td>
                                            <td><?= number_format($variant['price']) ?>đ</td>
                                            <td><?= number_format($variant['sale_price']) ?>đ</td>
                                            <td><?= $variant['stock_quantity'] ?></td>
                                            <td>
                                                <?php if ($variant['status'] == 'active'): ?>
                                                    <span class="badge bg-success">Hoạt động</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= $variant['status'] ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="index.php?route=admin&action=show_update_variant&id=<?= $variant['id'] ?>&product_id=<?= $product['id'] ?>&return=variants" 
                                                   class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger" 
                                                        onclick="deleteVariant(<?= $variant['id'] ?>, '<?= $variant['sku'] ?>', <?= $product['id'] ?>)"
                                                        title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Chưa có biến thể nào</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Thông tin tổng quan -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Màu sắc hiện có:</strong> 
                                <?php foreach ($existing_colors as $color): ?>
                                    <span class="badge bg-primary"><?= $color['value'] ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <strong>Size hiện có:</strong> 
                                <?php foreach ($existing_sizes as $size): ?>
                                    <span class="badge bg-primary"><?= $size['value'] ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NÚT LƯU CHUNG CHO TẤT CẢ CÁC TAB -->
    <div class="card mt-4 border-success">
        <div class="card-body bg-light">
            <form action="index.php?route=admin&action=update_product_action&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data" id="mainProductForm">
                <!-- Hidden inputs sẽ được JavaScript copy từ các tab -->
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <p class="mb-0 text-muted">
                            <i class="bi bi-info-circle"></i> Sau khi chỉnh sửa bất kỳ tab nào, nhấn nút "Lưu tất cả thay đổi" bên dưới để cập nhật sản phẩm.
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="bi bi-save"></i> Lưu tất cả thay đổi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal thêm biến thể -->
<div class="modal fade" id="addVariantModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Thêm biến thể mới</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?route=admin&action=add_single_variant&id=<?= $product['id'] ?>&tab=variants" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">SKU <span class="text-danger">*</span></label>
                        <input type="text" name="sku" class="form-control" placeholder="VD: PRO<?= $product['id'] ?>-RED-M" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Màu sắc <span class="text-danger">*</span></label>
                            <select name="color_id" class="form-select" required>
                                <option value="">-- Chọn màu --</option>
                                <?php foreach ($get_color as $color): ?>
                                    <option value="<?= $color['id'] ?>"><?= $color['value'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kích cỡ <span class="text-danger">*</span></label>
                            <select name="size_id" class="form-select" required>
                                <option value="">-- Chọn kích cỡ --</option>
                                <?php foreach ($get_size as $size): ?>
                                    <option value="<?= $size['id'] ?>"><?= $size['value'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="material_id" value="<?= $product_material['id'] ?? 8 ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giá gốc <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="0" min="0" value="<?= $product['price'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giá khuyến mãi <span class="text-danger">*</span></label>
                            <input type="number" name="sale_price" class="form-control" placeholder="0" min="0" value="<?= $product['sale_price'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số lượng tồn kho <span class="text-danger">*</span></label>
                            <input type="number" name="stock_quantity" class="form-control" placeholder="0" min="0" value="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="active">Hoạt động</option>
                                <option value="hidden">Ẩn</option>
                                <option value="out_of_stock">Hết hàng</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Hủy
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm biến thể
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
        function deleteImage(imageId, imageName) {
            if (confirm('Bạn có chắc muốn xóa ảnh "' + imageName + '"?')) {
                window.location.href = 'index.php?route=admin&action=delete_product_image&id=<?= $product['id'] ?>&image_id=' + imageId + '&tab=images';
            }
        }

        function deleteVariant(variantId, variantSku, productId) {
            if (confirm('Bạn có chắc muốn xóa biến thể "' + variantSku + '"?\n\nLưu ý: Xóa biến thể sẽ xóa tất cả dữ liệu liên quan (thuộc tính, đơn hàng cũ sẽ vẫn giữ).')) {
                window.location.href = 'index.php?route=admin&action=delete_variant&id=' + variantId + '&product_id=' + productId + '&tab=variants';
            }
        }

        function editImage(imageId, imageUrl, isPrimary) {
            console.log('Edit Image:', {imageId, imageUrl, isPrimary});
            
            // Set các giá trị vào form
            document.getElementById('edit_image_id').value = imageId;
            document.getElementById('current_image_preview').src = './Public/Img/uploads/' + imageUrl;
            document.getElementById('edit_is_primary').value = isPrimary;
            
            // Reset file input và preview
            document.querySelector('input[name="new_image"]').value = '';
            document.getElementById('new_image_preview_container').style.display = 'none';
            
            // Log để debug
            console.log('Form values set:', {
                image_id: document.getElementById('edit_image_id').value,
                is_primary: document.getElementById('edit_is_primary').value
            });
            
            // Mở modal
            var modal = new bootstrap.Modal(document.getElementById('editImageModal'));
            modal.show();
        }

        function previewNewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('new_image_preview').src = e.target.result;
                    document.getElementById('new_image_preview_container').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('new_image_preview_container').style.display = 'none';
            }
        }

        function toggleAddImageForm(colorId) {
    const form = document.getElementById('addImageForm_' + colorId);
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}

// Mở tab dựa vào URL parameter
window.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab');
    
    if (activeTab === 'images') {
        document.getElementById('images-tab').click();
    } else if (activeTab === 'variants') {
        document.getElementById('variants-tab').click();
    }
});

// Submit form chính với dữ liệu từ Tab 1
document.getElementById('mainProductForm').addEventListener('submit', function(e) {
    const formElement = this;
    
    // Xóa các input cũ nếu có (trừ current_image)
    formElement.querySelectorAll('input:not([name="current_image"])').forEach(el => el.remove());
    
    // Thêm các hidden input
    const fields = {
        'name': document.getElementById('product_name').value,
        'description': document.getElementById('product_description').value,
        'price': document.getElementById('product_price').value,
        'sale_price': document.getElementById('product_sale_price').value,
        'category_id': document.getElementById('product_category').value,
        'status': document.getElementById('product_status').value,
        'is_hot': document.getElementById('product_is_hot').checked ? '1' : '0',
        'is_new': document.getElementById('product_is_new').checked ? '1' : '0',
        'current_image': document.getElementById('product_current_image').value
    };
    
    Object.keys(fields).forEach(key => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = fields[key];
        formElement.appendChild(input);
    });
    
    // Clone file input từ tab 1 nếu có chọn file mới
    const fileInput = document.getElementById('product_image');
    if (fileInput && fileInput.files.length > 0) {
        const clonedFileInput = fileInput.cloneNode(true);
        formElement.appendChild(clonedFileInput);
    }
});
</script>
