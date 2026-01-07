<div class="modal fade modal-clean" id="modalProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formProduct" method="post" action="javascript:void(0);" onsubmit="return false;">
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
                    <hr class="my-3">

                    <h6 class="text-sm fw-bold text-muted mb-2">Link Marketplace (Opsional)</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Shopee</label>
                            <input type="url" name="shopee_url" id="shopee_url" class="form-control"
                                placeholder="https://shopee.co.id/...">
                        </div>

                        <div class="col-md-6">
                            <label>Tokopedia</label>
                            <input type="url" name="tokopedia_url" id="tokopedia_url" class="form-control"
                                placeholder="https://tokopedia.com/...">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label>TikTok Shop</label>
                            <input type="url" name="tiktokshop_url" id="tiktokshop_url" class="form-control"
                                placeholder="https://www.tiktok.com/...">
                        </div>

                        <div class="col-md-6">
                            <label>Lazada</label>
                            <input type="url" name="lazada_url" id="lazada_url" class="form-control"
                                placeholder="https://www.lazada.co.id/...">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Mode Penjualan</label>
                            <select name="sell_mode" id="sell_mode" class="form-control">
                                <option value="web">Web (Add to Cart)</option>
                                <option value="marketplace">Marketplace</option>
                                <option value="off">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-gradient-dark">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>