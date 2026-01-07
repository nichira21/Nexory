<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="fw-bold mb-0">Design Preview</h4>
            <p class="text-sm text-muted mb-0">
                Layered visual preview (background → jam → design)
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-body d-flex justify-content-center">

            <div style="width:400px;height:800px;position:relative;border:1px solid #ddd">

                <img src="<?= $background ?>" style="width:100%;position:absolute">
                <img src="<?= $jam ?>" style="width:80%;left:10%;top:25%;position:absolute">
                <img src="<?= $design ?>" style="width:60%;left:20%;top:60%;position:absolute">

            </div>

        </div>
    </div>

</div>