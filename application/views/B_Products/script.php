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

        $('#product_id').val(data.id);
        $('#name').val(data.name);
        $('#category_id').val(data.category_id);
        $('#price').val(data.price);
        $('#stock').val(data.stock);
        $('#featured').val(data.featured);
        $('#description').val(data.description);

        $('#shopee_url').val(data.shopee_url);
        $('#tokopedia_url').val(data.tokopedia_url);
        $('#tiktokshop_url').val(data.tiktokshop_url);
        $('#lazada_url').val(data.lazada_url);
        $('#sell_mode').val(data.sell_mode ?? 'web');

        $('#modalProduct').modal('show');
    }

    $('#formProduct').on('submit', function(e) {
        e.preventDefault(); // ⛔ STOP SUBMIT NATIVE

        const id = $('#product_id').val();

        const url = (mode === 'add') ?
            '<?= base_url('B_Manage_products/store') ?>' :
            '<?= base_url('B_Manage_products/update/') ?>' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    location.reload();
                } else {
                    alert(res.msg || 'Gagal menyimpan data');
                }
            }
        });
    });
</script>