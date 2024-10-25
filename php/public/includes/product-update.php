<?php
session_start();
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ProductController;

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}




$obj = new ProductController;
$isOK = $obj->updateProduct($_POST["id"], $_POST["categoryId"], $_POST["title"], $_POST["keywords"], $_POST["description"], $_POST["status"], $_POST["slug"], $_POST["quantity"], $_POST["minquantity"], $_POST["price"]);
if ($isOK) {
    $_SESSION["notification"]["text"] = "Category updated successfully.";
    $_SESSION["notification"]["title"] = "Success!";
    $_SESSION["notification"]["icon"] = "success";
    header("Location:../admin/product_list.php");
    exit();
}
return "Some problems have occured";
