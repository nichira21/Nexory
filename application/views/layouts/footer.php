</div>

<!-- FOOTER -->
<footer class="footer bg-dark text-light pt-5 pb-4 mt-4">
    <div class="container">

        <div class="row gy-4">

            <!-- BRAND -->
            <div class="col-lg-4 col-md-6">
                <h4 class="fw-bold">Nexory</h4>
                <p class="text-white mt-2">
                    Precision-engineered exhibition objects & deconstruction artworks.
                    Designed to endure. Built to be remembered.
                </p>
            </div>

            <!-- SHOP -->
            <div class="col-lg-2 col-md-3">
                <h6 class="fw-semibold mb-3">Collection</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Featured Objects</a></li>
                    <li><a href="#">Frames</a></li>
                    <li><a href="#">Limited Editions</a></li>
                    <li><a href="#">Custom Works</a></li>
                </ul>
            </div>

            <!-- SUPPORT -->
            <div class="col-lg-2 col-md-3">
                <h6 class="fw-semibold mb-3">Support</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Shipping & Warranty</a></li>
                    <li><a href="#">Order Tracking</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <!-- BUSINESS -->
            <div class="col-lg-4 col-md-6">
                <h6 class="fw-semibold mb-3">Business & Partnership</h6>
                <p class="text-white">
                    Exhibitions, collaborations, gallery partnerships, and corporate requests.
                </p>

                <a href="#" class="btn btn-outline-light btn-sm px-4">
                    Get in Touch
                </a>
            </div>

        </div>

        <hr class="border-secondary mt-4 mb-3">

        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <p class="mb-0 text-white">
                © Nexory 2025 — Precision Engineered Exhibition Objects
            </p>

            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <span class="mx-2">•</span>
                <a href="<?= base_url('marketplace/terms') ?> ?>">Terms</a>
            </div>
        </div>

    </div>
</footer>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
<!-- JQUERY (WAJIB) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.Toast = Swal.mixin({
        toast: true,
        position: window.innerWidth < 576 ? 'top' : 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        background: '#111',
        color: '#fff',
        iconColor: '#fff',
        customClass: {
            popup: 'rounded-4 shadow'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
            bootstrap.Dropdown.getOrCreateInstance(el);
        });
    });

    $(document).on('click', '.btn-logout', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Logout?',
            text: 'Kamu akan keluar dari akun ini',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= site_url('User/logout') ?>";
            }
        });
    });
</script>


</body>

</html>