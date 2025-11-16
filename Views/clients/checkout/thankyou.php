<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="Public/Css/Clients/thankyou.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
  <div class="container-checkout">
    <div class="head-checkouts">
      <div class="head-checkout">
        <a
          href="index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>"
          class="logo">
          <div class="logo">2TGD</div>
        </a>

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
          <div class="step1">
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
          <div class="step2">
            <span>3</span>
            <div class="title">Hoàn tất</div>
          </div>
        </div>
        <a
          href="index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>"
          class="back-shop">
          <div class="back-shop">
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
        </a>
      </div>
    </div>
    <div class="noti">
      <img width="300px" src="Public/Img/uploads/fast (1).png" alt="">
      <div class="noti-success">
        ĐẶT HÀNG THÀNH CÔNG !
      </div>
      <div class="thankyou-text">
        Cảm ơn bạn đã đặt hàng, bộ phận chăm sóc khách hàng của chúng tôi sẽ
        liên hệ với bạn trong vòng 24h để xác nhận, hãy để ý điện thoại bạn nhé !
      </div>
      <div class="action">
        <a href="index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>" class="back-homes">
          <div class="back-home">
            <div class="text">Quay về trang chủ</div>
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </div>
        </a>
        <a href="index.php?route=clients&action=profile&action_acc=oder<?= isset($user_id) && !empty($user_id) ? '&user_id=' . $user_id : '' ?>" class="back-homes">
          <div class="back-home">
            <div class="text">Theo dõi đơn hàng</div>
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </div>
        </a>
      </div>
      <div class="follow">
        Theo dõi chúng tôi trên
      </div>
      <div class="icon-mxh">
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-tiktok"></i>
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-square-instagram"></i>
      </div>
    </div>
  </div>
</body>

</html>