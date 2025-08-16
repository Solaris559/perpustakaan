<!--begin::App Main-->

<main class="app-main">
    <div class="app-content-header mb-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success" style="font-weight:700;"><i
                            class="bi bi-people-fill me-2"></i><?= $title ?></h3>
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
                            <!-- Modal Tambah Anggota -->
                            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                                    class="bi bi-person-plus-fill me-2"></i>Tambah Anggota</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('home/tambah_anggota') ?>" method="post">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_anggota" class="form-label">Nomor Anggota</label>
                                                    <input type="number" class="form-control" id="no_anggota"
                                                        name="no_anggota" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kelas" class="form-label">Kelas</label>
                                                    <input type="text" class="form-control" id="kelas" name="kelas"
                                                        required>
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
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered align-middle">
                                    <thead class="table-success">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nomor anggota</th>
                                            <th>Kelas</th>
                                            <th>QR Code</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($anggota as $index => $data): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['no_anggota'] ?></td>
                                                <td><?= $data['kelas'] ?></td>
                                                <td>
                                                    <?php if (!empty($data['kode_qr'])): ?>
                                                        <img src="<?= base_url('template/dist/assets/qr_codes/' . $data['kode_qr']) ?>"
                                                            width="80" class="border rounded shadow-sm">
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?= $data['id'] ?>"><i
                                                            class="bi bi-pencil-square"></i> Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>
                                                        Hapus</a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit Anggota -->
                                            <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1"
                                                aria-labelledby="editLabel<?= $data['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h1 class="modal-title fs-5" id="editLabel<?= $data['id'] ?>"><i
                                                                    class="bi bi-person-badge-fill me-2"></i>Detail Anggota
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?= base_url('home/simpan_buku') ?>" method="post"
                                                                enctype="multipart/form-data">
                                                                <input type="hidden" name="id_peminjaman"
                                                                    value="<?= $data['id'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" name="nama"
                                                                        value="<?= $data['nama'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_anggota" class="form-label">Nomor
                                                                        Anggota</label>
                                                                    <input type="number" class="form-control"
                                                                        id="no_anggota" name="no_anggota"
                                                                        value="<?= $data['no_anggota'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="kelas" class="form-label">Kelas</label>
                                                                    <input type="text" class="form-control" id="kelas"
                                                                        name="kelas" value="<?= $data['kelas'] ?>">
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