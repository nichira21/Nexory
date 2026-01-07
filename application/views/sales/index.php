<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Record Sales</h4>
            <p class="text-sm text-muted mb-0">
                Catat penjualan kombinasi desain (ID-based)
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="post" action="<?= site_url('sales/markAsSold') ?>">

                <div class="row">

                    <div class="col-md-6">
                        <label class="fw-semibold">Pilih Combination</label>
                        <select name="combination_id" class="form-control">

                            <?php foreach ($combinations as $c): ?>
                                <option value="<?= $c->id ?>">
                                    <?= $c->sku_code ?> —
                                    GEN <?= $c->generated_count ?> /
                                    SOLD <?= $c->sold_count ?>
                                </option>
                            <?php endforeach ?>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="fw-semibold">Qty</label>
                        <input type="number" name="qty" min="1" class="form-control">
                    </div>

                    <div class="col-md-3 mt-4 text-end">
                        <button class="btn bg-gradient-dark mt-2">
                            <i class="material-symbols-rounded text-sm">sell</i>
                            Mark as Sold
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>