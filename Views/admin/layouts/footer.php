</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    // document.addEventListener("submit", function(e) {
    //     let code = document.getElementById("code").value.trim();
    //     let discount = document.getElementById("discount_value").value.trim().replace(/,/g, ""); // bỏ dấu phẩy nếu có
    //     let usage = document.getElementById("usage_limit").value.trim();
    //     let start = document.getElementById("start_date").value;
    //     let end = document.getElementById("end_date").value;
    //     if (code === "") {
    //         alert("Mã giảm giá không được để trống");
    //         e.preventDefault();
    //         return;
    //     }

    //     if (discount === "" || isNaN(discount) || Number(discount) <= 0) {
    //         alert("Giá trị giảm phải là số dương");
    //         e.preventDefault();
    //         return;
    //     }

    //     if (usage === "" || isNaN(usage) || Number(usage) <= 0) {
    //         alert("Số lần sử dụng phải là số dương");
    //         e.preventDefault();
    //         return;
    //     }

    //     if (start === "") {
    //         alert("Vui lòng chọn ngày bắt đầu");
    //         e.preventDefault();
    //         return;
    //     }

    //     if (end === "") {
    //         alert("Vui lòng chọn ngày kết thúc");
    //         e.preventDefault();
    //         return;
    //     }

    //     if (new Date(end) < new Date(start)) {
    //         alert("Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu");
    //         e.preventDefault();
    //         return;
    //     }
    // });


    function validateEdit(e, array_filter1) {
        let code = document.getElementById("code").value.trim().toUpperCase(); // chuyển về chữ hoa
        let codes = array_filter1.map(c => c.toUpperCase()); // chuyển toàn bộ mảng về chữ hoa
        let discount = document.getElementById("discount_value_edit").value.trim().replace(/[^\d.]/g, ""); // bỏ dấu phẩy và các ký tự không phải số
        let usage = document.getElementById("usage_limit_edit").value.trim();
        let start = document.getElementById("start_date_edit").value;
        let end = document.getElementById("end_date_edit").value;

        if (code === "" ) {
            alert("Mã giảm giá không được để trống");
            e.preventDefault();
            return false;
        }

        // ✅ Nếu code thay đổi thì mới kiểm tra trùng
        if (code !== oldCode && array_filter1.includes(code)) {
            alert("Mã giảm giá đã tồn tại");
            e.preventDefault();
            return false;
        }
        if (discount === "" || isNaN(discount) || Number(discount) <= 0) {
            alert("Giá trị giảm phải là số dương");
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

</html>