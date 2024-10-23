    <?php
    include "../../../autoloader.php";
    include "components/header.php";
    include "components/leftSidebar.php";

    include($content);

    include "components/footer.php";
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

    include "components/closeBody.php";


    ?>