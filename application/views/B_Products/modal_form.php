<div class="modal fade" id="modalProduct" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formProduct">
                <div class="modal-body">

                    <input type="hidden" name="id" id="product_id">

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama Produk</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>Kategori</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($this->db->get('tb_categories')->result() as $c): ?>
                                    <option value="<?= $c->id ?>"><?= $c->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Harga</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Stok</label>
                            <input type="number" name="stock" id="stock" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Featured</label>
                            <select name="featured" id="featured" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Deskripsi</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-gradient-dark">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    let mode = 'add';

    function openAdd() {
        mode = 'add';
        $('#modalTitle').text('Tambah Produk');
        $('#formProduct')[0].reset();
        $('#product_id').val('');
        $('#modalProduct').modal('show');
    }

    function openEdit(data) {
        mode = 'edit';
        $('#modalTitle').text('Edit Produk');

        $('#product_id').val(data.id);
        $('#name').val(data.name);
        $('#category_id').val(data.category_id);
        $('#price').val(data.price);
        $('#stock').val(data.stock);
        $('#featured').val(data.featured);
        $('#description').val(data.description);

        $('#modalProduct').modal('show');
    }

    $('#formProduct').submit(function(e) {
        e.preventDefault();

        let url = mode === 'add' ?
            '<?= base_url('manage_products/store') ?>' :
            '<?= base_url('manage_products/update/') ?>' + $('#product_id').val();

        $.post(url, $(this).serialize(), function(res) {
            location.reload();
        }, 'json');
    });

    function deleteProduct(id) {
        Swal.fire({
            title: 'Hapus produk?',
            text: 'Produk akan dinonaktifkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus'
        }).then((r) => {
            if (r.isConfirmed) {
                $.post('<?= base_url('manage_products/delete/') ?>' + id, function() {
                    location.reload();
                });
            }
        });
    }
</script>