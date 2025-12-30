<div class="row g-3">
    <?php foreach ($products as $p): ?>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="<?= $p->image ?>" class="card-img-top">
                <div class="card-body">
                    <h6><?= $p->name ?></h6>
                    <p class="fw-bold text-primary">Rp<?= number_format($p->price) ?></p>
                    <a href="<?= base_url('product/' . $p->slug) ?>" class="btn btn-dark w-100">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>