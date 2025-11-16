<?php
// Lấy danh sách code từ mảng coupons
$array_filter = array_column($array_code_coupons, 'code');
?>
<script>
    // Truyền mảng code từ PHP sang JS
    const array_filter1 = <?= json_encode($array_filter) ?>;

    // function validateForm(e, codes) {
    //     const code = document.getElementById("code").value.trim();

    //     if (codes.includes(code)) {
    //         alert("Mã giảm giá đã tồn tại, vui lòng nhập mã khác!");
    //         e.preventDefault();
    //         return false;
    //     }
    //     return true;
    // }
</script>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="mb-4 text-center fw-semibold text-primary">Thêm coupons</h4>

                    <form onsubmit="return validateForm(event, array_filter1)" method="post" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" name="code" class="form-control rounded-3" id="code" placeholder="Nhập mã giảm giá" required>
                            <label for="code">Mã giảm giá</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="discount_value" class="form-control rounded-3" id="discount_value" placeholder="Nhập giá trị giảm" required>
                            <label for="discount_value">Giá trị giảm</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="min_order_value" class="form-control rounded-3" id="min_order_value" placeholder="Nhập giá trị đơn hàng tối thiểu">
                            <label for="min_order_value">Giá trị đơn hàng tối thiểu</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="usage_limit" class="form-control rounded-3" id="usage_limit" min="1" placeholder="Nhập số lần sử dụng tối đa">
                            <label for="usage_limit">Số lần sử dụng tối đa</label>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="start_date" class="form-control rounded-3" id="start_date" required>
                                    <label for="start_date">Ngày bắt đầu</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="end_date" class="form-control rounded-3" id="end_date" required>
                                    <label for="end_date">Ngày kết thúc</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" name="confirm_create_coupons" class="btn btn-primary rounded-3 py-2 fw-semibold">
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm(e, array_filter1) {
        // e.preventDefault();

        let code = document.getElementById("code").value.trim().toUpperCase(); // chuyển về chữ hoa
        let codes = array_filter1.map(c => c.toUpperCase()); // chuyển toàn bộ mảng về chữ hoa
        let discount = document.getElementById("discount_value").value.trim().replace(/[^\d.]/g, ""); // bỏ dấu phẩy và các ký tự không phải số
        let min_order_value = document.getElementById("min_order_value").value.trim().replace(/,/g, ""); // bỏ dấu phẩy nếu có
        let usage = document.getElementById("usage_limit").value.trim();
        let start = document.getElementById("start_date").value;
        let end = document.getElementById("end_date").value;

        if (code === "" || codes.includes(code)) {
            alert("Mã giảm giá không được để trống hoặc đã tồn tại");
            e.preventDefault();
            return false;
        }
        alert('đang chạy');
        if (discount === "" || isNaN(discount) || Number(discount) <= 0) {
            alert("Giá trị giảm phải là số dương");
            e.preventDefault();
            return false;
        }
        if (min_order_value === "" || isNaN(min_order_value) || Number(min_order_value) <= 0) {
            alert("Giá trị đơn hàng tối thiểu phải là số dương");
            e.preventDefault();
            return false;
        }

        if (usage === "" || isNaN(usage) || Number(usage) <= 0) {
            alert("Số lần sử dụng phải là số dương");
            e.preventDefault();
            return false;
        }

        if (start === "") {
            alert("Vui lòng chọn ngày bắt đầu");
            e.preventDefault();
            return false;
        }

        if (end === "") {
            alert("Vui lòng chọn ngày kết thúc");
            e.preventDefault();
            return false;
        }

        if (new Date(end) < new Date(start)) {
            alert("Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu");
            e.preventDefault();
            return false;
        }

        return true;
    }
</script>