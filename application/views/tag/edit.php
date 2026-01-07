<form method="post" action="<?= site_url('tag/update/' . $tag->id) ?>">

    <label>Nama Tag</label>
    <input type="text" name="tag_name"
        class="form-control"
        value="<?= $tag->tag_name ?>" required>

    <div class="text-end mt-3">
        <button class="btn bg-gradient-dark">Update</button>
    </div>

</form>