<?php
session_start();


//echo ("<p style='display:none;'>" . $_SESSION["error"] . "</p>");




$content = 'pages/categoryAdd.php';
$scripts = [
  "plugins/jquery/jquery.min.js",
  "plugins/bootstrap/js/bootstrap.bundle.min.js",
  "plugins/bs-custom-file-input/bs-custom-file-input.min.js",
  "dist/js/adminlte.min.js",
  "dist/js/demo.js",
];
$singles = [
  "
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
",
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
if (isset($_SESSION["error"])) {
  array_push($singles, "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: " . "'" . $_SESSION["error"] . "'" . ",
            timer: 3000,
            showConfirmButton: false
        });
    </script>");

  unset($_SESSION['error']);
}

include('layout.php');
