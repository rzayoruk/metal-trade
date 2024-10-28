<?php
session_start();
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ImageGalleryController;

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}

// var_dump($_POST);var_dump($_GET);
// var_dump($_FILES);
// exit;




$obj = new ImageGalleryController;
$productId = $_GET["productId"];

$isOK = $obj->insertImage($_GET["productId"], $_POST["title"], $_FILES);

if ($isOK) {
    $_SESSION["notification"]["text"] = "Image is added to the gallery successfully.";
    $_SESSION["notification"]["title"] = "Success!";
    $_SESSION["notification"]["icon"] = "success";
    header("Location:../admin/image_gallery.php?productId=$productId");
    exit();
}
return "Some problems have occured";
