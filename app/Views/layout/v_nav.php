<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand navbar-dark" style="background-color:#1e293b;">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                        </a>
                    </li> -->
                    <!--end::Navbar Search-->
                    <!--begin::Messages Dropdown Menu-->
                    <!--  -->
                    <!--end::Messages Dropdown Menu-->
                    <!--begin::Notifications Dropdown Menu-->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell-fill"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">
                                See All Notifications
                            </a>
                        </div>
                    </li>
                    <!--end::Notifications Dropdown Menu-->
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            data-bs-toggle="dropdown" style="min-width:100px;">
                            <img src="<?= base_url('template/dist/assets/img/' . session()->get('foto')) ?>"
                                class="user-image rounded-circle shadow border border-2 border-success" alt="User Image"
                                style="width:36px;height:36px;object-fit:cover;position:relative; top:4px;" />
                            <span class="d-none d-md-inline fw-semibold text-success"
                                style="font-size:1rem;"><?= session()->get('nama') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::Custom User Dropdown-->
                            <li class="dropdown-header text-center py-3" style="background:#fff;">
                                <img src="<?= base_url('template/dist/assets/img/' . session()->get('foto')) ?>"
                                    class="rounded-circle shadow" alt="User Image"
                                    style="width:64px;height:64px;object-fit:cover;">
                                <div class="mt-2 mb-1" style="font-size:1.15rem;font-weight:600;">
                                    <?= session()->get('nama') ?>
                                </div>
                                <div class="badge bg-dark ms-2" style="color:white;font-size:0.8rem;">
                                    <?= session()->get('role') ?>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider" style="border-color:#e5e7eb;">
                            </li>

                            <li>
                                <a href="#" id="btnAccountSettings"
                                    class="dropdown-item d-flex align-items-center gap-2 py-2">
                                    <i class="bi bi-gear" style="font-size:1.3rem;color:#374151;"></i>
                                    <span style="font-size:1.08rem;color:#232b36;font-weight:500;">Account
                                        Settings</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" id="btnHelpCenter"
                                    class="dropdown-item d-flex align-items-center gap-2 py-2">
                                    <i class="bi bi-life-preserver" style="font-size:1.3rem;color:#374151;"></i>
                                    <span style="font-size:1.08rem;color:#232b36;font-weight:500;">Help Center</span>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider" style="border-color:#e5e7eb;">
                            </li>
                            <li>
                                <a href="<?= base_url('home/logout') ?>"
                                    class="dropdown-item d-flex align-items-center gap-2 py-2">
                                    <i class="bi bi-box-arrow-right" style="font-size:1.3rem;color:#ef4444;"></i>
                                    <span style="font-size:1.08rem;color:#ef4444;font-weight:500;">Log Out</span>
                                </a>
                            </li>
                            <!--end::Custom User Dropdown-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <!-- Modal Edit Petugas -->
        <div class="modal fade" id="modalEditPetugas" tabindex="-1" aria-labelledby="modalEditPetugasLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?= base_url('home/edit_petugas/' . session()->get('id_petugas')) ?>" method="post"
                    enctype="multipart/form-data">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditPetugasLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 text-center">
                                <img src="<?= base_url('template/dist/assets/img/' . session()->get('foto')) ?>"
                                    id="previewFoto" alt="Foto Profil" class="rounded-circle shadow"
                                    style="width:100px;height:100px;object-fit:cover;">
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= session()->get('nama') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?= session()->get('username') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small class="text-muted">(isi
                                        jika
                                        ingin ganti password)</small></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password baru">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Help Center -->
        <div class="modal fade" id="modalHelpCenter" tabindex="-1" aria-labelledby="modalHelpCenterLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHelpCenterLabel">Help Center</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Jika Anda mengalami masalah dengan website, silakan hubungi:</p>
                        <ul>
                            <li><strong>No. HP:</strong> +62 812-3456-7890</li>
                            <li><strong>Email:</strong> support@website.com</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script -->
        <script>
            function previewImage(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('previewFoto').src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.getElementById('btnAccountSettings').addEventListener('click', function (e) {
                e.preventDefault();
                var myModal = new bootstrap.Modal(document.getElementById('modalEditPetugas'));
                myModal.show();
            });

            document.getElementById('btnHelpCenter').addEventListener('click', function (e) {
                e.preventDefault();
                var helpModal = new bootstrap.Modal(document.getElementById('modalHelpCenter'));
                helpModal.show();
            });
        </script>