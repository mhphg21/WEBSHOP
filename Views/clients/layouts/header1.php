<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .popup-list-cart {
      position: fixed;
      top: 0;
      right: 0;
      z-index: 9999;
      background-color: white;
      box-shadow: -2px 0 8px rgba(0, 0, 0, 0.2);
      /* padding: 20px; */
      border-radius: 0;
      width: 32%;
      /* height: 86vh; */
      display: none;
      overflow-y: auto;
      transition: transform 0.3s ease-in-out;
    }

    .popup-list-cart {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
  </style>

  <style>
    body {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    .container-header1 {
      margin: 0 auto;
      width: 100%;
    }

    .container-header1 .header1 {
      width: 100%;
      background-color: #29323a;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      /* position: relative; */
    }

    .container-header1 .header1 div {
      color: #ffe700;
      font-size: 14px;
      font-weight: 600;
      width: auto;
      /* font-family: "Montserrat-Medium"; */
    }

    .container-header1 .nav-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 90%;
      margin: 0 auto;
      margin-top: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
      /* position: sticky; */
    }

    .container-header1 .nav-header .nav-logo {
      text-decoration: none;
      /* font-family: "Montserrat-Bold"; */
      font-weight: bold;
      font-size: 20px;
      color: white;
      background-color: #ff0000;
      padding: 10px;
      cursor: pointer;
      width: auto;
    }

    .container-header1 .nav-header .categories ul {
      display: flex;
      gap: 30px;
      width: auto;
    }

    .container-header1 .nav-header .categories ul li {
      list-style: none;
      /* font-family: "Montserrat-Bold"; */
      font-size: 12px;
      font-weight: 700;
      width: auto;
    }

    .container-header1 .nav-header .categories ul li a {
      text-decoration: none;
      color: #29323a;
      cursor: pointer;
      text-transform: uppercase;
      width: auto;
    }

    .container-header1 .nav-header .categories ul li a:hover {
      color: #ff0000;
    }

    .container-header1 .nav-header .search-header {
      position: relative;
      display: flex;
      align-items: center;
      width: auto;
    }

    .container-header1 .nav-header .search-header .form-header {
      display: flex;
      gap: 7px;
      width: auto;
    }

    .container-header1 .nav-header .search-header .form-header .bt-header {
      border-radius: 5px;
      background-color: white;
      max-width: 80px;
      cursor: pointer;
      width: auto;
    }


    .container-header1 .nav-header .search-header .form-header .input-header {
      padding: 6px;
      max-width: 200px;
      border-radius: 5px;
      width: auto;
    }


    .container-header1 .nav-header .nav-right {
      display: flex;
      align-items: center;
      gap: 30px;
      width: auto;
    }

    .container-header1 .nav-header .nav-right .shop div {
      display: flex;
      flex-direction: column;
      gap: 2px;
      align-items: center;
      justify-content: center;
      width: auto;
      text-decoration: none;
      color: #29323a;
      font-size: 10px;
      cursor: pointer;
    }

    .container-header1 .nav-header .nav-right .shop a {
      display: flex;
      flex-direction: column;
      gap: 2px;
      align-items: center;
      justify-content: center;
      width: auto;
    }

    .container-header1 .nav-header .nav-right .shop a {
      text-decoration: none;
      color: #29323a;
      font-size: 10px;
      cursor: pointer;
      width: auto;
    }

    .container-header1 .nav-header .nav-right .shop a:hover {
      color: #ff0000;
    }

    .footer {
      margin-top: 60px;
      width: 100%;
      padding-top: 20px;
      padding-bottom: 50px;
      background-color: #29323A;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      width: 80%;
      margin: 0 auto;
    }

    .footer-container h3 {
      font-size: 14px;
      color: white;
    }

    .footer-container .ul {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .footer-container .ul .li a {
      text-decoration: none;
      color: #bfbfbeff;
      font-size: 14px;
    }

    .footer-container .social-icons {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .footer-container .social-icons a {
      text-decoration: none;
      color: white;
    }

    .cart-badge {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: #ff0000;
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: bold;
      border: 2px solid white;
    }

    .cart-container {
      position: relative;
      display: inline-block;
    }
  </style>
</head>

<body>
  <div class="container-header1">
    <header class="header1">
      <div>ĐỔI TRẢ HÀNG MIỄN PHÍ - TẠI TẤT CẢ CÁC CỬA HÀNG TRONG 30 NGÀY</div>
    </header>
    <div class="nav-header">
      <a class="nav-logo" href="index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>">
        <div class="logo">2PNH</div>
      </a>
      <div class="categories">
        <ul>
          <?php
          foreach ($categories as $row) {
          ?>
            <li><a href="index.php?route=clients&action=pro_cate&cate_id=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="search-header">
        <form id="searchForm" class="form-header" method="POST" action="index.php?route=clients&action=search" onsubmit="return validateSearch()">
          <input id="searchInput" class="input-header" name="search" type="text" placeholder="Tìm kiếm sản phẩm.." />
          <button class="bt-header" name="search-pro" type="submit">Tìm kiếm</button>
        </form>
      </div>
      <script>
      function validateSearch() {
          const searchInput = document.getElementById('searchInput');
          const keyword = searchInput.value.trim();
          
          // Kiểm tra rỗng
          if (keyword === '') {
              alert('Vui lòng nhập từ khóa tìm kiếm');
              searchInput.focus();
              return false;
          }
          
          // Kiểm tra ký tự đặc biệt (chỉ cho phép chữ, số, khoảng trắng, dấu gạch ngang)
          const specialChars = /[^a-zA-Z0-9\sÀ-ỹ\-]/;
          if (specialChars.test(keyword)) {
              alert('Từ khóa tìm kiếm không hợp lệ. Vui lòng không sử dụng ký tự đặc biệt');
              searchInput.focus();
              return false;
          }
          
          return true;
      }
      </script>
      <!-- <div id="pro-search" style="display: none;"></div> -->
      <div class="nav-right">
        <div class="shop">
          <div id="donhang">
            <img width="20px" src="Public/Img/resources/shopping-bag.png" alt="" />
            <div class="text">Đơn hàng</div>
          </div>
        </div>
        <div class="shop">
          <a href="index.php?route=clients&action=profile&action_acc=viewProfile<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>"><img width="20px" src="Public/Img/resources/user.png" alt="" />
            <div class="text">Tài khoản</div>
          </a>
        </div>
        <div class="shop">
          <div class="cart-container">
            <div onclick="show_list_cart()" class="nav-link" style="cursor: pointer;">
              <img width="20px" src="Public/Img/resources/shopping-cart.png" alt="" />
              <div class="text">Giỏ hàng</div>
            </div>
            <?php 
            // Tính count_cart trực tiếp tại header
            if (!isset($count_cart)) {
                $count_cart = 0;
                if (isset($_SESSION['user']['id'])) {
                    $temp_cart = new Cart();
                    $temp_cart_id = $temp_cart->get_or_create_cart_id($_SESSION['user']['id']);
                    $count_cart = $temp_cart->count_cart_items($temp_cart_id);
                }
            }
            ?>
            <span id="cart-badge" class="cart-badge" style="display: <?= ($count_cart > 0) ? 'flex' : 'none' ?>">
              <?= $count_cart > 99 ? '99+' : $count_cart ?>
            </span>
          </div>
        </div>
        <div class="popup-list-cart" id="popup-cart">

        </div>
        <!-- <div id="popup-coupons" style="display: none;"></div> -->
      </div>
      <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['name'])): ?>
        <div style="display: flex; align-items: center; margin-left: 12px; color: #000; gap: 10px;">
          <span style="font-size: 12px;">
            👋 Xin chào, <?= htmlspecialchars($_SESSION['user']['name']) ?>
          </span>
          <a href="index.php?route=user&action=logout"
            style="text-decoration: none; padding: 7px 10px; border-radius: 3px; background-color: #FF0000; color: white; font-size: 12px;">
            Đăng xuất
          </a>
        </div>
      <?php else: ?>
        <div style="display: flex; align-items: center; margin-left: 12px; gap: 10px;">
          <a href="index.php?route=user&action=login"
            style="text-decoration: none; padding: 7px 10px; border-radius: 3px; background-color: #303C58; color: white; font-size: 12px;">
            Đăng nhập
          </a>
          <a href="index.php?route=user&action=register"
            style="text-decoration: none; padding: 7px 10px; border-radius: 3px; background-color: #018C72; color: white; font-size: 12px;">
            Đăng ký
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
  <div class="clients-main-content">