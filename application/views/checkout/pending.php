<div class="container my-5" style="max-width:720px;">
    <div class="card border-0 shadow rounded-4 text-center p-4">

        <div class="mb-3">
            <i class="bi bi-hourglass-split text-warning" style="font-size:3rem;"></i>
        </div>

        <h4 class="fw-bold mb-2">Pembayaran Sedang Diproses</h4>

        <p class="text-muted mb-4">
            Kami sedang menunggu konfirmasi pembayaran Anda.<br>
            Proses ini bisa memerlukan beberapa saat tergantung metode pembayaran.
        </p>

        <div class="alert alert-warning small rounded-3">
            Jangan menutup halaman ini jika Anda masih menyelesaikan pembayaran.
            Status pesanan akan diperbarui secara otomatis setelah pembayaran diterima.
        </div>

        <div class="d-grid gap-2 mt-4">
            <a href="<?= base_url() ?>" class="btn btn-dark rounded-pill">
                Kembali ke Beranda
            </a>

            <a href="<?= site_url('order') ?>" class="btn btn-outline-dark rounded-pill">
                Lihat Pesanan Saya
            </a>
        </div>

    </div>
</div>