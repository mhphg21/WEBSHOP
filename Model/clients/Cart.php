<?php
class Cart
{
    public function list_category()
    {
        $query = "SELECT * FROM `categories`";
        $result = pdo_query($query);
        return $result;
    }

    public function get_or_create_cart_id($user_id)
    {
        $query = "SELECT id FROM carts WHERE user_id = ?";
        $result = pdo_query_one($query, $user_id);

        if ($result) {
            return $result['id'];
        } else {
            $query = "INSERT INTO carts (user_id) VALUES (?)";
            $result = pdo_execute_return_last_id($query, $user_id);
            return $result;
        }
    }

    public function check_variant_exists_in_cart($cart_id, $variant_id)
    {
        $query = "SELECT id FROM cart_items WHERE cart_id = ? AND product_variant_id = ?";
        $result = pdo_query_one($query, $cart_id, $variant_id);
        return $result ? true : false;
    }

    public function count_cart_by_user($user_id)
    {
        $query = "SELECT COUNT(ci.id) AS so_luong_cart FROM cart_items ci
                    JOIN carts c ON c.id = ci.cart_id
                    WHERE c.user_id = ?";
        $result = pdo_query_one_1($query, $user_id);
        return $result;
    }

    public function increase_quantity($cart_id, $variant_id, $quantity)
    {
        $query = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_variant_id = ?";
        pdo_execute($query, $quantity, $cart_id, $variant_id);
    }

    public function add_cart_item($cart_id, $variant_id, $quantity)
    {
        $query = "INSERT INTO cart_items (cart_id, product_variant_id, quantity) VALUES (?, ?, ?)";
        pdo_execute($query, $cart_id, $variant_id, $quantity);
    }

    public function list_cart_by_user($user_id)
    {
        $query = "SELECT p.name, pv.sku, pv.price, pv.sale_price, p.thumbnail, ci.quantity, pv.id AS product_variant_id , pv.stock_quantity, c.id as cart_id, ci.id FROM products p
                    JOIN product_variants pv ON pv.product_id = p.id
                    JOIN cart_items ci ON ci.product_variant_id = pv.id
                    JOIN carts c ON c.id = ci.cart_id
                    WHERE c.user_id = ?";
        $result = pdo_query($query, $user_id);
        return $result;
    }

    public function list_color_by_user($user_id)
    {
        $query = "SELECT av.value AS color_value, ci.product_variant_id FROM variant_attribute_values vav
                JOIN cart_items ci ON ci.product_variant_id = vav.product_variant_id
                JOIN carts c ON c.id = ci.cart_id
                JOIN attribute_values av ON av.id = vav.attribute_value_id
                WHERE c.user_id = ? AND vav.attribute_id = 1";
        $result = pdo_query($query, $user_id);
        return $result;
    }

    public function list_size_by_user($user_id)
    {
        $query = "SELECT av.value AS size_value,ci.product_variant_id FROM variant_attribute_values vav
                JOIN cart_items ci ON ci.product_variant_id = vav.product_variant_id
                JOIN carts c ON c.id = ci.cart_id
                JOIN attribute_values av ON av.id = vav.attribute_value_id
                WHERE c.user_id = ? AND vav.attribute_id = 2";
        $result = pdo_query($query, $user_id);
        return $result;
    }

    public function delete_from_cart($user_id, $variant_id)
    {
        $sql_cart = "SELECT id FROM carts WHERE user_id = ?";
        $cart = pdo_query_one($sql_cart, $user_id);

        if ($cart && isset($cart['id'])) {
            $cart_id = $cart['id'];

            $sql_delete = "DELETE FROM cart_items WHERE cart_id = ? AND product_variant_id = ?";
            pdo_execute($sql_delete, $cart_id, $variant_id);
        }
    }

    public function increase_cart($user_id, $variant_id)
    {
        $sql_cart = "SELECT id FROM carts WHERE user_id = ?";
        $cart = pdo_query_one($sql_cart, $user_id);

        if ($cart && isset($cart['id'])) {
            $cart_id = $cart['id'];

            $sql_delete = "UPDATE cart_items SET quantity = quantity + 1 WHERE cart_id = ? AND product_variant_id = ?;
";
            pdo_execute($sql_delete, $cart_id, $variant_id);
        }
    }

    public function reduce_cart($user_id, $variant_id)
    {
        $sql_cart = "SELECT id FROM carts WHERE user_id = ?";
        $cart = pdo_query_one($sql_cart, $user_id);

        if ($cart && isset($cart['id'])) {
            $cart_id = $cart['id'];

            $sql_update = "UPDATE cart_items SET quantity = quantity - 1 WHERE cart_id = ? AND product_variant_id = ?;
";
            pdo_execute($sql_update, $cart_id, $variant_id);

            $sql_check = "SELECT quantity FROM cart_items WHERE cart_id = ? AND product_variant_id = ?";
            $quantity = pdo_query_value($sql_check, $cart_id, $variant_id);

            if ($quantity <= 0) {
                $sql_delete = "DELETE FROM cart_items WHERE cart_id = ? AND product_variant_id = ?";
                pdo_execute($sql_delete, $cart_id, $variant_id);
            }
        }
    }



    public function get_items_by_user_id($user_id)
    {
        $querry = "SELECT pv.sku, p.name, ci.quantity, ci.product_variant_id, pv.price, pv.sale_price, p.thumbnail FROM carts c
                        JOIN cart_items ci ON ci.cart_id = c.id
                        JOIN product_variants pv ON pv.id = ci.product_variant_id
                        JOIN products p ON p.id = pv.product_id
                        WHERE c.user_id = ? ";
        $result = pdo_query($querry, $user_id);
        return $result;
    }

    public function get_i4_user_cart_id($user_id)
    {
        $querry = "SELECT * from users where id = ?";
        $result = pdo_query_one($querry, $user_id);
        return $result;
    }

    public function get_discount_value($get_coupon_id)
    {
        $query = "SELECT discount_value FROM coupons WHERE id = ? AND `status` = 'active'";
        $result = pdo_query_value($query, $get_coupon_id);
        return $result;
    }

    public function get_code_coupon($get_coupon_id) {
        $query = "SELECT code FROM coupons WHERE id = ? AND `status` = 'active'";
        $result = pdo_query_value($query, $get_coupon_id);
        return $result;
    }

    public function get_min_order_value($get_coupon_id) {
        $query = "SELECT min_order_value FROM coupons WHERE id = ? AND `status` = 'active'";
        $result = pdo_query_value($query, $get_coupon_id);
        return $result;
    }

    public function insert_orders($user_id, $coupon_id, $email_order, $phone_order, $name_order, $total_price, $address_order, $payment_method)
    {
        if (!empty($coupon_id)) {
            $query = "INSERT INTO orders (user_id, coupon_id, email_order, phone_order, name_order, total_price, shipping_address, payment_method, `status`) 
                  VALUES (?,?,?,?,?,?,?,?, 'processing')";
            return pdo_execute_return_last_id($query, $user_id, $coupon_id, $email_order, $phone_order, $name_order, $total_price, $address_order, $payment_method);
        } else {
            $query = "INSERT INTO orders (user_id, email_order, phone_order, name_order, total_price, shipping_address, payment_method, `status`) 
                  VALUES (?,?,?,?,?,?,?, 'processing')";
            return pdo_execute_return_last_id($query, $user_id, $email_order, $phone_order, $name_order, $total_price, $address_order, $payment_method);
        }
    }


    public function insert_orderDetail($data)
    {
        $query = "INSERT INTO order_details (order_id, product_variant_id, quantity, price) VALUE (:order_id, :product_variant_id, :quantity, :price)";
        $result = pdo_execute2($query, $data);
        return $result;
    }

    public function update_coupons($coupon_id) {
        $query = "UPDATE coupons set usage_limit = usage_limit - 1, used_count = used_count + 1 WHERE id = ?";
        pdo_query($query, $coupon_id);
    }

    public function insert_payments($order_id, $payment_method)
    {
        if ($payment_method == 'COD') {
            $query = "INSERT INTO payments (order_id) VALUE (?)";
            pdo_execute($query, $order_id);
        } else {
            $query = "INSERT INTO payments (order_id, payment_status) VALUE (?, 'paid')";
            pdo_execute($query, $order_id);
        }
    }

    public function clearCartByUserId($user_id)
    {
        $querry = "DELETE ci FROM cart_items ci
        join carts c on c.id = ci.cart_id
        where c.user_id = ?";
        $result = pdo_execute($querry, $user_id);
    }

    public function update_stock_quantity($quantity, $product_variant_id)
    {
        $query = "UPDATE product_variants p set p.stock_quantity = p.stock_quantity - ?  WHERE p.id = ?";
        $result = pdo_execute($query, $quantity, $product_variant_id);
        return $result;
    }
}
