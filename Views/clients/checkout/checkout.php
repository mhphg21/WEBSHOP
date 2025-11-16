<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="Public/Css/Clients/checkout.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      /* nền mờ */
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9998;
    }

    #qrcode {
      background: white;
      padding: 20px;
      border-radius: 8px;
      z-index: 9999;
    }
  </style>

  <style>
    #modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      /* nền mờ */
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9998;
    }

    #popup-coupons {
      background: white;
      padding: 20px;
      border-radius: 13px;
      z-index: 9999;
    }
  </style>
</head>

<div id="container-checkout" style="display: none;"></div>

<body>
  <div class="container-checkout">
    <div class="head-checkouts">
      <div class="head-checkout">
        <div class="logo">
          <div id="logo" class="logo">2TGD</div>
        </div>

        <div class="step">
          <div class="step1">
            <span>1</span>
            <div class="title">Giỏ hàng</div>
          </div>
          <svg height="5" width="50px" xmlns="http://www.w3.org/2000/svg">
            <line
              x1="0"
              y1="10"
              x2="50"
              y2="10"
              style="stroke: #c4c8cc; stroke-width: 12" />
          </svg>
          <div class="step2">
            <span>2</span>
            <div class="title">Thanh toán</div>
          </div>
          <svg height="5" width="50px" xmlns="http://www.w3.org/2000/svg">
            <line
              x1="0"
              y1="10"
              x2="50"
              y2="10"
              style="stroke: #c4c8cc; stroke-width: 12" />
          </svg>
          <div class="step3">
            <span>3</span>
            <div class="title">Hoàn tất</div>
          </div>
        </div>
        <div style="cursor: pointer;" id="back-shop" href="index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>" class="back-shop">
          <div onclick="backShop()" class="back-shop">
            <div class="title">TIẾP TỤC MUA SẮM</div>
            <svg
              width="21"
              height="21"
              viewBox="0 0 21 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M3.22656 7.9598H14.4766C16.5476 7.9598 18.2266 9.63873 18.2266 11.7098C18.2266 13.7809 16.5476 15.4598 14.4766 15.4598H10.7266M3.22656 7.9598L6.5599 4.62646M3.22656 7.9598L6.5599 11.2931"
                stroke="#333F48"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <form method="post" id="checkoutForm">
      <div class="form-checkout">

        <div class="info-user-pro">
          <div class="checkout-form">
            <div class="title-form">
              <div class="icon"><i class="fa-regular fa-map"></i></div>
              <div class="title">Thông tin giao hàng</div>
            </div>

            <div class="f-checkout">
              <div class="name-checkout">
                <div class="text">Họ và tên</div>
                <input
                  type="text"
                  class="checkout"
                  id="name_order"
                  name="name_order"
                  value="<?= $i4_user['name'] ?>"
                  placeholder="Nhập họ tên" />
                <div id="validName"></div>
              </div>
              <div class="name-checkout">
                <div class="text">Số điện thoại</div>
                <input
                  type="text"
                  id="phone_order"
                  class="checkout"
                  name="phone_order"
                  value="<?= $i4_user['phone'] ?>"
                  placeholder="Nhập số điện thoại nhận hàng" />
                <div id="validPhone"></div>
              </div>
              <div class="name-checkout">
                <div class="text">Email</div>
                <input
                  type="text"
                  id="email_order"
                  class="checkout"
                  name="email_order"
                  value="<?= $i4_user['email'] ?>"
                  placeholder="Nhập email" />
                <div id="validEmail"></div>
              </div>
              <div class="name-checkout">
                <div class="text">Địa chỉ chi tiết</div>
                <input
                  type="text"
                  id="address_order"
                  class="checkout"
                  name="address_order"
                  value="<?= $i4_user['address'] ?>"
                  placeholder="Nhập chi tiết địa chỉ" />
                <div id="validAddress"></div>
              </div>
            </div>
          </div>

          <?php
          $colors = [];
          foreach ($color_item as $row) {
            $colors[$row['product_variant_id']] = $row['color_value'];
          }
          $sizes  = [];
          foreach ($size_item as $row) {
            $sizes[$row['product_variant_id']] = $row['size_value'];
          }
          ?>

          <div class="method-checkout">
            <div class="method-payment">
              <div class="icon">
                <i class="fa-solid fa-sack-dollar"></i>
              </div>
              <div class="title">Phương thức thanh toán</div>
            </div>
            <div class="payments">
              <div class="payment">
                <i class="fa-solid fa-money-bill"></i>
                <label style="cursor: pointer;" for="COD">Tiền mặt</label>
                <input
                  style="cursor: pointer;"
                  type="radio"
                  name="payment_method"
                  id="COD"
                  value="COD" />
              </div>
              <?php $total_bill_qr = 0;
              foreach ($array_items_by_cart_id as $row): ?>
                <?php $total_bill_qr += $row['sale_price'] * $row['quantity']; ?>
              <?php endforeach ?>
              <div class="payment">
                <i class="fa-solid fa-building-columns"></i>
                <label style="cursor: pointer;" for="Bank_Transfer">Chuyển khoản</label>
                <?php if (!isset($discount_value)) { ?>
                  <input style="cursor: pointer;" onclick="showQr(<?= $total_bill_qr ?>)"
                    type="radio"
                    name="payment_method"
                    id="Bank_Transfer"
                    value="Bank Transfer" />
                <?php } else { ?>
                  <input style="cursor: pointer;" onclick="showQr(<?= $total_bill_qr - $discount_value ?>)"
                    type="radio"
                    name="payment_method"
                    id="Bank_Transfer"
                    value="Bank Transfer" />
                <?php } ?>
                <!-- Overlay -->
              </div>
              <div id="overlay" style="display:none;">
                <div id="qrcode"></div>
              </div>
            </div>
            <div id="validPayment"></div>
          </div>

          <div class="product-checkout">
            <div class="total-pro">
              <i class="fa-solid fa-bag-shopping"></i>
              <div class="title">Sản phẩm</div>
            </div>
            <?php
            foreach ($array_items_by_cart_id as $row) {
            ?>
              <div class="info-checkout">
                <div class="img">
                  <img
                    width="100px"
                    src="Public/Img/uploads/<?= $row['thumbnail'] ?>"
                    alt="" />
                </div>
                <div class="info">
                  <div class="name-pro"><?= $row['name'] ?></div>
                  <div class="sku-pro"><?= $row['sku'] ?></div>
                  <div class="size-color-price">
                    <div class="size-color">
                      <div class="color"><?= $colors[$row['product_variant_id']] ?></div>
                      <span>|</span>
                      <div class="size"><?= $sizes[$row['product_variant_id']] ?></div>
                    </div>
                    <div class="price">
                      <del><?= number_format($row['price']) ?> VND</del>
                    </div>
                  </div>
                  <div class="quan-price">
                    <div class="quan">x<?= $row['quantity'] ?></div>
                    <div class="sale-price"><?= number_format($row['sale_price']) ?> VND</div>
                  </div>
                </div>
              </div>
              <hr>
            <?php } ?>
          </div>
        </div>
        <div class="info-bill">
          <div class="voucher-checkout">
            <div class="icon-title">
              <i class="fa-solid fa-ticket-simple"></i>
              <div class="title">Mã ưu đãi</div>
            </div>

            <?php if (!isset($code_coupon)) { ?>
              <div style="cursor: pointer;" onclick="chooseCoupons(<?= $total_bill_qr ?>)" class="choose-voucer">
                <div class="text">Chọn hoặc nhập mã</div>
                <i class="fa-solid fa-angle-right"></i>
              </div>
            <?php } else { ?>
              <div style="cursor: pointer;" onclick="chooseCoupons(<?= $total_bill_qr ?>)" class="choose-voucer">
                <div class="text"><?= $code_coupon ?></div>
                <i class="fa-solid fa-angle-right"></i>
              </div>
            <?php } ?>

            <div id="modal" style="display: none;">
              <div id="popup-coupons"></div>
            </div>
          </div>
          <div class="bill-checkout">
            <div class="icon-title">
              <i class="fa-solid fa-receipt"></i>
              <div class="title">Chi tiết đơn hàng</div>
            </div>
            <div class="bill-detail">
              <?php $total_items = 0;
              foreach ($array_items_by_cart_id as $row): ?>
                <?php $total_items += $row['price'] * $row['quantity']; ?>
              <?php endforeach ?>
              <div class="value-item">
                <div class="text">Giá trị đơn hàng</div>
                <div class="price"><?= number_format($total_items) ?> VND</div>
              </div>

              <?php $total_sale = 0;
              foreach ($array_items_by_cart_id as $row): ?>
                <?php $total_sale += $row['price'] - $row['sale_price']; ?>
              <?php endforeach ?>
              <div class="sale-item">
                <div class="text">Giảm giá trực tiếp</div>
                <div class="price">-<?= number_format($total_sale) ?> VND</div>
              </div>

              <?php if (!isset($discount_value)) { ?>
                <div class="sale-item">
                  <div class="text">Giảm giá từ voucher</div>
                  <div class="price">-0 VND</div>
                </div>
              <?php } else { ?>
                <div class="sale-item">
                  <div class="text">Giảm giá từ voucher</div>
                  <div class="price">-<?= number_format($discount_value) ?> VND</div>
                </div>
              <?php } ?>

              <div class="value-item">
                <div class="text">Phí vận chuyển</div>
                <div class="price">0 VND</div>
              </div>
            </div>
            <hr>
            <div class="total-bill">
              <?php $total_bill = 0;
              foreach ($array_items_by_cart_id as $row): ?>
                <?php $total_bill += $row['sale_price'] * $row['quantity']; ?>
              <?php endforeach ?>
              <div class="total">
                <div class="text">Tổng tiền thanh toán</div>

                <?php if (!isset($discount_value)) { ?>
                  <div class="price"><?= number_format($total_bill) ?> VND</div>
                <?php } else { ?>
                  <div class="price"><?= number_format($total_bill - $discount_value) ?> VND</div>
                <?php } ?>

              </div>

              <?php if (!isset($discount_value)) { ?>
                <input type="hidden" name="total_price" value="<?= $total_bill ?>">
              <?php } else { ?>
                <input type="hidden" name="total_price" value="<?= $total_bill - $discount_value ?>">
              <?php } ?>

              <?php if (!isset($discount_value)) { ?>
                <div class="save-money">Tiết kiệm <?= number_format($total_sale) ?> VND</div>
              <?php } else { ?>
                <div class="save-money">Tiết kiệm <?= number_format($total_sale + $discount_value) ?> VND</div>
              <?php } ?>
            </div>
            <input type="hidden" name="test_voucher" value="<?= $_GET['coupon_id'] ?? '' ?>">
            <button style="cursor: pointer;" type="submit" name="check_out">Đặt hàng</button>
          </div>
        </div>
    </form>
  </div>
  </div>
  <script>
    function FormValidate() {
      const form = document.getElementById('checkoutForm');
      if (!form) return;
      form.addEventListener('submit', function(event) {
        const name_order = document.getElementById("name_order").value;
        const phone_order = document.getElementById("phone_order").value.trim();
        const email_order = document.getElementById("email_order").value;
        const address_order = document.getElementById("address_order").value;
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

        const validName = document.getElementById("validName");
        const validPhone = document.getElementById("validPhone");
        const validEmail = document.getElementById("validEmail");
        const validAddress = document.getElementById("validAddress");
        const validPayment = document.getElementById("validPayment");

        let isValid = true;

        if (name_order === "") {
          validName.innerText = "Họ tên không được để trống";
          isValid = false;
        } else {
          validName.innerText = "";
        }

        if (phone_order === "") {
          validPhone.innerText = "Số điện thoại không được để trống";
          isValid = false;
        } else if (!/^0\d{9,11}$/.test(phone_order)) {
          validPhone.innerText = "Số điện thoại phải có 10 chữ số và bắt đầu bằng số 0";
          isValid = false;
        } else {
          validPhone.innerText = "";
        }

        if (email_order === "") {
          validEmail.innerText = "Vui lòng nhập email";
          isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email_order)) {
          validEmail.innerText = "Vui lòng nhập đúng định dạng email";
          isValid = false;
        } else {
          validEmail.innerText = "";
        }

        if (address_order === "") {
          validAddress.innerText = "Địa chỉ nhận hàng không được để trống";
          isValid = false;
        } else {
          validAddress.innerText = "";
        }

        let isChecked = false;
        paymentRadios.forEach((radio) => {
          if (radio.checked) isChecked = true;
        });

        if (!isChecked) {
          validPayment.innerText = 'Vui lòng chọn phương thức thanh toán';
          isValid = false;
        } else {
          validPayment.innerText = '';
        }

        if (!isValid) {
          event.preventDefault();
        }
      })
    }

    function showQr(total) {
      const overlay = document.getElementById('overlay');
      const popupQrCode = document.getElementById('qrcode');
      fetch(`index.php?route=clients&action=list_cart&action_cart=check_out&act_checkout=qrcode&total=${total}`)
        .then(res => res.text())
        .then(data => {
          popupQrCode.innerHTML = data;
          overlay.style.display = 'flex';
        });
    }

    document.addEventListener('click', function(e) {
      const overlay = document.getElementById('overlay');
      if (e.target === overlay) {
        overlay.style.display = 'none';
        document.getElementById("Bank_Transfer").checked = false;
      }
    });


    function cancelQr() {
      const overlay = document.getElementById('overlay');
      if (confirm("Bạn thực sự muốn hủy giao dịch?")) {
        overlay.style.display = "none";
        document.getElementById("Bank_Transfer").checked = false;
      }
    }

    function confirmQr() {
      const overlay = document.getElementById('overlay');
      if (confirm("Xác nhận đã chuyển?")) {
        overlay.style.display = "none";
      }
    }

    document.addEventListener("click", function(e) {
      const logo = document.getElementById("logo");
      if (logo && e.target === logo) {
        e.preventDefault();
        if (confirm("Quý khách vui lòng không thoát khỏi trang khi đã thanh toán!!")) {
          window.location.href = "index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>";
        }
      }
    });

    function backShop() {
      if (confirm("Quý khách vui lòng không thoát khỏi trang khi đã thanh toán!!")) {
        window.location.href = "index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>";
      }
    }

    function chooseCoupons(totalBill) {
      const modal = document.getElementById('modal');
      const popupCoupons = document.getElementById("popup-coupons");
      fetch(`index.php?route=clients&action=list_cart&action_cart=check_out&act_checkout=popup_coupons&total_bill=${totalBill}`)
        .then(res => res.text())
        .then(data => {
          popupCoupons.innerHTML = data;
          modal.style.display = 'flex';
        });
    }

    document.addEventListener('click', function(e) {
      const modal = document.getElementById('modal');
      if (modal && e.target === modal) {
        modal.style.display = 'none';
      }
    });

    var selectedVoucher = '';

    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('voucher')) {
        const minOrderValue = parseFloat(e.target.getAttribute('data-min-order'));
        const totalBill = parseFloat(e.target.getAttribute('data-total-bill'));
        const validCoupon = document.getElementById('check_bill_valid');

        if (totalBill < minOrderValue) {
          validCoupon.innerText = "Đơn hàng của bạn không đủ điều kiện để sử dụng voucher này";
          e.target.checked = false;
          selectedVoucher = '';
          return;
        }

        validCoupon.innerText = "";
        const voucherInput = document.getElementById("voucher_id");
        selectedVoucher = e.target.getAttribute("data-coupons");
        voucherInput.value = selectedVoucher;
        console.log('selectedVoucher: ', selectedVoucher);
      }
    });



    const postIdVoucher = () => {
      const modal = document.getElementById('modal');
      if (!selectedVoucher) {
        modal.style.display = 'none';
        return;
      }
      fetch(`index.php?route=clients&action=list_cart&action_cart=check_out&coupon_id=${selectedVoucher}`)
        .then(res => res.text())
        .then(data => {
          document.querySelector('.container-checkout').style.display = 'none';
          document.querySelector('#container-checkout').innerHTML = data;
          document.querySelector('#container-checkout').style.display = 'block';

          FormValidate();
        })
    }
    FormValidate();
    function closePopup() {
      const modal = document.getElementById('modal');
      modal.style.display = 'none';
    }
  </script>
</body>


</html>