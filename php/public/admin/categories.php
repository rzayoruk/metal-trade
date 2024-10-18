<?php

require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\CategoryController;

$obj = new CategoryController;

$parentId = null;
$depth = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category CRUD</title>
</head>

<body style="background:black; color:white;">

    <h2>Add New Category</h2>
    <?php if (isset($_GET["status"])) {
        switch ($_GET["status"]) {
            case "success":
                echo "inserted into db successfully.";
                break;
        }
    }
    ?>
    <form action="../includes/category-add.php" method="post" enctype="multipart/form-data">

        <select name="parentId">
            <option value="main">Main Category</option>
            <?php $obj->getAllCategoryWithTree($parentId, $depth);
            ?>
        </select>
        <input type="file" name="catImg" id="fileInput"><img id="imagePreview" style="max-width:300px" src="" alt="">
        <input type="text" name="title">
        <button type="submit">insert</button>
    </form>
</body>
<script>
    const fileInput = document.getElementById('fileInput');
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
</script>

</html>