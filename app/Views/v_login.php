<?php
$blockStart = session()->get('block_time_start');
$blockTime = 0;

// Cek apakah blokir sudah habis
if ($blockStart) {
    $elapsed = time() - $blockStart;
    if ($elapsed >= 30) {
        session()->remove('login_attempts');
        session()->remove('last_attempt_time');
        session()->remove('block_time_start');
    } else {
        $blockTime = 30 - $elapsed;
    }
}
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Perpustakaan | MTSN 03 Kapuas Hulu</title>
    <link rel="icon" href="<?= base_url('template/dist/assets/img/logo_mtsn03.png') ?>" type="image/png" />
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Perpustakaan | MTSN 03 Kapuas Hulu" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="<?= base_url('template/dist/css/adminlte.css') ?>" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('template/dist/css/adminlte.css') ?>" />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page"
    style="background: url('<?= base_url('template/dist/assets/img/bg_login.avif') ?>') no-repeat center center fixed; background-size: cover;">
    <div class="login-box" style="max-width: 400px; margin: 5% auto;">
        <div class="card shadow-lg border-0" style="border-radius: 20px; background: rgba(255,255,255,0.95);">
            <div class="card-header text-center bg-success"
                style="border-top-left-radius:20px; border-top-right-radius:20px;">
                <img src="<?= base_url('template/dist/assets/img/logo_mtsn03.png') ?>" alt="Logo MTsN 03 Kapuas Hulu"
                    style="width:80px; margin-bottom:10px;">
                <h2 class="mb-0 text-white" style="font-family: 'Source Sans 3', sans-serif; font-weight:700;">MTsN 03
                    Kapuas Hulu</h2>
                <span class="text-light" style="font-size:1rem;">Perpustakaan Digital</span>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg" style="font-size:1.1rem; color:#198754; font-weight:500;">Silakan login
                    menggunakan Username dan Password yang terdaftar</p>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty(session()->getFlashdata('gagal')) && $blockTime == 0): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('gagal'); ?>
                    </div>
                <?php endif; ?>



                <?php echo form_open('home/cek_login') ?>
                <div class="mb-3">
                    <?= session()->getFlashdata('error') ? '<div class="alert alert-danger">' . session()->getFlashdata('error') . '</div>' : '' ?>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-success text-white"><i class="bi bi-person-fill"></i></span>
                    <input id="loginUsername" name="username" type="text" class="form-control" required
                        placeholder="Username" style="border-top-right-radius:10px; border-bottom-right-radius:10px;">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-success text-white"><i class="bi bi-lock-fill"></i></span>
                    <input id="loginPassword" name="password" type="password" class="form-control" required
                        placeholder="Password" style="border-top-right-radius:10px; border-bottom-right-radius:10px;">
                </div>
                <div class="d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-success btn-lg"
                        style="border-radius:10px; font-weight:600; transition:0.3s;">Login</button>
                </div>
                <?php echo form_close() ?>
                <div class="text-center mt-3">
                    <small class="text-muted">&copy; <?= date('Y') ?> Perpustakaan MTsN 03 Kapuas Hulu</small>
                </div>
            </div>
        </div>
    </div>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= base_url('template/dist/js/adminlte.js') ?>"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->

    <!-- Timer Dinamis -->
    <script>
        let blockTime = <?= $blockTime ?>;

        if (blockTime > 0) {
            const inputs = document.querySelectorAll('input, button');
            inputs.forEach(el => el.disabled = true);

            const form = document.querySelector('form');
            const countdownMsg = document.createElement('div');
            countdownMsg.style.color = 'red';
            countdownMsg.style.fontWeight = 'bold';
            countdownMsg.style.marginBottom = '15px';
            countdownMsg.style.textAlign = 'center';
            form.prepend(countdownMsg);

            function updateTimer() {
                countdownMsg.textContent = `⏳ Terlalu banyak percobaan login yang gagal. Silakan coba lagi dalam ${blockTime} detik.`;
                blockTime--;

                if (blockTime < 0) {
                    inputs.forEach(el => el.disabled = false);
                    countdownMsg.remove();
                    clearInterval(timerInterval);
                }
            }

            updateTimer();
            const timerInterval = setInterval(updateTimer, 1000);
        }
    </script>
</body>
<!--end::Body-->

</html>