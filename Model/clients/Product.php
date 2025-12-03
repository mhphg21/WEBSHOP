<?php
class Product
{
    public function get_8_product()
    {
        $query = "SELECT 
            p.*, 
            pv.id AS product_variant_id,
            GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
        FROM products p
        JOIN product_variants pv ON pv.product_id = p.id
        LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
        LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
        WHERE vav.attribute_id = 1 AND p.status = 'active' AND pv.status = 'active'
        GROUP BY p.id
        ORDER BY p.id ASC
        LIMIT 8 OFFSET 0";
        $result = pdo_query($query);
        return $result;
    }

    public function get_more_product($limit)
    {
        $query = "SELECT 
                p.*, 
                pv.id AS product_variant_id,
                GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
            FROM products p
            JOIN product_variants pv ON pv.product_id = p.id
            LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
            LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
            WHERE vav.attribute_id = 1 
              AND p.status = 'active' 
              AND pv.status = 'active'
            GROUP BY p.id
            ORDER BY p.id ASC
            LIMIT $limit OFFSET 0";
        return pdo_query($query);
    }

    public function get_count_pro()
    {
        $query = "SELECT COUNT(id) AS count FROM products";
        return pdo_query_value($query);
    }

    public function name_by_cate($cate_id)
    {
        $query = "SELECT name FROM categories WHERE id = ?";
        $result = pdo_query_value($query, $cate_id);
        return $result;
    }

    public function get_hot_product()
    {
        $query = "SELECT 
            p.*, 
            pv.id AS product_variant_id,
            GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
        FROM products p
        JOIN product_variants pv ON pv.product_id = p.id
        LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
        LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
        WHERE vav.attribute_id = 1 AND p.status = 'active' AND pv.status = 'active'
        GROUP BY p.id
        ORDER BY p.id DESC
        LIMIT 4 OFFSET 0";
        $result = pdo_query($query);
        return $result;
    }

    public function get_coupons()
    {
        $query = "SELECT * FROM coupons WHERE `status` = 'active' AND usage_limit > 0";
        $result = pdo_query($query);
        return $result;
    }

    public function get_banner()
    {
        $query = "SELECT image_url FROM banners";
        $result = pdo_query($query);
        return $result;
    }

    public function list_category()
    {
        $query = "SELECT * FROM `categories`";
        $result = pdo_query($query);
        return $result;
    }

    public function pro_by_cate($cate_id)
    {
        $query = "SELECT 
            p.*, 
            pv.id AS product_variant_id,
            GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
        FROM products p
        JOIN product_variants pv ON pv.product_id = p.id
        JOIN categories ca ON ca.id = p.category_id
        LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
        LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
        WHERE vav.attribute_id = 1 AND p.status = 'active' AND pv.status = 'active' AND ca.id = ?
        GROUP BY p.id
        ORDER BY p.id ASC
        LIMIT 8 OFFSET 0";
        $result = pdo_query($query, $cate_id);
        return $result;
    }

    public function count_pro_cate($cate_id)
    {
        $query = "SELECT COUNT(p.id) AS count FROM products p
                    JOIN categories ca ON ca.id = p.category_id
                    WHERE ca.id = $cate_id";
        return pdo_query_value($query);
    }


    public function get_more_cate_pro($limit, $cate_id)
    {
        $query = "SELECT 
            p.*, 
            pv.id AS product_variant_id,
            GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
        FROM products p
        JOIN product_variants pv ON pv.product_id = p.id
        JOIN categories ca ON ca.id = p.category_id
        LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
        LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
        WHERE vav.attribute_id = 1 AND p.status = 'active' AND pv.status = 'active' AND ca.id = ?
        GROUP BY p.id
        ORDER BY p.id ASC
        LIMIT $limit OFFSET 0";
        $result = pdo_query($query, $cate_id);
        return $result;
    }

    public function pros_by_search($keyword)
    {
        $query = "SELECT 
        p.*, 
        pv.id AS product_variant_id,
        GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
        FROM products p
        JOIN product_variants pv ON pv.product_id = p.id
        LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
        LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
        WHERE vav.attribute_id = 1 
        AND p.status = 'active' 
        AND pv.status = 'active'
        AND (p.name LIKE ? OR pv.sku LIKE ?)
        GROUP BY p.id
        ORDER BY p.id ASC
        LIMIT 8 OFFSET 0";
        $keyword = "%$keyword%";

        $result = pdo_query($query, $keyword, $keyword);
        return $result;
    }

    public function count_pros_by_search($keyword)
    {
        $query = "SELECT COUNT(DISTINCT p.id) AS count 
                  FROM products p 
                  JOIN product_variants pv ON pv.product_id = p.id 
                  WHERE (p.name LIKE ? OR pv.sku LIKE ?)";
        $keyword = "%$keyword%";
        return pdo_query_value($query, $keyword, $keyword);
    }

    public function get_more_search($limit, $keyword)
    {
        $query = "SELECT 
        p.*, 
        pv.id AS product_variant_id,
        GROUP_CONCAT(DISTINCT av.value ORDER BY av.value SEPARATOR ', ') AS color_values
        FROM products p
        JOIN product_variants pv ON pv.product_id = p.id
        LEFT JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id 
        LEFT JOIN attribute_values av ON av.id = vav.attribute_value_id
        WHERE vav.attribute_id = 1 
        AND p.status = 'active' 
        AND pv.status = 'active'
        AND (p.name LIKE ? OR pv.sku LIKE ?)
        GROUP BY p.id
        ORDER BY p.id ASC
        LIMIT $limit OFFSET 0";
        $keyword = "%$keyword%";
        $result = pdo_query($query, $keyword, $keyword);
        return $result;
    }


    public function get_product_variant_from_id($product_variant_id)
    {
        $query = "SELECT 
    pv.id, ct.name AS category_name,
    av.value AS color_value, 
    pv.sku, 
    pv.sale_price, 
    p.name, 
    p.description, 
    pv.stock_quantity
    FROM product_variants pv
    JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id
    JOIN attributes a ON a.id = vav.attribute_id
    JOIN attribute_values av ON av.id = vav.attribute_value_id
    JOIN products p ON p.id = pv.product_id
    JOIN categories ct ON ct.id = p.category_id
    AND a.id = 1 
    AND pv.id = ?
    AND pv.status = 'active'
    GROUP BY pv.id, av.value, pv.sku, pv.sale_price,  p.name, p.description, pv.stock_quantity";
        $result = pdo_query_one($query, $product_variant_id);
        return $result;
    }

    public function get_color_id_by_product_variant_id($product_variant_id)
    {
        $query = "SELECT pvi.color_id FROM product_variant_images pvi 
                JOIN product_variants pv ON pv.product_id = pvi.product_id
                JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id
                WHERE pv.id = ? AND vav.attribute_value_id = pvi.color_id  AND pv.status = 'active'";
        $result = pdo_query_one_1($query, $product_variant_id);
        return $result;
    }

    public function get_product_id_from_variant($product_variant_id)
    {
        $sql = "SELECT product_id FROM product_variants pv WHERE pv.id = ? AND pv.status = 'active'";
        $result = pdo_query_one($sql, $product_variant_id);
        return $result['product_id'];
    }

    public function get_cate_by_product_id($product_id)
    {
        $query = "SELECT ca.id FROM products p
                    JOIN categories ca ON ca.id = p.category_id
                    WHERE p.id = ?";
        $result = pdo_query_value($query, $product_id);
        return $result;
    }

    public function get_color_value_id_by_variant($product_variant_id)
    {
        $sql = "SELECT attribute_value_id
            FROM variant_attribute_values
            WHERE product_variant_id = ? AND attribute_id = 1";
        $result = pdo_query_one($sql, $product_variant_id);
        return $result ? $result['attribute_value_id'] : null;
    }

    public function get_image_is_primary($id, $color_id)
    {
        $query = "SELECT pvi.image_url  FROM product_variant_images pvi
                JOIN product_variants pv ON pv.product_id = pvi.product_id
                WHERE is_primary = 1 AND pv.id = ? AND pvi.color_id = ?";
        $result = pdo_query_one($query, $id, $color_id);
        return $result;
    }

    public function get_image_color($product_id)
    {
        $query = "SELECT pvi.image_url, pv.id AS product_variant_id, pvi.color_id , p.id AS product_id, vav.attribute_value_id
                FROM product_variant_images pvi
                JOIN product_variants pv ON pv.product_id = pvi.product_id
				JOIN products p ON p.id = pv.product_id
                JOIN variant_attribute_values vav ON vav.product_variant_id = pv.id
                WHERE pvi.is_primary = 2 AND pv.product_id = ? AND vav.attribute_id = 1 AND pvi.color_id = vav.attribute_value_id AND pv.status = 'active'
				GROUP BY pvi.color_id;";
        $result = pdo_query($query, $product_id);
        return $result;
    }

    public function get_image_isnot_primary($color_id, $product_variant_id)
    {
        $query = "SELECT pvi.image_url FROM product_variant_images pvi
                    JOIN product_variants pv ON pv.product_id = pvi.product_id
                    WHERE pvi.is_primary != 1 AND pvi.color_id = ? AND pv.id = ?
                    LIMIT 6";
        $result = pdo_query($query, $color_id, $product_variant_id);
        return $result;
    }

    public function get_size_by_color($product_id, $color_value_id)
    {
        $sql = "SELECT DISTINCT av_size.value AS size_value, pv.id AS product_variant_id, pv.status
            FROM product_variants pv
            JOIN variant_attribute_values vav_color ON vav_color.product_variant_id = pv.id
            JOIN variant_attribute_values vav_size ON vav_size.product_variant_id = pv.id
            JOIN attribute_values av_size ON av_size.id = vav_size.attribute_value_id
            JOIN attributes a_size ON a_size.id = vav_size.attribute_id
            WHERE pv.product_id = ? 
              AND vav_color.attribute_id = 1 
              AND vav_color.attribute_value_id = ? 
              AND vav_size.attribute_id = 2 
            ";
        return pdo_query($sql, $product_id, $color_value_id);
    }
}
