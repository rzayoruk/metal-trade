<?php
session_start();

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ProductController;


$obj = new ProductController;

$isOK = $obj->deleteProduct($_GET["id"]);

if (!$isOK) {
    $_SESSION["notification"]["title"] = "Error!";
    $_SESSION["notification"]["text"] = "error is occured when deleted";
    $_SESSION["notification"]["icon"] = "error";
    header("Location:../admin/product_list.php");
    exit;
}
$_SESSION["notification"]["title"] = "Success!";
$_SESSION["notification"]["text"] = "Deleted successfully!";
$_SESSION["notification"]["icon"] = "success";
header("Location:../admin/product_list.php");
exit;
