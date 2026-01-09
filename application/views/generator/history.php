<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Design Generator</h4>
            <p class="text-sm text-muted mb-0">
                Generate kombinasi desain berdasarkan tag & performa
            </p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Total Design</th>
                <th>PDF</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($batches as $b): ?>
                <tr>
                    <td><?= $b->id ?></td>
                    <td><?= $b->total_design ?></td>
                    <td>
                        <?php if (!empty($b->pdf_path)): ?>
                            <a href="<?= base_url($b->pdf_path) ?>" target="_blank"
                                class="btn btn-sm btn-primary">
                                Download PDF
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Generating...</span>
                        <?php endif ?>
                    </td>
                    <td><?= $b->created_at ?? '-' ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>
</div>

</div>