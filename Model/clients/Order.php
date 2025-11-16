<?php
class OrderClients
{

    public function list_category()
    {
        $query = "SELECT * FROM `categories`";
        $result = pdo_query($query);
        return $result;
    }

    public function list_order($user_id)
    {
        $query = "SELECT p.name, pv.price AS pv_price,
                        o.status, o.total_price, 
                        od.price, od.quantity, 
                        pv.id AS product_variant_id, p.description, 
                        p.thumbnail, od.id AS order_detail_id, pv.product_id, od.order_id
                    FROM orders o
                    JOIN order_details od ON od.order_id = o.id
                    JOIN product_variants pv ON od.product_variant_id = pv.id
                    JOIN products p ON p.id = pv.product_id
                    WHERE o.user_id = ?
                    GROUP BY o.id 
                    ORDER BY o.id DESC";
        $result = pdo_query($query, $user_id);
        return $result;
    }

    // Phải có order_id Bằng cách lấy theo user_id => Trả về dạng mảng => Làm giống bên check out để lấy từng order_id
    // lấy ra cái product_variant theo order_id và user_id
    // DONE

    public function list_color_by_user($user_id)
    {
        $query = "SELECT av.value AS color_value, od.product_variant_id 
                    FROM variant_attribute_values vav
                    JOIN order_details od ON od.product_variant_id = vav.product_variant_id
                    JOIN orders o ON o.id = od.order_id
                    JOIN attribute_values av ON av.id = vav.attribute_value_id
                    WHERE o.user_id = ? AND vav.attribute_id = 1";
        $result = pdo_query($query, $user_id);
        return $result;
    }

    public function list_size_by_user($user_id)
    {
        $query = "SELECT av.value AS size_value, od.product_variant_id 
                    FROM variant_attribute_values vav
                    JOIN order_details od ON od.product_variant_id = vav.product_variant_id
                    JOIN orders o ON o.id = od.order_id
                    JOIN attribute_values av ON av.id = vav.attribute_value_id
                    WHERE o.user_id = ? AND vav.attribute_id = 2";
        $result = pdo_query($query, $user_id);
        return $result;
    }

    public function count_order($user_id)
    {
        $query = "SELECT COUNT(o.id) FROM orders o
                    WHERE o.user_id = ?";
        $result = pdo_query_one_1($query, $user_id);
        return $result;
    }

    public function get_info_items($order_id)
    {
        $query = "SELECT od.product_variant_id, p.description, p.thumbnail, pv.price AS pv_price, od.price, od.quantity, p.name FROM orders o
                    JOIN order_details od ON od.order_id = o.id
                    JOIN product_variants pv ON pv.id = od.product_variant_id
                    JOIN products p ON p.id = pv.product_id
                    WHERE o.id = ?";
        $result = pdo_query($query, $order_id);
        return $result;
    }

    public function get_info_color($order_id)
    {
        $query = "SELECT av.value AS color_value, od.product_variant_id 
                    FROM variant_attribute_values vav
                    JOIN order_details od ON od.product_variant_id = vav.product_variant_id
                    JOIN orders o ON o.id = od.order_id
                    JOIN attribute_values av ON av.id = vav.attribute_value_id
                    WHERE o.id = ? AND vav.attribute_id = 1";
        $result = pdo_query($query, $order_id);
        return $result;
    }

    public function get_info_size($order_id)
    {
        $query = "SELECT av.value AS size_value, od.product_variant_id 
                    FROM variant_attribute_values vav
                    JOIN order_details od ON od.product_variant_id = vav.product_variant_id
                    JOIN orders o ON o.id = od.order_id
                    JOIN attribute_values av ON av.id = vav.attribute_value_id
                    WHERE o.id = ? AND vav.attribute_id = 2";
        $result = pdo_query($query, $order_id);
        return $result;
    }

    public function get_info_order($order_id)
    {
        $query = "SELECT c.id as coupon_id FROM `orders` o
                    JOIN coupons c ON c.id = o.coupon_id
                    WHERE o.id = ?";
        $result = pdo_query_one($query, $order_id);

        if (!empty($result)) {
            $query = "SELECT p.name, o.*, od.price, od.quantity, pv.price AS pv_price, c.min_order_value, c.discount_value FROM orders o
                    JOIN order_details od ON od.order_id = o.id
                    JOIN product_variants pv ON pv.id = od.product_variant_id
                    JOIN products p ON p.id = pv.product_id
                    JOIN coupons c ON c.id = o.coupon_id
                    WHERE o.id = ?";
            $result1 = pdo_query_one($query, $order_id);
            return $result1;
        } else {
            $query = "SELECT p.name, o.*, od.price, od.quantity, pv.price AS pv_price FROM orders o
                    JOIN order_details od ON od.order_id = o.id
                    JOIN product_variants pv ON pv.id = od.product_variant_id
                    JOIN products p ON p.id = pv.product_id
                    WHERE o.id = ?";
            $result1 = pdo_query_one($query, $order_id);
            return $result1;
        }
    }

    public function update_status_cancelled($order_id)
    {
        $query = "UPDATE orders SET status = 'cancelled' WHERE id = ?";
        pdo_execute($query, $order_id);
    }

    public function update_payments_cancel($order_id)
    {
        $query = "UPDATE payments SET payment_status = 'failed' WHERE order_id = ?";
        pdo_execute($query, $order_id);
    }

    public function update_stock_quantity($quantity, $product_variant_id)
    {
        $query = "UPDATE product_variants p set p.stock_quantity = p.stock_quantity + ?  WHERE p.id = ?";
        $result = pdo_execute($query, $quantity, $product_variant_id);
        return $result;
    }

    public function update_status_delivered($order_id)
    {
        $query = "UPDATE orders SET status = 'delivered' WHERE id = ?";
        pdo_execute($query, $order_id);
    }

    public function update_payments($order_id)
    {
        $query = "UPDATE payments SET payment_status = 'paid' WHERE order_id = ?";
        pdo_execute($query, $order_id);
    }
}
