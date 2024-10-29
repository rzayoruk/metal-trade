<?php
session_start();
if ($_SESSION["roleId"] !== 2) {
  header("Location: ../index.php");
}
$content = 'pages/productEdit.php';
$scripts = [
  "plugins/jquery/jquery.min.js",
  "plugins/bootstrap/js/bootstrap.bundle.min.js",
  "plugins/bs-custom-file-input/bs-custom-file-input.min.js",
  "dist/js/adminlte.min.js",
  "plugins/summernote/summernote-bs4.min.js",
  "plugins/codemirror/codemirror.js",
  "plugins/codemirror/mode/css/css.js",
  "plugins/codemirror/mode/xml/xml.js",
  "plugins/codemirror/mode/htmlmixed/htmlmixed.js",
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
</script>",
  "<script>

  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById('codeMirrorDemo'), {
      mode: 'htmlmixed',
      theme: 'monokai'
    });
  })

</script>"
];



include('layout.php');
