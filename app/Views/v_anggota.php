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
                        <li class="breadcrumb-item"><a href="<?= base_url('home/index') ?>">Dashboard</a></li>
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
                            <a href="<?= base_url('home/naikKelas') ?>" class="btn btn-warning btn-sm mb-3 ms-2"
                                onclick="return confirm('Yakin ingin naikkan kelas semua anggota dan hapus data yang sudah lulus?')">
                                <i class="bi bi-arrow-up-circle"></i> Naikkan Kelas Semua Anggota
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
                                                    <!-- <input type="number" class="form-control" id="no_anggota"
                                                        name="no_anggota" required> -->
                                                    <input type="number" class="form-control" name="no_anggota"
                                                        value="<?= esc($no_anggota) ?>">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="kelas" class="form-label">Kelas</label>
                                                    <select class="form-select" id="kelas" name="kelas" required>
                                                        <option value="">-- Pilih Kelas --</option>
                                                        <option value="7A">7A</option>
                                                        <option value="7B">7B</option>
                                                        <option value="7C">7C</option>
                                                        <option value="8A">8A</option>
                                                        <option value="8B">8B</option>
                                                        <option value="8C">8C</option>
                                                        <option value="9A">9A</option>
                                                        <option value="9B">9B</option>
                                                        <option value="9C">9C</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin"
                                                        required>
                                                        <option value="">-- Pilih jenis_kelamin --</option>
                                                        <option value="laki-laki">laki-laki</option>
                                                        <option value="perempuan">perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">No. HP</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
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
                            <?php if (!empty(session()->getFlashdata('success'))) { ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered align-middle">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Nomor anggota</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                            <th class="text-center">No. HP</th>
                                            <th class="text-center noExport">QR Code</th>
                                            <th class="text-center noExport">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($anggota as $index => $data): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['no_anggota'] ?></td>
                                                <td><?= $data['kelas'] ?></td>
                                                <td><?= $data['jenis_kelamin'] ?></td>
                                                <td><?= $data['no_hp'] ?></td>
                                                <td>
                                                    <?php if (!empty($data['kode_qr'])): ?>
                                                        <img src="<?= base_url('template/dist/assets/qr_codes/' . $data['kode_qr']) ?>"
                                                            width="80" class="border rounded shadow-sm">
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="noExport">
                                                    <a href="#" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?= $data['id_anggota'] ?>"><i
                                                            class="bi bi-pencil-square"></i> Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#hapus<?= $data['id_anggota'] ?>"><i
                                                            class="bi bi-trash"></i>Hapus</a>
                                                    <a href="<?= base_url('home/cetak_kartu/' . $data['id_anggota']) ?>"
                                                        target="_blank" class="btn btn-info btn-sm">
                                                        <i class="bi bi-printer-fill"></i> Cetak
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit Anggota -->
                                            <div class="modal fade" id="edit<?= $data['id_anggota'] ?>" tabindex="-1"
                                                aria-labelledby="editLabel<?= $data['id_anggota'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h1 class="modal-title fs-5"
                                                                id="editLabel<?= $data['id_anggota'] ?>"><i
                                                                    class="bi bi-person-badge-fill me-2"></i>Detail Anggota
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="<?= base_url('home/edit_anggota/' . $data['id_anggota']) ?>"
                                                                method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_anggota"
                                                                    value="<?= $data['id_anggota'] ?>">
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
                                                                    <select class="form-select" id="kelas" name="kelas"
                                                                        required>
                                                                        <option value="7A" <?= $data['kelas'] == '7A' ? 'selected' : '' ?>>7A</option>
                                                                        <option value="7B" <?= $data['kelas'] == '7B' ? 'selected' : '' ?>>7B</option>
                                                                        <option value="7C" <?= $data['kelas'] == '7C' ? 'selected' : '' ?>>7C</option>
                                                                        <option value="8A" <?= $data['kelas'] == '8A' ? 'selected' : '' ?>>8A</option>
                                                                        <option value="8B" <?= $data['kelas'] == '8B' ? 'selected' : '' ?>>8B</option>
                                                                        <option value="8C" <?= $data['kelas'] == '8C' ? 'selected' : '' ?>>8C</option>
                                                                        <option value="9A" <?= $data['kelas'] == '9A' ? 'selected' : '' ?>>9A</option>
                                                                        <option value="9B" <?= $data['kelas'] == '9B' ? 'selected' : '' ?>>9B</option>
                                                                        <option value="9C" <?= $data['kelas'] == '9C' ? 'selected' : '' ?>>9C</option>
                                                                    </select>

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jenis_kelamin" class="form-label">Jenis
                                                                        Kelamin</label>
                                                                    <select class="form-select" id="jenis_kelamin"
                                                                        name="jenis_kelamin" required>
                                                                        <option value="laki-laki"
                                                                            <?= $data['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-laki</option>
                                                                        <option value="perempuan"
                                                                            <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                                                    </select>

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="no_hp" class="form-label">No. HP</label>
                                                                    <input type="text" class="form-control" id="no_hp"
                                                                        name="no_hp" value="<?= $data['no_hp'] ?>">
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

                                            <!-- Modal Hapus Anggota -->
                                            <div class="modal fade" id="hapus<?= $data['id_anggota'] ?>" tabindex="-1"
                                                aria-labelledby="hapusLabel<?= $data['id_anggota'] ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <h1 class="modal-title fs-5"
                                                                id="hapusLabel<?= $data['id_anggota'] ?>">
                                                                <i class="bi bi-person-badge-fill me-2"></i>Hapus Data
                                                                <?= $data['nama'] ?>
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus data anggota
                                                                <strong><?= $data['nama'] ?></strong>?
                                                            </p>

                                                            <form
                                                                action="<?= base_url('home/hapus_anggota/' . $data['id_anggota']) ?>"
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