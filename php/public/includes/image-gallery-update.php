<?php
session_start();

require __DIR__ . "/../../../autoloader.php";

use App\Controllers\Admin\ImageGalleryController;

if ($_SESSION["roleId"] != 2) {
    echo "nanana";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit;
}


// http_response_code(200);

// echo json_encode(["success" => true, "message" => "np"]);
// var_dump($_POST);
// if (isset($_FILES["prodImg"]))
//     var_dump($_FILES["prodImg"]);
// exit;




$obj = new ImageGalleryController;
$isOK = $obj->updateImage($_POST["productId"], $_POST["imageId"], $_FILES, $_POST["title"]);
if ($isOK) {
    http_response_code(200);
    if (is_array($isOK)) {
        echo json_encode([
            "statusCode" => "200",
            "success" => "Updated successfully.",
            "title" => $isOK["title"],
            "imageName" => $isOK["imageName"]

        ]);
    } else {
        echo json_encode([
            "statusCode" => "200",
            "success" => "Updated successfully.",
            "title" => $isOK,
        ]);
    }
    exit;
}
return "Some problems have occured";
