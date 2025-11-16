<?php

use FFI\Exception;
class AdminProductController
{
    // Hiển thị danh sách sản phẩm
    public function list_product()
    {
        $keyword = $_POST['keyword'] ?? "";
        $filter_by_categories = $_POST['filter_by_categories'] ?? 0;
        $stmt = new AdminProduct();
        $count = $stmt->select_count();
        $limit = 6;
        $total_pages = ceil($count / $limit);
        $current_page = $_GET['page'] ?? 1;
        $current_page = max(1, min($current_page, $total_pages));
        $start = ($current_page - 1) * $limit;

        $all_products = $stmt->get_all_products($start, $limit, $filter_by_categories, $keyword);
        $categories = $stmt->get_categories();
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/list.php';
        include './Views/admin/layouts/footer.php';
    }

    // Hiển thị chi tiết các biến thể sản phẩm
    public function detail_product()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_variant_id'])) {
            $delete_variant_id = $_POST['delete_variant_id'];
            $stmt = new AdminProduct();
            $count = $stmt->check_order_item($delete_variant_id);

            if ($count > 0) {
                echo "<script>alert('Sản phẩm có đơn hàng, không thể xóa !'); window.location.href = 'index.php?route=admin';</script>";
            } else {
                $stmt->delete_variant($delete_variant_id);
                echo "<script>alert('Xóa sản phẩm thành công !'); window.location.href = 'index.php?route=admin';</script>";
                // header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }

        } else {
            echo "Invalid product ID.";
        }
        $id = $_GET['id'] ?? null;
        $_SESSION['detail_produc_url)'] = $_SERVER['REQUEST_URI'];
        $stmt = new AdminProduct();
        $products = $stmt->get_product_variant($id);
        if ($products) {
            include './Views/admin/layouts/dashboard.php';
            include './Views/admin/products/product_variant.php';
            include './Views/admin/layouts/footer.php';
        } else {
            echo "Product not found.";
        }
    }

    // Hiển thị form chỉnh sửa biến thể sản phẩm
    public function update_variant()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = new AdminProduct();
            $product = $stmt->get_variant_by_id($id);
            include './Views/admin/layouts/dashboard.php';
            include './Views/admin/products/update_variant.php';
            include './Views/admin/layouts/footer.php';
        }
    }

    // Gọi hàm cập nhật biến thể sản phẩm
    public function update_variant_action()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $sku = $_POST['sku'] ?? '';
            $price = $_POST['price'] ?? 0;
            $sale_price = $_POST['sale_price'] ?? 0;
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $status = $_POST['status'] ?? 'active';
            $is_hot = $_POST['is_hot'] ?? 0;
            $stmt = new AdminProduct();
            try {
                $stmt->update_variant($is_hot, $sku, $price, $sale_price, $stock_quantity, $status, $id);
                echo "<script>alert('Cập nhật biến thể thành công!'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
                exit;
            } catch (Exception $e) {
                echo "<script>alert('Cập nhật biến thể không thành công!'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
            }
        }
    }
    // Hiển thị form thêm biến thể sản phẩm
    public function create_variant()
    {
        $act = new AdminProduct;
        $get_categories = $act->get_categories();
        $get_color = $act->get_att_value(1);
        $get_size = $act->get_att_value(2);
        $get_material = $act->get_att_value(3);

        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/create_variant.php';
        include './Views/admin/layouts/footer.php';
    }
    // Gọi hàm thêm biến thể sản phẩm
    public function create_variant_action()
    {
        $product_id = $_POST['product_id'] ?? null;
        $sku = $_POST['sku'] ?? '';
        $price = $_POST['price'] ?? 0;
        $sale_price = $_POST['sale_price'] ?? 0;
        $stock_quantity = $_POST['stock_quantity'] ?? 0;
        $status = $_POST['status'] ?? 'active';
        $stmt = new AdminProduct();
        $exists = $stmt->check_variant_exists($sku);

        if ($exists) {
            echo "<script>alert('Biến thể đã tồn tại, không thể thêm trùng SKU'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
            exit;
        } else {
            if ($product_id && $sku && $price >= 0) {
                $stmt = new AdminProduct();
                $pro_variant_id = $stmt->create_variant($product_id, $sku, $price, $sale_price, $stock_quantity, $status);

                // Lưu thuộc tính biến thể sản phẩm
                $variant_size = $_POST['variant_size'] ?? "";
                $variant_color = $_POST['variant_color'] ?? 1;
                $variant_material = $_POST['variant_material'] ?? 1;
                $atr_color = 1; // ID thuộc tính màu sắc
                $atr_size = 2; // ID thuộc tính kích thước
                $atr_material = 3; // ID thuộc tính kích thước
                $stmt = new AdminProduct();
                $stmt->create_product_variant_attribute($pro_variant_id, $atr_color, $variant_color);
                $stmt->create_product_variant_attribute($pro_variant_id, $atr_size, $variant_size);
                $stmt->create_product_variant_attribute($pro_variant_id, $atr_material, $variant_material);
                echo "<script>alert('Thêm biến thể mới thành công');</script>";
                header("Location: index.php?route=admin&action=detail_product&id=<?= $product_id ?>");
            } else {
                echo "Invalid data provided.";
            }
        }
    }
    // 
    public function create_product_action()
    {
        // b1: Thêm sản phẩm
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $pro_name = $_POST['name'] ?? '';
            $pro_description = $_POST['description'] ?? '';
            $pro_status = $_POST['status'] ?? '';
            $pro_category_id = $_POST['category_id'] ?? '';
            $pro_price = $_POST['price'] ?? '0';
            $pro_sale_price = $_POST['sale_price'] ?? '0';
            $pro_image = $_FILES['image_product'];
            $pro_new = 1;
            $pro_hot = 0;

            if (isset($pro_image) && $pro_image['error'] === 0) {
                $upload_dir = './Public/Img/uploads/';
                if (getimagesize($pro_image["tmp_name"])) {
                    $ext = pathinfo($pro_image['name'], PATHINFO_EXTENSION);
                    $new_image_name = time() . '_' . uniqid() . '.' . $ext;
                    $img_path = $upload_dir . $new_image_name;
                    move_uploaded_file($pro_image["tmp_name"], $img_path);
                } else {
                    echo "File không phải là ảnh!";
                }
            }
            $stmt = new AdminProduct();
            $product_id = $stmt->create_product($pro_category_id, $pro_name, $pro_description, $new_image_name, $pro_price, $pro_sale_price, $pro_status, $pro_new, $pro_hot);

            // b2: Thêm biến thể
            if (isset($_POST['variants'])) {
                foreach ($_POST['variants'] as $index => $value) {

                    $color = $value['color'] ?? null;
                    $size = $value['size'] ?? null;
                    $material = $value['material'] ?? null;
                    $price = $value['price'] ?? 0;
                    $sale_price = $value['sale_price'] ?? 0;
                    $quantity = $value['quantity'] ?? 0;
                    $sku = $value['sku'] ?? '';
                    $variant_status = $value['status'] ?? 'active';

                    $act = new AdminProduct();

                    $exists = $stmt->check_variant_exists($sku);
                    if (!$exists) {
                        $pv_id = $act->create_product_variants($product_id, $pro_hot, $sku, $price, $sale_price, $quantity, $variant_status);

                        $act->create_variant_attribute_values($pv_id, 1, $color);
                        $act->create_variant_attribute_values($pv_id, 2, $size);
                        $act->create_variant_attribute_values($pv_id, 3, $material);
                    }else{
                        continue;
                    }

                }
            }

            // b3: Thêm ảnh cho từng màu + sản phẩm
            $upload_dir = './Public/Img/uploads/';
            $path = "./Public/Img/uploads/";
            if (isset($_FILES['color_images'])) {
                foreach ($_FILES['color_images']['name'] as $index => $images) {
                    foreach ($images as $i => $imgName) {
                        if ($imgName) {
                            $image_ext = pathinfo($imgName, PATHINFO_EXTENSION);
                            $image_url = time() . '_' . uniqid() . '.' . $image_ext;

                            move_uploaded_file($_FILES['color_images']['tmp_name'][$index][$i], $upload_dir . $image_url);

                            // Ảnh đầu tiên là ảnh chính, còn lại ảnh phụ
                            $is_primary = ($i === 0) ? 1 : 2;
                            $color_value_id = $index;
                            // Thêm ảnh vào db
                            $add_img = new AdminProduct();
                            $add_img->create_variant_image($product_id, $color_value_id, $image_url, $is_primary, $path);
                        }
                    }
                }
            }
            echo "<script>alert('Thêm sản phẩm và biến thể thành công!'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
            exit;

        }
    }

    // Hiển thị form thêm sản phẩm
    public function create_product()
    {
        $act = new AdminProduct;
        $get_categories = $act->get_categories();
        $get_color = $act->get_att_value(1);
        $get_size = $act->get_att_value(2);
        $get_material = $act->get_att_value(3);
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/create_product.php';
        include './Views/admin/layouts/footer.php';
    }

    public function form_update_product()
    {
        $stmt = new AdminProduct();
        $id = $_GET['id'];
        $get_categories = $stmt->get_categories();
        $product = $stmt->get_product_by_id($_GET['id']);
        print_r($product);
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/update_product.php';
        include './Views/admin/layouts/footer.php';
    }
    public function update_product_action()
    {
        try {
            if (isset($_GET['id'])) {
                $edit_pro = $_GET['id'];
                $name = $_POST['name'] ?? "";
                $category_id = $_POST['category_id'] ?? 1;
                $description = $_POST['description'] ?? '';
                $price = $_POST['price'] ?? 0;
                $sale_price = $_POST['sale_price'] ?? 0;
                $is_new = isset($_POST['is_new']) ? 1 : 0;
                $is_hot = isset($_POST['is_hot']) ? 1 : 0;
                $image_url = $_POST['current_image'] ?? '';
                $file = $_FILES['image_url'];
                $status = $_POST['status'];

                // Xử lý ảnh (nếu có upload mới)
                if (!empty($file['tmp_name']) && getimagesize($file['tmp_name'])) {
                    $image_url = time() . '_' . basename($file['name']);
                    move_uploaded_file($file['tmp_name'], "./Public/Img/uploads/" . $image_url);
                }

                $action = new AdminProduct();
                $result = $action->update_product($category_id, $name, $description, $image_url, $price, $sale_price, $status, $is_new, $is_hot, $edit_pro);

                if ($result) {
                    echo "<script>alert('✅ Cập nhật sản phẩm thành công!'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
                } else {
                    echo "<script>alert('❌ Cập nhật thất bại. Vui lòng thử lại.'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
                }
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
            echo "<script>alert('Lỗi: $msg'); window.location.href = 'index.php?route=admin';</script>";
        }
    }

    // Quản lý danh mục
    public function list_categories()
    {
        $stmt = new AdminProduct();
        $categories = $stmt->get_categories();

        // Xử lý xóa danh mục
        if (isset($_GET["delete_id"]) && $_GET["delete_id"]) {
            $delete_id = (int) $_GET["delete_id"];
            if ($stmt->category_exists_2($delete_id)) {
                echo "<script>alert('Danh mục đã có sản phẩm, không thể xóa'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            }
            try {
                $stmt->delete_category($delete_id);
                echo "<script>alert('Xóa danh mục thành công'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            } catch (Exception $e) {
                echo "<script>alert('Xóa danh mục không thành công'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            }
        }

        // Xử lý thêm danh mục
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST['name'] ?? "");
            if ($name === "") {
                echo "<script>alert('Tên danh mục không được để trống'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            }
            if ($stmt->category_exists($name)) {
                echo "<script>alert('Danh mục đã tồn tại'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            }
            try {
                $stmt->create_category($name);
                echo "<script>alert('Thêm danh mục thành công'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            } catch (Exception $e) {
                echo "<script>alert('Lỗi khi thêm danh mục'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            }
        }
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/categories.php';
        include './Views/admin/layouts/footer.php';
    }
    // Cập nhật danh mục 
    public function update_category()
    {
        $stmt = new AdminProduct();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $category = $stmt->get_category_by_id($id);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $id = $_POST['id'] ?? null;
            if ($id && $name) {
                $stmt->update_category($id, $name);
                echo "<script>alert('Cập nhật danh mục thành công'); window.location.href = 'index.php?route=admin&action=list_categories';</script>";
                exit;
            }
        }
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/update_category.php';
        include './Views/admin/layouts/footer.php';
    }
    //  Biểu đồ
    public function chart()
    {
        $stmt = new AdminProduct();
        $filter = $_GET['filter'] ?? 'day';
        switch ($filter) {
            case 'year':
                $result = $stmt->filter_total_price_by_year();
                break;
            case 'month':
                $result = $stmt->filter_total_price_by_month();
                break;
            default:
                $result = $stmt->filter_total_price_by_day();
                break;
        }

        $get_categories = $stmt->count_product_by_category();
        $best_selling = $stmt->get_best_selling_product();
        $get_total_revenue_and_orders = $stmt->get_total_revenue_and_orders();
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/chart.php';
        include './Views/admin/layouts/footer.php';
    }


}


