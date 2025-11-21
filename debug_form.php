<!DOCTYPE html>
<html>
<head>
    <title>Debug Form Submit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Debug: Test Update Image Form</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<div class='alert alert-info'>";
        echo "<h4>POST Data Received:</h4>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        echo "<h4>FILES Data:</h4>";
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        echo "</div>";
        
        // Test actual update
        require_once 'Model/Pdo.php';
        require_once 'Model/admin/product.php';
        
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $image_id = isset($_POST['image_id']) ? (int)$_POST['image_id'] : 0;
        $is_primary = isset($_POST['is_primary']) ? (int)$_POST['is_primary'] : null;
        
        echo "<div class='alert alert-warning'>";
        echo "<h4>Parsed Values:</h4>";
        echo "product_id: $product_id<br>";
        echo "image_id: $image_id<br>";
        echo "is_primary: " . ($is_primary ?? 'null') . "<br>";
        echo "</div>";
        
        if ($image_id > 0) {
            $stmt = new AdminProduct();
            $old_image = $stmt->get_image_by_id($image_id);
            
            echo "<div class='alert alert-primary'>";
            echo "<h4>Current Image in DB:</h4>";
            echo "<pre>";
            print_r($old_image);
            echo "</pre>";
            echo "</div>";
            
            // Try update
            if ($is_primary !== null) {
                echo "<div class='alert alert-success'>";
                echo "<h4>Attempting Update...</h4>";
                try {
                    $result = $stmt->update_product_image($image_id, null, $is_primary, null);
                    echo "Result: " . ($result ? 'TRUE (success)' : 'FALSE (failed)') . "<br>";
                    
                    // Check again
                    $new_image = $stmt->get_image_by_id($image_id);
                    echo "<h5>After Update:</h5>";
                    echo "<pre>";
                    print_r($new_image);
                    echo "</pre>";
                    
                    if ($new_image['is_primary'] == $is_primary) {
                        echo "<strong style='color: green;'>✅ UPDATE SUCCESSFUL!</strong>";
                    } else {
                        echo "<strong style='color: red;'>❌ UPDATE FAILED (value not changed)</strong>";
                    }
                } catch (Exception $e) {
                    echo "Exception: " . $e->getMessage();
                }
                echo "</div>";
            }
        }
    }
    ?>
    
    <hr>
    
    <h3>Test Form (chỉ đổi loại ảnh)</h3>
    <form method="POST" enctype="multipart/form-data" class="border p-4">
        <div class="mb-3">
            <label>Product ID:</label>
            <input type="number" name="product_id" class="form-control" value="39" required>
        </div>
        
        <div class="mb-3">
            <label>Image ID:</label>
            <input type="number" name="image_id" class="form-control" value="73" required>
            <small>ID 73 là ảnh đầu tiên trong DB</small>
        </div>
        
        <div class="mb-3">
            <label>Loại ảnh:</label>
            <select name="is_primary" class="form-select" required>
                <option value="1">Ảnh chính (1)</option>
                <option value="2">Ảnh phụ (2)</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Upload file mới (optional):</label>
            <input type="file" name="new_image" class="form-control" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit & Test</button>
    </form>
    
    <hr>
    <a href="index.php?route=admin&action=list_product" class="btn btn-secondary">← Quay lại admin</a>
</body>
</html>
