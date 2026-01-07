<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Design Generator</h4>
            <p class="text-sm text-muted mb-0">
                Generate kombinasi desain berdasarkan tag & performa
            </p>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="card mb-4">
        <div class="card-body">

            <form method="post" action="<?= site_url('generator/generate') ?>" target="_blank">

                <div class="row">

                    <div class="col-md-4">
                        <label class="fw-semibold">Pilih Tag</label>
                        <select class="form-control" name="tags[]" multiple required>
                            <?php foreach ($tags as $t): ?>
                                <option value="<?= $t->tag_name ?>">
                                    <?= $t->tag_name ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="fw-semibold">Jumlah Generate</label>
                        <input type="number" name="qty" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-3">
                        <label class="fw-semibold">Orientasi</label>
                        <select class="form-control" name="orientation">
                            <option value="portrait">Portrait</option>
                            <option value="landscape">Landscape</option>
                        </select>
                    </div>

                    <div class="col-md-2 text-end mt-4">
                        <button class="btn bg-gradient-dark mt-2">
                            <i class="material-symbols-rounded text-sm">bolt</i>
                            Generate
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

</div>