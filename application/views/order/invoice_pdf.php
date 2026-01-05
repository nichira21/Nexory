<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice <?= $order->order_code ?></title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #222;
            background: #fff;
        }

        .invoice-wrapper {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ddd;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .invoice-header img {
            height: 55px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .invoice-meta {
            margin-top: 5px;
            font-size: 12px;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .info-box {
            width: 48%;
        }

        .info-box h4 {
            margin-bottom: 6px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            background: #000;
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        table tbody td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        table tfoot td {
            padding: 10px;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            width: 40%;
            margin-left: auto;
            margin-top: 20px;
        }

        .summary table td {
            padding: 6px 0;
        }

        .summary .total {
            font-weight: bold;
            font-size: 15px;
            border-top: 2px solid #000;
            padding-top: 8px;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px dashed #aaa;
            padding-top: 15px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="invoice-wrapper">

        <!-- HEADER -->
        <div class="invoice-header">
            <img src="https://nexory.id/assets/img/nexory-logo-black-transparent.png" alt="Nexory">

            <div class="invoice-title">
                <h1>INVOICE</h1>
                <div class="invoice-meta">
                    <div>No: <strong><?= $order->order_code ?></strong></div>
                    <div>Tanggal: <?= date('d F Y', strtotime($order->created_at)) ?></div>
                </div>
            </div>
        </div>

        <!-- INFO PENJUAL & PEMBELI -->
        <div class="info-section">
            <div class="info-box">
                <h4>DITERBITKAN OLEH</h4>
                <strong>Nexory</strong><br>
                Jakarta, Indonesia<br>
                Email: support@nexory.id<br>
            </div>

            <div class="info-box">
                <h4>DITAGIHKAN KE</h4>
                <strong><?= $this->session->userdata('name') ?></strong><br>
                <?= $this->session->userdata('email') ?><br>
                <?= $this->session->userdata('phone') ?? '' ?>
            </div>
        </div>

        <!-- TABEL ITEM -->
        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th width="80">Qty</th>
                    <th width="150">Harga Satuan</th>
                    <th width="150">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $subtotal = 0; ?>
                <?php foreach ($items as $i): ?>
                    <?php $line_total = $i->qty * $i->price; ?>
                    <?php $subtotal += $line_total; ?>
                    <tr>
                        <td><?= $i->name ?></td>
                        <td><?= $i->qty ?></td>
                        <td>Rp <?= number_format($i->price, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($line_total, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="summary">
            <table width="100%">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">
                        Rp <?= number_format($subtotal, 0, ',', '.') ?>
                    </td>
                </tr>

                <?php if ($promo_value > 0): ?>
                    <tr>
                        <td>
                            Promo
                            <?php if (!empty($order->promo_code)): ?>
                                <small>(<?= strtoupper($order->promo_code) ?>)</small>
                            <?php endif ?>
                        </td>
                        <td class="text-right">
                            − Rp <?= number_format($promo_value, 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endif ?>

                <tr class="total">
                    <td>Total</td>
                    <td class="text-right">
                        Rp <?= number_format($total_final, 0, ',', '.') ?>
                    </td>
                </tr>
            </table>
        </div>



        <!-- FOOTER -->
        <div class="footer">
            <strong>Metode Pembayaran:</strong><br>
            Transfer Bank / Virtual Account / E-Wallet<br><br>

            <strong>Syarat & Ketentuan:</strong><br>
            Pembayaran dilakukan maksimal 1×24 jam setelah invoice diterbitkan.
            Pesanan akan diproses setelah pembayaran diterima.<br><br>

            <em>Invoice ini diterbitkan secara otomatis dan sah tanpa tanda tangan.</em>
        </div>

    </div>

</body>

</html>