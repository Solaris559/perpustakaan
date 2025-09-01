<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
    }

    .kartu {
        width: 8.6cm;
        height: 5.4cm;
        border: 1px solid #000;
        box-sizing: border-box;
        margin: 10px auto;
        position: relative;
        background: linear-gradient(to top, #ffffff, #d4f0d4);
        page-break-after: always;
        overflow: hidden;
    }

    .header {
        background-color: #3a7733;
        color: white;
        padding: 4px 8px;
        display: flex;
        align-items: center;
    }

    .header img {
        height: 40px;
        margin-right: 8px;
    }

    .header-text {
        flex-grow: 1;
        text-align: center;
        font-size: 10px;
        line-height: 1.3;
    }

    .header-text b {
        font-size: 12px;
        display: block;
    }

    .isi {
        padding: 8px 12px 0 12px;
        font-size: 12px;
    }

    .isi table {
        width: 100%;
    }

    .isi td {
        padding: 3px 0;
    }

    .footer {
        position: absolute;
        bottom: 10px;
        left: 12px;
        right: 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .qr {
        flex: 1;
    }

    .qrcode {
        width: 50px;
        height: 50px;
        image-rendering: pixelated;
    }

    .ttd {
        flex: 1;
        text-align: right;
        font-size: 10px;
    }

    .ttd img {
        width: 60px;
        height: auto;
        margin: 2px 0;
        display: inline-block;
    }

    .ttd u {
        display: block;
        margin-top: 2px;
        font-weight: normal;
    }

    @media print {
        body {
            margin: 0;
            padding: 0;
            background: none;
            -webkit-print-color-adjust: exact;
        }

        .kartu {
            box-shadow: none;
        }
    }
</style>

<div class="kartu">
    <div class="header">
        <img src="<?= base_url('template/dist/assets/logo.png') ?>" alt="Logo">
        <div class="header-text">
            <b>Kartu Anggota Perpustakaan</b>
            MTsN 03 Kapuas Hulu<br>
            kec. Jongkong, kab. Kapuas Hulu, Kalimantan Barat
        </div>
    </div>

    <div class="isi">
        <table>
            <tr>
                <td>Nama</td>
                <td>: <?= strtoupper(htmlspecialchars($anggota->nama)) ?></td>
            </tr>
            <tr>
                <td>No. Anggota</td>
                <td>: <?= htmlspecialchars($anggota->no_anggota) ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: <?= htmlspecialchars($anggota->jenis_kelamin) ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <div class="qr">
            <?php if (!empty($anggota->kode_qr)): ?>
                <img src="file:///<?= FCPATH . 'template/dist/assets/qr_codes/' . $anggota->kode_qr ?>" alt="QR Code"
                    class="qrcode">
            <?php endif; ?>
        </div>

        <div class="ttd">
            Kepala Perpustakaan,<br>
            <img src="<?= base_url('template/dist/assets/ttd.png') ?>" alt="Tanda Tangan"><br>
            <u>Winda Arti, S.Pd.</u>
        </div>
    </div>
</div>