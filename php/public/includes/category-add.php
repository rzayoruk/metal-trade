<?php
session_start();
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\CategoryController;

echo "test1";
if ($_SERVER["REQUEST_METHOD"] !== "POST" || $_SESSION["roleId"] !== 2 || !isset($_POST["parentId"]) || !isset($_POST["title"])) {
    header("Location:../index.php");
    exit;
}
echo "test2";


$obj = new CategoryController;
$isOK = $obj->insertCategory($_POST["parentId"], $_POST["title"]);
if ($isOK) {
    header("Location:../admin/categories.php?status=success");
    exit();
}
return "Some problems have occured";