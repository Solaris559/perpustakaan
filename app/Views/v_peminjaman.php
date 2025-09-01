<!--begin::App Main-->

<main class="app-main">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success" style="font-weight:700;"><i
                            class="bi bi-journal-bookmark-fill me-2"></i><?= $title ?></h3>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0 mb-4" style="border-radius: 18px;">
                        <div class="card-body">
                            <a href="#" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
                                data-bs-target="#tambah">
                                <i class="bi bi-plus-lg"></i> Tambah Data
                            </a>
                            <!-- Modal Tambah Peminjaman -->
                            <!-- Modal Tambah Peminjaman -->
                            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                                    class="bi bi-journal-plus me-2"></i>Tambah Peminjaman</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" onclick="stopScanner()"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('home/tambah_peminjaman') ?>" method="post"
                                                enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            required>
                                                        <button type="button" id="scan-anggota-btn"
                                                            class="btn btn-outline-secondary">Scan Anggota</button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_anggota" class="form-label">Nomor Anggota</label>
                                                    <input type="number" class="form-control" id="no_anggota"
                                                        name="no_anggota" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="judul" class="form-label">Judul Buku</label>
                                                    <div class="input-group">
                                                        <select class="form-select" id="judul" name="judul" required>
                                                            <option value="">-- Pilih Buku --</option>
                                                            <?php foreach ($buku as $data): ?>
                                                                <option value="<?= $data['isbn'] ?>">
                                                                    <?= $data['judul_buku'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <button type="button" id="scan-buku-btn"
                                                            class="btn btn-outline-secondary">Scan Buku</button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah" class="form-label">Jumlah</label>
                                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_peminjaman" class="form-label">Tanggal
                                                        Peminjaman</label>
                                                    <input type="date" class="form-control" id="tgl_peminjaman"
                                                        name="tgl_peminjaman" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="batas_waktu" class="form-label">Batas Waktu</label>
                                                    <input type="date" class="form-control" id="batas_waktu"
                                                        name="batas_waktu" required>
                                                </div>

                                                <!-- Scanner Area Anggota -->
                                                <div id="scan-anggota-region" style="display:none; margin-bottom:15px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <strong>Scan QR Kartu Anggota</strong>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            id="close-anggota-scan">Tutup</button>
                                                    </div>
                                                    <div id="reader-anggota" style="width:100%; max-width:400px;"></div>
                                                </div>

                                                <!-- Scanner Area Buku -->
                                                <div id="scan-buku-region" style="display:none; margin-bottom:15px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <strong>Scan QR Kode Buku</strong>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            id="close-buku-scan">Tutup</button>
                                                    </div>
                                                    <div id="reader-buku" style="width:100%; max-width:400px;"></div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" onclick="stopScanner()">Batal</button>
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="bi bi-save me-1"></i> Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Scanner -->
                            <div class="modal fade" id="scannerModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Scan Kode</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" onclick="stopScanner()"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div id="qr-reader" style="width: 100%"></div>
                                            <div id="qr-result" class="mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Scanner -->




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
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['no_anggota'] ?></td>
                                                <td><?= $data['judul'] ?></td>
                                                <td><?= $data['jumlah'] ?></td>
                                                <td><?= $data['tgl_peminjaman'] ?></td>
                                                <td><?= $data['batas_waktu'] ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?= $data['id_peminjaman'] ?>"><i
                                                            class="bi bi-pencil-square"></i> Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#selesai<?= $data['id_peminjaman'] ?>"><i
                                                            class="bi bi-trash"></i> Hapus</a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit Peminjaman -->
                                            <div class="modal fade" id="edit<?= $data['id_peminjaman'] ?>" tabindex="-1"
                                                aria-labelledby="modalLabel<?= $data['id_peminjaman'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <form action="<?= base_url('home/edit_peminjaman') ?>"
                                                            method="post">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel<?= $data['id_peminjaman'] ?>">
                                                                    Edit Peminjaman</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_peminjaman"
                                                                    value="<?= $data['id_peminjaman'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" name="nama"
                                                                        value="<?= $data['nama'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_anggota" class="form-label">No
                                                                        Anggota</label>
                                                                    <input type="text" class="form-control"
                                                                        name="no_anggota"
                                                                        value="<?= $data['no_anggota'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="judul" class="form-label">Judul Buku</label>
                                                                    <input type="text" class="form-control" name="judul"
                                                                        value="<?= $data['judul'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jumlah" class="form-label">Jumlah</label>
                                                                    <input type="number" class="form-control" name="jumlah"
                                                                        value="<?= $data['jumlah'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tgl_peminjaman" class="form-label">Tanggal
                                                                        Peminjaman</label>
                                                                    <input type="date" class="form-control"
                                                                        name="tgl_peminjaman"
                                                                        value="<?= $data['tgl_peminjaman'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="batas_waktu" class="form-label">Batas
                                                                        Waktu</label>
                                                                    <input type="date" class="form-control"
                                                                        name="batas_waktu"
                                                                        value="<?= $data['batas_waktu'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success"><i
                                                                        class="bi bi-save me-1"></i> Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Pengembalian -->
                                            <div class="modal fade" id="selesai<?= $data['id_peminjaman'] ?>" tabindex="-1"
                                                aria-labelledby="modalLabel<?= $data['id_peminjaman'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <form action="<?= base_url('home/tambah_pengembalian') ?>"
                                                            method="post">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel<?= $data['id_peminjaman'] ?>">
                                                                    Form Pengembalian</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_peminjaman"
                                                                    value="<?= $data['id_peminjaman'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" name="nama"
                                                                        value="<?= $data['nama'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_anggota" class="form-label">No
                                                                        Anggota</label>
                                                                    <input type="text" class="form-control"
                                                                        name="no_anggota" value="<?= $data['no_anggota'] ?>"
                                                                        readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="judul" class="form-label">Judul Buku</label>
                                                                    <input type="text" class="form-control" name="judul"
                                                                        value="<?= $data['judul'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jumlah" class="form-label">Jumlah</label>
                                                                    <input type="number" class="form-control" name="jumlah"
                                                                        value="<?= $data['jumlah'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tgl_pengembalian" class="form-label">Tanggal
                                                                        Pengembalian</label>
                                                                    <input type="date" class="form-control"
                                                                        name="tgl_pengembalian" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select name="status" class="form-select" required>
                                                                        <option value="" disabled selected>-- Pilih Status
                                                                            --</option>
                                                                        <option value="Selesai">Selesai</option>
                                                                        <option value="Terlambat">Terlambat</option>
                                                                        <option value="Hilang">Hilang</option>
                                                                        <option value="Rusak">Rusak</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="denda" class="form-label">Denda</label>
                                                                    <input type="number" class="form-control" name="denda"
                                                                        min="0">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success"><i
                                                                        class="bi bi-save me-1"></i> Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Pengembalian -->
                <div class="modal fade" id="selesai<?= $data['id_peminjaman'] ?>" tabindex="-1"
                    aria-labelledby="modalLabel<?= $data['id_peminjaman'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= base_url('home/tambah_pengembalian') ?>" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel<?= $data['id_peminjaman'] ?>">Form Pengembalian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_peminjaman" value="<?= $data['id_peminjaman'] ?>">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_anggota" class="form-label">No Anggota</label>
                                        <input type="text" class="form-control" name="no_anggota"
                                            value="<?= $data['no_anggota'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul Buku</label>
                                        <input type="text" class="form-control" name="judul"
                                            value="<?= $data['judul'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah"
                                            value="<?= $data['jumlah'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                        <input type="date" class="form-control" name="tgl_pengembalian" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Status --</option>
                                            <option value="Selesai">Selesai</option>
                                            <option value="Terlambat">Terlambat</option>
                                            <option value="Hilang">Hilang</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="denda" class="form-label">Denda</label>
                                        <input type="number" class="form-control" name="denda" min="0">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- endforeach dihapus karena sudah ditutup pada blok di atas -->
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script src="<?= base_url('template/dist/js/scanner.js') ?>"></script>
</main>