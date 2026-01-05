<!-- HERO SECTION -->
<div id="uxBackdrop" class="ux-backdrop d-none"></div>

<section class="trust-strip">
    <div class="container">
        <div class="row align-items-center">
            <!-- Hero Text -->
            <div class="col-md-6 text-start">
                <div class="logo-crop logo-blend mb-3">
                    <img src="<?= base_url('assets/img/nexory-logo-black-transparent.png') ?>"
                        alt="NEXORY"
                        class="logo-img">
                </div>



                <p class="hero-sub">
                    Teknologi ikonik yang dibongkar dengan rapi,<br>
                    dibikin jadi karya yang seru dilihat dan layak dikoleksi.
                </p>

                <!-- MARKETPLACE BUTTONS -->
                <div class="d-flex gap-3 mt-3 flex-wrap justify-content-start">
                    <a href="https://www.tokopedia.com/nexory.id/" target="_blank" class="marketplace-btn">
                        <i class="bi bi-bag-fill me-1"></i> Tokopedia
                    </a>
                    <a href="https://www.tiktok.com/nexory.id" target="_blank" class="marketplace-btn">
                        <i class="bi bi-tiktok me-1"></i> TikTok Shop
                    </a>
                    <a href="https://shopee.co.id/nexory.id/" target="_blank" class="marketplace-btn">
                        <i class="bi bi-cart-fill me-1"></i> Shopee
                    </a>
                    <a href="https://www.lazada.co.id/nexory.id" target="_blank" class="marketplace-btn">
                        <i class="bi bi-bag-check-fill me-1"></i> Lazada
                    </a>
                </div>

                <p class="mt-4 text-muted fst-italic">
                    Designed to be appreciated. Built to endure.
                </p>
                <a href="https://wa.me/6289602970645" target="_blank"
                    class="btn btn-dark px-4 py-2 mb-4">
                    Chat Nexory on Whatsapp
                </a>
            </div>

            <!-- Hero Image -->
            <div class="col-md-6 text-center mt-4 mt-md-0">
                <img src="http://nexory.id//assets/img/background.png"
                    alt="NEXORY Featured Object"
                    class="img-fluid"
                    style="background: transparent;">
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->

<section class="trust-strip py-5">
    <div class="container">
        <div class="row text-center justify-content-center g-4">

            <div class="col-6 col-md-3">
                <i class="bi bi-shield-check fs-1 text-secondary"></i>
                <p class="mt-2 text-muted">Garansi Resmi 18 Bulan</p>
            </div>

            <div class="col-6 col-md-3">
                <i class="bi bi-cash-coin fs-1 text-secondary"></i>
                <p class="mt-2 text-muted">Jaminan Uang Kembali 30 Hari</p>
            </div>

            <div class="col-6 col-md-3">
                <i class="bi bi-headset fs-1 text-secondary"></i>
                <p class="mt-2 text-muted">Dukungan Pelanggan Seumur Hidup</p>
            </div>

            <div class="col-6 col-md-3">
                <i class="bi bi-truck fs-1 text-secondary"></i>
                <p class="mt-2 text-muted">Pengiriman Cepat ke Seluruh Indonesia</p>
            </div>

        </div>
    </div>
</section>

<!-- HOLIDAY PROMO MINI SECTION -->
<section class="py-4 text-center text-white" style="background-color: #000000; position: relative; overflow: hidden;">
    <div class="container position-relative" style="z-index:1;">
        <h4 class="fw-bold mb-2">🎄 Promo Natal & Tahun Baru 🎉</h4>
        <p class="mb-2 fs-6">
            Diskon hingga <span class="fw-bold">30%</span> untuk produk pilihan!<br>
        </p>
        <hr>
        <p class="fs-6 mt-1"> <!-- margin bawah diperkecil -->
            Gunakan kode promo:<br>
            <span id="promo-code" class="fw-bold" style="
                background-color: #888; 
                color: #888; 
                padding: 8px 20px; /* lebih besar area kode */
                font-size: 1.25rem; /* teks lebih besar */
                border-radius: 5px; 
                cursor: pointer;
                user-select: none;
                display: inline-block;
                transition: all 0.3s;
            ">
                HOLIDAY2025
            </span>
        </p>
    </div>
</section>

<!-- SEARCH + CATEGORY FILTER -->
<section class="py-4 border-top bg-white">
    <div class="container my-4">
        <h1 class="fw-bold display-4 text-dark mb-3">
            Koleksi Pilihan
        </h1>

        <div class="input-group mb-4">
            <span class="input-group-text bg-white border-end-0">
            </span>
            <input type="text" class="form-control border-start-0" placeholder="Cari Device, Brand, atau Kategori">
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="badge rounded-pill bg-dark px-3 py-2">iPhone</span>
            <span class="badge rounded-pill bg-secondary px-3 py-2">Samsung</span>
            <span class="badge rounded-pill bg-secondary px-3 py-2">Google Pixel</span>
            <span class="badge rounded-pill bg-secondary px-3 py-2">Xiaomi</span>
            <span class="badge rounded-pill bg-secondary px-3 py-2">OPPO</span>
            <span class="badge rounded-pill bg-secondary px-3 py-2">Huawei</span>
        </div>


    </div>
</section>

<div class="container">
    <section class="row g-4">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $p) :
                // Naikkan 50-70% dan bulatkan ribuan
                $increase_percent = rand(50, 70);
                $old_price = round($p->price * (1 + $increase_percent / 100), -3);
            ?>
                <div class="col-md-3">
                    <div class="behance-card position-relative">

                        <div class="thumb-wrapper">
                            <img src="<?= base_url('uploads/products/' . $p->image) ?>"
                                alt="<?= $p->name ?>"
                                class="behance-thumb">

                            <div class="overlay">

                                <?php if ($p->sell_mode === 'web'): ?>

                                    <!-- WEB -->
                                    <button
                                        class="btn btn-dark fw-semibold px-4"
                                        onclick="NexoryCart.add(this)"
                                        data-id="<?= $p->id ?>"
                                        data-name="<?= htmlspecialchars($p->name, ENT_QUOTES) ?>"
                                        data-price="<?= $p->price ?>"
                                        data-image="<?= base_url('uploads/products/' . $p->image) ?>">
                                        Add to Cart
                                    </button>

                                <?php elseif ($p->sell_mode === 'marketplace'): ?>

                                    <!-- MARKETPLACE -->
                                    <div class="d-flex gap-2 flex-wrap justify-content-center">

                                        <?php if ($p->shopee_url): ?>
                                            <a href="<?= $p->shopee_url ?>" target="_blank"
                                                class="btn btn-outline-danger btn-sm fw-semibold">
                                                Shopee
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($p->tokopedia_url): ?>
                                            <a href="<?= $p->tokopedia_url ?>" target="_blank"
                                                class="btn btn-outline-success btn-sm fw-semibold">
                                                Tokopedia
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($p->tiktokshop_url): ?>
                                            <a href="<?= $p->tiktokshop_url ?>" target="_blank"
                                                class="btn btn-outline-dark btn-sm fw-semibold">
                                                TikTok Shop
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($p->lazada_url): ?>
                                            <a href="<?= $p->lazada_url ?>" target="_blank"
                                                class="btn btn-outline-primary btn-sm fw-semibold">
                                                Lazada
                                            </a>
                                        <?php endif; ?>

                                    </div>

                                <?php else: ?>

                                    <!-- OFF -->
                                    <button class="btn btn-secondary fw-semibold px-4" disabled>
                                        Tidak Tersedia
                                    </button>

                                <?php endif; ?>

                            </div>



                        </div>

                        <div class="p-2 pt-3">
                            <h6 class="fw-bold mb-1 text-dark"><?= $p->name ?></h6>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><?= $p->category_name ?></span>

                                <div class="text-end">
                                    <span class="text-muted small text-decoration-line-through me-1">
                                        Rp <?= number_format($old_price, 0, ',', '.') ?>
                                    </span>
                                    <span class="fw-semibold text-primary">
                                        Rp <?= number_format($p->price, 0, ',', '.') ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk tersedia.</p>
            </div>
        <?php endif ?>
    </section>
</div>

<!-- DECONSTRUCTION ART SECTION -->
<section class="py-5 bg-light text-center">
    <div class="container">
        <hr>
        <p class="mb-4 text-muted fs-5">
            Explore the beauty of deconstruction in our framed art collection.<br>
            Where vintage tech meets timeless design — perfect for collectors and enthusiasts.
        </p>
        <a href="https://www.instagram.com/nexory.id" target="_blank"
            class="btn btn-dark px-4 py-2 mb-4">
            Follow Nexory on Instagram
        </a>
        <a href="https://wa.me/6289602970645" target="_blank"
            class="btn btn-dark px-4 py-2 mb-4">
            Chat Nexory on Whatsapp
        </a>

        <!-- Instagram Feed (Hardcoded) -->
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <a href="#" target="_blank" class="d-block">
                    <img src="http://nexory.id//uploads/products/img.jpg" alt="Instagram Post 1"
                        class="img-fluid rounded shadow-sm">
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" target="_blank" class="d-block">
                    <img src="http://nexory.id//uploads/products/img.jpg" alt="Instagram Post 2"
                        class="img-fluid rounded shadow-sm">
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" target="_blank" class="d-block">
                    <img src="http://nexory.id//uploads/products/img.jpg" alt="Instagram Post 3"
                        class="img-fluid rounded shadow-sm">
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="#" target="_blank" class="d-block">
                    <img src="http://nexory.id//uploads/products/img.jpg" alt="Instagram Post 4"
                        class="img-fluid rounded shadow-sm">
                </a>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="loginModal"
    tabindex="-1"
    data-bs-backdrop="true"
    data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-body text-center px-4 py-4">
                <h5 class="fw-bold mb-3">Masuk ke Akun</h5>

                <div class="mb-3 text-start">
                    <label class="form-label">Email</label>
                    <input type="email" id="loginEmail" class="form-control">
                </div>

                <div class="mb-2 text-start">
                    <label class="form-label">Password</label>

                    <div class="input-group">
                        <input type="password" id="loginPassword" class="form-control">
                        <span class="input-group-text bg-white"
                            onclick="togglePassword('loginPassword','eyeLogin')"
                            onmousedown="event.preventDefault()">
                            <i id="eyeLogin" class="bi bi-eye"></i>
                        </span>

                    </div>
                </div>


                <p class="small text-secondary text-end mb-3">
                    <a href="#">Lupa password?</a>
                </p>

                <div class="d-grid gap-2 mt-3">
                    <button onclick="loginSubmit()" class="btn btn-dark">LOGIN</button>

                    <button
                        class="btn btn-outline-dark py-2 fw-semibold rounded-pill"
                        data-bs-toggle="modal"
                        data-bs-target="#registerModal"
                        data-bs-dismiss="modal">
                        BUAT AKUN
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="registerModal"
    tabindex="-1"
    data-bs-backdrop="true"
    data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-body text-center px-4 py-4">
                <h5 class="fw-bold mb-3">Daftar Akun Baru</h5>

                <div class="mb-3 text-start">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="regName" class="form-control">
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Email</label>
                    <input type="email" id="regEmail" class="form-control">
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" id="regPassword" class="form-control"
                            oninput="checkPasswordMatch()">
                        <span class="input-group-text bg-white"
                            onclick="togglePassword('regPassword','eyeReg1')"
                            onmousedown="event.preventDefault()">
                            <i id="eyeReg1" class="bi bi-eye"></i>
                        </span>


                    </div>
                </div>

                <div class="mb-1 text-start">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" id="regPasswordConfirm" class="form-control"
                            oninput="checkPasswordMatch()">
                        <span class="input-group-text bg-white"
                            onclick="togglePassword('regPasswordConfirm','eyeReg2')"
                            onmousedown="event.preventDefault()">
                            <i id="eyeReg2" class="bi bi-eye"></i>
                        </span>

                    </div>
                </div>

                <small id="passwordHint" class="text-danger d-none">
                    Password tidak sama
                </small>


                <div class="d-grid gap-2 mt-3">
                    <button onclick="registerSubmit()" class="btn btn-dark">Daftar</button>


                    <button
                        class="btn btn-outline-dark py-2 fw-semibold rounded-pill"
                        data-bs-toggle="modal"
                        data-bs-target="#loginModal"
                        data-bs-dismiss="modal">
                        Login
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    /* ======================================================
   NEXORY CART — FINAL FIX (ANTI 1→3)
====================================================== */
    window.NexoryCart = (function() {

        const KEY = 'nexory_cart';
        let cartEl, badgeEl, totalEl;

        /* ================= TEMPLATE ================= */
        function tpl(item) {
            return `
    <div class="cart-item p-3 border rounded-4 mb-3 cart-flash"
         data-id="${item.id}" data-price="${item.price}">
      <img src="${item.image}" style="width:90px;height:90px;object-fit:cover" class="rounded-3">
      <div class="flex-grow-1">
        <div class="fw-semibold">${item.name}</div>
        <div class="fw-semibold mt-1">  Rp ${Number(item.price).toLocaleString('id-ID')}</div>

        <div class="d-flex gap-2 mt-2">
          <button class="btn btn-dark btn-sm" data-act="minus">−</button>
          <span class="px-2 qty">${item.qty}</span>
          <button class="btn btn-dark btn-sm" data-act="plus">+</button>
          <button class="btn btn-light btn-sm" data-act="delete">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
    </div>`;
        }

        /* ================= INIT ================= */
        function init() {
            cartEl = document.getElementById('cartItems');
            badgeEl = document.getElementById('cartBadge');
            totalEl = document.getElementById('cartTotal');
            if (!cartEl || !totalEl) return;

            load();
            cartEl.onclick = handleCartClick;
        }

        /* ================= ADD ================= */
        function add(btn) {
            const id = btn.dataset.id;
            let item = cartEl.querySelector(`.cart-item[data-id="${id}"]`);

            if (item) {
                const q = item.querySelector('.qty');
                q.textContent = +q.textContent + 1;
                flash(item);
            } else {
                cartEl.insertAdjacentHTML('afterbegin', tpl({
                    id,
                    name: btn.dataset.name,
                    price: +btn.dataset.price,
                    image: btn.dataset.image,
                    qty: 1
                }));
            }

            sync();
            pulse();
        }

        /* ================= CART CLICK ================= */
        function handleCartClick(e) {
            const act = e.target.closest('[data-act]');
            if (!act) return;

            const item = act.closest('.cart-item');
            const qtyEl = item.querySelector('.qty');

            if (act.dataset.act === 'plus') qtyEl.textContent++;
            if (act.dataset.act === 'minus' && qtyEl.textContent > 1) qtyEl.textContent--;
            if (act.dataset.act === 'delete') item.remove();

            flash(item);
            sync();
            pulse();
        }

        /* ================= SYNC ================= */
        function sync() {
            let total = 0,
                count = 0,
                data = [];
            cartEl.querySelectorAll('.cart-item').forEach(i => {
                const q = +i.querySelector('.qty').textContent;
                const p = Number(i.dataset.price);
                total += q * p;
                count += q;
                data.push({
                    id: i.dataset.id,
                    name: i.querySelector('.fw-semibold').textContent,
                    price: p,
                    image: i.querySelector('img').src,
                    qty: q
                });
            });
            totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
            if (badgeEl) badgeEl.textContent = count;
            localStorage.setItem(KEY, JSON.stringify(data));
        }

        function load() {
            cartEl.innerHTML = ''; // 🔥 wajib
            (JSON.parse(localStorage.getItem(KEY) || '[]'))
            .forEach(i => cartEl.insertAdjacentHTML('beforeend', tpl(i)));
            sync();
        }


        /* ================= ANIMATION ================= */
        function pulse() {
            if (!badgeEl) return;
            badgeEl.classList.remove('cart-badge-animate');
            void badgeEl.offsetWidth;
            badgeEl.classList.add('cart-badge-animate');
        }

        function flash(el) {
            if (!el) return;
            el.classList.remove('cart-flash');
            void el.offsetWidth;
            el.classList.add('cart-flash');
        }

        return {
            init,
            add
        };

    })();

    /* ===================================================== PROMO CODE ===================================================== */
    document.addEventListener('DOMContentLoaded', () => {
        const promo = document.getElementById('promo-code');
        if (promo) {
            promo.addEventListener('click', () => {
                promo.style.backgroundColor = 'transparent';
                promo.style.color = '#FFC107';
            });
        }
    });
    // ⛔ END GUARD

    document.addEventListener('DOMContentLoaded', NexoryCart.init);
</script>






<script>
    let syncing = false;

    function syncCartAfterLogin() {
        if (syncing) return;
        syncing = true;

        const cart = JSON.parse(localStorage.getItem('nexory_cart') || '[]');

        $.ajax({
            url: "<?= site_url('Order/sync') ?>",
            method: "POST",
            data: {
                cart: JSON.stringify(cart)
            },
            dataType: "json",
            success(res) {
                if (res.status && res.cart) {
                    localStorage.setItem('nexory_cart', JSON.stringify(res.cart));
                }
            },
            complete() {
                syncing = false;
            }
        });
    }


    function loginSubmit() {
        $.post("<?= site_url('User/login') ?>", {
            email: $('#loginEmail').val(),
            password: $('#loginPassword').val()
        }, function(r) {

            if (r.status) {
                Toast.fire({
                    icon: 'success',
                    title: r.msg
                });

                syncCartAfterLogin();

                setTimeout(() => {
                    window.location.href = r.redirect;
                }, 700);

            } else {
                Toast.fire({
                    icon: 'error',
                    title: r.msg
                });
            }

        }, 'json');
    }


    function registerSubmit() {
        $.post("<?= site_url('User/register') ?>", {
            name: $('#regName').val(),
            email: $('#regEmail').val(),
            password: $('#regPassword').val()
        }, function(res) {
            let r = JSON.parse(res);
            if (r.status) {
                Toast.fire({
                    icon: 'success',
                    title: r.msg
                });
                setTimeout(() => switchToLogin(), 800);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: r.msg
                });
            }
        });
    }
</script>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (!input || !icon) return;

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }


    /* ================= PASSWORD MATCH CHECK ================= */
    function checkPasswordMatch() {
        const pass = document.getElementById('regPassword');
        const pass2 = document.getElementById('regPasswordConfirm');
        const hint = document.getElementById('passwordHint');

        if (!pass || !pass2 || !hint) return;

        if (!pass2.value) {
            pass2.classList.remove('is-valid', 'is-invalid');
            hint.classList.add('d-none');
            return;
        }

        if (pass.value === pass2.value) {
            pass2.classList.add('is-valid');
            pass2.classList.remove('is-invalid');
            hint.classList.add('d-none');
        } else {
            pass2.classList.add('is-invalid');
            pass2.classList.remove('is-valid');
            hint.classList.remove('d-none');
        }
    }

    /* ================= BLOCK REGISTER IF NOT MATCH ================= */
    function isPasswordValid() {
        const pass = document.getElementById('regPassword').value;
        const pass2 = document.getElementById('regPasswordConfirm').value;
        return pass && pass === pass2;
    }
</script>