<?php
class Coupons
{
    public function getListCoupon()
    {
        $querry = "SELECT * from coupons 
        where status = 'active'
        order by id desc
        ";
        $result = pdo_query($querry);
        return $result;
    }
    public function countFilterCouponsByStatus()
    {
        $querry = "SELECT COUNT(*) as total FROM coupons WHERE status = 'active'";
        $result = pdo_query_one($querry);
        return (int) $result['total'];
    }


    // Sau khi thêm mới coupons sẽ sổ ra list status  = pending
    public function getListNewCoupon()
    {
        $querry = "SELECT * from coupons 
        where status = 'pending'
        order by id desc";
        $result = pdo_query($querry);
        return $result;
    }

    public function countFilterNewCouponsByStatus()
    {
        $querry = "SELECT COUNT(*) as total FROM coupons WHERE status = 'pending'";
        $result = pdo_query_one($querry);
        return (int) $result['total'];
    }
    public function countFilterCoupons($code, $min_price, $max_price, $status, $start_date, $end_date, $used_count, $order_value)
    {
        $query = "SELECT COUNT(*) as total FROM coupons
        WHERE 1=1
        ";
        // $params = [];
        if ($code != null) {
            $query .= " AND code LIKE '%$code%'";
        }
        if ($min_price != null) {
            $query .= " AND min_order_value >= $min_price";
        }
        if ($max_price != null) {
            $query .= " AND min_order_value <= $max_price";
        }
        if ($status != null) {
            $query .= " AND status = '$status'";
        }
        if ($start_date != null) {
            $query .= " AND DATE(start_date) >= '$start_date'";
        }
        if ($end_date != null) {
            $query .= " AND DATE(end_date) <= '$end_date'";
        }

        // Xử lý ORDER BY
        $orderConditions = [];
        if ($used_count != null) {
            // Sắp xếp theo used_count
            $orderConditions[] = "used_count $used_count"; // $used_count = 'ASC' hoặc 'DESC'
        }
        if ($order_value != null) {
            // Sắp xếp theo order_value
            $orderConditions[] = "min_order_value $order_value"; // $order_value = 'ASC' hoặc 'DESC'
        }

        if (!empty($orderConditions)) {
            $query .= " ORDER BY " . implode(", ", $orderConditions);
        }
        $result = pdo_query_value($query);
        return (int) $result;
    }

    public function searchCoupons($code, $min_price, $max_price, $status, $start_date, $end_date, $used_count, $order_value, $page, $limit)
    {
        $start = ($page - 1) * $limit;

        $query = "SELECT * FROM coupons WHERE 1=1";

        if ($code != null) {
            $query .= " AND code LIKE '%$code%'";
        }
        if ($min_price != null) {
            $query .= " AND min_order_value >= $min_price";
        }
        if ($max_price != null) {
            $query .= " AND min_order_value <= $max_price";
        }
        if ($status != null) {
            $query .= " AND status = '$status'";
        }
        if ($start_date != null) {
            $query .= " AND DATE(start_date) >= '$start_date'";
        }
        if ($end_date != null) {
            $query .= " AND DATE(end_date) <= '$end_date'";
        }

        // Xử lý ORDER BY
        $orderConditions = [];
        if ($used_count != null) {
            // Sắp xếp theo used_count
            $orderConditions[] = "used_count $used_count"; // $used_count = 'ASC' hoặc 'DESC'
        }
        if ($order_value != null) {
            // Sắp xếp theo order_value
            $orderConditions[] = "min_order_value $order_value"; // $order_value = 'ASC' hoặc 'DESC'
        }

        if (!empty($orderConditions)) {
            $query .= " ORDER BY " . implode(", ", $orderConditions);
        }

        // Thêm phân trang
        $query .= " LIMIT $start, $limit";

        $result = pdo_query($query);
        return $result;
    }

    public function handleUpdateStatusCoupon($newStatus, $idCoupon)
    {
        $query = "Update coupons SET status = '$newStatus' WHERE id = '$idCoupon'";
        $result = pdo_execute($query);
        return $result;
    }


    //--------------------lấy chi tiết coupons------------------------
    public function get_coupons_by_id($idCoupon)
    {
        $query = "SELECT * from coupons where id = ?";
        $result = pdo_query_one($query, $idCoupon);
        return $result;
    }

    //--------------------update chi tiết coupons------------------------
    public function update_coupon($code, $discount_value, $usage_limit, $start_date, $end_date, $idCoupon)
    {
        $query = "UPDATE coupons set 
                        code = ?, discount_value=?,usage_limit=?,start_date=?,end_date=?
                        where id = ?";
        $result = pdo_execute($query, $code, $discount_value, $usage_limit, $start_date, $end_date, $idCoupon);
    }
    //--------------------thêm coupons------------------------
    public function create_coupon($code, $discount_value, $min_order_value, $usage_limit, $start_date, $end_date)
    {
        // $query = "SELECT COUNT(*) as total FROM coupons WHERE code = ?";
        // $count = pdo_query_value($query, $code);
        // if ($count > 0) {
        //     return false; // Mã giảm giá đã tồn tại
        // } else {
            $query = "INSERT INTO coupons (code, discount_type, discount_value, min_order_value, usage_limit, start_date, end_date, status) 
                    VALUES (?,'fixed', ?, ?, ?, ?, ?, 'pending')";
            $result = pdo_execute($query, $code, $discount_value, $min_order_value, $usage_limit, $start_date, $end_date);
            return $result;
        // }
    }

    public function get_code_coupons(){
        $query = "SELECT code FROM coupons";
        $result = pdo_query($query);
        return $result;
    }
}
