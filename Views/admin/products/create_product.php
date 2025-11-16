<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .form-section {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 30px;
    }

    .form-section h3 {
        margin-bottom: 20px;
    }

    .variant-section .form-check-label {
        margin-right: 15px;
        cursor: pointer;
    }

    .variant-section {
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }
</style>

<div class="container mt-4">
    <!-- Gộp thành 1 form duy nhất -->
    <form method="POST" action="index.php?route=admin&action=create_product_action" enctype="multipart/form-data">

        <!-- Phần thêm sản phẩm -->
        <div class="form-section">
            <h3 class="mb-3 text-primary">Thêm Sản Phẩm</h3>

            <input type="hidden" name="id" value="">
            <input type="hidden" name="is_new" value="0">

            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm..." required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" name="description" rows="5"
                    placeholder="Nhập mô tả tại đây..."></textarea>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label class="form-label">Giá sản phẩm</label>
                    <input type="number" name="price" class="form-control" placeholder="Nhập giá sản phẩm..." required>
                </div>
                <div class="mb-3 col">
                    <label class="form-label">Giá khuyến mãi sản phẩm</label>
                    <input type="number" name="sale_price" class="form-control" placeholder="Nhập giá khuyến mãi..."
                        required>
                </div>
                <div class="mb-3 col">
                    <label class="form-label">Anh sản phẩm</label>
                    <input type="file" name="image_product" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status">
                        <option value="active" selected>Hiển thị</option>
                        <option value="inactive">Ẩn</option>
                    </select>
                </div>

                <div class="mb-3 col">
                    <label class="form-label">Danh mục</label>
                    <select class="form-select" name="category_id">
                        <?php foreach ($get_categories as $value): ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Phần tạo biến thể -->
        <div class="form-section">
            <h3 class="text-primary">Tạo Biến Thể Sản Phẩm</h3>

            <div class="variant-section">
                <label class="form-label">Màu sắc:</label><br>
                <?php foreach ($get_color as $value): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input color-checkbox" name="colors[]" type="checkbox"
                            value="<?= $value['id'] ?>">
                        <label class="form-check-label"><?= $value['value'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="variant-section">
                <label class="form-label">Kích cỡ:</label><br>
                <?php foreach ($get_size as $value): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input size-checkbox" name="sizes[]" type="checkbox"
                            value="<?= $value['id'] ?>">
                        <label class="form-check-label"><?= $value['value'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="variant-section">
                <label class="form-label">Chất liệu:</label><br>
                <?php foreach ($get_material as $value): ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input material-checkbox" name="materials[]" type="checkbox"
                            value="<?= $value['id'] ?>">
                        <label class="form-check-label"><?= $value['value'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="button" class="btn btn-primary mb-3" onclick="generateVariantsRecursive()">Tạo Biến
                Thể</button>

            <!-- render ra input ảnh ở đây -->
            <div id="colorImageInputsContainer" class="mt-3"></div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="variantsTable">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Màu sắc</th>
                            <th>Kích cỡ</th>
                            <th>Chất liệu</th>
                            <th>Giá</th>
                            <th>Giá KM</th>
                            <th>SKU</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                           
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="text-end mb-5">
            <button type="submit" class="btn btn-success" name="save">Lưu Sản Phẩm</button>
        </div>
    </form>
</div>

<script>
    function getCheckedValues(className) {
        return [...document.querySelectorAll(`.${className}:checked`)].map(input => input.value);
    }

    function generateVariantsRecursive() {
        const colors = getCheckedValues('color-checkbox');
        const sizes = getCheckedValues('size-checkbox');
        const materials = getCheckedValues('material-checkbox');

        if (colors.length === 0 || sizes.length === 0 || materials.length === 0) {
            alert("Vui lòng chọn đầy đủ Màu sắc, Kích cỡ và Chất liệu!");
            return;
        }

        const allAttributes = [colors, sizes, materials];
        
        const allVariants = [];

        function combineRecursive(index, currentCombo) {
            if (index === allAttributes.length) {
                allVariants.push([...currentCombo]);
                return;
            }
            for (let val of allAttributes[index]) {
                currentCombo.push(val);
                combineRecursive(index + 1, currentCombo);
                currentCombo.pop();
            }
        }

        const colorMap = <?= json_encode(array_column($get_color, 'value', 'id')) ?>;
        const sizeMap = <?= json_encode(array_column($get_size, 'value', 'id')) ?>;
        const materialMap = <?= json_encode(array_column($get_material, 'value', 'id')) ?>;

        console.log(colorMap);
        combineRecursive(0, []);

        const tbody = document.querySelector('#variantsTable tbody');
        tbody.innerHTML = '';

        allVariants.forEach((variant, i) => {
            const [color, size, material] = variant;
            const index = i;


            const row = document.createElement('tr');
            row.innerHTML = `
            <td class="stt">${i + 1}</td>
            <td>
                <input type="hidden" name="variants[${index}][color]" value="${color}">${colorMap[color]}
            </td>
            <td>
                <input type="hidden" name="variants[${index}][size]" value="${size}">${sizeMap[size]}
            </td>
            <td>
                <input type="hidden" name="variants[${index}][material]" value="${material}">${materialMap[material]}
            </td>
            <td>
                <input type="number" name="variants[${index}][price]" class="form-control form-control-sm" required>
            </td>
            <td>
                <input type="number" name="variants[${index}][sale_price]" class="form-control form-control-sm" required>
            </td>
            <td>
                <input type="text" name="variants[${index}][sku]" class="form-control form-control-sm" required>
            </td>
            <td>
                <input type="text" name="variants[${index}][quantity]" class="form-control form-control-sm" required>
            </td>
            <td>
                <select name="variants[${index}][status]" class="form-select form-select-sm">
                        <option value="active">active</option>
                        <option value="hidden">hidden</option>
                        <option value="out_of_stock">out_of_stock</option>
                    </select>
            </td>
            
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Xóa</button>
            </td>
        `;
            tbody.appendChild(row);
        });
        renderImageInputsByColor();
    }

    function removeRow(btn) {
        const row = btn.closest('tr');
        row.remove();
        updateSTT();
    }

    function updateSTT() {
        const rows = document.querySelectorAll('#variantsTable tbody tr');
        rows.forEach((row, i) => {
            row.querySelector('.stt').textContent = i + 1;
        });
    }
    


    function renderImageInputsByColor() {
        const colors = getCheckedValues('color-checkbox');
        const container = document.getElementById('colorImageInputsContainer');
        container.innerHTML = '';  // Xóa nội dung cũ mỗi lần render lại

        if (colors.length === 0) {
            return; // Không hiển thị nếu chưa chọn màu
        }

        const colorMap = <?= json_encode(array_column($get_color, 'value', 'id')) ?>;

        colors.forEach(colorId => {
            const colorName = colorMap[colorId] || colorId;
            const div = document.createElement('div');
            div.classList.add('mb-3'); // Thêm khoảng cách giữa các ô input
            div.innerHTML = `
            <label for="color_images_${colorId}" class="form-label">
                Ảnh cho màu: <strong>${colorName}</strong>
            </label>
            <input type="file" name="color_images[${colorId}][]" id="color_images_${colorId}" class="form-control" multiple>
        `;
            container.appendChild(div);
        });
    }
    // validate cho ảnh
    document.querySelector("form").addEventListener("submit", function (e) {
    const colors = getCheckedValues('color-checkbox');
    let valid = true;

    colors.forEach(colorId => {
        const fileInput = document.getElementById(`color_images_${colorId}`);
        if (!fileInput || fileInput.files.length === 0) {
            alert(`Vui lòng chọn ít nhất 1 ảnh cho màu: ${fileInput.previousElementSibling.textContent}`);
            valid = false;
        }
    });

    if (!valid) {
        e.preventDefault(); // Chặn submit nếu chưa đủ ảnh
    }
});

</script>