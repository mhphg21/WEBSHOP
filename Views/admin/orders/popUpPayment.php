<table
    class="table">
    <thead>
        <tr>
            <th scope="col">Phương thức thanh toán</th>
            <th scope="col">Tổng tiền</th>
            <th scope="col">Trạng thái thanh toán</th>
            <th scope="col">Mã thanh toán</th>
            <th scope="col">Cổng thanh toán</th>
            <th scope="col">Thời điểm thanh toán</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($arrayPaymentDetail as $row): ?>
            <tr>
                <td><?= $row['payment_method'] ?></td>
                <td><?= number_format($row['total']) ?>VND</td>
                <td><?= $row['payment_status'] ?></td>
                <td><?= $row['transaction_id'] ?? ' ' ?></td>
                <td><?= $row['payment_gateway'] ?></td>
                <td><?= $row['paid_at'] ?? ''?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>