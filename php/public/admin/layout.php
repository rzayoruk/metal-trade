    <?php

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
    if (isset($singles)) {
        foreach ($singles as $single) {
            echo $single;
        }
    }

    ?>