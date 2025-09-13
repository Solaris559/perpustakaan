$(document).ready(function() {
    $('#example').DataTable({
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari total _MAX_ data)",
            search: "Cari:"
        },

        dom:
            "<'row mb-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 text-center'B><'col-sm-12 col-md-4 text-md-end'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        buttons: {
            dom: {
                button: {
                    className: 'btn btn-outline-secondary btn-sm me-1'
                }
            },
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        },

        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ]
    });

    $('#PengembalianTable').DataTable({
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari total _MAX_ data)",
            search: "Cari:"
        },

        dom:
            "<'row mb-3'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 text-center'B><'col-sm-12 col-md-4 text-md-end'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        buttons: {
            dom: {
                button: {
                    className: 'btn btn-outline-secondary btn-sm me-1'
                }
            },
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        },

        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ]
    });
});
