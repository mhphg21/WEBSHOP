<style>
  .container-order-detail {
    width: 70%;
    display: flex;
    flex-direction: column;
    gap: 20px;
    box-sizing: border-box;
  }

  /* --- Header --- */
  .container-order-detail .head-order-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #ccc;
  }

  .container-order-detail .head-order-detail a {
    text-decoration: none;
    color: #444;
  }

  .container-order-detail .head-order-detail .back {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
  }

  .container-order-detail .head-order-detail .sku-status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
  }

  .container-order-detail .head-order-detail .sku-status .status-order {
    color: #FF0000;
  }

  /* --- Thông tin người nhận --- */
  .container-order-detail .info-user-order-detail {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 10px 0;
    border-bottom: 1px solid #ccc;
  }

  .container-order-detail .info-user-order-detail .info-user {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .container-order-detail .info-user .title-order-detail {
    font-weight: 600;
    margin-bottom: 5px;
  }

  .container-order-detail .info-user .info {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .container-order-detail .address-order {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .container-order-detail .status-detail {
    text-align: right;
    display: flex;
    font-size: 14px;
    gap: 15px;
  }

  .container-order-detail .status-detail .status {
    color: #FF0000;
  }

  /* --- Thông tin sản phẩm --- */
  .container-order-detail .info-pro-oder {
    padding: 10px 0;
    display: flex;
    flex-direction: column;
    gap: 15px;
    border-bottom: 1px solid #ccc;
  }

  .container-order-detail .header1-oder .name-pro-oder {
    font-weight: 600;
    font-size: 16px;
  }

  .container-order-detail .info-oders {
    display: flex;
    gap: 15px;
  }

  .container-order-detail .img-oder img {
    width: 100px;
    height: auto;
    border-radius: 4px;
    object-fit: cover;
  }

  .container-order-detail .info-oder {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .container-order-detail .des-oder {
    font-size: 14px;
    color: #444;
  }

  .container-order-detail .price-type-order {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .container-order-detail .price-type-order .price-type {
    color: gray;
  }

  .container-order-detail .pro-type-oder {
    font-size: 14px;
    font-style: italic;
    color: #555;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .container-order-detail .quantity-price-oder {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
  }

  /* --- Thông tin hóa đơn --- */
  .container-order-detail .bill-order {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 10px 0;
  }

  .container-order-detail .bill-order>div {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .container-order-detail .total-order .text {
    font-size: 16px;
    font-weight: 700;
  }

  .container-order-detail .total-order .price {
    font-size: 20px;
    color: #FF0000;
    font-weight: 800;
  }

  .container-order-detail .method-order .methods {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .container-order-detail .method-order .noti {
    font-size: 14px;
    color: #d9534f;
    font-weight: 500;
  }
</style>

<?php
if (!function_exists('convertEtoV')) {
  function convertEtoV($status)
  {
    return match ($status) {
      'processing' => "Đang xử lí",
      'shipping' => "Đang vận chuyển",
      'delivered' => "Đã giao hàng",
      'cancelled' => "Đơn hàng bị hủy",
      default => $status
    };
  }
}
$status = $info_order['status'];
$statusV = convertEtoV($status);
?>

<div class="container-order-detail">
  <div class="head-order-detail">
    <a href="index.php?route=clients&action=profile&action_acc=oder<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>">
      <div class="back">
        <div class="icon-back">
          <i class="fa-solid fa-arrow-left"></i>
        </div>
        <div class="text-back">TRỞ LẠI</div>
      </div>
    </a>
    <div class="sku-status">
      <!-- <div class="sku-order">MÃ ĐƠN HÀNG. SKJASLFJA</div>
      <span>|</span> -->
      <div class="status-order"><?= $statusV ?></div>
    </div>
  </div>
  <div class="info-user-order-detail">
    <div class="info-user">
      <div class="title-order-detail">Địa Chỉ Nhận Hàng</div>
      <div class="info">
        <div class="name-user"><?= $info_order['name_order'] ?></div>
        <div class="address-order">
          <div class="phone">0<?= $info_order['phone_order'] ?></div>
          <div class="address"><?= $info_order['shipping_address'] ?></div>
        </div>
      </div>
    </div>
    <div class="status-detail">
      <div class="time-detail"><?= $info_order['updated_at'] ?></div>
      <div class="status"><?= $statusV ?></div>
    </div>
  </div>

  <div class="info-pro-oder">

    <?php
    $colors = [];
    foreach ($info_color as $row) {
      $colors[$row['product_variant_id']] = $row['color_value'];
    }

    $sizes = [];
    foreach ($info_size as $row) {
      $sizes[$row['product_variant_id']] = $row['size_value'];
    }
    ?>
    <?php
    foreach ($info_items as $row) {
    ?>
      <div style="font-weight: 600;"><?= $row['name'] ?></div>
      <div class="info-oders">
        <div class="img-oder">
          <a href="index.php?route=clients&action=detail&id=<?= $row['product_variant_id'] ?><?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>">
            <img width="100px" src="Public/Img/uploads/<?= $row['thumbnail'] ?>" alt="" />
          </a>
        </div>
        <div class="info-oder">
          <div class="des-oder">
            <?= $row['description'] ?>
          </div>
          <div class="price-type-order">
            <div class="pro-type-oder">
              <div class="text">Phân loại hàng:</div>
              <div class="color"><?= $colors[$row['product_variant_id']] ?></div>
              <span>|</span>
              <div class="size"><?= $sizes[$row['product_variant_id']] ?></div>
            </div>
            <div class="price-type"><del><?= number_format($row['pv_price']) ?>đ</del></div>
          </div>

          <div class="quantity-price-oder">
            <div class="quantity-oder">x<?= $row['quantity'] ?></div>
            <div class="price-oder"><?= number_format($row['price']) ?>đ</div>
          </div>
        </div>
      </div>
      <hr>
    <?php } ?>
  </div>
  <hr>
  <?php $total_items = 0;
  foreach ($info_items as $row): ?>
    <?php $total_items += $row['pv_price'] * $row['quantity']; ?>
  <?php endforeach ?>

  <div class="bill-order">
    <div class="total-price">
      <div class="text">Tổng tiền hàng</div>
      <div class="price"><?= number_format($total_items) ?>đ</div>
    </div>

    <?php $total_sale = 0;
    foreach ($info_items as $row): ?>
      <?php $total_sale += $row['pv_price'] - $row['price']; ?>
    <?php endforeach ?>

    <div class="voucher-order">
      <div class="text">Giảm giá trực tiếp</div>
      <div class="price">-<?= number_format($total_sale) ?>đ</div>
    </div>

    <?php if (!isset($info_order['discount_value'])) { ?>
      <div class="voucher-order">
        <div class="text">Giảm giá từ voucher</div>
        <div class="price">-0 VND</div>
      </div>
    <?php } else { ?>
      <div class="voucher-order">
        <div class="text">Giảm giá từ voucher</div>
        <div class="price">-<?= number_format($info_order['discount_value']) ?>đ</div>
      </div>
    <?php } ?>

    <div class="voucher-order">
      <div class="text">Phí vận chuyển</div>
      <div class="price">-0đ</div>
    </div>

    <div class="total-order">
      <div class="text">Thành tiền</div>
      <div class="price"><?= number_format($info_order['total_price']) ?>đ</div>
    </div>
    <div class="method-order">
      <div class="methods">
        <?php
        $status = $info_order['status'];
        $payment_method = $info_order['payment_method'];
        $actionText = '';
        $showAction = true;

        if ($status !== 'cancelled' && $status !== 'delivered' && $payment_method === 'COD') {
          $totalFormatted = number_format($info_order['total_price']);
          $actionText = "Vui lòng thanh toán {$totalFormatted}đ khi nhận hàng.";
        } else {
          $showAction = false;
        }
        ?>

        <?php if ($showAction): ?>
          <div class="noti"><?= $actionText ?></div>
        <?php endif; ?>

        <div class="text">Phương thức thanh toán</div>
      </div>
      <div class="method"><?= $info_order['payment_method'] ?></div>
    </div>
  </div>
</div>