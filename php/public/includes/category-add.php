<?php
session_start();
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\CategoryController;

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}




$obj = new CategoryController;
$isOK = $obj->insertCategory($_POST["parentId"], $_POST["title"], $_FILES, $_POST["keywords"], $_POST["description"], $_POST["status"], $_POST["slug"]);
if ($isOK) {
    header("Location:../admin/category_add.php?status=success");
    exit();
}
return "Some problems have occured";
