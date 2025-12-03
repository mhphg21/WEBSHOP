<?php
class BuyingController
{
    public function cart($user_id)
    {
        $get = new Cart();
        $categories = $get->list_category();

        $count_cart = $get->count_cart_by_user($user_id);

        $list_cart = $get->list_cart_by_user($user_id);

        $list_color = $get->list_color_by_user($user_id);

        $list_size = $get->list_size_by_user($user_id);

        // Kiểm tra nếu là AJAX request thì không include header/footer
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        
        if (!$isAjax) {
            include './Views/clients/layouts/header1.php';
        }
        include './Views/clients/cart/list_cart.php';
        if (!$isAjax) {
            include './Views/clients/layouts/footer.php';
        }
    }

    public function deleteCart()
    {
        if (isset($_GET['variant_id']) && isset($_SESSION['user']['id'])) {

            $user_id = $_SESSION['user']['id'];
            $variant_id = $_GET['variant_id'];

            $cart = new Cart();
            $cart->delete_from_cart($user_id, $variant_id);
        }
    }

    public function increase_cart()
    {
        if (isset($_GET['variant_id']) && isset($_SESSION['user']['id'])) {

            $user_id = $_SESSION['user']['id'];
            $variant_id = $_GET['variant_id'];

            $cart = new Cart();
            $cart->increase_cart($user_id, $variant_id);
        }
    }

    public function reduce_cart()
    {
        if (isset($_GET['variant_id']) && isset($_SESSION['user']['id'])) {

            $user_id = $_SESSION['user']['id'];
            $variant_id = $_GET['variant_id'];

            $cart = new Cart();
            $cart->reduce_cart($user_id, $variant_id);
        }
    }

    public function coupons()
    {
        
        $gets = new Product();
        $total_bill = $_GET['total_bill'];
        $coupons = $gets->get_coupons();
        include './Views/clients/checkout/popup-coupons.php';
    }


    public function check_out_page($user_id)
    {
        // echo "<pre>";
        $cart_id = $_GET['cart_id'] ?? '';

        $get = new Cart();
        $array_items_by_cart_id = $get->get_items_by_user_id($user_id);

        if (isset($_GET['coupon_id'])) {
            $get_coupon_id = $_GET['coupon_id'] ?? '';
            $discount_value = $get->get_discount_value($get_coupon_id);
            $code_coupon = $get->get_code_coupon($get_coupon_id);
            $min_order_value = $get->get_min_order_value($get_coupon_id);
        }
        $color_item = $get->list_color_by_user($user_id);

        $size_item = $get->list_size_by_user($user_id);

        $i4_user = $get->get_i4_user_cart_id($user_id);

        if (isset($_POST['check_out'])) {
            $name_order = $_POST['name_order'];
            $phone_order = $_POST['phone_order'];
            $email_order = $_POST['email_order'];
            $address_order = $_POST['address_order'];
            $total_price = $_POST['total_price'];
            $payment_method = $_POST['payment_method'];
            if (!empty($_POST['test_voucher'])) {
                $coupon_id = $_POST['test_voucher'];
                $order_id = $get->insert_orders($user_id, $coupon_id, $email_order, $phone_order, $name_order, $total_price, $address_order, $payment_method);
            } else {
                $order_id = $get->insert_orders($user_id, null, $email_order, $phone_order, $name_order, $total_price, $address_order, $payment_method);
            }
            foreach ($array_items_by_cart_id as $row) {
                $product_variant_id = $row['product_variant_id'];
                $quantity = $row['quantity'];

                $data = [
                    'order_id' => $order_id,
                    'product_variant_id' => $product_variant_id,
                    'quantity' => $quantity,
                    'price' => $row['sale_price'],
                ];

                $get->insert_orderDetail($data);
                $get->update_stock_quantity($quantity, $product_variant_id);
            }
            if (!empty($_POST['test_voucher']) && isset($_POST['check_out'])) {
                $get->update_coupons($coupon_id);
            }
            $get->insert_payments($order_id, $payment_method);

            // Tạo thông báo cho đơn hàng mới
            $notification = new Notification();
            $message = "Đơn hàng #{$order_id} của bạn đã được đặt thành công! Tổng tiền: " . number_format($total_price) . "đ. Chúng tôi đang xử lý đơn hàng của bạn.";
            $notification->create_notification($user_id, $message, 'order');

            //Xoá giỏ hàng sau khi checkout
            $get->clearCartByUserId($user_id);


            header("Location: index.php?route=clients&action=list_cart&action_cart=thank_you");
        }
        include './Views/clients/checkout/checkout.php';
    }

    public function show_qrcode()
    {
        $total = $_GET['total'] ?? '';

        include './Views/clients/checkout/qrcode.php';
    }

    public function thank_you($user_id)
    {
        include './Views/clients/checkout/thankyou.php';
    }
}
