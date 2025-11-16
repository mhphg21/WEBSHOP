<style>
  .container-list-oder {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    width: 70%;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .container-list-oder h1 {
    color: #29323A;
    margin-bottom: 5px;
    font-size: 24px;
  }

  .container-list-oder .info-pro-oder {
    border: 1px solid #EAEAEA;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .container-list-oder .info-pro-oder .header1-oder {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .container-list-oder .info-pro-oder .header1-oder .name-pro-oder {
    font-weight: 600;
  }

  .container-list-oder .info-pro-oder .header1-oder .status-oder {
    color: #FF0000;
    font-weight: bold;
  }

  .container-list-oder .info-pro-oder .info-oders {
    display: flex;
    gap: 20px;
    /* width: 100%; */
  }

  .container-list-oder .info-pro-oder .info-oders .info-oder {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
  }

  .container-list-oder .info-pro-oder .info-oders .info-oder .des-oder {
    width: 70%;
    font-size: 14px;
  }

  .container-list-oder .info-pro-oder .info-oders .info-oder .pro-type-oder {
    color: #7a7a7aff;
  }

  .container-list-oder .info-pro-oder .info-oders .price-type-order {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .container-list-oder .info-pro-oder .info-oders .price-type-order .price-type {
    color: gray;
  }

  .container-list-oder .info-pro-oder .info-oders .info-oder .quantity-price-oder {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .container-list-oder .info-pro-oder .info-oders .info-oder .quantity-price-oder .price-oder {
    color: #29323A;
    font-weight: 600;
  }

  .container-list-oder .total-oder {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid #EAEAEA;
    background-color: #FFFEFB;
    padding: 20px;
  }

  .container-list-oder .total-oder .action-oder {
    background-color: #FF0000;
    padding: 15px 15px;
    border-radius: 3px;
    cursor: pointer;
  }

  .container-list-oder .total-oder .action-button {
    text-decoration: none;
    color: white;
    font-weight: 500;
  }

  .container-list-oder .total-oder .total {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .container-list-oder .total-oder .total .total-num {
    color: #FF0000;
    font-weight: 900;
    font-size: 22px;
  }
</style>

<div class="container-list-oder">
  <h1>Đơn mua (<?= $count_order ?>)</h1>
  <?php
  $colors = [];
  foreach ($list_color as $item) {
    $colors[$item['product_variant_id']] = $item['color_value'];
  }

  $sizes = [];
  foreach ($list_size as $item) {
    $sizes[$item['product_variant_id']] = $item['size_value'];
  }
  ?>
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
  ?>
  <?php
  foreach ($list_order as $item) {
  ?>
    <div class="list-oders">
      <div class="info-pro-oder">
        <div class="header1-oder">
          <div class="name-pro-oder"><?= $item['name'] ?></div>
          <?php
          $status = $item['status'];
          $statusV = convertEtoV($status);
          ?>
          <div class="status-oder"><?= $statusV ?></div>
        </div>
        <div class="hr">
          <hr>
        </div>
        <div class="info-oders">
          <div class="img-oder">
            <a href="index.php?route=clients&action=profile&action_acc=oder&action_oder=oder_detail&order_id=<?= $item['order_id'] ?>"><img width="100px" src="Public/Img/uploads/<?= $item['thumbnail'] ?>" alt="" /></a>
          </div>
          <div class="info-oder">
            <div class="des-oder">
              <?= $item['description'] ?>
            </div>
            <div class="price-type-order">
              <div class="pro-type-oder">Phân loại hàng: <?= $colors[$item['product_variant_id']] ?>, <?= $sizes[$item['product_variant_id']] ?></div>
              <div class="price-type"><del><?=number_format($item['pv_price'])?>đ</del></div>
            </div>

            <div class="quantity-price-oder">
              <div class="quantity-oder">x<?= $item['quantity'] ?></div>
              <div class="price-oder"><?= number_format($item['price']) ?>đ</div>
            </div>
          </div>
        </div>
      </div>
      <div class="total-oder">
        <?php
        $status = $item['status'];
        $actionText = '';
        $showAction = true;

        $processing = ($status === 'processing');
        $shipping   = ($status === 'shipping');
        $cancelled  = ($status === 'cancelled' || $status === 'delivered');


        if ($status === 'processing') {
          $actionText = 'Hủy đơn hàng';
        } elseif ($status === 'shipping') {
          $actionText = 'Đã nhận được hàng';
        } else if ($status === 'cancelled' || $status === 'delivered') {
          $actionText = 'Mua lại';
        } else {
          $showAction = false;
        }
        ?>


        <?php if ($showAction): ?>
          <a onclick="actionOder(<?= $processing ? 'true' : 'false' ?>, <?= $shipping ? 'true' : 'false' ?>, <?= $cancelled ? 'true' : 'false' ?>, <?= $item['order_id'] ?>, <?= $item['product_variant_id'] ?>)" class="action-button">
            <div class="action-oder">
              <?= $actionText ?>
            </div>
          </a>
        <?php endif; ?>
        <div class="total">
          <div class="total-text">Thành tiền:</div>
          <div class="total-num"><?= number_format($item['total_price']) ?>đ</div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>