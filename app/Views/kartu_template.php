<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Anggota Perpustakaan</title>
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
            background: linear-gradient(to top, #ffffff, #d4f0d4);
            box-sizing: border-box;
            padding: 0;
        }

        .header {
            background-color: #3a7733;
            color: white;
            text-align: center;
            padding: 8px;
        }

        .header b {
            font-size: 12px;
        }

        .header span {
            font-size: 10px;
            display: block;
            line-height: 1.2;
        }

        .isi {
            padding: 8px 12px 4px 12px;
        }

        .isi table {
            width: 100%;
        }

        .isi td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .isi td:first-child {
            width: 40%;
            font-weight: bold;
        }

        .footer {
            width: 100%;
            padding: 4px 12px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            vertical-align: bottom;
        }

        .qr-img {
            width: 48px;
            height: 48px;
        }

        .ttd {
            text-align: right;
            font-size: 12px;
        }

        .ttd .space-ttd {
            height: 50mm;
            /* tambah ruang tanda tangan */
            line-height: 50mm;
            /* sesuaikan dengan height */
            font-size: 1pt;
            /* minimal font agar tidak hilang di mPDF */
        }
    </style>
</head>

<body>

    <div class="kartu">
        <!-- Header -->
        <div class="header">
            <b>Kartu Anggota Perpustakaan</b><br>
            <span>MTsN 03 Kapuas Hulu</span><br>
            <span>Kec. Jongkong, Kab. Kapuas Hulu, Kalimantan Barat</span>
        </div>

        <!-- Data Anggota -->
        <div class="isi">
            <table>
                <tr>
                    <td style="width: 35%; font-weight: bold; text-align: left;">Nama</td>
                    <td style="width: 5%; text-align: center;">:</td>
                    <td style="width: 60%; text-align: left;"><?= strtoupper(htmlspecialchars($anggota->nama)) ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: left;">No. Anggota</td>
                    <td style="text-align: center;">:</td>
                    <td><?= htmlspecialchars($anggota->no_anggota) ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: left;">Jenis Kelamin</td>
                    <td style="text-align: center;">:</td>
                    <td><?= htmlspecialchars($anggota->jenis_kelamin) ?></td>
                </tr>
            </table>


        </div>

        <!-- Footer: QR + TTD -->
        <div class="footer">
            <table class="footer-table">
                <tr>
                    <td style="width: 50%;">
                        <?php if (!empty($anggota->kode_qr)): ?>
                            <img src="<?= FCPATH . 'template/dist/assets/qr_codes/' . $anggota->kode_qr ?>" alt="QR Code"
                                class="qr-img" />
                        <?php endif; ?>
                    </td>
                    <td class="ttd">
                        Kepala Perpustakaan,<br>
                        <div class="space-ttd">&nbsp;</div> <!-- ruang tanda tangan manual -->
                        <u>Winda Arti, S.Pd.</u>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>