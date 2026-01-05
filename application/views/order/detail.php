<div class="container my-5" style="max-width:900px;">
    <h4 class="fw-bold mb-3">Detail Pesanan</h4>

    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Kode Pesanan</strong><br><?= $order->order_code ?>
                </div>
                <div class="col-md-6 text-md-end">
                    <strong>Status</strong><br>
                    <span class="badge bg-<?= $order->payment_status === 'paid' ? 'success' : 'warning' ?>">
                        <?= strtoupper($order->payment_status) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered rounded-4 overflow-hidden">
        <thead class="table-light">
            <tr>
                <th>Produk</th>
                <th width="80">Qty</th>
                <th width="150">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $i): ?>
                <tr>
                    <td><?= $i->name ?></td>
                    <td><?= $i->qty ?></td>
                    <td>Rp <?= number_format($i->price, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-end">Total</th>
                <th>Rp <?= number_format($order->total, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

    <div class="d-flex gap-2 mt-4">
        <a href="<?= site_url('order') ?>" class="btn btn-outline-dark rounded-pill">
            Kembali
        </a>

        <?php if ($order->payment_status !== 'paid'): ?>
            <a href="<?= site_url('checkout/retry/' . $order->order_code) ?>"
                class="btn btn-dark rounded-pill">
                Bayar Sekarang
            </a>
        <?php endif ?>

        <a href="<?= site_url('order/invoice/' . $order->order_code) ?>"
            class="btn btn-outline-secondary rounded-pill">
            Download Invoice
        </a>
    </div>
</div>