<script>
    document.addEventListener('DOMContentLoaded', function() {

        if (typeof window.jQuery === 'undefined') {
            console.error('jQuery belum ter-load');
            return;
        }

        let mode = 'add';

        window.openAdd = function() {
            mode = 'add';
            $('#modalTitle').text('Tambah Produk');
            $('#formProduct')[0].reset();
            $('#product_id').val('');
            $('#modalProduct').modal('show');
        }

        window.openEdit = function(data) {
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

        // ==========================
        // SUBMIT ADD / EDIT
        // ==========================
        $('#formProduct').off('submit').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const id = $('#product_id').val();
            const url = (mode === 'add') ?
                '<?= base_url('B_Manage_products/store') ?>' :
                '<?= base_url('B_Manage_products/update/') ?>' + id;

            $.ajax({
                url: url,
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        location.reload();
                    } else {
                        alert(res.msg || 'Gagal menyimpan data');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('AJAX error');
                }
            });
        });

        // ==========================
        // DELETE PRODUCT (INI YANG KURANG)
        // ==========================
        window.deleteProduct = function(id, name, image) {

            let htmlPreview = `
            <div style="text-align:left">
                <strong>Produk:</strong><br>
                <span style="font-size:14px">${name}</span>
            </div>
        `;

            if (image) {
                htmlPreview = `
                <div class="d-flex align-items-center gap-3">
                    <img src="<?= base_url('uploads/products/') ?>${image}"
                         style="width:60px;height:60px;object-fit:cover;border-radius:8px">
                    <div>
                        <div class="fw-semibold">${name}</div>
                        <div class="text-muted text-sm">Produk akan dinonaktifkan</div>
                    </div>
                </div>
            `;
            }

            Swal.fire({
                title: 'Hapus produk?',
                html: htmlPreview,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('B_Manage_products/delete/') ?>' + id,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Produk berhasil dihapus',
                                    timer: 1200,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            } else {
                                Swal.fire('Gagal', res.msg || 'Gagal menghapus produk', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            Swal.fire('Error', 'Terjadi kesalahan server', 'error');
                        }
                    });
                }
            });
        };

    });
</script>