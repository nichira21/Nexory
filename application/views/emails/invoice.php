<h2>Invoice <?= $order->order_code ?></h2>
<p>Hi <?= $order->name ?>,</p>

<table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga</th>
    </tr>
    <?php foreach ($items as $i): ?>
        <tr>
            <td><?= $i->name ?></td>
            <td><?= $i->qty ?></td>
            <td>Rp <?= number_format($i->price, 0, ',', '.') ?></td>
        </tr>
    <?php endforeach ?>
</table>

<p><strong>Total: Rp <?= number_format($order->total, 0, ',', '.') ?></strong></p>

<p>Terima kasih sudah berbelanja di Nexory.</p>