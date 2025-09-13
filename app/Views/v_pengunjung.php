<main class="app-main">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success" style="font-weight:700;">
                        <i class="bi bi-person-check-fill me-2"></i><?= $title ?>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end bg-light p-2 rounded shadow-sm">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card shadow-lg border-0 mb-4" style="border-radius: 18px;">
                <div class="card-body">

                    <!-- Tombol Tambah Data -->
                    <a href="#" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
                        data-bs-target="#tambahKunjungan">
                        <i class="bi bi-plus-lg"></i> Tambah Kunjungan
                    </a>

                    <!-- Modal Tambah Kunjungan -->
                    <div class="modal fade" id="tambahKunjungan" tabindex="-1" aria-labelledby="tambahKunjunganLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="tambahKunjunganLabel">
                                        <i class="bi bi-person-plus me-2"></i>Tambah Kunjungan
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        onclick="stopScanner()"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('home/tambah_kunjungan') ?>" method="post">

                                        <div class="mb-3">
                                            <label for="id_anggota" class="form-label">Nama Pengunjung</label>
                                            <div class="input-group">
                                                <!-- Select normal -->
                                                <select class="form-select" id="id_anggota" name="id_anggota" required>
                                                    <option value="">-- Pilih Nama --</option>
                                                    <?php foreach ($anggota as $a): ?>
                                                        <option value="<?= $a['id_anggota'] ?>"
                                                            data-no_anggota="<?= $a['no_anggota'] ?>">
                                                            <?= htmlspecialchars($a['nama']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <!-- Hidden untuk hasil scan -->
                                                <input type="hidden" id="id_anggota_hidden" name="id_anggota_scan">

                                                <!-- Input text hasil scan (default disembunyikan) -->
                                                <input type="text" class="form-control" id="nama_anggota_scan" readonly
                                                    style="display:none;">

                                                <button type="button" id="scan-anggota-btn"
                                                    class="btn btn-outline-secondary">Scan Anggota</button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="no_anggota" class="form-label">Nomor Anggota</label>
                                            <input type="text" class="form-control" id="no_anggota" name="no_anggota"
                                                readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                                            <input type="date" class="form-control" id="tanggal_kunjungan"
                                                name="tanggal_kunjungan" required value="<?= date('Y-m-d') ?>">
                                        </div>

                                        <!-- Scanner Area -->
                                        <div id="scan-anggota-region" style="display:none; margin-bottom:15px;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>Scan QR Kartu Anggota</strong>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    id="close-anggota-scan">Tutup</button>
                                            </div>
                                            <div id="reader-anggota" style="width:100%; max-width:400px;"></div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                onclick="stopScanner()">Batal</button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-save me-1"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data Kunjungan -->
                    <div class="table-responsive">
                        <table id="table-kunjungan" class="table table-striped table-bordered align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Anggota</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kunjungan as $index => $data): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($data['nama']) ?></td>
                                        <td><?= htmlspecialchars($data['no_anggota']) ?></td>
                                        <td><?= htmlspecialchars($data['tanggal_kunjungan']) ?></td>
                                        <td>
                                            <form action="<?= base_url('home/hapus_kunjungan/' . $data['id_pengunjung']) ?>"
                                                method="post" class="d-inline"
                                                onsubmit="return confirm('Hapus data kunjungan ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<!-- Include html5-qrcode library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

<!-- scanner.js -->
<script src="<?= base_url('template/dist/js/scanner.js') ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const anggotaSelect = document.getElementById('id_anggota');
        const noAnggotaInput = document.getElementById('no_anggota');

        anggotaSelect.addEventListener('change', function () {
            const selectedOption = anggotaSelect.options[anggotaSelect.selectedIndex];
            const noAnggota = selectedOption.getAttribute('data-no_anggota');
            noAnggotaInput.value = noAnggota || '';
        });
    });
</script>