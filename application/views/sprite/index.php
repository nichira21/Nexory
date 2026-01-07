<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Manage Sprite Assets</h4>
            <p class="text-sm text-muted mb-0">
                Kelola sprite jam, desain, dan background
            </p>
        </div>

        <div class="col-md-6 text-end">
            <button class="btn bg-gradient-dark btn-sm" onclick="openAddSprite()">
                <i class="material-symbols-rounded text-sm">add</i> Tambah Sprite
            </button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive px-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Tag</th>
                            <th>Used</th>
                            <th>Sold</th>
                            <th>Status</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($sprites as $s): ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url($s->file_path) ?>"
                                        style="width:42px;height:42px;object-fit:contain"
                                        class="rounded">
                                </td>

                                <td>
                                    <div class="fw-semibold"><?= $s->sprite_name ?></div>
                                    <div class="text-xs text-muted"><?= $s->id ?></div>
                                </td>

                                <td>
                                    <span class="badge bg-dark text-uppercase">
                                        <?= $s->sprite_type ?>
                                    </span>
                                </td>

                                <td>
                                    <?php foreach ($s->tags as $t): ?>
                                        <span class="badge bg-secondary"><?= $t ?></span>
                                    <?php endforeach ?>
                                </td>

                                <td><span class="badge bg-info"><?= $s->used_count ?></span></td>
                                <td><span class="badge bg-success"><?= $s->sold_count ?></span></td>

                                <td>
                                    <?= $s->is_active
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Disabled</span>'
                                    ?>
                                </td>

                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick='openEditSprite(<?= json_encode($s) ?>)'>
                                        Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm"
                                        onclick="deleteSprite(<?= $s->id ?>)">
                                        Hapus
                                    </button>
                                </td>

                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="spriteModal" class="modal fade modal-clean" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title fw-bold" id="modalTitle">Tambah Sprite</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="modalBody">
                <!-- form akan dimuat via AJAX -->
            </div>

        </div>
    </div>
</div>

<script>
    function openAddSprite() {
        $('#modalTitle').text('Tambah Sprite');

        $.get('<?= site_url("sprite/create") ?>', function(res) {
            $('#modalBody').html(res);
            $('#spriteModal').modal('show');
        });
    }

    function openEditSprite(data) {
        $('#modalTitle').text('Edit Sprite');

        $.get('<?= site_url("sprite/edit/") ?>' + data.id, function(res) {
            $('#modalBody').html(res);
            $('#spriteModal').modal('show');
        });
    }

    function deleteSprite(id) {
        if (!confirm('Hapus sprite ini?')) return;

        window.location.href =
            '<?= site_url("sprite/delete/") ?>' + id;
    }
</script>