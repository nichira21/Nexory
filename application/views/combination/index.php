<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Combination Performance Ranking</h4>
            <p class="text-sm text-muted mb-0">
                Ranking berdasarkan conversion & sales
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive px-3">

                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Hash</th>
                            <th>Generated</th>
                            <th>Sold</th>
                            <th>Score</th>
                            <th>Status</th>
                            <th width="100">Preview</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($combinations as $c): ?>
                            <tr>

                                <td class="fw-semibold"><?= $c->sku_code ?></td>

                                <td class="text-xs text-muted"><?= $c->hash_key ?></td>

                                <td><span class="badge bg-info"><?= $c->generated_count ?></span></td>

                                <td><span class="badge bg-success"><?= $c->sold_count ?></span></td>

                                <td>
                                    <span class="badge bg-dark">
                                        <?= number_format($c->performance_score, 2) ?>
                                    </span>
                                </td>

                                <td>
                                    <?= $c->is_disabled
                                        ? '<span class="badge bg-danger">DISABLED</span>'
                                        : '<span class="badge bg-success">ACTIVE</span>'
                                    ?>
                                </td>

                                <td>
                                    <a href="<?= site_url('preview/view/' . $c->id) ?>"
                                        class="btn btn-secondary btn-sm"
                                        target="_blank">
                                        Preview
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>