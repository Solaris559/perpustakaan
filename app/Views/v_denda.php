<!--begin::App Main-->

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
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-success">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Anggota</th>
                                            <th>Nilai Ganti</th>
                                            <th>Status Denda</th>
                                            <th>Tanggal Pelunasan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($denda)): ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($denda as $item): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= esc($item['nama']) ?></td>
                                                    <td><?= esc($item['no_anggota']) ?></td>
                                                    <td><?= esc($item['jumlah_denda']) ?></td>
                                                    <td><?= esc($item['status_denda']) ?></td>
                                                    <td><?= $item['tanggal_pembayaran'] ? esc($item['tanggal_pembayaran']) : '-' ?>
                                                    </td>
                                                    <td><?= esc($item['keterangan']) ?></td>
                                                    <td>
                                                        <form action="<?= base_url('home/updateStatus/' . $item['id_denda']) ?>"
                                                            method="post">
                                                            <select name="status_denda" onchange="this.form.submit()">
                                                                <option value="belum lunas" <?= $item['status_denda'] == 'belum lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                                                                <option value="lunas" <?= $item['status_denda'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Data Denda Tidak Ditemukan</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
