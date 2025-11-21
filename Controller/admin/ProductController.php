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
        $product_id = $_GET['product_id'] ?? null;
        $return = $_GET['return'] ?? 'list';
        
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
                
                if ($return === 'variants' && $product_id) {
                    echo "<script>alert('Cập nhật biến thể thành công!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=variants';</script>";
                } else {
                    echo "<script>alert('Cập nhật biến thể thành công!'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
                }
                exit;
            } catch (Exception $e) {
                if ($return === 'variants' && $product_id) {
                    echo "<script>alert('Cập nhật biến thể không thành công!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=variants';</script>";
                } else {
                    echo "<script>alert('Cập nhật biến thể không thành công!'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
                }
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $upload_dir = './Public/Img/uploads/';
            $new_image_name = '';
            
            // Upload ảnh sản phẩm chính
            if (isset($_FILES['image_product']) && $_FILES['image_product']['error'] === 0) {
                if (getimagesize($_FILES['image_product']["tmp_name"])) {
                    $ext = pathinfo($_FILES['image_product']['name'], PATHINFO_EXTENSION);
                    $new_image_name = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['image_product']["tmp_name"], $upload_dir . $new_image_name);
                } else {
                    echo "File không phải là ảnh!";
                    return;
                }
            }
            
            $stmt = new AdminProduct();
            $product_id = $stmt->create_product(
                $_POST['category_id'] ?? '', 
                $_POST['name'] ?? '', 
                $_POST['description'] ?? '', 
                $new_image_name, 
                $_POST['price'] ?? 0, 
                $_POST['sale_price'] ?? 0, 
                $_POST['status'] ?? '', 
                1, // is_new
                0  // is_hot
            );

            // b2: Thêm biến thể
            $material = $_POST['material'] ?? null;
            
            if (isset($_POST['variants'])) {
                foreach ($_POST['variants'] as $value) {
                    if ($stmt->check_variant_exists($value['sku'] ?? '')) continue;
                    
                    $pv_id = $stmt->create_product_variants(
                        $product_id, 
                        0, // is_hot
                        $value['sku'] ?? '', 
                        $value['price'] ?? 0, 
                        $value['sale_price'] ?? 0, 
                        $value['quantity'] ?? 0, 
                        $value['status'] ?? 'active'
                    );

                    if ($pv_id) {
                        $stmt->create_variant_attribute_values($pv_id, 1, $value['color'] ?? null);
                        $stmt->create_variant_attribute_values($pv_id, 2, $value['size'] ?? null);
                        $stmt->create_variant_attribute_values($pv_id, 3, $material);
                    }
                }
            }

            // b3: Thêm ảnh cho từng màu
            $path = './Public/Img/uploads/';
            
            // Ảnh chính
            if (isset($_FILES['color_primary_image']['name'])) {
                foreach ($_FILES['color_primary_image']['name'] as $color_id => $imgName) {
                    if ($imgName && $_FILES['color_primary_image']['error'][$color_id] === 0) {
                        $image_url = time() . '_' . uniqid() . '.' . pathinfo($imgName, PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES['color_primary_image']['tmp_name'][$color_id], $path . $image_url);
                        $stmt->create_variant_image($product_id, $color_id, $image_url, 1, $path);
                    }
                }
            }
            
            // Ảnh phụ
            if (isset($_FILES['color_images']['name'])) {
                foreach ($_FILES['color_images']['name'] as $color_id => $images) {
                    if (is_array($images)) {
                        foreach ($images as $i => $imgName) {
                            if ($imgName && $_FILES['color_images']['error'][$color_id][$i] === 0) {
                                $image_url = time() . '_' . uniqid() . '.' . pathinfo($imgName, PATHINFO_EXTENSION);
                                move_uploaded_file($_FILES['color_images']['tmp_name'][$color_id][$i], $path . $image_url);
                                $stmt->create_variant_image($product_id, $color_id, $image_url, 2, $path);
                            }
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
        include './Views/admin/products/create_product_new.php';
        include './Views/admin/layouts/footer.php';
    }

    public function form_update_product()
    {
        $stmt = new AdminProduct();
        $id = $_GET['id'];
        $get_categories = $stmt->get_categories();
        $product = $stmt->get_product_by_id($id);
        
        // Lấy thêm dữ liệu cho quản lý biến thể
        $product_images = $stmt->get_product_images_by_color($id);
        $existing_colors = $stmt->get_existing_colors($id);
        $existing_sizes = $stmt->get_existing_sizes($id);
        $product_material = $stmt->get_product_material($id);
        $product_variants = $stmt->get_product_variant($id);
        
        // Lấy danh sách đầy đủ các thuộc tính
        $get_color = $stmt->get_att_value(1);
        $get_size = $stmt->get_att_value(2);
        $get_material = $stmt->get_att_value(3);
        
        include './Views/admin/layouts/dashboard.php';
        include './Views/admin/products/update_product_advanced.php';
        include './Views/admin/layouts/footer.php';
    }
    public function update_product_action()
    {
        try {
            if (!isset($_GET['id'])) return;
            
            $id = $_GET['id'];
            $image_url = $_POST['current_image'] ?? '';
            
            // Upload ảnh mới nếu có
            if (!empty($_FILES['image_url']['tmp_name']) && getimagesize($_FILES['image_url']['tmp_name'])) {
                $image_url = time() . '_' . basename($_FILES['image_url']['name']);
                move_uploaded_file($_FILES['image_url']['tmp_name'], "./Public/Img/uploads/" . $image_url);
            }

            $stmt = new AdminProduct();
            $result = $stmt->update_product(
                $_POST['category_id'] ?? 1,
                $_POST['name'] ?? '',
                $_POST['description'] ?? '',
                $image_url,
                $_POST['price'] ?? 0,
                $_POST['sale_price'] ?? 0,
                $_POST['status'] ?? 'active',
                isset($_POST['is_new']) ? 1 : 0,
                isset($_POST['is_hot']) ? 1 : 0,
                $id
            );

            $msg = $result ? '✅ Cập nhật sản phẩm thành công!' : '❌ Cập nhật thất bại!';
            echo "<script>alert('$msg'); window.location.href = 'index.php?route=admin&action=list_product';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Lỗi: {$e->getMessage()}'); window.location.href = 'index.php?route=admin';</script>";
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

    // Thêm ảnh mới cho sản phẩm
    public function add_product_images()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_GET['id'];
            $tab = $_GET['tab'] ?? 'images';
            $color_id = $_POST['color_id'];
            $upload_dir = './Public/Img/uploads/';
            $stmt = new AdminProduct();

            // Upload ảnh chính
            if (isset($_FILES['primary_image']) && $_FILES['primary_image']['error'] === 0) {
                $ext = pathinfo($_FILES['primary_image']['name'], PATHINFO_EXTENSION);
                $new_name = time() . '_' . uniqid() . '.' . $ext;
                
                if (move_uploaded_file($_FILES['primary_image']['tmp_name'], $upload_dir . $new_name)) {
                    $stmt->create_variant_image($product_id, $color_id, $new_name, 1, $upload_dir);
                }
            }

            // Upload ảnh phụ
            if (isset($_FILES['secondary_images']) && !empty($_FILES['secondary_images']['name'][0])) {
                foreach ($_FILES['secondary_images']['tmp_name'] as $index => $tmp_name) {
                    if ($_FILES['secondary_images']['error'][$index] === 0) {
                        $ext = pathinfo($_FILES['secondary_images']['name'][$index], PATHINFO_EXTENSION);
                        $new_name = time() . '_' . uniqid() . '.' . $ext;
                        
                        if (move_uploaded_file($tmp_name, $upload_dir . $new_name)) {
                            $stmt->create_variant_image($product_id, $color_id, $new_name, 2, $upload_dir);
                        }
                    }
                }
            }

            echo "<script>alert('Thêm ảnh thành công!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
        }
    }

    // Xóa ảnh sản phẩm
    public function delete_product_image()
    {
        $product_id = $_GET['id'];
        $image_id = $_GET['image_id'];
        $tab = $_GET['tab'] ?? 'images';
        
        $stmt = new AdminProduct();
        $image = $stmt->get_image_by_id($image_id);
        
        if ($image) {
            // Xóa file vật lý
            $file_path = './Public/Img/uploads/' . $image['image_url'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            // Xóa record trong database
            $stmt->delete_product_image($image_id);
            echo "<script>alert('Xóa ảnh thành công!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
        } else {
            echo "<script>alert('Không tìm thấy ảnh!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
        }
    }

    // Cập nhật ảnh sản phẩm
    public function update_product_image()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $image_id = isset($_POST['image_id']) ? (int)$_POST['image_id'] : 0;
            $tab = $_POST['tab'] ?? 'images';
            $is_primary = isset($_POST['is_primary']) ? (int)$_POST['is_primary'] : null;
            
            // Validate input
            if ($product_id <= 0 || $image_id <= 0) {
                echo "<script>alert('Dữ liệu không hợp lệ!'); history.back();</script>";
                return;
            }
            
            $stmt = new AdminProduct();
            $old_image = $stmt->get_image_by_id($image_id);
            
            if (!$old_image) {
                echo "<script>alert('Không tìm thấy ảnh với ID: $image_id'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
                return;
            }
            
            $new_image_url = null;
            $path = null;
            $upload_dir = './Public/Img/uploads/';
            $has_new_file = false;
            
            // Kiểm tra xem có upload file mới không
            if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === 0) {
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $ext = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
                
                if (!in_array($ext, $allowed_extensions)) {
                    echo "<script>alert('Chỉ chấp nhận file ảnh: jpg, jpeg, png, gif, webp'); history.back();</script>";
                    return;
                }
                
                $new_name = time() . '_' . uniqid() . '.' . $ext;
                
                if (move_uploaded_file($_FILES['new_image']['tmp_name'], $upload_dir . $new_name)) {
                    // Xóa ảnh cũ nếu upload thành công
                    $old_file = $upload_dir . $old_image['image_url'];
                    if (file_exists($old_file)) {
                        @unlink($old_file);
                    }
                    $new_image_url = $new_name;
                    $path = $upload_dir;
                    $has_new_file = true;
                } else {
                    echo "<script>alert('Upload file thất bại!'); history.back();</script>";
                    return;
                }
            }
            
            // Kiểm tra xem có thay đổi gì không
            if (!$has_new_file && ($is_primary === null || $is_primary == $old_image['is_primary'])) {
                echo "<script>alert('Không có thay đổi nào!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
                return;
            }
            
            // Cập nhật database
            try {
                $result = $stmt->update_product_image($image_id, $new_image_url, $is_primary, $path);
                
                if ($result !== false) {
                    $message = 'Cập nhật thành công!';
                    if ($has_new_file && $is_primary !== null && $is_primary != $old_image['is_primary']) {
                        $message = 'Đã cập nhật cả file ảnh và loại ảnh!';
                    } elseif ($has_new_file) {
                        $message = 'Đã thay đổi file ảnh!';
                    } elseif ($is_primary !== null) {
                        $message = 'Đã đổi loại ảnh!';
                    }
                    echo "<script>alert('$message'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
                } else {
                    // Nếu update fail và đã upload file mới, xóa file mới
                    if ($has_new_file && isset($new_name)) {
                        @unlink($upload_dir . $new_name);
                    }
                    echo "<script>alert('Cập nhật database thất bại!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
                }
            } catch (Exception $e) {
                // Rollback: Xóa file mới nếu có
                if ($has_new_file && isset($new_name)) {
                    @unlink($upload_dir . $new_name);
                }
                echo "<script>alert('Lỗi: " . addslashes($e->getMessage()) . "'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
            }
        }
    }

    // Xóa biến thể
    public function delete_variant()
    {
        $variant_id = $_GET['id'] ?? 0;
        $product_id = $_GET['product_id'] ?? 0;
        $tab = $_GET['tab'] ?? 'variants';
        $redirect = "index.php?route=admin&action=update_product&id=$product_id&tab=$tab";
        
        if ($variant_id <= 0 || $product_id <= 0) {
            echo "<script>alert('Dữ liệu không hợp lệ!'); history.back();</script>";
            return;
        }
        
        $stmt = new AdminProduct();
        
        if (!$stmt->get_variant_by_id($variant_id)) {
            echo "<script>alert('Không tìm thấy biến thể!'); window.location.href = '$redirect';</script>";
            return;
        }
        
        if ($stmt->check_variant_in_orders($variant_id)) {
            echo "<script>alert('Không thể xóa biến thể này vì đã có trong đơn hàng!\\nBạn có thể ẩn biến thể bằng cách đổi trạng thái thành Hidden.'); window.location.href = '$redirect';</script>";
            return;
        }
        
        try {
            $stmt->delete_variant_attributes($variant_id);
            $result = $stmt->delete_variant($variant_id);
            $msg = $result ? 'Xóa biến thể thành công!' : 'Xóa biến thể thất bại!';
            echo "<script>alert('$msg'); window.location.href = '$redirect';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Lỗi: " . addslashes($e->getMessage()) . "'); window.location.href = '$redirect';</script>";
        }
    }

    // Thêm biến thể hàng loạt
    public function add_variants_bulk()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_GET['id'];
            $tab = $_GET['tab'] ?? 'variants';
            $new_colors = $_POST['new_colors'] ?? [];
            $new_sizes = $_POST['new_sizes'] ?? [];
            $material = $_POST['material'];
            $default_price = $_POST['default_price'];
            $default_sale_price = $_POST['default_sale_price'];

            if (empty($new_colors) || empty($new_sizes)) {
                echo "<script>alert('Vui lòng chọn ít nhất 1 màu và 1 size!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
                return;
            }

            $stmt = new AdminProduct();
            $created_count = 0;

            foreach ($new_colors as $color_id) {
                foreach ($new_sizes as $size_id) {
                    $sku = 'PRO' . $product_id . '-C' . $color_id . '-S' . $size_id;

                    $variant_id = $stmt->create_product_variants(
                        $product_id,
                        0,
                        $sku,
                        $default_price,
                        $default_sale_price,
                        0,
                        'active'
                    );

                    if ($variant_id) {
                        $stmt->create_variant_attribute_values($variant_id, 1, $color_id);
                        $stmt->create_variant_attribute_values($variant_id, 2, $size_id);
                        $stmt->create_variant_attribute_values($variant_id, 3, $material);
                        $created_count++;
                    }
                }
            }

            echo "<script>alert('Đã tạo $created_count biến thể mới!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
        }
    }

    // Thêm 1 biến thể mới (người dùng tự nhập đầy đủ thông tin)
    public function add_single_variant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_GET['id'];
            $tab = $_GET['tab'] ?? 'variants';
            
            $sku = trim($_POST['sku'] ?? '');
            $color_id = $_POST['color_id'] ?? null;
            $size_id = $_POST['size_id'] ?? null;
            $material_id = $_POST['material_id'] ?? null;
            $price = $_POST['price'] ?? 0;
            $sale_price = $_POST['sale_price'] ?? 0;
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $status = $_POST['status'] ?? 'active';
            
            // Validate
            if (empty($sku) || empty($color_id) || empty($size_id)) {
                echo "<script>alert('Vui lòng nhập đầy đủ thông tin!'); history.back();</script>";
                return;
            }
            
            $stmt = new AdminProduct();
            
            try {
                // Kiểm tra SKU đã tồn tại chưa
                $existing = $stmt->check_sku_exists($sku);
                if ($existing) {
                    echo "<script>alert('SKU đã tồn tại!'); history.back();</script>";
                    return;
                }
                
                // Tạo biến thể
                $variant_id = $stmt->create_product_variants(
                    $product_id,
                    0, // is_hot
                    $sku,
                    $price,
                    $sale_price,
                    $stock_quantity,
                    $status
                );
                
                if ($variant_id) {
                    // Thêm thuộc tính màu
                    $stmt->create_variant_attribute_values($variant_id, 1, $color_id);
                    
                    // Thêm thuộc tính size
                    $stmt->create_variant_attribute_values($variant_id, 2, $size_id);
                    
                    // Thêm thuộc tính material nếu có
                    if ($material_id) {
                        $stmt->create_variant_attribute_values($variant_id, 3, $material_id);
                    }
                    
                    echo "<script>alert('Đã thêm biến thể mới thành công!'); window.location.href = 'index.php?route=admin&action=update_product&id=$product_id&tab=$tab';</script>";
                } else {
                    echo "<script>alert('Không thể tạo biến thể!'); history.back();</script>";
                }
                
            } catch (Exception $e) {
                echo "<script>alert('Lỗi: " . addslashes($e->getMessage()) . "'); history.back();</script>";
            }
        }
    }

}


