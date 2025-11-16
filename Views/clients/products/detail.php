<style>
    .container-detail {
        width: 90%;
        margin: 0 auto;
    }

    .container-detail .categories {
        display: flex;
        margin-bottom: 10px;
    }

    .container-detail .home {
        font-size: 12px;
        font-weight: bold;
        margin-right: 30px;
    }

    .container-detail .home a {
        text-decoration: none;
        color: #000;
    }

    .container-detail .vach {
        font-size: 12px;
        font-weight: bold;
        margin-right: 30px;
    }

    .container-detail .category {
        font-size: 12px;
        font-weight: lighter;
        color: gray;
    }

    .container-detail .products-detail {
        display: flex;
        gap: 50px;
    }

    .container-detail .images {
        display: flex;
        /* width: 50%; */
    }

    .container-detail .main-image {
        margin-right: 30px;
    }

    .container-detail .child-img img.active {
        border: 1px solid #000;
    }

    .container-detail .attributes {
        width: auto;
    }

    .container-detail .name-pros {
        font-size: 16px;
        font-weight: bold;
    }

    .container-detail .code-pros {
        font-size: 14px;
        font-weight: lighter;
        color: gray;
    }

    .container-detail .price-pros {
        font-size: 24px;
        font-weight: bolder;
    }

    .container-detail .color {
        font-size: 14px;
        font-weight: bolder;
    }

    .container-detail .color-choice {
        display: flex;
    }

    .container-detail .color-img {
        margin-right: 10px;
        cursor: pointer;
    }

    .color-img img.active {
        border: 1px solid black;
        /* border-radius: 4px; */
    }

    .container-detail .size {
        font-size: 14px;
        font-weight: lighter;
        color: gray;
    }

    .container-detail .size-block {
        display: flex;
    }

    .container-detail .bl-size {
        padding: 10px;
        width: 20px;
        height: 20px;
        border-radius: 5px;
        border: 1px solid gray;
        margin-right: 10px;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container-detail .bl-size:hover {
        background-color: #D92A1C;
        border: 1px solid #D92A1C;
        color: white;
    }

    .container-detail .bl-size.active {
        background-color: #D92A1C;
        border: 1px solid #D92A1C;
        color: white;
    }

    .container-detail .btn-action {
        display: flex;
        margin-top: 10px;
        margin-bottom: 10px;
        /* justify-content: space-between; */
        gap: 50px;
    }

    .container-detail .btn-action button {
        border: none;
    }

    .container-detail .cart-btn {
        font-size: 14px;
        font-weight: bold;
        padding: 15px 0;
        width: 50%;
        min-width: 300px;
        max-width: 300px;
        color: white;
        background-color: #D92A1C;
        border-radius: 5px;
    }

    .container-detail .buy-now {
        font-size: 14px;
        font-weight: bold;
        padding: 15px 0;
        width: 50%;
        min-width: 300px;
        max-width: 300px;
        color: white;
        background-color: #015A49;
        border-radius: 5px;
    }

    .container-detail .description {
        margin-top: 20px;
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        width: 100%;
        max-width: 650px;
    }

    .container-detail .des {
        font-size: 14px;
        font-weight: bolder;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .container-detail .content {
        font-size: 14px;
        font-weight: lighter;
        color: gray;
        margin-bottom: 15px;
        width: 100%;
    }

    .container-detail .policies {
        display: flex;
        gap: 70px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .container-detail .policy {
        display: flex;
    }

    .container-detail .policy img {
        margin-right: 15px;
        margin-top: 15px;
    }

    .container-detail .policy .text-policy .text-policy1 {
        font-weight: bold;
        margin-bottom: -2px;
    }

    .container-detail .xemthem {
        display: flex;
        justify-content: space-between;
    }

    .container-detail .title {
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        color: black;
    }

    .container-detail .title span {
        color: red;
    }

    /* -------------------------PRODUCTS----------------------------- */
    .container-detail .products {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        max-width: 100%;
        margin: 20px auto;
    }

    .container-detail .products .product {
        width: 23%;
        min-width: 288px;
    }

    .container-detail .products .product img {
        width: 100%;
    }

    .container-detail .text-pros {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .container-detail .pro-name {
        width: 100%;
    }

    .container-detail .pro-name a {
        text-decoration: none;
        /* font-size: 16px; */
        font-weight: lighter;
        color: black;
        font-size: 12px;
    }

    .container-detail .old-price {
        display: flex;
        align-items: center;
    }

    .container-detail .old-price .price {
        font-size: 12px;
        font-weight: lighter;
    }

    .container-detail .old-price .sale {
        font-size: 16px;
        color: red;
        font-weight: bold;
        text-indent: 20px;
    }

    .container-detail .new-price {
        margin-bottom: -10px;
        font-size: 16px;
        font-weight: bolder;
    }

    .container-detail .color {
        display: flex;
        margin-top: 10px;
        gap: 8px;
    }

    .container-detail .dot {
        width: 15px;
        height: 15px;
        border-radius: 50%;
    }

    .container-detail .inner-dot {
        border: 2px solid white;
        border-radius: 50%;
    }

    .container-detail .inner-dot:hover {
        outline: 1px solid black;
    }
</style>
<div id="product-detail" style="display: none;"></div>
<div class="container-detail">
    <!-- -----------------------------DANH MUC---------------------------- -->
    <div class="categories">
        <div class="home">
            <a href="index.php?route=clients&action=home<?= isset($user_id) && !empty($user_id) ? '&user_id' . $user_id : '' ?>">Trang chủ</a>
        </div>
        <div class="vach">|</div>
        <div class="category">
            <?= $arr_products_variant['category_name'] ?>
        </div>
    </div>
    <!-- -----------------------------PRODUCTS---------------------------- -->
    <div class="products-detail">
        <div class="images">
            <div class="main-image">
                <img id="main-image" src="./Public/Img/uploads/<?= $image_is_primary['image_url'] ?>" alt="anh chinh"
                    width="485px" height="640px">
            </div>

            <div class="child-image">
                <?php
                foreach ($image_isnot_primary as $row) {
                ?>
                    <div class="child-img">
                        <img src="./Public/Img/uploads/<?= $row['image_url'] ?>" alt="" width="78px" height="103px"
                            onclick="changeImage(this)">
                    </div>
                <?php } ?>
            </div>

        </div>
        <!-- -----------------------------THANH PHAN---------------------------- -->
        <div class="attributes">
            <p class="name-pros">
                <?= $arr_products_variant['name'] ?>
            </p>
            <!-- <input type="hidden" name="" > -->
            <p class="code-pros">
                Mã sản phẩm: <?= $arr_products_variant['sku'] ?>
            </p>
            <p class="price-pros">
                <?= number_format($arr_products_variant['sale_price']) ?>đ
            </p>
            <p class="color">
                Màu sắc: <?= $arr_products_variant['color_value'] ?>
            </p>
            <div class="color-choice">
                <?php
                foreach ($color_images as $row) {
                ?>
                    <div onclick="show_detail(<?= $row['product_variant_id'] ?>, <?= $user_id ?>)">
                        <div class="color-img">
                            <img src="Public/Img/uploads/<?= $row['image_url'] ?>" alt="" width="48px" height="64px" onclick="activeImg(this)">
                        </div>
                    </div>
                <?php } ?>
            </div>
            <p class="size">
                Kích cỡ:
            </p>
            <div class="size-block">
                <?php foreach ($list_size as $row): ?>
                    <?php if ($row['status'] == 'hidden' || $row['status'] == 'out_of_stock'): ?>
                        <div class="bl-size" style="background-color: #e5e3e3ff; pointer-events: none; color: #adaaaaff; border: 1px solid #E1E0E4">
                            <?= $row['size_value'] ?>
                        </div>
                    <?php else: ?>
                        <div data-size="<?= $row['product_variant_id'] ?>" class="bl-size">
                            <?= $row['size_value'] ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Hidden inputs -->

            <form onsubmit="return validateForm()" method="post">
                <input type="hidden" name="product_size" id="product_size" value="">
                <div class="btn-action">
                    <button type="submit" name="add_to_cart" class="cart-btn">
                        THÊM VÀO GIỎ HÀNG
                    </button>

                    <button type="submit" name="add_to_cart" class="buy-now">
                        MUA NGAY
                    </button>
                </div>
            </form>

            <div class="description">
                <div class="des">
                    Mô tả:
                </div>
                <div class="content">
                    <?= $arr_products_variant['description'] ?>
                </div>
            </div>
        </div>
    </div>


    <!-- -----------------------------POLICY---------------------------- -->
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

    <div class="xemthem">
        <div class="title">Sản phẩm cùng loại</div>
        <a href="index.php?route=clients&action=pro_cate&cate_id=<?= $cate_id ?>" class="title">Xem thêm <span>>></span></a>
    </div>

    <div class="products">
        <?php
        foreach ($pro_by_cate as $row) {
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