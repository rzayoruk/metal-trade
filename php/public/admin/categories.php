<?php

require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\CategoryController;

$obj = new CategoryController;
var_dump($obj->getAllCategory());
$categories = $obj->getAllCategory();
foreach ($categories as $category) {
    getTree($category);
}
function getTree($category)
{
    if ($category["parent_id"] == 0) {
    }
}

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
            <?php foreach ($categories as $category) :  ?>
                <option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="title">
        <button type="submit">insert</button>
    </form>
</body>

</html>