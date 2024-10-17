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
    <form action="../includes/category-add.php" method="post">

        <select name="parentId">
            <option value="main">Main Category</option>
            <?php $obj->getAllCategoryWithTree($parentId, $depth);
            ?>
        </select>
        <input type="text" name="title">
        <button type="submit">insert</button>
    </form>
</body>

</html>