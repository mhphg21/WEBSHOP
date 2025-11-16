<style>
    .container-list-cart {
        padding: 15px;
    }

    .container-list-cart header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5px;
    }

    .container-list-cart header a {
        text-decoration: none;
        color: black;
    }

    .container-list-cart header h1 {
        font-size: 16px;
        font-weight: bolder;
    }

    .container-list-cart main {
        display: flex;
        padding-left: 5px;
        gap: 10px;
    }

    .container-list-cart main img {
        border-radius: 5px;
    }

    .container-list-cart .pro p {
        font-size: 12px;
        color: red;
    }

    .container-list-cart article {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 100%;
    }

    .container-list-cart article .info-pro {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .container-list-cart article .info-pro .size-color {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        font-weight: 200;
    }

    .container-list-cart article .info-pro .name-pro {
        display: flex;
        align-items: center;
        font-size: 12px;
        font-weight: 200;
        gap: 10px;
    }

    .container-list-cart .price-quantity {
        display: flex;
        /* justify-content: space-between; */
        /* align-items: center; */
        flex-direction: column;
        gap: 3px;
    }

    .container-list-cart .price-quantity .old-price {
        font-size: 14px;
        color: gray;
    }

    .container-list-cart .price-quantity .sale-prices {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .container-list-cart article .price-quantity .sale-prices .quantity {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .container-list-cart article .price-quantity .sale-prices .quantity .tru {
        width: 20px;
        height: 20px;
        /* font-size: 16px; */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 50%;
        border: 1px solid lightgray;
        cursor: pointer;
    }

    .container-list-cart article .price-quantity .sale-prices .quantity .cong {
        width: 20px;
        height: 20px;
        /* font-size: 16px; */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid lightgray;
        cursor: pointer;
    }

    .container-list-cart .sale-price {
        font-size: 14px;
        font-weight: bold;
        color: red;
    }

    .container-list-cart .b-main {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }

    .container-list-cart .b-main .stock_quantity {
        color: red;
        font-size: 12px;
    }

    .container-list-cart .b-main a {
        text-decoration: none;
        color: red;
        font-size: 12px;
        cursor: pointer;
    }

    .container-list-cart section {
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .container-list-cart section .choose-voucher {
        cursor: pointer;
    }

    .container-list-cart .coupons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .container-list-cart section a {
        text-decoration: none;
        color: black;
    }

    .container-list-cart footer {
        display: flex;
        justify-content: space-between;
        padding: 5px;
    }

    .container-list-cart footer .total {
        font-size: 16px;
        font-weight: bolder;
    }

    .container-list-cart button {
        width: 100%;
        padding: 10px;
        background-color: red;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .container-list-cart .empty {
        margin-top: 20px;
        margin-bottom: 10px;
    }
</style>

<div class="container-list-cart">
    <header>
        <h1>Giỏ hàng (<?= $count_cart ?>)</h1>
        <a class="nav-link" href=""><i class="fa-solid fa-xmark"></i></a>
    </header>
    <hr>

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
    if (empty($list_cart)) {
    ?>
        <div class="empty">Giỏ hàng trống</div>
        <?php
    } else {
        foreach ($list_cart as $item) {
        ?>
            <div class="not-empty">
                <div class="pro">
                    <main>
                        <div class="img_pro">
                            <img src="Public/Img/uploads/<?= $item['thumbnail'] ?>" alt="" width="80px" height="100px">
                        </div>
                        <article>
                            <div class="info-pro">
                                <div class="name-pro">
                                    <div class="name"><?= $item['name'] ?></div>

                                    <span>|</span>
                                    <div class="sku"><?= $item['sku'] ?></div>
                                </div>
                                <div class="size-color">
                                    <div class="colors"><?= $colors[$item['product_variant_id']] ?></div>
                                    <span>|</span>
                                    <div class="size"><?= $sizes[$item['product_variant_id']] ?></div>

                                </div>
                            </div>

                            <div class="price-quantity">
                                <del class="old-price"><?= number_format($item['price']) ?>đ</del>
                                <div class="sale-prices">
                                    <div class="sale-price"><?= number_format($item['sale_price']) ?>đ</div>
                                    <div class="quantity">
                                        <span onclick="reduceCart(<?= $item['product_variant_id'] ?>,<?= $item['quantity'] ?>)"
                                            class="tru"><i class="fa-solid fa-minus"></i></span>
                                        <div class="number"><?= $item['quantity'] ?></div>
                                        <span onclick="increaseCart(<?= $item['product_variant_id'] ?>)" class="cong"><i
                                                class="fa-solid fa-plus"></i></span>

                                    </div>
                                </div>
                            </div>

                        </article>
                    </main>
                    <div class="b-main">
                        <div class="stock_quantity">Còn <?= $item['stock_quantity'] ?> sản phẩm</div>
                        <a onclick="deleteFromCart(<?= $item['product_variant_id'] ?>)" style="color:red">
                            Xóa
                        </a>
                    </div>
                </div>
                <hr>
            <?php } ?>
            
            <?php
            $total = 0;
            foreach ($list_cart as $item) {
                $total += $item['sale_price'] * $item['quantity'];
            }
            ?>
            <footer>
                <p>Tạm tính</p>
                <p class="total"><?= number_format($total) ?>đ</p>
            </footer>
            <a id="btn_check_out" href="index.php?route=clients&action=list_cart&action_cart=check_out&id_cart=<?= $item['cart_id']  ?? '' ?>"><button class="" type="submit" name="check_out">Thanh Toán</button></a>

            </div>
        <?php
    }
        ?>
</div>

