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
                $badge = 'secondary';
                if ($o->payment_status === 'paid') $badge = 'success';
                if ($o->payment_status === 'unpaid') $badge = 'warning';
                ?>

                <div class="list-group-item d-flex justify-content-between align-items-center py-3">

                    <div>
                        <div class="fw-semibold"><?= $o->order_code ?></div>
                        <div class="small text-muted">
                            <?= date('d M Y H:i', strtotime($o->created_at)) ?>
                        </div>
                    </div>

                    <div class="text-end">
                        <div class="fw-semibold">
                            Rp <?= number_format($o->total, 0, ',', '.') ?>
                        </div>
                        <span class="badge bg-<?= $badge ?>">
                            <?= strtoupper($o->payment_status) ?>
                        </span>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>
</div>