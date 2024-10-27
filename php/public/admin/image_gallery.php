<?php
session_start();
if ($_SESSION["roleId"] !== 2) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link
        rel="stylesheet"
        href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link
        rel="stylesheet"
        href="../temp/AdminLTE-3.1.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
    <!-- iCheck -->
    <link
        rel="stylesheet"
        href="../temp/AdminLTE-3.1.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link
        rel="stylesheet"
        href="../temp/AdminLTE-3.1.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../temp/AdminLTE-3.1.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include 'pages/imageGallery.php';
        ?>
    </div>
    <?php
    $scripts = [
        "plugins/jquery/jquery.min.js",
        "plugins/bootstrap/js/bootstrap.bundle.min.js",
        "plugins/bs-custom-file-input/bs-custom-file-input.min.js",
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
    $singles = [
        '<script>
$(function () {
  bsCustomFileInput.init();
});
</script>',
        '
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
',
        "<script>
    const fileInput = document.getElementById('exampleInputFile');
    const imagePreview = document.getElementById('imagePreview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }

            reader.readAsDataURL(file); // b64
        }
    });
</script>"
    ];

    $prefix = "../temp/AdminLTE-3.1.0/";
    if (isset($scripts)) {
        foreach ($scripts as $script) {
            echo "<script src ='$prefix" . "$script'></script>";
        }
    }

    if (isset($_SESSION["notification"])) {
        array_push($singles, "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: " . "'" . $_SESSION["notification"]["icon"] . "'" . ",
            title: " . "'" . $_SESSION["notification"]["title"] . "'" . ",
            text: " . "'" . $_SESSION["notification"]["text"] . "'" . ",
            timer: 3000,
            showConfirmButton: false
        });
    </script>");

        unset($_SESSION['notification']);
    }

    if (isset($singles)) {
        foreach ($singles as $single) {
            echo $single;
        }
    }
    ?>

</body>

</html>