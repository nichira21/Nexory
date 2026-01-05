<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="mb-0 fw-bold">Manage Products</h4>
            <p class="text-sm text-muted mb-0">Kelola produk, stok, dan status penjualan</p>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn bg-gradient-dark btn-sm" onclick="openAdd()">
                <i class="material-symbols-rounded text-sm">add</i> Tambah Produk
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
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Target</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <?php if (!empty($p->image)): ?>
                                            <img src="<?= base_url('uploads/products/' . $p->image) ?>"
                                                class="rounded"
                                                style="width:40px;height:40px;object-fit:cover">
                                        <?php else: ?>
                                            <div class="rounded bg-secondary" style="width:40px;height:40px"></div>
                                        <?php endif; ?>

                                        <div>
                                            <div class="fw-semibold"><?= $p->name ?></div>
                                            <div class="text-xs text-muted"><?= $p->slug ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $p->category_name ?></td>
                                <td>Rp <?= number_format($p->price, 0, ',', '.') ?></td>
                                <td><?= $p->stock ?></td>
                                <td>
                                    <?= $p->featured ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' ?>
                                </td>
                                <td>
                                    <?= $p->status ? '<span class="badge bg-info">Aktif</span>' : '<span class="badge bg-danger">Nonaktif</span>' ?>
                                </td>
                                <td>
                                    <?php if ($p->sell_mode === 'web'): ?>
                                        <span class="badge bg-dark">WEB</span>
                                    <?php elseif ($p->sell_mode === 'marketplace'): ?>
                                        <span class="badge bg-info">MARKETPLACE</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">OFF</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick='openEdit(<?= json_encode($p) ?>)'>
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?= $p->id ?>)">
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