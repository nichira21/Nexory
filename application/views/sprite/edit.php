<form method="post"
    action="<?= site_url('sprite/update/' . $sprite->id) ?>"
    enctype="multipart/form-data">

    <div class="mb-2">
        <label class="fw-semibold">Nama Sprite</label>
        <input value="<?= $sprite->sprite_name ?>"
            type="text" name="sprite_name"
            class="form-control" required>
    </div>

    <div class="mb-2">
        <label class="fw-semibold">Tipe Sprite</label>
        <select name="sprite_type" class="form-control">
            <option value="jam" <?= $sprite->sprite_type == 'jam' ? 'selected' : '' ?>>Jam</option>
            <option value="design" <?= $sprite->sprite_type == 'design' ? 'selected' : '' ?>>Design</option>
            <option value="background" <?= $sprite->sprite_type == 'background' ? 'selected' : '' ?>>Background</option>
        </select>
    </div>

    <div class="mb-2">
        <label class="fw-semibold">Tag</label>
        <select multiple name="tags[]" class="form-control">
            <?php foreach ($tags as $t): ?>
                <option value="<?= $t->id ?>"
                    <?= in_array($t->id, $selected_tags) ? 'selected' : '' ?>>
                    <?= $t->tag_name ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-2">
        <label class="fw-semibold">Ganti File (opsional)</label>
        <input type="file" name="sprite_file" class="form-control">
    </div>

    <div class="text-end mt-3">
        <button class="btn bg-gradient-dark">Update</button>
    </div>

</form>