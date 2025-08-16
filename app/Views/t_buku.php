<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('home/buku') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">General Form</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="col-md-6">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <!-- <div class="card-header">
                            <div class="card-title">Edit Buku</div>
                        </div> -->
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="<?= base_url('home/simpan_buku') ?>" method="post" enctype="multipart/form-data">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!-- Upload Sampul -->
                                <div class="mb-3">
                                    <label for="sampul" class="form-label">Sampul Buku</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sampul" name="sampul"
                                            accept="image/*">
                                        <label class="input-group-text" for="sampul">Upload</label>
                                    </div>
                                </div>

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="judul" name="judul_buku" required>
                                </div>

                                <!-- Pengarang -->
                                <div class="mb-3">
                                    <label for="pengarang" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                                </div>

                                <!-- Penerbit -->
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit">
                                </div>

                                <!-- Kota -->
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota Terbit</label>
                                    <input type="text" class="form-control" id="kota" name="kota">
                                </div>

                                <!-- Tahun Terbit -->
                                <div class="mb-3">
                                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                                        min="1000" max="9999" required>
                                </div>

                                <!-- Jilid -->
                                <div class="mb-3">
                                    <label for="jilid" class="form-label">Jilid</label>
                                    <input type="number" class="form-control" id="jilid" name="jilid">
                                </div>

                                <!-- Jumlah Buku -->
                                <div class="mb-3">
                                    <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku"
                                        min="1" required>
                                </div>

                                <!-- Harga Satuan -->
                                <div class="mb-3">
                                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"
                                        min="0">
                                </div>

                                <!-- Katalog -->
                                <div class="mb-3">
                                    <label for="katalog" class="form-label">Katalog</label>
                                    <input type="text" class="form-control" id="katalog" name="katalog">
                                </div>

                                <!-- Jumlah Halaman -->
                                <div class="mb-3">
                                    <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                                    <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman"
                                        min="1" required>
                                </div>

                                <!-- ISBN -->
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn">
                                </div>
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->

                </div>
                <!--end::Col-->

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->