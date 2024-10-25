<?php
session_start();
$content = 'pages/productList.php';
$scripts = [
    "plugins/jquery/jquery.min.js",
    "plugins/bootstrap/js/bootstrap.bundle.min.js",
    "plugins/datatables/jquery.dataTables.min.js",
    "plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
    "plugins/datatables-responsive/js/dataTables.responsive.min.js",
    "plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
    "plugins/datatables-buttons/js/dataTables.buttons.min.js",
    "plugins/datatables-buttons/js/buttons.bootstrap4.min.js",
    "plugins/jszip/jszip.min.js",
    "plugins/pdfmake/pdfmake.min.js",
    "plugins/pdfmake/vfs_fonts.js",
    "plugins/datatables-buttons/js/buttons.html5.min.js",
    "plugins/datatables-buttons/js/buttons.print.min.js",
    "plugins/datatables-buttons/js/buttons.colVis.min.js",
    "dist/js/adminlte.min.js",
    "dist/js/demo.js",
];
$singles = ['
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
    $("#example2").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
'];

include('layout.php');
