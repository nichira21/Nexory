<!-- FORM -->
<form method="post"
    action="<?= site_url('Sprite/store') ?>"
    enctype="multipart/form-data">

    <div class="modal-body">

        <!-- ROW 1 -->
        <div class="row">
            <div class="col-md-8">
                <label>Nama Sprite</label>
                <input type="text"
                    name="sprite_name"
                    class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label>Tipe Sprite</label>
                <select name="sprite_type" class="form-control">
                    <option value="jam">Jam</option>
                    <option value="design">Design</option>
                    <option value="background">Background</option>
                </select>
            </div>
        </div>

        <!-- TAG -->
        <div class="mt-3">
            <label>Tag</label>
            <select name="tags[]"
                class="form-control select2-tags"
                multiple="multiple"
                data-placeholder="Pilih tag">
                <?php foreach ($tags as $t): ?>
                    <option value="<?= $t->id ?>">
                        <?= $t->tag_name ?>
                    </option>
                <?php endforeach ?>
            </select>
            <small class="text-muted">
                Bisa pilih lebih dari satu
            </small>
        </div>


        <hr class="my-3">

        <!-- FILE -->
        <div>
            <label>File PNG</label>
            <input type="file"
                name="sprite_file"
                class="form-control"
                accept="image/png"
                required>
            <small class="text-muted">
                PNG transparan, resolusi disarankan 512×512
            </small>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="modal-footer">
        <button type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">
            Batal
        </button>
        <button type="submit"
            class="btn bg-gradient-dark">
            Simpan
        </button>
    </div>

</form>