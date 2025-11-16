<table class="table">
    <thead>
        <tr>
            <!-- <th scope="col">Id biến thể</th> -->
            <th scope="col">STT</th>
            <th scope="col">Mã SKU</th>
            <th scope="col">Tên Sản phẩm</th>
            <th scope="col">Size</th>
            <th scope="col">Màu</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Số lượng</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sizeMap = [];
        foreach ($sizeArray as $size) {
            $sizeMap[$size['product_variant_id']] = $size['size'];
        }
        // print_r($sizeMap);
        // echo "<pre>";
        $colorMap = [];
        foreach ($colorArray as $color) {
            $colorMap[$color['product_variant_id']] = $color['color'];
        }

        // print_r($sizeMap);

        foreach ($arrayOrderDetail as $index => $row) {

        ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $row['sku_name'] ?></td>
                <td><?= $row['product_name'] ?></td>
                <td><?= $sizeMap[$row['product_variant_id']] ?? '' ?></td>
                <td><?= $colorMap[$row['product_variant_id']] ?? '' ?></td>
                <td><?= number_format($row['price']) ?>VND</td>
                <td><?= $row['quantity'] ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>