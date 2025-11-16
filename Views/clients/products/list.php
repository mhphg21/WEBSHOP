    <style>
        .container-list {
            width: 90%;
            margin: 0 auto;
        }

        /* -------------------------POLICY----------------------------- */
        .container-list .banner img {
            width: 100%;
            margin-bottom: 15px;
            height: auto;
        }

        .container-list .ban {
            display: none;
        }

        .container-list .banner {
            position: relative;
        }

        #act_ban_left {
            display: flex;
            justify-content: end;
            /* padding: 30px; */
            position: absolute;
            top: 45%;
            left: 0;
            margin-left: 30px;
            font-size: 20px;
            font-weight: 200;
            color: gray;
            width: 40px;
            height: 40px;
            background-color: #cbd5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(186, 185, 185, 0.5);
            cursor: pointer;
        }

        #act_ban_left:hover {
            background-color: rgba(107, 94, 94, 0.5);
            color: white;
        }

        #act_ban_right {
            display: flex;
            justify-content: end;
            /* padding: 30px; */
            position: absolute;
            top: 45%;
            right: 0;
            margin-right: 30px;
            font-size: 20px;
            font-weight: 200;
            color: gray;
            width: 40px;
            height: 40px;
            background-color: #cbd5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(186, 185, 185, 0.5);
            cursor: pointer;
        }

        #act_ban_right:hover {
            background-color: rgba(107, 94, 94, 0.5);
            color: white;
        }

        .container-list .policies {
            display: flex;
            justify-content: space-evenly;
        }

        .container-list .policy {
            display: flex;
            align-items: center;
        }

        .container-list .policy img {
            margin-right: 15px;
        }

        .container-list .policy .text-policy .text-policy1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: -2px;
        }

        /* -------------------------VOUCHERS----------------------------- */
        .container-list .vouchers {
            display: flex;
            /* justify-content: space-between; */
            gap: 20px;
            margin-bottom: 20px;
        }

        .container-list .voucher-box {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 16px;
            width: 20%;
            min-width: 280px;
            /* font-family: Arial, sans-serif; */
            color: #1e293b;
        }

        .container-list .voucher-box h2 {
            margin-top: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .container-list .voucher-box p {
            margin: 4px 0;
            font-size: 14px;
        }

        .container-list .voucher-footer {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-top: 12px;

        }

        .container-list .voucher-condition {
            font-weight: bold;
            font-size: 14px;
            color: #1e293b;
            text-decoration: none;
        }

        .container-list .use-button {
            background-color: #1e293b;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        /* -------------------------PRODUCTS----------------------------- */
        .container-list .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
            width: 100%;
            margin: 20px auto;
            margin-bottom: 40px;
        }

        .container-list .product {
            margin-bottom: 10px;
        }

        .container-list .products .product {
            width: 23%;
            min-width: 288px;
        }

        .container-list .products .product img {
            width: 100%;
        }

        .container-list .text-pros {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .container-list .old-price {
            display: flex;
            align-items: center;
        }

        .container-list .pro-name {
            width: 100%;
        }

        .container-list .pro-name a {
            text-decoration: none;
            /* font-size: 16px; */
            font-weight: lighter;
            color: black;
            font-size: 12px;
        }

        .container-list .old-price .price {
            font-size: 12px;
            font-weight: lighter;
        }

        .container-list .old-price .sale {
            font-size: 16px;
            color: red;
            font-weight: bold;
            text-indent: 20px;
        }

        .container-list .new-price {
            margin-bottom: -10px;
            font-size: 16px;
            font-weight: bolder;
        }

        .container-list .color {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .container-list .inner-dot {
            border: 2px solid white;
            border-radius: 50%;
            cursor: pointer;
        }

        .container-list .inner-dot:hover {
            outline: 1px solid black;
        }

        .container-list .dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
        }

        .container-list .green {
            background-color: green;
        }

        .container-list .yellow {
            background-color: yellow;
        }

        .container-list .black {
            background-color: black;
        }

        /* -------------------------BANNER CONTENT----------------------------- */
        .container-list .banner-content img {
            width: 100%;
        }

        /* -------------------------XEM TẤT CẢ----------------------------- */
        .container-list .view-more {
            margin: 0 auto;
            margin-bottom: 40px;
            font-size: 12px;
            font-weight: 700;
            color: white;
            background-color: #ff0000;
            width: 70px;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 40px;
            /* margin-bottom: 20px; */
        }

        /* -------------------------GALLEY----------------------------- */
        .container-list .galley {
            display: flex;
            justify-content: space-between;
        }

        .container-list .galley img {
            width: 30%;
        }
    </style>

    <div class="container-list">
        <!-- -----------------------------BANNER--------------------------------- -->
        <div class="banner">
            <div class="banners">
                <?php
                foreach ($banners as $row) {
                ?>
                    <div class="ban">
                        <img src="Public/Img/resources/<?= $row['image_url'] ?>" alt="">
                    </div>
                <?php } ?>
            </div>
            <span onclick="preview()" id="act_ban_left"><i class="fa-solid fa-angle-left"></i></span>
            <span onclick="next()" id="act_ban_right"><i class="fa-solid fa-angle-right"></i></span>
        </div>

        <!-- -----------------------------POLICY--------------------------------- -->
        <div class="policies">
            <div class="policy">
                <img width="44px" height="44px" src="Public/Img/resources/codesandbox.png" alt="thanhtoan">
                <div class="text-policy">
                    <p class="text-policy1">
                        Thanh toán khi nhận hàng
                    </p>
                    <p class="text-policy2">
                        giao hàng toàn quốc
                    </p>
                </div>
            </div>

            <div class="policy">
                <img width="44px" height="44px" src="Public/Img/resources/truck.png" alt="thanhtoan">
                <div class="text-policy">
                    <p class="text-policy1">
                        Miễn phí giao hàng
                    </p>
                    <p class="text-policy2">
                        với đơn hàng trên 99.000đ
                    </p>
                </div>
            </div>

            <div class="policy">
                <img width="44px" height="44px" src="Public/Img/resources/Group 99.png" alt="thanhtoan">
                <div class="text-policy">
                    <p class="text-policy1">
                        Thanh toán khi nhận hàng
                    </p>
                    <p class="text-policy2">
                        giao hàng toàn quốc
                    </p>
                </div>
            </div>
        </div>

        <hr>
        <!-- -----------------------------VOUCHERS--------------------------------- -->


        <?php
        if (empty($coupons)) {
        ?>
            <div class="div"></div>
        <?php
        } else {
        ?>
            <h3>Ưu đãi nổi bật</h3>
            <div class="vouchers">
                <?php
                foreach ($coupons as $row) {
                ?>
                    <div class="voucher-box">
                        <h2>Voucher <?= number_format($row['discount_value'] / 1000) ?>K</h2>
                        <p>Giảm <?= number_format($row['discount_value'] / 1000) ?>K cho tất cả các đơn từ <?= number_format($row['min_order_value'] / 1000) ?>K</p>
                        <p>HSD: <?= $row['end_date'] ?></p>
                        <div class="voucher-footer">
                            <button onclick="useCoupon()" class="use-button">Dùng mã</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <!-- -----------------------------FLASH DEAL--------------------------------- -->
        <h4>SẢN PHẨM MỚI</h4>
        <div class="products">
            <?php
            foreach ($hot_pros as $row) {
            ?>
                <div class="product">
                    <a class="img-p" href="index.php?route=clients&action=detail&id=<?= $row['product_variant_id'] ?><?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>"><img
                            src="./Public/Img/uploads/<?= $row['thumbnail'] ?>" alt="anh sp"></a>
                    <div class="color">
                        <?php
                        if (!function_exists('convertColorNameToHex')) {
                            function convertColorNameToHex($color)
                            {
                                $map = [
                                    'Trắng' => '#FFFFFF',
                                    'Đen' => '#000000',
                                    'Đỏ' => '#FF0000',
                                    'Xanh' => '#BDDCF3',
                                    'Xám' => '#808080',
                                    'Nâu' => '#8B4513',
                                    'Hồng' => '#EDD1E1',
                                ];
                                return $map[$color] ?? $color;
                            }
                        }
                        // Xử lý chuỗi color_values
                        $color_values = $row['color_values'];
                        $colors = explode(',', $color_values);
                        $colors = array_map('trim', $colors); // loại bỏ khoảng trắng
                        ?>
                        <?php
                        foreach ($colors as $color) {
                            $colorCode = convertColorNameToHex($color);
                        ?>
                            <div class="inner-dot">
                                <div class="dot" style="background-color: <?= htmlspecialchars($colorCode) ?>;"></div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="text-pros">
                        <div class="pro-name">
                            <a href="index.php?route=clients&action=detail&id=<?= $row['product_variant_id'] ?><?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>"><?= $row['name'] ?></a>
                        </div>
                        <div class="new-price">
                            <?= number_format($row['sale_price']) ?>đ
                        </div>
                        <div class="old-price">
                            <div class="price">
                                <del> <?= number_format($row['price']) ?>đ</del>
                            </div>
                            <div class="sale">
                                <?= round((($row['price'] - $row['sale_price']) / $row['price']) * 100) ?>%
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- -----------------------------BANNER CONTENT--------------------------------- -->
        <div class="banner-content">
            <img src="Public/Img/resources/banner_content.png" alt="banner" width="1286px">
        </div>

        <!-- -----------------------------PRODUCTS--------------------------------- -->
        <h4>TOÀN BỘ SẢN PHẨM</h4>
        <div id="view-more-pro" style="display: none;"></div>
        <div id="ap">
            <div class="products">
                <?php
                foreach ($products as $row) {
                ?>
                    <div class="product">
                        <a href="index.php?route=clients&action=detail&id=<?= $row['product_variant_id'] ?><?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>"><img
                                src="./Public/Img/uploads/<?= $row['thumbnail'] ?>" alt="anh sp"></a>
                        <div class="color">
                            <?php
                            if (!function_exists('convertColorNameToHex')) {
                                function convertColorNameToHex($color)
                                {
                                    $map = [
                                        'Trắng' => '#FFFFFF',
                                        'Đen' => '#000000',
                                        'Đỏ' => '#FF0000',
                                        'Xanh' => '#7ab5e1ff',
                                        'Xám' => '#808080',
                                        'Nâu' => '#8B4513',
                                        'Hồng' => '#EDD1E1',
                                    ];
                                    return $map[$color];
                                }
                            }
                            // Xử lý chuỗi color_values
                            $color_values = $row['color_values'];
                            $colors = explode(',', $color_values);
                            $colors = array_map('trim', $colors); // loại bỏ khoảng trắng
                            ?>
                            <?php
                            foreach ($colors as $color) {
                                $colorCode = convertColorNameToHex($color);
                            ?>
                                <div class="inner-dot">
                                    <div class="dot" style="background-color: <?= htmlspecialchars($colorCode) ?>;"></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="text-pros">
                            <div class="pro-name">
                                <a href="index.php?route=clients&action=detail&id=<?= $row['product_variant_id'] ?><?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>"><?= $row['name'] ?></a>
                            </div>
                            <div class="new-price">
                                <?= number_format($row['sale_price']) ?>đ
                            </div>
                            <div class="old-price">
                                <div class="price">
                                    <del> <?= number_format($row['price']) ?>đ</del>
                                </div>
                                <div class="sale">
                                    <?= round((($row['price'] - $row['sale_price']) / $row['price']) * 100) ?>%
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>


        <!-- -----------------------------XEM TẤT CẢ--------------------------------- -->
        <div onclick="moreProducts(<?= $count ?>)" class="view-more">
            Xem thêm
        </div>

        <!-- -----------------------------GALLERY--------------------------------- -->
        <div class="galley">
            <img src="Public/Img/resources/1.png" alt="anh 1">
            <img src="Public/Img/resources/2.png" alt="anh 2">
            <img src="Public/Img/resources/3.png" alt="anh 3">
        </div>
    </div>