<style>
    .container-search {
        width: 90%;
        margin: 0 auto;
    }

    /* -------------------------POLICY----------------------------- */
    .container-search .banner img {
        width: 100%;
        margin-bottom: 15px;
    }

    .container-search .policies {
        display: flex;
        justify-content: space-evenly;
    }

    .container-search .policy {
        display: flex;
        align-items: center;
    }

    .container-search .policy img {
        margin-right: 15px;
    }

    .container-search .policy .text-policy .text-policy1 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: -2px;
    }

    /* -------------------------PRODUCTS----------------------------- */

    .container-search .products {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        width: 100%;
        margin: 20px auto;
    }

    .container-search .products .product {
        width: 23%;
        min-width: 288px;
    }

    .container-search .products .product img {
        width: 100%;
    }

    .container-search .text-pros {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .container-search .old-price {
        display: flex;
        align-items: center;
    }

    .container-search .pro-name {
        width: 100%;
    }

    .container-search .pro-name a {
        text-decoration: none;
        /* font-size: 16px; */
        font-weight: lighter;
        color: black;
        font-size: 12px;
    }

    .container-search .old-price .price {
        font-size: 12px;
        font-weight: lighter;
    }

    .container-search .old-price .sale {
        font-size: 16px;
        color: red;
        font-weight: bold;
        text-indent: 20px;
    }

    .container-search .new-price {
        margin-bottom: -10px;
        font-size: 16px;
        font-weight: bolder;
    }

    .container-search .color {
        display: flex;
        gap: 8px;
        margin-top: 10px;
    }

    .container-search .inner-dot {
        border: 2px solid white;
        border-radius: 50%;
        cursor: pointer;
    }

    .container-search .inner-dot:hover {
        outline: 1px solid black;
    }

    .container-search .dot {
        width: 15px;
        height: 15px;
        border-radius: 50%;
    }

    .container-search .green {
        background-color: green;
    }

    .container-search .yellow {
        background-color: yellow;
    }

    .container-search .black {
        background-color: black;
    }

    /* -------------------------XEM TẤT CẢ----------------------------- */
    .container-search .view-more {
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
</style>

<div class="container-search">
    <div class="banner">
        <img src="Public/Img/resources/banner.png" alt="">
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
    <h4>Sản phẩm theo từ khóa: <?= $keyword ?></h4>
    <div id="view-more-pro" style="display: none;"></div>
    <div id="ap">
        <div class="products">
            <?php
            foreach ($pros_by_search as $row) {
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
    </div>
    <!-- -----------------------------XEM TẤT CẢ--------------------------------- -->
    <div onclick="moreProductsSearch('<?=$keyword?>', <?=$count_pros_by_search?>)" class="view-more">
        Xem thêm
    </div>
</div>