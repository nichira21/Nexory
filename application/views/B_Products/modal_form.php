<div class="modal fade" id="modalProduct" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formProduct">
                <input type="hidden" name="id" id="product_id">

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nama Produk</label>
                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="category_id"
                            id="category_id"
                            class="form-select"
                            required>
                            <?php foreach ($categories as $c): ?>
                                <option value="<?= $c->id ?>"><?= $c->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="form-label">Harga</label>
                        <input type="number"
                            name="price"
                            id="price"
                            class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stok</label>
                        <input type="number"
                            name="stock"
                            id="stock"
                            class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Featured</label>
                        <select name="featured"
                            id="featured"
                            class="form-select">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description"
                        id="description"
                        class="form-control"
                        rows="3"></textarea>
                </div>
            </form>


        </div>
    </div>
</div>