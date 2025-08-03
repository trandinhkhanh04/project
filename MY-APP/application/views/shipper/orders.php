<?php foreach ($orders as $order): ?>
<tr>
    <td><?= $order->Order_Code ?></td>
    <td><?= $order->TotalAmount ?></td>
    <td>
        <?php if ($order->Order_Status == 3): ?>
            <form method="post" action="<?= base_url('shipper/confirm_delivery') ?>">
                <input type="hidden" name="OrderID" value="<?= $order->OrderID ?>">
                <button type="submit" class="btn btn-success btn-sm">Xác nhận đã giao</button>
            </form>
        <?php elseif ($order->Order_Status == 4): ?>
            <span class="text-success">Đã giao</span>
        <?php else: ?>
            <span class="text-muted">Không khả dụng</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
