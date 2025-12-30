<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Nexory — Precision Engineered Objects | The Next Standard</title>

  <meta name="description" content="Nexory creates precision-engineered display objects and exhibition frames designed with discipline, clarity, and enduring relevance. Discover Nexory FRAME — built to be seen, not replaced." />
  <meta name="keywords" content="Nexory, engineered objects, exhibition frame, design object, premium frame display, precision design, collectible display, engineering design brand" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://nexory.id//" />

  <!-- Open Graph -->
  <meta property="og:title" content="Nexory — Precision Engineered Objects" />
  <meta property="og:description" content="Teknologi ikonik yang dibongkar dengan rapi, dibikin jadi karya yang layak dikoleksi." />
  <meta property="og:image" content="https://nexory.id/assets/img/og-nexory.png" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:url" content="https://nexory.id/" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="Nexory" />


  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Nexory — The Next Standard" />
  <meta name="twitter:description" content="Precision-engineered exhibition objects designed to endure." />
  <meta name="twitter:image" content="https://nexory.id/assets/img/og-nexory.png" />


  <!-- Favicon -->
  <link rel="icon" type="image/png" href="https://nexory.id/assets/img/asset.png" />
  <link rel="canonical" href="https://nexory.id/" />

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5FZFH9RB');
  </script>
  <!-- End Google Tag Manager -->


  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '918300190624192');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=918300190624192&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- Clarity -->
  <script type="text/javascript">
    (function(c, l, a, r, i, t, y) {
      c[a] = c[a] || function() {
        (c[a].q = c[a].q || []).push(arguments)
      };
      t = l.createElement(r);
      t.async = 1;
      t.src = "https://www.clarity.ms/tag/" + i;
      y = l.getElementsByTagName(r)[0];
      y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "urunv5poe5");
  </script>
  <!-- Clarity -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="<?= base_url('assets/css/behance-style.css') ?>">
  <style>
    .ux-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .45);
      backdrop-filter: blur(6px);
      z-index: 1045;
      /* di bawah offcanvas (1046) */
      opacity: 0;
      transition: opacity .25s ease;
    }

    @keyframes cartPulse {
      0% {
        transform: scale(1);
      }

      40% {
        transform: scale(1.35);
      }

      70% {
        transform: scale(0.9);
      }

      100% {
        transform: scale(1);
      }
    }

    .cart-badge-animate {
      animation: cartPulse 0.45s ease;
    }

    @keyframes cartPulse {
      0% {
        transform: scale(1);
      }

      40% {
        transform: scale(1.4);
      }

      100% {
        transform: scale(1);
      }
    }

    .cart-badge-animate {
      animation: cartPulse .45s ease;
    }

    @keyframes cartFlash {
      0% {
        background: #fff;
      }

      40% {
        background: #f1f3f5;
      }

      100% {
        background: #fff;
      }
    }

    .cart-flash {
      animation: cartFlash .6s ease;
    }


    .ux-backdrop.active {
      opacity: 1;
    }

    .logo-crop {
      height: 300px;
      /* tinggi hasil akhir */
      overflow: hidden;
      /* POTONG atas & bawah */

    }

    .logo-crop img {
      width: 100%;
      height: 150%;
      object-fit: cover;
      object-position: center;
      background: transparent;
    }

    .logo-blend {
      mix-blend-mode: multiply;
    }
  </style>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-67BFF5C47W"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-67BFF5C47W');
</script>

<body class="bg-light">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FZFH9RB"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold fs-4" href="<?= base_url() ?>">Nexory</a>

      <div class="d-flex align-items-center gap-2">

        <a class="btn btn-light border rounded-pill px-3 py-2 position-relative d-flex align-items-center"
          data-bs-toggle="offcanvas"
          data-bs-target="#cartPanel">
          <i class="bi bi-bag fs-5"></i>

          <!-- Lingkaran merah bulat -->
          <span id="cartBadge"
            class="position-absolute top-0 start-100 translate-middle bg-danger text-white d-flex justify-content-center align-items-center"
            style="width:18px; height:18px; font-size:12px; border-radius:50%;">
            2
          </span>
        </a>






        <a href="#"
          class="btn btn-dark rounded-pill px-4 py-2 fw-semibold"
          data-bs-toggle="modal"
          data-bs-target="#loginModal">
          Masuk
        </a>


      </div>

    </div>
  </nav>