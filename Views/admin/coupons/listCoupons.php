<style>
    .admin-table-container {
        overflow-x: auto;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .admin-table th {
        background-color: #f1f3f5;
        color: #495057;
        font-weight: 600;
        white-space: nowrap;
    }

    .admin-table td {
        vertical-align: middle;
        white-space: nowrap;
    }

    .admin-table tr:hover {
        background-color: #f8f9fa;
    }

    .btn-detail {
        padding: 4px 12px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .admin-table-container {
            padding: 10px;
        }

        .btn-detail {
            font-size: 12px;
            padding: 2px 8px;
        }
    }

    .background-wrapper {
        background: #e0f7fa;
        /* Màu nền nhạt dễ chịu */
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        background: #ffffff;
        border-radius: 8px;
        padding: 20px;
        border: 1px solid #dee2e6;
    }

    .form-section h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-export {
        background-color: #28a745;
        color: white;
        margin-left: 10px;
    }

    .btn-export:hover {
        background-color: #218838;
        color: white;
    }

    .pop_Up_Update_Coupons {
        position: fixed;
        /* hoặc absolute */
        top: 50%;
        /* canh giữa */
        left: 55%;
        transform: translate(-50%, -50%);
        /* chính giữa màn hình */
        z-index: 9999;
        /* lớn để nằm trên hết */
        background-color: white;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        /* bóng đẹp */
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        height: auto;
        display: none;
        /* Ẩn ban đầu, show bằng JS */
    }
</style>



<div class="container mt-3">
    <div class="d-flex gap-2 flex-wrap mt-3">
        <div class="container">
            <form id="couponForm" action="" method="POST" class="form-section">
                <h2>Danh sách coupons</h2>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Mã giảm giá</span>
                            <input type="text" name="code" class="form-control" placeholder="Mã giảm giá">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Số lượt sử dụng</span>
                            <select class="form-select" name="used_count">
                                <option value="" selected></option>
                                <option value="asc">Tăng dần</option>
                                <option value="desc">Giảm dần</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Giá trị từ</label>
                        <input type="number" name="min_price" placeholder="Nhập số tiền dương >0" class="form-control" min="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Giá trị đến</label>
                        <input type="number" name="max_price" placeholder="Nhập số tiền dương >0" class="form-control" min="0">
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Trạng thái</span>
                            <select class="form-select" name="status">
                                <option value="" selected></option>
                                <option value="pending">Chưa áp dụng</option>
                                <option value="active">Hoạt động</option>
                                <option value="expired">Ngừng hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">Giá tị đơn hàng tối thiểu</span>
                            <select class="form-select" name="order_value">
                                <option value="" selected></option>
                                <option value="asc">Giảm dần</option>
                                <option value="desc">Tăng dần</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ngày bắt đầu</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ngày kết thúc</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button class="btn btn-success" type="submit" name="handleCoupons">Tìm kiếm</button>
                        <button class="btn btn-export" type="#">Xuất Excel</button>
                    </div>
                </div>
            </form>
        </div>





    </div>
</div>
<?php
$current_page = $_GET['page'] ?? 1;
$current_page = (int)$current_page;
if (!isset($num_page)) {
    $num_page = '';
}
// echo($num_page);
?>
<?php if ($current_page > 1): ?>
    <a href="index.php?route=admin&action=list_coupons_page&page=<?= $current_page - 1 ?>&act=handleCoupons"
        class="btn btn-outline-primary">
        ⟵ Trước
    </a>
<?php endif; ?>

<?php for ($i = 1; $i <= $num_page; $i++): ?>
    <a href="index.php?route=admin&action=list_coupons_page&page=<?= $i ?>&act=handleCoupons"
        class="btn <?= $current_page == $i ? 'btn-primary' : 'btn-outline-primary' ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>

<?php if ($current_page < $num_page): ?>
    <a href="index.php?route=admin&action=list_coupons_page&page=<?= $current_page + 1 ?>&act=handleCoupons"
        class="btn btn-outline-primary">
        Sau ⟶
    </a>
<?php endif; ?>


<?php
// Lấy danh sách code từ mảng coupons
$array_filter = array_column($array_code_coupons, 'code');
?>
<script>
    // Truyền mảng code từ PHP sang JS
    const array_filter1 = <?= json_encode($array_filter) ?>;
</script>


<div class="admin-table-container mt-4">
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-list-check me-2"></i>
        Tổng số coupons:<strong class="ms-1"> <?= $total ?? '' ?></strong>

    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>STT</th>
                    <th>Mã coupon</th>
                    <!-- <th>Kiểu giảm giá</th> -->
                    <th>Giá trị giảm giá</th>
                    <th>Giá trị đơn hàng tối thiểu</th>
                    <th>Số lần sử dụng tối đa</th>
                    <th>Số lần đã sử dụng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listCoupons)): ?>
                    <?php foreach ($listCoupons as $index => $row):
                        $renderStatus = match ($row['discount_type']) {
                            'fixed' => 'Số tiền',
                            'percent' => 'Phần trăm',
                            default => 'Không xác định'
                        };
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-sm btn-success" onclick="edit_coupons(<?= $row['id'] ?>)">☰</button>
                                    <!-- <button class="btn btn-sm btn-warning" onclick="showPaymentDetail(<?= $row['id'] ?>)">💳</button> -->
                                    <!-- <button id="update_status" class="btn btn-sm btn-danger" onclick="cancelOrder(<?= $row['id'] ?>, '<?= $row['status'] ?>')">❌</button> -->
                                </div>
                            </td>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($row['code']) ?></td>

                            <td> <?= number_format($row['discount_value']) ?></td>
                            <td><?= number_format($row['min_order_value']) ?></td>
                            <td><?= number_format($row['usage_limit']) ?></td>
                            <td><?= number_format($row['used_count']) ?></td>
                            <td><?= $row['start_date'] ?></td>
                            <td><?= $row['end_date'] ?></td>
                            <td>
                                <?php
                                $renderColor = match ($row['status']) {
                                    'pendind' => 'warning',
                                    'active' => 'success',
                                    'expired' => 'danger',
                                    default => 'info'
                                };
                                ?>
                                <span onclick="handleUpdate('<?= $row['id'] ?>','<?= $index ?>', '<?= $row['status'] ?>')" data-index="<?= $index ?>" class="button-status badge bg-<?= $renderColor ?>"><?= $row['status'] ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">Không có dữ liệu coupons.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="pop_Up_Update_Coupons">

</div>
<script>
    handleUpdate = (rowId, tableIndex, currentStatus) => {
        var btnStatus = document.querySelector(`[data-index="${tableIndex}"]`);
        if (btnStatus.tagName === "SELECT") return
        // e.preventDefault();

        var select = document.createElement('select');
        select.className = "form-select form-select-sm";
        //Tạo option
        var options = [{
                value: 'pending',
                label: 'pending'
            },
            {
                value: 'active',
                label: 'active'
            },
            {
                value: 'expired',
                label: 'expired'
            },
        ];


        options.forEach(opt => {
            const option = document.createElement("option");
            option.value = opt.value;
            option.textContent = opt.label;

            // Nếu status hiện tại trùng thì set selected
            if (btnStatus.innerText.trim() === opt.label) {
                option.selected = true;
            }

            select.appendChild(option);
        });

        // Thay thế span bằng select
        btnStatus.replaceWith(select)


        select.addEventListener("change", function() {
            console.log("Trạng thái mới:", this.value);
            // Sau khi cập nhật có thể gửi fetch hoặc AJAX lên server tại đây
            fetch(`index.php?route=admin&action=list_coupons_page&actionCoupons=updateStatus&idCoupon=${rowId}&newStatus=${this.value}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Cập nhật thành công!");
                    } else {
                        alert("Có lỗi khi cập nhật!");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
            confirmUpdate(rowId, tableIndex, currentStatus)
        });
        select.setAttribute("data-index", tableIndex);
    }

    confirmUpdate = (rowId, tableIndex, currentStatus) => {

        var select = document.querySelector(`[data-index="${tableIndex}"]`);
        var selectedValue = select.value;
        var selectedLabel = select.options[select.selectedIndex].text;
        console.log(selectedValue);


        // Mapping màu theo status
        const statusColorMap = {
            'pending': 'warning',
            'active': 'success',
            'expired': 'danger'
        };

        // Tạo lại span
        const span = document.createElement("span");
        span.setAttribute("data-index", tableIndex);
        span.className = `button-status badge bg-${statusColorMap[selectedValue] || 'secondary'}`;
        span.id = `status-${tableIndex}`;
        span.innerText = selectedLabel;

        select.replaceWith(span);
        span.onclick = () => handleUpdate(rowId, tableIndex, selectedValue);
    }


    //Mở pop up sửa thông tin coupons
    const popup_coupons = document.querySelector('.pop_Up_Update_Coupons')
    edit_coupons = (id) => {
        fetch(`index.php?route=admin&action=list_coupons_page&actionCoupons=edit_coupons&idCoupon=${id}`)
            .then(res => res.text())
            .then(data => {
                popup_coupons.innerHTML = data;
                popup_coupons.style.display = 'block';
                const codeInput = document.getElementById("code");
                if (codeInput) {
                    window.oldCode = codeInput.value.trim().toUpperCase();
                }
            })
    }
    //đóng popup 
    window.addEventListener('click', function(e) {
        // Nếu popup đang hiển thị và click không nằm trong popup
        if (popup_coupons.style.display === 'block' && !popup_coupons.contains(e.target) && !e.target.matches('button.btn-success')) {
            popup_coupons.style.display = 'none';
        }
    })



    //-----------------validate-----------
    // document.addEventListener("DOMContentLoaded", function() {
    //     const form = document.getElementById("couponForm");

    //     form.addEventListener("submit", function(e) {
    //         let errors = [];

    //         const code = form.code.value.trim();f
    //         const minPrice = form.min_price.value.trim();
    //         const maxPrice = form.max_price.value.trim();
    //         const startDate = form.start_date.value;
    //         const endDate = form.end_date.value;

    //         // Validate mã giảm giá (nếu nhập thì chỉ chữ & số)
    //         if (code !== "" && !/^[A-Za-z0-9]{1,50}$/.test(code)) {
    //             errors.push("Mã giảm giá chỉ được nhập chữ và số (tối đa 50 ký tự).");
    //         }

    //         // Validate số tiền
    //         if (minPrice !== "" && minPrice < 0) {
    //             errors.push("Giá trị từ phải ≥ 0.");
    //         }
    //         if (maxPrice !== "" && maxPrice < 0) {
    //             errors.push("Giá trị đến phải ≥ 0.");
    //         }
    //         if (minPrice !== "" && maxPrice !== "" && Number(minPrice) > Number(maxPrice)) {
    //             errors.push("Giá trị từ không được lớn hơn giá trị đến.");
    //         }

    //         // Validate ngày
    //         if (startDate !== "" && endDate !== "" && startDate > endDate) {
    //             errors.push("Ngày bắt đầu không được lớn hơn ngày kết thúc.");
    //         }

    //         if (errors.length > 0) {
    //             e.preventDefault(); // chặn submit
    //             alert(errors.join("\n"));
    //         }
    //     });
    // });
</script>