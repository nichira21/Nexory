<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Manage Tags</h4>
            <p class="text-sm text-muted mb-0">
                Kelola kategori & pengelompokan sprite
            </p>
        </div>

        <div class="col-md-6 text-end">
            <button class="btn bg-gradient-dark btn-sm"
                onclick="openAddTag()">
                <i class="material-symbols-rounded text-sm">add</i>
                Tambah Tag
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive px-3">

                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Tag</th>
                            <th>Used</th>
                            <th>Sold</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($tags as $t): ?>
                            <tr>

                                <td class="fw-semibold"><?= $t->tag_name ?></td>

                                <td><span class="badge bg-info"><?= $t->used_count ?></span></td>
                                <td><span class="badge bg-success"><?= $t->sold_count ?></span></td>

                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick='openEditTag(<?= json_encode($t) ?>)'>
                                        Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm"
                                        onclick="deleteTag(<?= $t->id ?>)">
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

<script>
    function openAddTag() {
        $.get('<?= site_url("tag/create") ?>', res => {
            $('#modalTitle').text('Tambah Tag');
            $('#modalBody').html(res);
            $('#spriteModal').modal('show');
        });
    }

    function openEditTag(data) {
        $.get('<?= site_url("tag/edit/") ?>' + data.id, res => {
            $('#modalTitle').text('Edit Tag');
            $('#modalBody').html(res);
            $('#spriteModal').modal('show');
        });
    }

    function deleteTag(id) {
        if (!confirm('Hapus tag ini?')) return;
        location.href = '<?= site_url("tag/delete/") ?>' + id;
    }
</script>