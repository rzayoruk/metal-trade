<?php
session_start();

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}
require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ImageGalleryController;

$obj = new ImageGalleryController;

// echo $_GET["imageId"];
// exit;

$isOK = $obj->deleteImage($_GET["imageId"]);

if (!$isOK) {
    http_response_code(404);
    echo json_encode([
        "statusCode" => "404",
        "error" => "somethşng went wrong",
    ]);
    exit;
}

echo json_encode([
    "statusCode" => "200",
    "success" => "Deleted successfully.",
]);
exit;
