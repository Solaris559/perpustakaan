<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <main class="app-main">
                <div class="app-content-header mb-4">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3 class="mb-0 text-success" style="font-weight:700;"><i
                                        class="bi bi-book me-2"></i><?= $title ?></h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end bg-light p-2 rounded shadow-sm">
                                    <li class="breadcrumb-item"><a href="<?= base_url('home/index') ?>">Dashboard</a>
                                    </li>
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

                                <div class="card-body d-flex align-items-center gap-3 flex-wrap">
                                    <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#tambah">
                                        <i class="bi bi-plus-lg"></i> Tambah Data
                                    </a>

                                    <form method="get" action="<?= base_url('home/buku') ?>" class="d-flex gap-2">
                                        <select name="katalog" class="form-select form-select-sm"
                                            onchange="this.form.submit()" style="min-width:150px;">
                                            <option value="">Semua Katalog</option>
                                            <?php foreach ($katalog as $k): ?>
                                                <option value="<?= $k['katalog'] ?>" <?= ($k['katalog'] == $katalogFilter) ? 'selected' : '' ?>>
                                                    <?= $k['katalog'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <select name="rak" class="form-select form-select-sm"
                                            onchange="this.form.submit()" style="min-width:150px;">
                                            <option value="">Semua Rak</option>
                                            <?php foreach ($rak as $r): ?>
                                                <option value="<?= $r['rak'] ?>" <?= ($r['rak'] == $rakFilter) ? 'selected' : '' ?>>
                                                    <?= $r['rak'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </form>



                                    <!-- Modal Tambah Buku -->
                                    <div class="modal fade" id="tambah" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                                            class="bi bi-book-plus me-2"></i>Tambah Buku</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('home/tambah_buku') ?>" method="post"
                                                        enctype="multipart/form-data">
                                                        <!-- Upload Sampul -->
                                                        <div class="mb-3">
                                                            <label for="sampul" class="form-label">Sampul</label>
                                                            <input type="file" class="form-control" id="sampul"
                                                                name="sampul">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label">Judul</label>
                                                            <input type="text" class="form-control" id="judul_buku"
                                                                name="judul_buku" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="katalog" class="form-label">Katalog</label>
                                                            <input type="text" class="form-control" id="katalog"
                                                                name="katalog">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="rak" class="form-label">Rak</label>
                                                            <input type="number" class="form-control" id="rak"
                                                                name="rak">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pengarang" class="form-label">Pengarang</label>
                                                            <input type="text" class="form-control" id="pengarang"
                                                                name="pengarang" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penerbit" class="form-label">Penerbit</label>
                                                            <input type="text" class="form-control" id="penerbit"
                                                                name="penerbit">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kota" class="form-label">Kota</label>
                                                            <input type="text" class="form-control" id="kota"
                                                                name="kota">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tahun_terbit" class="form-label">Tahun
                                                                Terbit</label>
                                                            <input type="number" class="form-control" id="tahun_terbit"
                                                                name="tahun_terbit">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jilid" class="form-label">Jilid</label>
                                                            <input type="text" class="form-control" id="jilid"
                                                                name="jilid">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jumlah_buku" class="form-label">Jumlah
                                                                Buku</label>
                                                            <input type="number" class="form-control" id="jumlah_buku"
                                                                name="jumlah_buku" min="1" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga_satuan" class="form-label">Harga
                                                                Satuan</label>
                                                            <input type="number" class="form-control" id="harga_satuan"
                                                                name="harga_satuan">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jumlah_halaman" class="form-label">Jumlah
                                                                Halaman</label>
                                                            <input type="number" class="form-control"
                                                                id="jumlah_halaman" name="jumlah_halaman">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="isbn" class="form-label">ISBN</label>
                                                            <input type="text" class="form-control" id="isbn"
                                                                name="isbn">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success"><i
                                                                    class="bi bi-save me-1"></i> Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty(session()->getFlashdata('success'))) { ?>
                                        <div class="alert alert-success">
                                            <?= session()->getFlashdata('success'); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered align-middle">
                                            <thead class="table-success">
                                                <tr>
                                                    <th>No</th>
                                                    <th class="noExport">Sampul</th>
                                                    <th>Judul</th>
                                                    <th>Katalog</th>
                                                    <th>Rak</th>
                                                    <th>Pengarang</th>
                                                    <th>Penerbit</th>
                                                    <th>Kota</th>
                                                    <th>Tahun Terbit</th>
                                                    <th>Jilid</th>
                                                    <th>Jumlah Buku</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Jumlah Halaman</th>
                                                    <th>ISBN</th>
                                                    <th class="noExport">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($buku as $index => $data): ?>
                                                    <tr>
                                                        <td class="noExport"><?= $index + 1 ?></td>
                                                        <td><img src="<?= base_url('template/dist/assets/covers/' . $data['sampul']) ?>"
                                                                width="60" class="border rounded shadow-sm"></td>
                                                        <td><?= $data['judul_buku'] ?></td>
                                                        <td><?= $data['katalog'] ?></td>
                                                        <td><?= $data['rak'] ?></td>
                                                        <td><?= $data['pengarang'] ?></td>
                                                        <td><?= $data['penerbit'] ?></td>
                                                        <td><?= $data['kota'] ?></td>
                                                        <td><?= $data['tahun_terbit'] ?></td>
                                                        <td><?= $data['jilid'] ?></td>
                                                        <td><?= $data['jumlah_buku'] ?></td>
                                                        <td><?= $data['harga_satuan'] ?></td>

                                                        <td><?= $data['jumlah_halaman'] ?></td>
                                                        <td><?= $data['isbn'] ?></td>
                                                        <td class="noExport">
                                                            <a href="#" class="btn btn-warning btn-sm me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit<?= $data['id_buku'] ?>"><i
                                                                    class="bi bi-pencil-square"></i> Edit</a>
                                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#hapus<?= $data['id_buku'] ?>"><i
                                                                    class="bi bi-trash"></i> Hapus</a>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Detail/Edit Buku -->
                                                    <div class="modal fade" id="edit<?= $data['id_buku'] ?>" tabindex="-1"
                                                        aria-labelledby="editLabel<?= $data['id_buku'] ?>"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success text-white">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="editLabel<?= $data['id_buku'] ?>">
                                                                        <i class="bi bi-book me-2"></i>Detail Buku
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="<?= base_url('home/edit_buku/' . $data['id_buku']) ?>"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <!-- Upload Sampul -->
                                                                        <!-- <div class="mb-3">
                                                                            <label for="sampul"
                                                                                class="form-label">Sampul</label>
                                                                            <input type="file" class="form-control"
                                                                                id="sampul" name="sampul">
                                                                        </div> -->
                                                                        <div class="mb-3">
                                                                            <label for="sampul"
                                                                                class="form-label">Sampul</label><br>
                                                                            <!-- Tampilkan gambar sampul lama -->
                                                                            <img src="<?= base_url('template/dist/assets/covers/' . $data['sampul']) ?>"
                                                                                width="100"
                                                                                class="mb-2 border rounded shadow-sm"><br>
                                                                            <!-- Input upload file -->
                                                                            <input type="file" class="form-control"
                                                                                id="sampul" name="sampul">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="judul"
                                                                                class="form-label">Judul</label>
                                                                            <input type="text" class="form-control"
                                                                                id="judul" name="judul_buku"
                                                                                value="<?= $data['judul_buku'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="katalog"
                                                                                class="form-label">Katalog</label>
                                                                            <input type="text" class="form-control"
                                                                                id="katalog" name="katalog"
                                                                                value="<?= $data['katalog'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="rak" class="form-label">Rak</label>
                                                                            <input type="number" class="form-control"
                                                                                id="rak" name="rak"
                                                                                value="<?= $data['rak'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="pengarang"
                                                                                class="form-label">Pengarang</label>
                                                                            <input type="text" class="form-control"
                                                                                id="pengarang" name="pengarang"
                                                                                value="<?= $data['pengarang'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="penerbit"
                                                                                class="form-label">Penerbit</label>
                                                                            <input type="text" class="form-control"
                                                                                id="penerbit" name="penerbit"
                                                                                value="<?= $data['penerbit'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="kota"
                                                                                class="form-label">Kota</label>
                                                                            <input type="text" class="form-control"
                                                                                id="kota" name="kota"
                                                                                value="<?= $data['kota'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="tahun_terbit"
                                                                                class="form-label">Tahun
                                                                                Terbit</label>
                                                                            <input type="number" class="form-control"
                                                                                id="tahun_terbit" name="tahun_terbit"
                                                                                value="<?= $data['tahun_terbit'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jilid"
                                                                                class="form-label">Jilid</label>
                                                                            <input type="text" class="form-control"
                                                                                id="jilid" name="jilid"
                                                                                value="<?= $data['jilid'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="jumlah_buku"
                                                                                class="form-label">Jumlah
                                                                                Buku</label>
                                                                            <input type="number" class="form-control"
                                                                                id="jumlah_buku" name="jumlah_buku"
                                                                                value="<?= $data['jumlah_buku'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="harga_satuan"
                                                                                class="form-label">Harga
                                                                                Satuan</label>
                                                                            <input type="number" class="form-control"
                                                                                id="harga_satuan" name="harga_satuan"
                                                                                value="<?= $data['harga_satuan'] ?>">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="jumlah_halaman"
                                                                                class="form-label">Jumlah
                                                                                Halaman</label>
                                                                            <input type="number" class="form-control"
                                                                                id="jumlah_halaman" name="jumlah_halaman"
                                                                                value="<?= $data['jumlah_halaman'] ?>">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="isbn"
                                                                                class="form-label">ISBN</label>
                                                                            <input type="text" class="form-control"
                                                                                id="isbn" name="isbn"
                                                                                value="<?= $data['isbn'] ?>">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-success"><i
                                                                                    class="bi bi-save me-1"></i>
                                                                                Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Hapus buku -->
                                                    <div class="modal fade" id="hapus<?= $data['id_buku'] ?>" tabindex="-1"
                                                        aria-labelledby="hapusLabel<?= $data['id_buku'] ?>"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success text-white">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="hapusLabel<?= $data['id_buku'] ?>">
                                                                        <i class="bi bi-person-badge-fill me-2"></i>Hapus
                                                                        Data Buku
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus data buku ini?
                                                                    </p>

                                                                    <form
                                                                        action="<?= base_url('home/hapus_buku/' . $data['id_buku']) ?>"
                                                                        method="post">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger">
                                                                                <i class="bi bi-trash me-1"></i>Hapus
                                                                            </button>
                                                                        </div>
                                                                    </form>

                                                                </div>
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
                </div>
        </div>
</main>
<!--end::App Main-->