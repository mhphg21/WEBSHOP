    <?php
    class Order
    {
        public function getListOrders()
        {
            $querry = "SELECT * from orders";
            $result = pdo_query($querry);
            return $result;
        }


        public function countFilterOrder($name, $email, $phone, $shipping_address, $payment_method, $status, $created_at, $updated_at, $min_price, $max_price)
        {
            $querry = "SELECT COUNT(*) as total from orders o
                    join users u on u.id = o.user_id
                    where 1=1";
            $params = [];
            if (!empty($name)) {
                $querry .= " AND u.name LIKE :name";
                $params[':name'] = '%' . $name . '%';
            }

            if (!empty($email)) {
                $querry .= " AND email LIKE :email";
                $params[':email'] = '%' . $email . '%';
            }

            if (!empty($phone)) {
                $querry .= " AND u.phone LIKE :phone";
                $params[':phone'] = '%' . $phone . '%';
            }

            if (!empty($total_price)) {
                $querry .= " AND total_price LIKE :total_price";
                $params[':total_price'] = '%' . $total_price . '%';
            }

            if (!empty($shipping_address)) {
                $querry .= " AND shipping_address LIKE :shipping_address";
                $params[':shipping_address'] =  '%' . $shipping_address . '%';
            }

            if (!empty($payment_method)) {
                $querry .= " AND payment_method = :payment_method";
                $params[':payment_method'] =  $payment_method;
            }

            if (!empty($status)) {
                $querry .= " AND o.status = :status";
                $params[':status'] =  $status;
            }

            if (!empty($created_at)) {
                $querry .= " AND DATE(o.created_at) >= :created_at";
                $params[':created_at'] = $created_at;
            }

            if (!empty($updated_at)) {
                $querry .= " AND DATE(o.updated_at) <= :updated_at";
                $params[':updated_at'] = $updated_at;
            }

            if (!empty($min_price)) {
                $querry .= " AND total_price >= :min_price";
                $params[':min_price'] = $min_price;
            }

            if (!empty($max_price)) {
                $querry .= " AND total_price <= :max_price";
                $params[':max_price'] = $max_price;
            }

            $result = pdo_query_one_with_params($querry, $params);
            return (int) $result['total'];
        }


        public function searchOrder($name, $email, $phone, $shipping_address, $payment_method, $status, $created_at, $updated_at, $min_price, $max_price, $page, $limit)
        {
            $start = ($page - 1) * $limit;
            $querry = "SELECT u.name as username,
                        u.email as email,
                        u.phone as phone,
                        o.id,
                        o.total_price,
                        o.shipping_address,
                        o.payment_method,
                        o.status,
                        o.created_at,
                        o.updated_at
                        from orders o
                        JOIN users u on u.id = o.user_id
                        where 1=1";
            $params = [];

            if (!empty($name)) {
                $querry .= " AND u.name LIKE :name";
                $params[':name'] = '%' . $name . '%';
            }

            if (!empty($email)) {
                $querry .= " AND u.email LIKE :email";
                $params[':email'] = '%' . $email . '%';
            }

            if (!empty($phone)) {
                $querry .= " AND u.phone LIKE :phone";
                $params[':phone'] = '%' . $phone . '%';
            }

            if (!empty($shipping_address)) {
                $querry .= " AND o.shipping_address LIKE :shipping_address";
                $params[':shipping_address'] = '%' . $shipping_address . '%';
            }

            if (!empty($payment_method)) {
                $querry .= " AND payment_method = :payment_method";
                $params[':payment_method'] =  $payment_method;
            }

            if (!empty($status)) {
                $querry .= " AND o.status = :status";
                $params[':status'] =  $status;
            }

            if (!empty($created_at)) {
                $querry .= " AND DATE(o.created_at) >= :created_at";
                $params[':created_at'] = $created_at;
            }

            if (!empty($updated_at)) {
                $querry .= " AND DATE(o.updated_at) <= :updated_at";
                $params[':updated_at'] = $updated_at;
            }

            if (!empty($min_price)) {
                $querry .= " AND total_price >= :min_price";
                $params[':min_price'] = $min_price;
            }

            if (!empty($max_price)) {
                $querry .= " AND total_price <= :max_price";
                $params[':max_price'] = $max_price;
            }

            $querry .= " ORDER BY o.id DESC LIMIT $start, $limit";
            $result =  pdo_query2($querry, $params);
            return $result;
        }
        // Đếm danh sách order processing
        public function countOrderProcessing()
        {
            $querry = "SELECT COUNT(*) as total from orders o
                    join users u on u.id = o.user_id
                    where o.status = 'processing'";
            $result = pdo_query_one($querry);
            return (int) $result['total'];
        }
        // Danh sách đơn hàng đang xử lí 
        public function listOrderPending()
        {
            $querry = "SELECT u.name as username,
                        u.email as email,
                        u.phone as phone,
                        o.id,
                        o.total_price,
                        o.shipping_address,
                        o.payment_method,
                        o.status,
                        o.created_at,
                        o.updated_at
                        from orders o
                        JOIN users u on u.id = o.user_id
                        where o.status = 'processing'";
            $result = pdo_query2($querry, array());
            return $result;
        }
        public function orderDetail($idOrder)
        {
            $querry = " SELECT 
                pdv.sku as sku_name,
                pdv.id as product_variant_id,
                p.name as product_name,
                odt.price,
                odt.quantity
                FROM order_details odt
                JOIN product_variants pdv on pdv.id = odt.product_variant_id
                JOIN products p on p.id = pdv.product_id
                JOIN orders o ON o.id = odt.order_id
                -- JOIN users u on u.id = o.user_id
                WHERE o.id = ? 
            ";
            $result = pdo_query($querry, $idOrder);
            return $result;
        }


        public function getSize($pdv_id)
        {
            $querry = "SELECT atv.value as size,
                            vav.product_variant_id
                            from attribute_values atv
                            JOIN attributes atb on atb.id = atv.attribute_id
                            JOIN variant_attribute_values vav on vav.attribute_id = atb.id
                            JOIN product_variants pv on pv.id = vav.product_variant_id 
                            WHERE pv.id = ? AND atb.id = 2 and atv.id = vav.attribute_value_id";
            $result = pdo_query_one($querry, $pdv_id);
            return $result;
        }

        public function getcolor($pdv_id)
        {
            $querry = "SELECT atv.value as color,
                            vav.product_variant_id
                            from attribute_values atv
                            JOIN attributes att on att.id = atv.attribute_id
                            JOIN variant_attribute_values vav on vav.attribute_id = att.id
                            JOIN product_variants pv on pv.id = vav.product_variant_id 
                            WHERE pv.id = ? AND att.id = 1 and atv.id = vav.attribute_value_id";
            $result = pdo_query_one($querry, $pdv_id);
            return $result;
        }

        public function paymentDetail($idOrder)
        {
            $querry = "SELECT 
                            o.payment_method,
                            o.total_price as total,
                            p.payment_status,
                            p.transaction_id,
                            p.payment_gateway,
                            p.paid_at
                            FROM payments p
                            JOIN orders o on o.id = p.order_id
                            where o.id = ?";
            $result = pdo_query($querry, $idOrder);
            return $result;
        }


        public function handleUpdateOrderStatus($newStatus, $idOrder)
        {
            $querry = "UPDATE orders SET status = ? WHERE id = ?";
            $result = pdo_query($querry, $newStatus, $idOrder);
            return $result;
        }

        public function get_user_id_by_order($idOrder)
        {
            $querry = "SELECT user_id FROM orders WHERE id = ?";
            $result = pdo_query_one($querry, $idOrder);
            return $result ? $result['user_id'] : null;
        }

        public function handle_cancel_order($newStatus, $idOrder)
        {
            $querry = "UPDATE orders SET status = ? WHERE id = ?";
            $result = pdo_query($querry, $newStatus, $idOrder);
            return $result;
        }
        public function handleUpdatePaymentStatus($newStatus, $idOrder)
        {
            $querry = "UPDATE payments SET payment_status = ? WHERE order_id = ?";
            // Assuming the payment status is updated based on the order status
            // This might need to be adjusted based on your actual logic
            if ($newStatus == 'delivered') {
                $newStatusPayment = 'paid';
            } else if ($newStatus == 'cancelled') {
                $newStatusPayment = 'failed';
            } else {
                $newStatusPayment = 'pending';
            }
            $result = pdo_query($querry, $newStatusPayment, $idOrder);
            return $result;
        }
    }
