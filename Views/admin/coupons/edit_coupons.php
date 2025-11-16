<script>
    const oldCode = "<?= $detailCoupons['code'] ?>".toUpperCase();
    console.log(oldCode)
</script>
<form action="index.php?route=admin&action=list_coupons_page&actionCoupons=edit_coupons&idCoupon=<?= $detailCoupons['id'] ?>" onsubmit="return validateEdit(event, array_filter1)" method="post">
    <div class="mb-3">
        <label for="code" class="form-label">Mã giảm giá</label>
        <input type="text" name="code" class="form-control" value="<?= $detailCoupons['code'] ?>" id="code">
    </div>
    <div class="mb-3">
        <label for="discount_value" class="form-label">Giá trị giảm</label>
        <input type="text" name="discount_value" class="form-control" value="<?= number_format($detailCoupons['discount_value']) ?>" id="discount_value_edit">
    </div>
    <div class="mb-3">
        <label for="usage_limit" class="form-label">Số lần sử dụng tối đa</label>
        <input type="number" name="usage_limit" class="form-control" value="<?= $detailCoupons['usage_limit'] ?>" id="usage_limit_edit">
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Ngày bắt đầu</label>
        <input type="date" name="start_date" class="form-control" value="<?= date('Y-m-d', strtotime($detailCoupons['start_date'])) ?>" id="start_date_edit">
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">Ngày kết thúc</label>
        <input type="date" name="end_date" class="form-control" value="<?= date('Y-m-d', strtotime($detailCoupons['end_date'])) ?>" id="end_date_edit">
    </div>

    <button type="submit" name="confirm_update_coupons" class="btn btn-primary">Submit</button>
</form>

