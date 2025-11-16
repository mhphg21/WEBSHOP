<?php
class AdminProduct
{

    // Lấy tất cả sản phẩm 
    public function get_all_products($start, $limit, $filter_by_categories, $keyword = "")
    {
        $params = [];
        $query = "SELECT p.*, SUM(v.stock_quantity) AS total_stock, c.name AS categories 
              FROM products p 
              LEFT JOIN product_variants v ON p.id = v.product_id 
              LEFT JOIN categories c ON p.category_id = c.id 
              WHERE 1=1 ";  // điều kiện luôn đúng, để dễ nối các điều kiện tiếp theo

        // Nếu lọc theo danh mục
        if ($filter_by_categories > 0) {
            $query .= "AND p.category_id = ? ";
            $params[] = $filter_by_categories;
        }

        // Nếu tìm kiếm theo tên sản phẩm
        if (!empty($keyword)) {
            $query .= "AND p.name LIKE ? ";
            $params[] = "%" . $keyword . "%";  // tìm kiếm gần đúng
        }

        $query .= "GROUP BY p.id LIMIT $start, $limit";


        return pdo_query($query, ...$params);
    }




    // Lấy tất cả biến thể sản phẩm theo ID products
    public function get_product_variant($id)
    {
        $query = "SELECT 
                pv.*, 
                av_color.value AS color, 
                av_size.value AS size
            FROM product_variants pv
            LEFT JOIN variant_attribute_values vav_color 
                ON pv.id = vav_color.product_variant_id 
                AND vav_color.attribute_id = (SELECT id FROM attributes WHERE name = 'màu' LIMIT 1)
            LEFT JOIN attribute_values av_color 
                ON vav_color.attribute_value_id = av_color.id
            LEFT JOIN variant_attribute_values vav_size 
                ON pv.id = vav_size.product_variant_id 
                AND vav_size.attribute_id = (SELECT id FROM attributes WHERE name = 'Size' LIMIT 1)
            LEFT JOIN attribute_values av_size 
                ON vav_size.attribute_value_id = av_size.id
            WHERE pv.product_id = ?";
        $stmt = pdo_query($query, $id);
        return $stmt;
    }

    // Lấy biến thể sản phẩm theo ID product_variant
    public function get_variant_by_id($id)
    {
        $query = "SELECT * FROM product_variants WHERE id = ? ";
        $stmt = pdo_query_one($query, $id);
        return $stmt;
    }

    // Cập nhật biến thể sản phẩm
    public function update_variant($is_hot, $sku, $price, $sale_price, $stock_quantity, $status, $id)
    {
        $query = "UPDATE product_variants SET is_hot = ?, sku = ?, price = ?, sale_price = ?, stock_quantity = ?, status = ? WHERE id = ?";
        pdo_execute($query, $is_hot, $sku, $price, $sale_price, $stock_quantity, $status, $id);
    }

    // Thêm biến thể sản phẩm
    public function create_variant($product_id, $sku, $price, $sale_price, $stock_quantity, $status)
    {
        $query = "INSERT INTO product_variants (product_id, sku, price, sale_price, stock_quantity,status) VALUES (?, ?, ?, ?, ?, ?)";
        $result = pdo_execute_return_last_id($query, $product_id, $sku, $price, $sale_price, $stock_quantity, $status);
        return $result;
    }

    // Xóa biến thể sản phẩm
    public function delete_variant($id)
    {
        $query = "DELETE FROM product_variants WHERE id = ?";
        pdo_execute($query, $id);
    }


    // Lấy danh mục sản phẩm
    public function get_categories()
    {
        $query = "SELECT * FROM categories";
        $result = pdo_query($query);
        return $result;
    }

    public function count_product_by_category()
    {
        $query = "SELECT 
    c.id AS category_id,
    c.name AS category_name,
    COUNT(p.id) AS total_products
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name
ORDER BY total_products DESC";
        $result = pdo_query($query);
        return $result;
    }

    public function get_revenue()
    {
        $query = "SELECT o.total_price FROM orders o
                JOIN payments p ON p.order_id = o.id WHERE p.payment_status = 'paid'";
        $result = pdo_query($query);
        return $result;
    }

    // Lấy attribute 
    public function get_att_value($id)
    {
        $query = "SELECT a.name ,av.value, av.id FROM attribute_values av LEFT JOIN attributes a ON av.attribute_id = a.id WHERE attribute_id = ?;";
        $result = pdo_query($query, $id);
        return $result;
    }

    // Kiểm tra tồn tại biến thể
    public function check_variant_exists( $sku)
    {
        $query = "SELECT COUNT(*) FROM product_variants WHERE sku = ? ";
        $count = pdo_query_value($query,  $sku);
        return $count > 0;
    }

    // Kiểm tra tồn tại danh mục
    public function category_exists($name)
    {
        $query = "SELECT COUNT(*) FROM categories WHERE name = ? ";
        $count = pdo_query_value($query, $name);
        return $count > 0;
    }

    // Tạo sản phẩm mới 
    public function create_product($pro_category_id, $pro_name, $pro_description, $thumbnail, $price, $sale_price, $pro_status, $pro_new, $pro_hot)
    {
        $query = "INSERT INTO products (category_id, name, description,thumbnail ,price, sale_price, status, is_new, is_hot) VALUES (?, ? ,?,? ,? ,? ,?, ?,?)";
        $result = pdo_execute_return_last_id($query, $pro_category_id, $pro_name, $pro_description, $thumbnail, $price, $sale_price, $pro_status, $pro_new, $pro_hot);
        return $result;
    }
    // Thêm thuộc tính sản phẩm
    public function create_product_variants($product_id, $pro_hot, $sku, $price, $sale_price, $quantity, $variant_status)
    {
        $query = "INSERT INTO product_variants ( product_id, is_hot, sku, price, sale_price, stock_quantity, status) VALUE (?,?,?,?,?,?,?)";
        $result = pdo_execute_return_last_id($query, $product_id, $pro_hot, $sku, $price, $sale_price, $quantity, $variant_status);
        return $result;
    }
    // Thêm giá trị thuộc tính
    public function create_variant_attribute_values($product_variant_id, $attribute_id, $attribute_value_id)
    {
        $query = "INSERT INTO variant_attribute_values (product_variant_id, attribute_id, attribute_value_id) VALUES (? ,? ,? )";
        pdo_execute($query, $product_variant_id, $attribute_id, $attribute_value_id);
    }
    // Thêm ảnh sản phẩm
    public function create_variant_image($product_id, $color_value_id, $image_url, $is_primary, $path)
    {
        $query = "INSERT INTO product_variant_images ( product_id, color_id, image_url, is_primary, path) VALUES (?,?,?,?,?)";
        pdo_execute($query, $product_id, $color_value_id, $image_url, $is_primary, $path);
    }




    // Thêm biến thể sản phẩm 
    public function create_product_variant($product_id, $variant_sku, $variant_price, $variant_sale_price, $variant_stock, $variant_image_url, $variant_status)
    {
        $query = "INSERT INTO product_variants (product_id, sku, price, sale_price, stock_quantity, image_url, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $result = pdo_execute_return_last_id($query, $product_id, $variant_sku, $variant_price, $variant_sale_price, $variant_stock, $variant_image_url, $variant_status);
        return $result;
    }

    // Tạo bảng giá trị thuộc tính của sản biến thể
    public function create_product_variant_attribute($variant_id, $color, $size)
    {
        $query = "INSERT INTO variant_attribute_values (product_variant_id, attribute_id, attribute_value_id) VALUES (?, ?, ?)";
        pdo_execute($query, $variant_id, $color, $size);
    }

    // Đếm tổng số sản phẩm
    public function count_total_products()
    {
        $query = 'SELECT COUNT(*) as total FROM products';
        $stmt = pdo_query_one($query);
        return $stmt['total'] ?? 0;
    }

    // Đếm tổng số đơn hàng
    public function count_total_orders()
    {
        $query = 'SELECT COUNT(*) as total FROM orders';
        $stmt = pdo_query_one($query);
        return $stmt['total'] ?? 0;
    }

    // Đếm tổng số khách hàng
    public function count_total_customers()
    {
        $query = 'SELECT COUNT(*) as total FROM users WHERE role_id = 3';
        $stmt = pdo_query_one($query);
        return $stmt['total'] ?? 0;
    }

    // phân trang 

    // Lấy tổng số bản ghi
    public function select_count()
    {
        $query = "SELECT COUNT(*) as total FROM products";
        $stmt = pdo_query2($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }


    // Truy vấn dữ liệu trang
    public function select_current_page($start, $limit)
    {
        $query = "SELECT * FROM products LIMIT $start, $limit";
        $stmt = pdo_query($query);
        return $stmt;
    }

    // Truy vấn sản phẩm thay đổi
    public function get_product_by_id($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = pdo_query_one($query, $id);
        return $stmt;
    }

    // Sửa sản phẩm
    public function update_product($category_id, $name, $description, $image_url, $price, $sale_price, $status, $is_new, $is_hot, $edit_pro)
    {
        $query = "UPDATE products SET 
                category_id = ?, 
                name = ?, 
                description = ?, 
                thumbnail = ?, 
                price = ?, 
                sale_price = ?, 
                status = ?, 
                is_new = ?, 
                is_hot = ?
              WHERE id = ?";
        try {
            pdo_execute($query, $category_id, $name, $description, $image_url, $price, $sale_price, $status, $is_new, $is_hot, $edit_pro);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    // Lấy đơn hàng của biến thể
    public function check_order_item($product_id)
    {
        $query = "SELECT COUNT(*) AS count
              FROM order_details 
              WHERE product_variant_id IN (
                  SELECT id 
                  FROM product_variants 
                  WHERE product_id = ?
              )";

        $result = pdo_query2_fetch($query, [$product_id]);  // Truyền tham số dưới dạng mảng
        return $result['count'];  // Trả về số lượng
    }

    // Thêm danh mục mới
    public function create_category($name)
    {
        $query = "INSERT INTO categories (name) VALUES (?)";
        pdo_execute($query, $name);
    }

    // Xóa danh mục
    public function delete_category($id)
    {
        $query = "DELETE FROM categories WHERE id = ? ";
        pdo_execute($query, $id);
    }

    // check exists category
    public function category_exists_2($category_id)
    {
        $query = "SELECT COUNT(*) FROM products WHERE category_id = ?";
        $count = pdo_query_value($query, $category_id);
        return $count > 0;
    }
    //  Lấy danh mục theo ID
    public function get_category_by_id($id)
    {
        $query = "SELECT * FROM categories WHERE id = ?";
        $result = pdo_query_one($query, $id);
        return $result;
    }
    public function update_category($id, $name)
    {
        $query = "UPDATE categories SET name = ? WHERE id = ?";
        pdo_execute($query, $name, $id);
    }
    // lấy doanh thu theo ngày
    public function filter_total_price_by_day()
    {
        $query = "SELECT DATE(created_at) as ngay, SUM(total_price) as tongtien, SUM(total_price) as tongdoanhthu FROM orders GROUP BY ngay ORDER BY ngay ASC LIMIT 7";
        $result = pdo_query($query);
        return $result;
    }


    // Lấy doanh thu theo tháng
    public function filter_total_price_by_month()
    {
        $query = "SELECT DATE_FORMAT(created_at, '%Y-%m') as ngay, SUM(total_price) as tongtien FROM orders GROUP BY ngay ORDER BY ngay ASC";
        return pdo_query($query);
    }

    // Lấy doanh thu theo năm
    public function filter_total_price_by_year()
    {
        $query = "SELECT YEAR(created_at) as ngay, SUM(total_price) as tongtien FROM orders GROUP BY ngay ORDER BY ngay ASC";
        return pdo_query($query);
    }
    // Lấy tổng doanh thu và tổng số đơn hàng
    public function get_total_revenue_and_orders()
    {
        $query = "SELECT 
                SUM(total_price) AS tongtien, 
                COUNT(*) AS tongsoluong 
              FROM orders";
        $result = pdo_query_one($query);
        return $result;
    }

    // Lấy sản phẩm bán chạy nhất
    public function get_best_selling_product()
    {
        $query = "SELECT 
                p.id, 
                p.name, 
                SUM(od.quantity) AS total_sold
            FROM products p
            JOIN product_variants pv ON p.id = pv.product_id
            JOIN order_details od ON pv.id = od.product_variant_id
            GROUP BY p.id, p.name
            ORDER BY total_sold DESC
            LIMIT 1";
        $result = pdo_query_one($query);
        return $result;
    }
}
