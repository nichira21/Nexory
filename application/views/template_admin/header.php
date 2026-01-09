<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png">
    <title>
        <?= $judul_panjang; ?>
    </title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url(); ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url(); ?>assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* ================================
   CLEAN FORM MODAL (UNIVERSAL)
================================ */

        .modal-clean .modal-content {
            border-radius: 14px;
        }

        .modal-clean .modal-header {
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-clean .modal-title {
            font-weight: 600;
            font-size: 18px;
        }

        /* LABEL */
        .modal-clean label,
        .modal-clean .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 6px;
        }

        /* INPUT / SELECT / TEXTAREA */
        .modal-clean .form-control,
        .modal-clean .form-select {
            border-radius: 10px !important;
            border: 1.5px solid #d1d5db !important;
            font-size: 14px;
            padding: 10px 12px !important;
            background-color: #fff !important;
            box-shadow: none !important;
            transition: all .2s ease;
        }

        /* FOCUS */
        .modal-clean .form-control:focus,
        .modal-clean .form-select:focus {
            border-color: #111827 !important;
            box-shadow: 0 0 0 2px rgba(17, 24, 39, 0.12) !important;
        }

        /* TEXTAREA */
        .modal-clean textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        /* GRID SPACING */
        .modal-clean .row>div {
            margin-bottom: 14px;
        }

        /* FOOTER */
        .modal-clean .modal-footer {
            border-top: 1px solid #e5e7eb;
            padding: 16px;
        }

        /* BUTTONS */
        .modal-clean .btn {
            border-radius: 10px;
            font-size: 13px;
            padding: 8px 16px;
        }

        .modal-clean .btn-secondary {
            background: #6b7280;
            border: none;
        }

        .modal-clean .btn-dark,
        .modal-clean .btn.bg-gradient-dark {
            background: #111827 !important;
            border: none;
        }

        /* INPUT NORMALIZATION */
        .modal-clean input,
        .modal-clean textarea,
        .modal-clean select {
            outline: none !important;
            -webkit-appearance: none;
        }
    </style>


</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-3 m-0 d-flex align-items-center gap-2" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard">
                <img src="<?= base_url(); ?>assets/img/logo-ct-dark.png"
                    class="navbar-brand-img"
                    width="26"
                    height="26"
                    alt="XG Budgeting Logo">

                <div class="lh-sm">
                    <span class="text-sm fw-bold text-dark d-block">
                        XG Budgeting
                    </span>

                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted">•</span>
                        <span class="text-xs fw-semibold text-dark">
                            Hi, Alfredo Adi
                        </span>
                        <span class="text-muted">•</span>
                    </div>
                </div>

            </a>
        </div>

        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active bg-gradient-dark text-white" href="<?= base_url('B_Dashboard') ?>">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?= base_url('B_Manage_products') ?>">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Manage Produk</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Jam Custom</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/Sprite') ?>">
                        <i class="material-symbols-rounded opacity-5">image</i>
                        <span class="nav-link-text ms-1">Manage Sprite</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/Tag') ?>">
                        <i class="material-symbols-rounded opacity-5">sell</i>
                        <span class="nav-link-text ms-1">Manage Tag</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/GeneratorController') ?>">
                        <i class="material-symbols-rounded opacity-5">bolt</i>
                        <span class="nav-link-text ms-1">Generator Jam</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/GeneratorController/history') ?>">
                        <i class="material-symbols-rounded opacity-5">history</i>
                        <span class="nav-link-text ms-1">Batch History</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/CombinationController') ?>">
                        <i class="material-symbols-rounded opacity-5">leaderboard</i>
                        <span class="nav-link-text ms-1">Performance Ranking</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/SalesController') ?>">
                        <i class="material-symbols-rounded opacity-5">shopping_cart</i>
                        <span class="nav-link-text ms-1">Record Sales</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="<?= base_url('index.php/SalesController/log') ?>">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Sales Log</span>
                    </a>
                </li>


            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn bg-gradient-dark w-100" href="#" type="button">Logout</a>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg "> <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav d-flex align-items-center  justify-content-end">

                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>