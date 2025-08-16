<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"
        style="padding:65px 0 32px 0; min-height:130px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
        <!--begin::Brand Link-->
        <a href="<?= base_url() ?>" class="brand-link d-flex flex-column align-items-center gap-2 py-2"
            style="border-radius:12px;margin-bottom:8px;width:100%;">
            <!--begin::Brand Image-->
            <img src="<?= base_url('template/dist/assets/img/logo_mtsn03.png') ?>" alt="Logo MTsN 03" class=""
                style="width:70px;height:70px;object-fit:cover;background:none;margin-top:0;" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-bold text-success text-center"
                style="font-size:1.15rem;letter-spacing:1px;line-height:1.2;margin-bottom:24px;">
                Perpustakaan
                <span style="display:block;margin-top:2px;font-size:1rem;color:#198754;font-weight:bold;">MTsN 03
                </span>
            </span>
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <style>
                .sidebar-menu .nav-link {
                    transition: background 0.2s, color 0.2s;
                    border-radius: 8px;
                    font-weight: 500;
                    font-size: 1.05rem;
                    margin-bottom: 2px;
                }

                .sidebar-menu .nav-link.active,
                .sidebar-menu .nav-link:hover {
                    background: #198754 !important;
                    color: #fff !important;
                }

                .sidebar-menu .nav-link.active i,
                .sidebar-menu .nav-link:hover i {
                    color: #fff !important;
                }

                .sidebar-menu .nav-link i {
                    margin-right: 8px;
                    font-size: 1.2rem;
                }

                .sidebar-menu .nav-link p {
                    margin-bottom: 0;
                }

                .sidebar-header {
                    font-size: 0.95rem;
                    color: #198754;
                    font-weight: bold;
                    margin-top: 1rem;
                    letter-spacing: 1px;
                }
            </style>
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item menu-open">
                    <a href="<?= base_url('home/index') ?>" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('home/anggota') ?>" class="nav-link">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>
                            Anggota
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('home/buku') ?>" class="nav-link">
                        <i class="nav-icon bi bi-book"></i>
                        <p>
                            Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-tree-fill"></i>
                        <p>
                            Transaksi
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('home/peminjaman') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('home/pengembalian') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Pengembalian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('home/denda') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Denda</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('home/buku') ?>" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Forms
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-table"></i>
                        <p>
                            Tables
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('template/dist/tables/simple.html') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Simple Tables</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-in-right"></i>
                        <p>
                            Auth
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Version 1
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('template/dist/examples/login.html') ?>" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Login</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('template/dist/examples/register.html') ?>" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Register</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Version 2
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('template/dist/examples/login-v2.html') ?>" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Login</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('template/dist/examples/register-v2.html') ?>"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Register</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('template/dist/examples/lockscreen.html') ?>" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Lockscreen</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->