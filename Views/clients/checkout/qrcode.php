    <style>
      .container-qrcode {
        /* border: 1px solid black; */
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        padding-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 300px;
        /* border-radius: 5px;
        box-shadow: 0 3px 7px #919293; */
        font-family: "Montserrat", sans-serif;
      }

      .container-qrcode .header-qrcode {
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: center;
        align-items: center;
        border-bottom: 1px dashed gray;
        padding-bottom: 15px;
      }

      .container-qrcode .header-qrcode .scan {
        font-size: 14px;
        font-weight: 600;
      }

      .container-qrcode .header-qrcode .name-stk {
        font-size: 18px;
        font-weight: 800;
      }

      .container-qrcode .header-qrcode .stk {
        font-size: 14px;
        font-weight: 600;
      }

      .container-qrcode .main-qrcode {
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: center;
        align-items: center;
      }

      .container-qrcode .main-qrcode .name-bank {
        color: #ff0000;
        font-weight: 700;
      }

      .container-qrcode .qr247 {
        display: flex;
        /* justify-content: space-around; */
        gap: 20px;
      }

      .q247qr {
        margin-top: 3px;
      }

      .container-qrcode .footer-qrcode {
        border-top: 1px dashed gray;
        padding: 20px;
        /* border-bottom: 1px dashed gray; */
      }

      .container-qrcode .footer-qrcode .price-qrcode {
        display: flex;
        justify-content: center;
        font-size: 22px;
        font-weight: 600;
      }

      .container-qrcode .action-qrcode {
        display: flex;
        justify-content: space-between;
        padding: 10px;
      }

      .container-qrcode .action-qrcode .cancel-gd {
        background-color: #ff0000;
        padding: 10px 20px;
        width: 120px;
        color: white;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        cursor: pointer;
        font-size: 12px;
      }

      .container-qrcode .action-qrcode .confirm-gd {
        background-color: #037510;
        padding: 10px 20px;
        width: 120px;
        color: white;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        cursor: pointer;
        font-size: 12px;
      }
    </style>
    <div class="container-qrcode">
      <div class="header-qrcode">
        <div class="scan">Scan to pay</div>
        <div class="name-stk">2TGD SHOP</div>
        <div class="stk">0866030204</div>
      </div>
      <div class="main-qrcode">
        <div class="name-bank">TGDBank</div>
        <div class="qr-img">
          <img width="150px" src="Public/Img/resources/qrcode2.jpg" alt="" />
        </div>
        <div class="qr247">
          <div class="vietqr">
            <img
              width="50px"
              src="Public/Img/resources/VietQR_Logo.png"
              alt="" />
          </div>
          <div class="q247qr">
            <img
              width="50px"
              src="Public/Img/resources/Logo-Napas.webp"
              alt="" />
          </div>
        </div>
      </div>
      <div class="footer-qrcode">
        <div class="price-qrcode"><?=number_format($total)?> đ</div>
      </div>
      <div class="action-qrcode">
        <div onclick="cancelQr()" class="cancel-gd">Hủy</div>
        <div onclick="confirmQr()" class="confirm-gd">Đã chuyển</div>
      </div>
    </div>