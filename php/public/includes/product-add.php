<?php
session_start();
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ProductController;

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}




$obj = new ProductController;
// var_dump($_POST);
// exit;
$isOK = $obj->insertProduct($_POST["parentId"], $_SESSION["id"], $_POST["title"], $_FILES, $_POST["keywords"], $_POST["description"], $_POST["status"], $_POST["slug"], $_POST["detail"], $_POST["quantity"], $_POST["minquantity"], $_POST["price"], $_POST["tax"]);
if ($isOK) {
    $_SESSION["notification"]["text"] = "Product added successfully.";
    $_SESSION["notification"]["title"] = "Success!";
    $_SESSION["notification"]["icon"] = "success";
    header("Location:../admin/product_list.php");
    exit();
}
return "Some problems have occured";
