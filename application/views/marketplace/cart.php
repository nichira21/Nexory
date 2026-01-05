<!-- OFFCANVAS -->
<div class="offcanvas offcanvas-end border-0 shadow-lg" id="cartPanel" data-bs-backdrop="static" data-bs-scroll="false">
    <div class="offcanvas-header">
        <h5 class="fw-bold mb-0">Your Basket</h5>
        <button class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column pt-0">

        <div id="cartItems" class="flex-grow-1 overflow-auto">



        </div>

        <!-- Footer Total -->
        <div class="mt-auto rounded-4 border p-3 bg-white">
            <div class="d-flex justify-content-between small text-muted">
                <span>Subtotal</span>
                <strong id="cartTotal" class="text-dark">Rp 180.000</strong>
            </div>

            <button class="btn btn-dark w-100 fw-semibold py-2 rounded-pill mt-3"
                onclick="checkout()">
                Lanjutkan
            </button>


            <a href="#" class="d-block text-center mt-2 small text-decoration-underline" data-bs-dismiss="offcanvas">
                Batalkan
            </a>
        </div>
    </div>
</div>

<script>
    function checkout() {
        $.post("<?= site_url('checkout/create') ?>", {}, function(r) {
            if (!r.status) {
                Toast.fire({
                    icon: 'error',
                    title: r.msg
                });
                return;
            }

            window.snap.pay(r.snap_token, {
                onSuccess: function() {
                    location.href = "<?= site_url('checkout/success') ?>";
                },
                onPending: function() {
                    location.href = "<?= site_url('checkout/pending') ?>";
                },
                onError: function() {
                    location.href = "<?= site_url('checkout/error') ?>";
                }
            });

        }, 'json');
    }
</script>