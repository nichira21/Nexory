<div class="container my-5" style="max-width:900px;">
    <h3 class="fw-bold mb-4">Pesanan Saya</h3>

    <?php if (empty($orders)): ?>
        <div class="alert alert-light border text-center rounded-4">
            Kamu belum memiliki pesanan.
        </div>
    <?php else: ?>

        <div class="list-group shadow-sm rounded-4 overflow-hidden">

            <?php foreach ($orders as $o): ?>
                <?php
                // STATUS MAPPING
                $badge = 'secondary';
                $statusText = 'Menunggu Pembayaran';

                if ($o->payment_status === 'paid') {
                    $badge = 'success';
                    $statusText = 'Lunas';
                } elseif ($o->payment_status === 'unpaid') {
                    $badge = 'warning';
                    $statusText = 'Menunggu Pembayaran';
                }
                ?>

                <a href="<?= site_url('order/detail/' . $o->order_code) ?>"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">

                    <div>
                        <div class="fw-semibold"><?= $o->order_code ?></div>
                        <div class="small text-muted">
                            <?= date('d M Y H:i', strtotime($o->created_at)) ?>
                        </div>

                        <!-- ACTION -->
                        <div class="mt-2">
                            <?php if ($o->payment_status !== 'paid'): ?>
                                <span class="badge bg-warning text-dark me-2">Belum Dibayar</span>
                            <?php else: ?>
                                <span class="badge bg-success me-2">Invoice Tersedia</span>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="text-end">
                        <div class="fw-semibold mb-1">
                            Rp <?= number_format($o->total, 0, ',', '.') ?>
                        </div>

                        <span class="badge bg-<?= $badge ?>">
                            <?= $statusText ?>
                        </span>
                    </div>

                </a>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>
</div>