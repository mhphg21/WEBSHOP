<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .nav-pills .nav-link {
        color: #6c757d;
    }
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
    }
    .nav-pills .nav-link.completed {
        background-color: #198754;
        color: white;
    }
    .color-upload-section {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s;
    }
    .color-upload-section:hover {
        border-color: #0d6efd;
        background: #e7f1ff;
    }
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    .preview-item {
        position: relative;
        width: 100px;
        height: 100px;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }
    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .preview-item .badge {
        position: absolute;
        top: 5px;
        left: 5px;
        font-size: 9px;
    }
    .preview-item .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        padding: 0;
        font-size: 12px;
        line-height: 1;
    }
    .variant-table-container {
        max-height: 400px;
        overflow-y: auto;
    }
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
    }
    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
    }
    .step-item:not(:last-child)::after {
        content: '→';
        position: absolute;
        right: -15px;
        top: 15px;
        color: #dee2e6;
        font-size: 24px;
    }
    .step-number {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background: #dee2e6;
        color: #6c757d;
        display: inline-block;
        margin-bottom: 10px;
        font-weight: bold;
    }
    .step-item.active .step-number {
        background: #0d6efd;
        color: white;
    }
    .step-item.completed .step-number {
        background: #198754;
        color: white;
    }
</style>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-plus-circle"></i> Thêm sản phẩm mới</h3>
        <a href="index.php?route=admin&action=list_product" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    <!-- Step Indicator -->
    <div class="step-indicator">
        <div class="step-item active" id="step-1">
            <div class="step-number">1</div>
            <div>Thông tin cơ bản</div>
        </div>
        <div class="step-item" id="step-2">
            <div class="step-number">2</div>
            <div>Ảnh theo màu sắc</div>
        </div>
        <div class="step-item" id="step-3">
            <div class="step-number">3</div>
            <div>Biến thể & Hoàn tất</div>
        </div>
    </div>

    <!-- Form chính -->
    <form method="POST" action="index.php?route=admin&action=create_product_action" enctype="multipart/form-data" id="productForm">

        <!-- Navigation Tabs -->
        <ul class="nav nav-pills mb-4" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-btn" data-bs-toggle="pill" data-bs-target="#tab1" type="button">
                    <i class="bi bi-info-circle"></i> Bước 1: Thông tin cơ bản
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-btn" data-bs-toggle="pill" data-bs-target="#tab2" type="button" disabled>
                    <i class="bi bi-palette"></i> Bước 2: Ảnh màu sắc
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3-btn" data-bs-toggle="pill" data-bs-target="#tab3" type="button" disabled>
                    <i class="bi bi-grid-3x3"></i> Bước 3: Biến thể
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="productTabsContent">
            
            <!-- TAB 1: THÔNG TIN CƠ BẢN -->
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Thông tin cơ bản của sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="product_name" class="form-control" placeholder="VD: Áo thun bé gái cotton USA..." required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mô tả sản phẩm</label>
                                    <textarea name="description" class="form-control" rows="4" placeholder="Mô tả chi tiết về sản phẩm..."></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Giá gốc <span class="text-danger">*</span></label>
                                        <input type="number" name="price" id="product_price" class="form-control" placeholder="0" min="0" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Giá khuyến mãi <span class="text-danger">*</span></label>
                                        <input type="number" name="sale_price" id="product_sale_price" class="form-control" placeholder="0" min="0" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id" required>
                                            <option value="">-- Chọn danh mục --</option>
                                            <?php foreach ($get_categories as $cat): ?>
                                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Chất liệu <span class="text-danger">*</span></label>
                                        <select class="form-select" name="material" id="material" required>
                                            <option value="">-- Chọn chất liệu --</option>
                                            <?php foreach ($get_material as $value): ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['value'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Trạng thái</label>
                                        <select class="form-select" name="status">
                                            <option value="active">Hiển thị</option>
                                            <option value="inactive">Ẩn</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Đánh dấu</label>
                                        <div class="mt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="is_hot" value="1">
                                                <label class="form-check-label">🔥 HOT</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="is_new" value="1" checked>
                                                <label class="form-check-label">✨ MỚI</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Ảnh đại diện sản phẩm <span class="text-danger">*</span></label>
                                    <input type="file" name="image_product" id="main_image" class="form-control" accept="image/*" required onchange="previewMainImage(this)">
                                    <small class="text-muted">Ảnh hiển thị ở trang danh sách</small>
                                    <div id="main_image_preview" class="mt-3 text-center"></div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-primary btn-lg" onclick="goToTab2()">
                                Tiếp theo: Chọn ảnh màu <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: ẢNH THEO MÀU -->
            <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-palette"></i> Chọn màu sắc và upload ảnh</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Chọn các màu sắc có sẵn cho sản phẩm, sau đó upload ảnh cho từng màu.
                            <strong>Ảnh đầu tiên</strong> của mỗi màu sẽ là ảnh chính.
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Chọn màu sắc (chọn ít nhất 1 màu) <span class="text-danger">*</span></label>
                            <div class="row">
                                <?php foreach ($get_color as $color): ?>
                                    <div class="col-md-3 col-sm-4 col-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input color-checkbox" type="checkbox" 
                                                   name="colors[]" value="<?= $color['id'] ?>" 
                                                   id="color_<?= $color['id'] ?>"
                                                   onchange="toggleColorUpload(<?= $color['id'] ?>, '<?= $color['value'] ?>')">
                                            <label class="form-check-label" for="color_<?= $color['id'] ?>">
                                                <?= $color['value'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <hr>

                        <div id="colorUploadContainer" class="mt-4">
                            <p class="text-muted text-center">
                                <i class="bi bi-hand-index"></i> Chọn màu ở trên để hiển thị form upload ảnh
                            </p>
                        </div>

                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-secondary me-2" onclick="goToTab1()">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </button>
                            <button type="button" class="btn btn-primary btn-lg" onclick="goToTab3()">
                                Tiếp theo: Tạo biến thể <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: BIẾN THỂ -->
            <div class="tab-pane fade" id="tab3" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-grid-3x3"></i> Tạo biến thể sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> Chọn các kích cỡ có sẵn. 
                            Hệ thống sẽ tự động tạo biến thể cho tất cả tổ hợp <strong>Màu × Size</strong>.
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Chọn kích cỡ (chọn ít nhất 1 size) <span class="text-danger">*</span></label>
                            <div class="row">
                                <?php foreach ($get_size as $size): ?>
                                    <div class="col-md-2 col-sm-3 col-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input size-checkbox" type="checkbox" 
                                                   name="sizes[]" value="<?= $size['id'] ?>" 
                                                   id="size_<?= $size['id'] ?>">
                                            <label class="form-check-label" for="size_<?= $size['id'] ?>">
                                                <?= $size['value'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success mb-3" onclick="generateVariants()">
                            <i class="bi bi-magic"></i> Tạo biến thể tự động
                        </button>

                        <div class="variant-table-container">
                            <table class="table table-bordered table-hover" id="variantsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">STT</th>
                                        <th>Màu sắc</th>
                                        <th>Kích cỡ</th>
                                        <th>Chất liệu</th>
                                        <th width="120">Giá</th>
                                        <th width="120">Giá KM</th>
                                        <th width="120">SKU</th>
                                        <th width="100">Số lượng</th>
                                        <th width="120">Trạng thái</th>
                                        <th width="80">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">
                                            Nhấn "Tạo biến thể tự động" để tạo các biến thể
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-secondary me-2" onclick="goToTab2()">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </button>
                            <button type="submit" class="btn btn-success btn-lg" name="save">
                                <i class="bi bi-check-circle"></i> Hoàn tất & Lưu sản phẩm
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const colorMap = <?= json_encode(array_column($get_color, 'value', 'id')) ?>;
const sizeMap = <?= json_encode(array_column($get_size, 'value', 'id')) ?>;
const materialMap = <?= json_encode(array_column($get_material, 'value', 'id')) ?>;

// Preview ảnh đại diện
function previewMainImage(input) {
    const preview = document.getElementById('main_image_preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded border" style="max-height: 200px;">`;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Toggle upload section cho từng màu
function toggleColorUpload(colorId, colorName) {
    const container = document.getElementById('colorUploadContainer');
    const checkbox = document.getElementById('color_' + colorId);
    
    if (checkbox.checked) {
        // Thêm section upload
        const section = document.createElement('div');
        section.id = 'upload_section_' + colorId;
        section.className = 'color-upload-section';
        section.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0"><i class="bi bi-palette-fill"></i> Màu: <strong>${colorName}</strong></h6>
                <span class="badge bg-secondary">Màu ID: ${colorId}</span>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-success">
                        <i class="bi bi-star-fill"></i> Ảnh chính (bắt buộc)
                    </label>
                    <input type="file" name="color_primary_image[${colorId}]" 
                           class="form-control border-success" accept="image/*" 
                           onchange="previewPrimaryImage(this, ${colorId})" required>
                    <small class="text-muted">Ảnh hiển thị mặc định khi chọn màu này</small>
                    <div id="preview_primary_${colorId}" class="image-preview-container mt-2"></div>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold text-info">
                        <i class="bi bi-images"></i> Ảnh phụ (review, tùy chọn)
                    </label>
                    <input type="file" name="color_images[${colorId}][]" 
                           class="form-control border-info" multiple accept="image/*" 
                           onchange="previewSecondaryImages(this, ${colorId})">
                    <small class="text-muted">Ảnh chi tiết sản phẩm (có thể chọn nhiều ảnh)</small>
                    <div id="preview_secondary_${colorId}" class="image-preview-container mt-2"></div>
                </div>
            </div>
        `;
        container.appendChild(section);
    } else {
        // Xóa section upload
        const section = document.getElementById('upload_section_' + colorId);
        if (section) section.remove();
    }
}

// Preview ảnh chính
function previewPrimaryImage(input, colorId) {
    const preview = document.getElementById('preview_primary_' + colorId);
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.innerHTML = `
                <img src="${e.target.result}" alt="Ảnh chính">
                <span class="badge bg-success">Ảnh chính</span>
            `;
            preview.appendChild(div);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Preview ảnh phụ
function previewSecondaryImages(input, colorId) {
    const preview = document.getElementById('preview_secondary_' + colorId);
    preview.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        Array.from(input.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Ảnh phụ ${index + 1}">
                    <span class="badge bg-info">Ảnh phụ ${index + 1}</span>
                `;
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}

// Tạo biến thể tự động
function generateVariants() {
    const colors = [...document.querySelectorAll('.color-checkbox:checked')].map(el => el.value);
    const sizes = [...document.querySelectorAll('.size-checkbox:checked')].map(el => el.value);
    const material = document.getElementById('material').value;
    const materialName = materialMap[material];

    if (colors.length === 0 || sizes.length === 0) {
        alert('Vui lòng chọn ít nhất 1 màu và 1 size!');
        return;
    }

    if (!material) {
        alert('Vui lòng chọn chất liệu ở Tab 1!');
        return;
    }

    const tbody = document.querySelector('#variantsTable tbody');
    tbody.innerHTML = '';

    let index = 0;
    colors.forEach(color => {
        sizes.forEach(size => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">${index + 1}</td>
                <td>
                    <input type="hidden" name="variants[${index}][color]" value="${color}">
                    ${colorMap[color]}
                </td>
                <td>
                    <input type="hidden" name="variants[${index}][size]" value="${size}">
                    ${sizeMap[size]}
                </td>
                <td>${materialName}</td>
                <td>
                    <input type="number" name="variants[${index}][price]" class="form-control form-control-sm" 
                           value="${document.getElementById('product_price').value}" required>
                </td>
                <td>
                    <input type="number" name="variants[${index}][sale_price]" class="form-control form-control-sm" 
                           value="${document.getElementById('product_sale_price').value}" required>
                </td>
                <td>
                    <input type="text" name="variants[${index}][sku]" class="form-control form-control-sm" 
                           placeholder="Tự động" required>
                </td>
                <td>
                    <input type="number" name="variants[${index}][quantity]" class="form-control form-control-sm" 
                           value="0" required>
                </td>
                <td>
                    <select name="variants[${index}][status]" class="form-select form-select-sm">
                        <option value="active">active</option>
                        <option value="hidden">hidden</option>
                        <option value="out_of_stock">out_of_stock</option>
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove(); updateSTT();">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
            index++;
        });
    });

    alert(`✅ Đã tạo ${index} biến thể (${colors.length} màu × ${sizes.length} size)`);
}

function updateSTT() {
    document.querySelectorAll('#variantsTable tbody tr').forEach((row, i) => {
        row.cells[0].textContent = i + 1;
    });
}

// Navigation giữa các tab
function goToTab1() {
    document.getElementById('tab1-btn').click();
    updateSteps(1);
}

function goToTab2() {
    // Validate Tab 1
    const name = document.getElementById('product_name').value;
    const price = document.getElementById('product_price').value;
    const sale_price = document.getElementById('product_sale_price').value;
    const main_image = document.getElementById('main_image').files.length;
    const material = document.getElementById('material').value;

    if (!name || !price || !sale_price || !main_image || !material) {
        alert('⚠️ Vui lòng điền đầy đủ thông tin cơ bản và chọn ảnh đại diện!');
        return;
    }

    document.getElementById('tab2-btn').disabled = false;
    document.getElementById('tab2-btn').click();
    document.getElementById('tab1-btn').classList.add('completed');
    updateSteps(2);
}

function goToTab3() {
    // Validate Tab 2
    const colors = document.querySelectorAll('.color-checkbox:checked');
    if (colors.length === 0) {
        alert('⚠️ Vui lòng chọn ít nhất 1 màu sắc!');
        return;
    }

    // Kiểm tra mỗi màu đã upload ảnh chưa
    let allHaveImages = true;
    colors.forEach(checkbox => {
        const colorId = checkbox.value;
        const primaryInput = document.querySelector(`input[name="color_primary_image[${colorId}]"]`);
        if (!primaryInput || primaryInput.files.length === 0) {
            allHaveImages = false;
        }
    });

    if (!allHaveImages) {
        alert('⚠️ Vui lòng upload ít nhất ảnh chính cho tất cả các màu đã chọn!');
        return;
    }

    document.getElementById('tab3-btn').disabled = false;
    document.getElementById('tab3-btn').click();
    document.getElementById('tab2-btn').classList.add('completed');
    updateSteps(3);
}

function updateSteps(currentStep) {
    for (let i = 1; i <= 3; i++) {
        const step = document.getElementById('step-' + i);
        step.classList.remove('active', 'completed');
        if (i < currentStep) {
            step.classList.add('completed');
        } else if (i === currentStep) {
            step.classList.add('active');
        }
    }
}

// Validate form trước khi submit
document.getElementById('productForm').addEventListener('submit', function(e) {
    const variants = document.querySelectorAll('#variantsTable tbody tr');
    if (variants.length === 0 || variants[0].cells.length < 5) {
        e.preventDefault();
        alert('⚠️ Vui lòng tạo ít nhất 1 biến thể!');
        goToTab3();
        return false;
    }
});
</script>
