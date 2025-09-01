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
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nomor anggota</th>
                                            <th>Judul Buku</th>
                                            <th>Jumlah Buku</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Batas Waktu</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                            <th>Denda</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Tiger Nixon</td>
                                            <td>001</td>
                                            <td>Suci Dalam Gelas</td>
                                            <td>1</td>
                                            <td>17-8-2025</td>
                                            <td>7</td>
                                            <td>21-8-2025</td>
                                            <td>Selesai</td>
                                            <td>Tidak Ada</td>
                                        </tr>
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
</div>