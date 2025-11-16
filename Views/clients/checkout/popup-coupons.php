<style>
  .modal-content {
    width: 350px;
    /* border-radius: 12px;
    padding: 20px; */
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    padding-top: 10px;
  }

  .header-modal-content {
    display: flex;
    justify-content: space-between;
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .voucher-input {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }

  .voucher-input input {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  .voucher-input .btn-apply {
    background: #ccc;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    color: white;
  }

  .voucher-section {
    max-height: 800px;
    overflow-y: auto;
  }

  .group-title {
    padding: 6px 10px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 8px;
  }

  .group-title.best {
    background: #4caf50;
    color: white;
  }

  .group-title.personal {
    background: #f0f0f0;
  }

  .voucher-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f9f9f9;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 10px;
  }

  .voucher-info h3 {
    margin: 0 0 4px;
    font-size: 16px;
  }

  .voucher-info p {
    font-size: 12px;
  }

  .voucher-info .code {
    font-size: 14px;
  }

  .voucher-info .expiry {
    font-size: 14px;
  }

  .voucher-info .code span {
    background: #eee;
    padding: 2px 4px;
    border-radius: 4px;
  }

  .btn-apply-bottom {
    width: 100%;
    padding: 12px;
    background: #d32f2f;
    color: white;
    border: none;
    border-radius: 6px;
    margin-top: 20px;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #check_bill_valid {
    color: red;
    font-size: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .empty {
    display: flex;
    justify-content: center;
    margin-top: 40px;
  }
</style>

<div class="modal-content">
  <div class="header-modal-content">
    <div></div>
    <h2>MÃ ƯU ĐÃI</h2>
    <div style="cursor: pointer;" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></div>
  </div>
  <?php
    if(empty($coupons)) {
  ?>
    <div class="empty">Bạn không có mã ưu đãi nào.</div>
  <?php
    } else {
  ?>
  <div class="voucher-section">
    <div class="voucher-group">
      <div class="group-title best">Lựa chọn tốt nhất</div>
      <?php
      foreach ($coupons as $row) {
      ?>
        <div class="voucher-item">
          <div class="voucher-info">
            <h3>Voucher <?= number_format($row['discount_value'] / 1000) ?>K</h3>
            <p>Giảm <?= number_format($row['discount_value'] / 1000) ?>K cho tất cả các đơn từ <?= number_format($row['min_order_value'] / 1000) ?>K</p>
            <div class="code">Mã: <span><?= $row['code'] ?></span></div>
            <div class="expiry">HSD: <?= $row['end_date'] ?></div>
          </div>
          <input
            data-coupons="<?= $row['id'] ?>"
            data-min-order="<?= $row['min_order_value'] ?>"
            data-total-bill="<?= $total_bill ?>"
            type="radio"
            name="coupon_id"
            class="voucher"
            style="cursor: pointer;" />
        </div>
        <div id="check_bill_valid"></div>
      <?php } ?>
    </div>
  </div>
  <input type="hidden" name="voucher_id" id="voucher_id" value="">
  <div onclick="postIdVoucher()" style="cursor: pointer;" class="btn-apply-bottom">ÁP DỤNG</div>
  <?php } ?>
</div>