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
    $_SESSION["notification"]["text"] = "Category added successfully.";
    $_SESSION["notification"]["title"] = "Success!";
    $_SESSION["notification"]["icon"] = "success";
    header("Location:../admin/category_add.php");
    exit();
}
return "Some problems have occured";
