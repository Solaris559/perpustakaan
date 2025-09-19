<main class="app-main">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success" style="font-weight:700;">
                        <i class="bi bi-journal-bookmark-fill me-2"></i><?= $title ?>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end bg-light p-2 rounded shadow-sm">
                        <li class="breadcrumb-item"><a href="<?= base_url('home/tambah_buku') ?>">Home</a></li>
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
                    <a href="#" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#tambah">
                        <i class="bi bi-plus-lg"></i> Tambah Data
                    </a>

                    <!-- Modal Tambah Peminjaman -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="tambahLabel">
                                        <i class="bi bi-journal-plus me-2"></i>Tambah Peminjaman
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        onclick="stopScanner()"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('home/tambah_peminjaman') ?>" method="post"
                                        enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <div class="input-group">
                                                <!-- <input type="text" class="form-control" id="nama" name="nama" required> -->
                                                <select class="form-select" id="id_anggota" name="id_anggota" required>
                                                    <option value="">-- Pilih Nama --</option>
                                                    <?php foreach ($anggota as $a): ?>
                                                        <option value="<?= $a['id_anggota'] ?>"
                                                            data-no_anggota="<?= $a['no_anggota'] ?>">
                                                            <?= $a['nama'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

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
                                            <label for="judul" class="form-label">Judul Buku</label>
                                            <div class="input-group">
                                                <select class="form-select" id="judul" name="judul" required>
                                                    <option value="">-- Pilih Buku --</option>
                                                    <?php foreach ($buku as $data): ?>
                                                        <option value="<?= $data['isbn'] ?>">
                                                            <?= htmlspecialchars($data['judul_buku']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="button" id="scan-buku-btn"
                                                    class="btn btn-outline-secondary">Scan Buku</button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jumlah_buku" class="form-label">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah_buku"
                                                name="jumlah_buku" required value="1" min="1" max="1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_peminjaman" class="form-label">Tanggal Peminjaman</label>
                                            <input type="date" class="form-control" id="tgl_peminjaman"
                                                name="tgl_peminjaman" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="batas_waktu" class="form-label">Batas Waktu</label>
                                            <input type="date" class="form-control" id="batas_waktu" name="batas_waktu"
                                                required>
                                        </div>

                                        <!-- Scanner Areas (gunakan scanner.js yang kamu punya) -->
                                        <div id="scan-anggota-region" style="display:none; margin-bottom:15px;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>Scan QR Kartu Anggota</strong>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    id="close-anggota-scan">Tutup</button>
                                            </div>
                                            <div id="reader-anggota" style="width:100%; max-width:400px;"></div>
                                        </div>

                                        <div id="scan-buku-region" style="display:none; margin-bottom:15px;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>Scan Barcode Buku</strong>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    id="close-buku-scan">Tutup</button>
                                            </div>
                                            <div id="reader-buku" style="width:100%; max-width:400px;"></div>
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

                    <!-- Tabel Data Peminjaman -->
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered align-middle">
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Batas Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peminjaman as $index => $data): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($data['nama']) ?></td>
                                        <td><?= htmlspecialchars($data['no_anggota']) ?></td>
                                        <td><?= htmlspecialchars($data['judul_buku']) ?></td>
                                        <td><?= htmlspecialchars($data['jumlah_buku']) ?></td>
                                        <td><?= htmlspecialchars($data['tgl_peminjaman']) ?></td>
                                        <td><?= htmlspecialchars($data['batas_waktu']) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $data['id_peminjaman'] ?>">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#selesai<?= $data['id_peminjaman'] ?>">
                                                <i class="bi bi-check-circle-fill"></i> Selesai
                                            </a>
                                            <a href="<?= base_url('home/kirimPengingatPeminjaman/' . $data['id_peminjaman']) ?>"
                                                onclick="return confirm('Kirim pengingat WhatsApp ke <?= esc($data['nama']) ?>?')"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-whatsapp"></i> Kirim WA
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Peminjaman -->
                                    <div class="modal fade" id="edit<?= $data['id_peminjaman'] ?>" tabindex="-1"
                                        aria-labelledby="modalLabel<?= $data['id_peminjaman'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form
                                                    action="<?= base_url('home/edit_peminjaman/' . $data['id_peminjaman']) ?>"
                                                    method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modalLabel<?= $data['id_peminjaman'] ?>">Edit Peminjaman
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_peminjaman"
                                                            value="<?= $data['id_peminjaman'] ?>">
                                                        <div class="mb-3">
                                                            <label for="nama<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name="nama"
                                                                id="nama<?= $data['id_peminjaman'] ?>"
                                                                value="<?= htmlspecialchars($data['nama']) ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="no_anggota<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">No Anggota</label>
                                                            <input type="text" class="form-control" name="no_anggota"
                                                                id="no_anggota<?= $data['id_peminjaman'] ?>"
                                                                value="<?= htmlspecialchars($data['no_anggota']) ?>"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="judul<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Judul Buku</label>
                                                            <select class="form-select" name="judul"
                                                                id="judul<?= $data['id_peminjaman'] ?>" required>
                                                                <option value="">-- Pilih Buku --</option>
                                                                <?php foreach ($buku as $b): ?>
                                                                    <option value="<?= $b['isbn'] ?>"
                                                                        <?= ($b['judul_buku'] == $data['judul_buku']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($b['judul_buku']) ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jumlah_buku<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Jumlah</label>
                                                            <input type="number" class="form-control" name="jumlah_buku"
                                                                id="jumlah_buku<?= $data['id_peminjaman'] ?>"
                                                                value="<?= htmlspecialchars($data['jumlah_buku']) ?>"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tgl_peminjaman<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Tanggal Peminjaman</label>
                                                            <input type="date" class="form-control" name="tgl_peminjaman"
                                                                id="tgl_peminjaman<?= $data['id_peminjaman'] ?>"
                                                                value="<?= htmlspecialchars($data['tgl_peminjaman']) ?>"
                                                                required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="batas_waktu<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Batas Waktu</label>
                                                            <input type="date" class="form-control" name="batas_waktu"
                                                                id="batas_waktu<?= $data['id_peminjaman'] ?>"
                                                                value="<?= htmlspecialchars($data['batas_waktu']) ?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">
                                                            <i class="bi bi-save me-1"></i> Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Selesai Peminjaman -->
                                    <div class="modal fade" id="selesai<?= $data['id_peminjaman'] ?>" tabindex="-1"
                                        aria-labelledby="selesaiLabel<?= $data['id_peminjaman'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form
                                                    action="<?= base_url('home/selesai_peminjaman/' . $data['id_peminjaman']) ?>"
                                                    method="post">
                                                    <input type="hidden" name="id_buku" value="<?= $data['id_buku'] ?>">
                                                    <input type="hidden" name="jumlah_buku"
                                                        value="<?= $data['jumlah_buku'] ?>">

                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title"
                                                            id="selesaiLabel<?= $data['id_peminjaman'] ?>">Selesaikan
                                                            Peminjaman</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menyelesaikan peminjaman ini?</p>

                                                        <div class="mb-3">
                                                            <label for="statusPengembalian<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Status Pengembalian</label>
                                                            <select name="status"
                                                                id="statusPengembalian<?= $data['id_peminjaman'] ?>"
                                                                class="form-select" required>
                                                                <option value="" disabled selected>-- Pilih Status --
                                                                </option>
                                                                <option value="tepat waktu">Tepat Waktu</option>
                                                                <option value="terlambat">Terlambat</option>
                                                                <option value="rusak">Rusak</option>
                                                                <option value="hilang">Hilang</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3" id="inputGanti<?= $data['id_peminjaman'] ?>"
                                                            style="display:none;">
                                                            <label for="jenisGanti<?= $data['id_peminjaman'] ?>"
                                                                class="form-label">Jenis Penggantian</label>
                                                            <select class="form-select" name="jenis_ganti"
                                                                id="jenisGanti<?= $data['id_peminjaman'] ?>">
                                                                <option value="">-- Pilih Jenis Penggantian --</option>
                                                                <option value="nilai_ganti">Uang</option>
                                                                <option value="buku">Buku yang Sama</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3" id="inputNominal<?= $data['id_peminjaman'] ?>"
                                                            style="display:none;">
                                                            <label for="nilaiGanti<?= $data['id_peminjaman'] ?>"
                                                                class="form-label"
                                                                id="labelNilaiGanti<?= $data['id_peminjaman'] ?>">Nilai
                                                                Penggantian</label>
                                                            <input type="text" class="form-control" name="nilai_ganti"
                                                                id="nilaiGanti<?= $data['id_peminjaman'] ?>">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="bi bi-save me-1"></i> Selesaikan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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

<!-- Include scanner.js (yang sudah kamu punya) -->
<script src="<?= base_url('template/dist/js/scanner.js') ?>"></script>

<!-- Script Modal Selesai Peminjaman untuk handle show/hide input penggantian -->
<?php foreach ($peminjaman as $data): ?>
    <script>
        (function () {
            const statusSelect = document.getElementById('statusPengembalian<?= $data['id_peminjaman'] ?>');
            const inputGantiDiv = document.getElementById('inputGanti<?= $data['id_peminjaman'] ?>');
            const jenisGantiSelect = document.getElementById('jenisGanti<?= $data['id_peminjaman'] ?>');
            const inputNominalDiv = document.getElementById('inputNominal<?= $data['id_peminjaman'] ?>');
            const labelNilaiGanti = document.getElementById('labelNilaiGanti<?= $data['id_peminjaman'] ?>');
            const nilaiGantiInput = document.getElementById('nilaiGanti<?= $data['id_peminjaman'] ?>');

            if (!statusSelect) return;

            statusSelect.addEventListener('change', function () {
                const status = this.value;

                if (status === 'hilang' || status === 'rusak') {
                    inputGantiDiv.style.display = 'block';
                    inputNominalDiv.style.display = 'none';

                    // Reset value & add required
                    jenisGantiSelect.value = '';
                    jenisGantiSelect.setAttribute('required', 'required');

                    nilaiGantiInput.value = '';
                    nilaiGantiInput.removeAttribute('required');

                } else {
                    // Hide optional fields and remove required
                    inputGantiDiv.style.display = 'none';
                    inputNominalDiv.style.display = 'none';

                    jenisGantiSelect.value = '';
                    jenisGantiSelect.removeAttribute('required');

                    nilaiGantiInput.value = '';
                    nilaiGantiInput.removeAttribute('required');
                }
            });

            jenisGantiSelect.addEventListener('change', function () {
                const jenis = this.value;

                if (jenis === 'nilai_ganti') {
                    labelNilaiGanti.textContent = 'Jumlah Uang Penggantian';
                    nilaiGantiInput.placeholder = 'Masukkan jumlah uang penggantian';
                    nilaiGantiInput.type = 'number';
                    inputNominalDiv.style.display = 'block';
                    nilaiGantiInput.setAttribute('required', 'required');

                } else if (jenis === 'buku') {
                    labelNilaiGanti.textContent = 'Detail Buku Penggantian';
                    nilaiGantiInput.placeholder = 'Masukkan detail buku penggantian';
                    nilaiGantiInput.type = 'text';
                    inputNominalDiv.style.display = 'block';
                    nilaiGantiInput.setAttribute('required', 'required');

                } else {
                    inputNominalDiv.style.display = 'none';
                    nilaiGantiInput.value = '';
                    nilaiGantiInput.removeAttribute('required');
                }
            });
        })();
    </script>

<?php endforeach; ?>

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