<?php
// Test file để debug chức năng update image
echo "<h2>Test Update Image Function</h2>";

// Include các file cần thiết
require_once 'Model/Pdo.php';
require_once 'Model/admin/product.php';

// Test 1: Kiểm tra kết nối database
echo "<h3>Test 1: Database Connection</h3>";
try {
    $conn = pdo_get_connection();
    echo "✅ Kết nối database thành công<br>";
} catch (Exception $e) {
    echo "❌ Lỗi kết nối: " . $e->getMessage() . "<br>";
    die();
}

// Test 2: Lấy 1 ảnh bất kỳ để test
echo "<h3>Test 2: Get Image Info</h3>";
$stmt = new AdminProduct();
$query = "SELECT * FROM product_variant_images LIMIT 1";
$test_image = pdo_query_one($query);

if ($test_image) {
    echo "✅ Tìm thấy ảnh test:<br>";
    echo "<pre>";
    print_r($test_image);
    echo "</pre>";
    
    $image_id = $test_image['id'];
    $old_is_primary = $test_image['is_primary'];
    
    // Test 3: Thử update chỉ is_primary
    echo "<h3>Test 3: Update Only is_primary</h3>";
    $new_is_primary = ($old_is_primary == 1) ? 2 : 1;
    echo "Đổi is_primary từ $old_is_primary sang $new_is_primary<br>";
    
    try {
        $result = $stmt->update_product_image($image_id, null, $new_is_primary, null);
        
        if ($result) {
            echo "✅ Update thành công (return true)<br>";
            
            // Kiểm tra lại database
            $check = $stmt->get_image_by_id($image_id);
            echo "Giá trị mới trong DB: is_primary = " . $check['is_primary'] . "<br>";
            
            if ($check['is_primary'] == $new_is_primary) {
                echo "✅ Cập nhật database THÀNH CÔNG!<br>";
            } else {
                echo "❌ Cập nhật database THẤT BẠI (giá trị không đổi)<br>";
            }
            
            // Đổi lại về giá trị cũ
            echo "<br>Đang đổi lại về giá trị cũ...<br>";
            $stmt->update_product_image($image_id, null, $old_is_primary, null);
            echo "✅ Đã restore lại giá trị cũ<br>";
        } else {
            echo "❌ Update thất bại (return false)<br>";
        }
    } catch (Exception $e) {
        echo "❌ Exception: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Không tìm thấy ảnh nào trong database<br>";
}

echo "<br><hr><br>";
echo "<a href='index.php?route=admin&action=list_product'>← Quay lại danh sách sản phẩm</a>";
?>
