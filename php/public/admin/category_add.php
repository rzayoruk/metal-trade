<?php
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
"
];

include('layout.php');
