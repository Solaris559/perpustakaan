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
                                    <li class="breadcrumb-item"><a href="<?= base_url('home/tambah_buku') ?>">Home</a>
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
                                <div class="card shadow-lg border-0 mb-4" style="border-radius: 18px;">
                                    <div class="card-body">
                                        <a href="#" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
                                            data-bs-target="#tambah">
                                            <i class="bi bi-plus-lg"></i> Tambah Data
                                        </a>
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
                                                                <input type="text" class="form-control" id="judul"
                                                                    name="judul" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="pengarang"
                                                                    class="form-label">Pengarang</label>
                                                                <input type="text" class="form-control" id="pengarang"
                                                                    name="pengarang" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penerbit"
                                                                    class="form-label">Penerbit</label>
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
                                                                <input type="number" class="form-control"
                                                                    id="tahun_terbit" name="tahun_terbit">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jilid" class="form-label">Jilid</label>
                                                                <input type="text" class="form-control" id="jilid"
                                                                    name="jilid">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jumlah_buku" class="form-label">Jumlah
                                                                    Buku</label>
                                                                <input type="number" class="form-control"
                                                                    id="jumlah_buku" name="jumlah_buku">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga_satuan" class="form-label">Harga
                                                                    Satuan</label>
                                                                <input type="number" class="form-control"
                                                                    id="harga_satuan" name="harga_satuan">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="katalog" class="form-label">Katalog</label>
                                                                <input type="text" class="form-control" id="katalog"
                                                                    name="katalog">
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
                                                        <th>Sampul</th>
                                                        <th>Judul</th>
                                                        <th>Pengarang</th>
                                                        <th>Tahun Terbit</th>
                                                        <th>Jumlah Buku</th>
                                                        <th>Jumlah Halaman</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($buku as $index => $data): ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><img src="<?= base_url('template/dist/assets/uploads/' . $data['sampul']) ?>"
                                                                    width="60" class="border rounded shadow-sm"></td>
                                                            <td><?= $data['judul_buku'] ?></td>
                                                            <td><?= $data['pengarang'] ?></td>
                                                            <td><?= $data['tahun_terbit'] ?></td>
                                                            <td><?= $data['jumlah_buku'] ?></td>
                                                            <td><?= $data['jumlah_halaman'] ?></td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning btn-sm me-1"><i
                                                                        class="bi bi-pencil-square"></i> Edit</a>
                                                                <a href="#" class="btn btn-danger btn-sm"><i
                                                                        class="bi bi-trash"></i> Hapus</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Modal Detail Buku -->
                                        <div class="modal fade" id="detail" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                                                class="bi bi-book me-2"></i>Detail Buku</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('home/simpan_buku') ?>" method="post"
                                                            enctype="multipart/form-data">
                                                            <!-- Upload Sampul -->
                                                            <div class="mb-3">
                                                                <label for="sampul" class="form-label">Sampul</label>
                                                                <input type="file" class="form-control" id="sampul"
                                                                    name="sampul">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="judul" class="form-label">Judul</label>
                                                                <input type="text" class="form-control" id="judul"
                                                                    name="judul">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="pengarang"
                                                                    class="form-label">Pengarang</label>
                                                                <input type="text" class="form-control" id="pengarang"
                                                                    name="pengarang">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="penerbit"
                                                                    class="form-label">Penerbit</label>
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
                                                                <input type="number" class="form-control"
                                                                    id="tahun_terbit" name="tahun_terbit">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jilid" class="form-label">Jilid</label>
                                                                <input type="text" class="form-control" id="jilid"
                                                                    name="jilid">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jumlah_buku" class="form-label">Jumlah
                                                                    Buku</label>
                                                                <input type="number" class="form-control"
                                                                    id="jumlah_buku" name="jumlah_buku">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga_satuan" class="form-label">Harga
                                                                    Satuan</label>
                                                                <input type="number" class="form-control"
                                                                    id="harga_satuan" name="harga_satuan">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="katalog" class="form-label">Katalog</label>
                                                                <input type="text" class="form-control" id="katalog"
                                                                    name="katalog">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Modal -->
            <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Buku</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--begin::Form-->
                            <form action="<?= base_url('home/simpan_buku') ?>" method="post"
                                enctype="multipart/form-data">
                                <!--begin::Body-->
                                <!-- Upload Sampul -->
                                <div class="mb-3">
                                    <label for="detail_sampul" class="form-label">Sampul Buku</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="detail_sampul" name="sampul"
                                            accept="image/*">
                                        <label class="input-group-text" for="sampul">Upload</label>
                                    </div>
                                </div>

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label for="detail_judul" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="detail_judul" name="judul_buku"
                                        required>
                                </div>

                                <!-- Pengarang -->
                                <div class="mb-3">
                                    <label for="detail_pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="detail_pengarang" name="pengarang"
                                        required>
                                </div>

                                <!-- Penerbit -->
                                <div class="mb-3">
                                    <label for="detail_penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="detail_penerbit" name="penerbit">
                                </div>

                                <!-- Kota -->
                                <div class="mb-3">
                                    <label for="detail_kota" class="form-label">Kota Terbit</label>
                                    <input type="text" class="form-control" id="detail_kota" name="kota">
                                </div>

                                <!-- Tahun Terbit -->
                                <div class="mb-3">
                                    <label for="detail_tahun_terbit" class="form-label">Tahun
                                        Terbit</label>
                                    <input type="number" class="form-control" id="detail_tahun_terbit"
                                        name="tahun_terbit" min="1000" max="9999" required>
                                </div>

                                <!-- Jilid -->
                                <div class="mb-3">
                                    <label for="detail_jilid" class="form-label">Jilid</label>
                                    <input type="number" class="form-control" id="detail_jilid" name="jilid">
                                </div>

                                <!-- Jumlah Buku -->
                                <div class="mb-3">
                                    <label for="detail_jumlah_buku" class="form-label">Jumlah
                                        Buku</label>
                                    <input type="number" class="form-control" id="detail_jumlah_buku" name="jumlah_buku"
                                        min="1" required>
                                </div>

                                <!-- Harga Satuan -->
                                <div class="mb-3">
                                    <label for="detail_harga_satuan" class="form-label">Harga
                                        Satuan</label>
                                    <input type="number" class="form-control" id="detail_harga_satuan"
                                        name="harga_satuan" min="0">
                                </div>

                                <!-- Katalog -->
                                <div class="mb-3">
                                    <label for="detail_katalog" class="form-label">Katalog</label>
                                    <input type="text" class="form-control" id="detail_katalog" name="katalog">
                                </div>

                                <!-- Jumlah Halaman -->
                                <div class="mb-3">
                                    <label for="detail_jumlah_halaman" class="form-label">Jumlah
                                        Halaman</label>
                                    <input type="number" class="form-control" id="detail_jumlah_halaman"
                                        name="jumlah_halaman" min="1" required>
                                </div>

                                <!-- ISBN -->
                                <div class="mb-3">
                                    <label for="detail_isbn" class="form-label">ISBN</label>
                                    <input type="text" class="form-control" id="detail_isbn" name="isbn">
                                </div>
                                <!--end::Body-->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
</main>
<!--end::App Main-->