<?php
session_start();
if ($_SESSION["roleId"] !== 2) {
    header("Location: ../index.php");
}
$content = 'pages/categoryEdit.php';
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



include('layout.php');
