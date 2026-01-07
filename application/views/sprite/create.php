<form method="post"
    action="<?= site_url('sprite/store') ?>"
    enctype="multipart/form-data">

    <div class="mb-2">
        <label class="fw-semibold">Nama Sprite</label>
        <input type="text" name="sprite_name" class="form-control" required>
    </div>

    <div class="mb-2">
        <label class="fw-semibold">Tipe Sprite</label>
        <select name="sprite_type" class="form-control">
            <option value="jam">Jam</option>
            <option value="design">Design</option>
            <option value="background">Background</option>
        </select>
    </div>

    <div class="mb-2">
        <label class="fw-semibold">Tag</label>
        <select multiple name="tags[]" class="form-control">
            <?php foreach ($tags as $t): ?>
                <option value="<?= $t->id ?>"><?= $t->tag_name ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-2">
        <label class="fw-semibold">File PNG</label>
        <input type="file" name="sprite_file" class="form-control" required>
        <small class="text-muted">PNG transparan</small>
    </div>

    <div class="text-end mt-3">
        <button class="btn bg-gradient-dark">Simpan</button>
    </div>

</form>