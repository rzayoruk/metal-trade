<?php

require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\CategoryController;

$obj = new CategoryController;
var_dump($obj->getAllCategory());
$categories = $obj->getAllCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category CRUD</title>
</head>

<body>

    <h2>Add New Category</h2>
    <?php if (isset($_GET["status"])) {
        switch ($_GET["status"]) {
            case "success":
                echo "insreted into db successfully.";
                break;
        }
    }
    ?>
    <form action="../includes/category-add.php" method="post">

        <select name="parentId">
            <?php foreach ($categories as $category) :  ?>
                <option value="<?= $category["parent_id"] ?>"><?= $category["title"] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="title">
        <button type="submit">insert</button>
    </form>
</body>

</html>