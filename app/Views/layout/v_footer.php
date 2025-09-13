<footer class="app-footer">
    <!--begin::To the end-->
    <!-- <div class="float-end d-none d-sm-inline">Anything you want</div> -->
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; <?= date('Y') ?>&nbsp;
        <a href="https://www.instagram.com/mtsn03kapuashulu?igsh=MXgxZm1ua3gxMnN5Zg=="
            class="text-decoration-none">Perpustakaan MTsN 03 Kapuas Hulu</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>
<!--end::Footer-->
</div>
<!--end::App Wrapper-->
<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="<?= base_url('template/dist/js/adminlte.js') ?>"></script>

<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->


<script src="<?= base_url('template/dist/js/datatables.min.js') ?>"></script>
<script src="<?= base_url('template/dist/js/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('template/dist/js/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('template/dist/js/custom.js') ?>"></script>

<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined
        ) {
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
<!--end::OverlayScrollbars Configure--><!-- Image path runtime fix -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Find the link tag for the main AdminLTE CSS file.
        const cssLink = document.querySelector(
            'link[href*="<?= base_url('public/template/dist/css/adminlte.css') ?>"]'
        );
        if (!cssLink) {
            return; // Exit if the link isn't found
        }

        // Extract the base path from the CSS href.
        // e.g., from "../css/adminlte.css", we get "../"
        // e.g., from "./css/adminlte.css", we get "./"
        const cssHref = cssLink.getAttribute("href");
        const deploymentPath = cssHref.slice(
            0,
            cssHref.indexOf("<?= base_url('public/template/dist/css/adminlte.css') ?>")
        );

        // Find all images with absolute paths and fix them.
        document.querySelectorAll('img[src^="<?= base_url('template/dist/assets/') ?>"]').forEach((img) => {
            const originalSrc = img.getAttribute("src");
            if (originalSrc) {
                const relativeSrc = originalSrc.slice(1); // Remove leading '/'
                img.src = deploymentPath + relativeSrc;
            }
        });
    });
</script>
<!-- OPTIONAL SCRIPTS -->
<!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
<!-- sortablejs -->
<script>
    new Sortable(document.querySelector(".connectedSortable"), {
        group: "shared",
        handle: ".card-header",
    });

    const cardHeaders = document.querySelectorAll(
        ".connectedSortable .card-header"
    );
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = "move";
    });
</script>

<!-- jsvectormap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
</body>
<!--end::Body-->

</html>