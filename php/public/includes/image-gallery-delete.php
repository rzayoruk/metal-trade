<?php
session_start();

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ImageGalleryController;

$obj = new ImageGalleryController;

// echo $_GET["productId"] . $_GET["imageId"];
// exit;

$isOK = $obj->deleteImage($_GET["imageId"], $_GET["productId"]);

if (!$isOK) {
    $_SESSION["notification"]["title"] = "Error!";
    $_SESSION["notification"]["text"] = "error is occured when deleted";
    $_SESSION["notification"]["icon"] = "error";
    header("Location:../admin/image_gallery.php?productId=" . $_GET['productId']);
    exit;
}
$_SESSION["notification"]["title"] = "Success!";
$_SESSION["notification"]["text"] = "Deleted successfully!";
$_SESSION["notification"]["icon"] = "success";
header("Location:../admin/image_gallery.php?productId=" . $_GET['productId']);
exit;
