<style>
    .container-list .products {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        width: 100%;
        margin: 20px auto;
    }

    .container-list .product {
        margin-bottom: 10px;
    }

    .container-list .products .product {
        width: 23%;
    }

    .container-list .products .product img {
        width: 100%;
        min-width: 288px;
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
        font-size: 12px;
        font-weight: lighter;
        color: black;
    }

    .container-list .old-price .price {
        font-size: 12px;
        font-weight: lighter;
    }

    .container-list .old-price .sale {
        font-size: 14px;
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
</style>

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