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