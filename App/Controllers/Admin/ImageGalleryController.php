<?php

namespace App\Controllers\Admin;

use App\Models\ImageGallery;

class ImageGalleryController extends ImageGallery
{

    public function getAllImage($productId)
    {
        parent::__construct();
        return $this->getAll($productId);
    }

    public function getBranch($categoryId)
    {

        $parentAndTitle = $this->findFirstChildCategory($categoryId);
        $branch = $this->getSpecificBranch($parentAndTitle["parent_id"], $parentAndTitle["title"]);
        return $branch;
    }
    private function getCatId($editId)
    {
        return $this->getCategoryId($editId);
    }
    public function getAllCategoryWithTree($parentId, $depth, $arr, $editId)
    {
        parent::__construct();
        $categoryId = $this->getCatId($editId);
        $this->getWithTree($parentId, $depth, $arr, $editId, $categoryId);
    }

    private function isImageValid($file, $productId)
    {

        if ($file["prodImg"]["error"] == 4) {
            $_SESSION["notification"]["text"] = "Product image should be uploaded.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/image_gallery.php?productId=$productId");
            exit;
        }

        // var_dump($file);
        // exit;
        if (!is_uploaded_file($file["prodImg"]["tmp_name"])) {
            $_SESSION["notification"]["text"] = "Product image must be uploaded to the tmp.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/image_gallery.php?productId=$productId");
            exit;
        }

        $validFileExtensions = [
            "image/jpeg",
            "image/png",
        ];

        $fileExtension = $file["prodImg"]["type"];

        if (!in_array($fileExtension, $validFileExtensions)) {
            $_SESSION["notification"]["text"] = "image extension is not valid.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/image_gallery.php?productId=$productId");
            exit;
        }

        $validFileSize = 1024 * 1024 * 5;  // 1024b^2*5 = 5mb

        if ($file["prodImg"]["size"] <= $validFileSize) {

            $name = uniqid(""); // it can be an option for large-scale app
            $absolutePath = realpath(__DIR__ . "/../../../php/public/images");
            $exploded = explode(".", $file["prodImg"]["name"]);
            $extension =  $exploded[count($exploded) - 1];
            $imageName = $name . "." . $extension;
            $upload = move_uploaded_file($file["prodImg"]["tmp_name"], $absolutePath . "/" . $imageName);
            if ($upload) {
                //echo '<img src= "../images/' . $file["catImg"]["name"] . '" width = "500" height="500">';
                return $imageName;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    private function isValidOthers($productId, $title)
    {

        if (empty($productId) || empty($title)) { //empty Input check

            return false;
        }

        return true;
    }

    public function insertImage($productId, $title, $file)
    {


        if (!$this->isValidOthers($productId, $title)) {

            $_SESSION["notification"]["text"] = "All inputs are necessary. Please fill all fields.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/image_gallery.php?productId=$productId");
            exit;
        }


        $imageName = $this->isImageValid($file, $productId);

        if (!$imageName) {
            $_SESSION["notification"]["text"] = "Something went wrong when the product image uploaded.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/image_gallery.php?productId=$productId");
            exit;
        }


        // sanitizing must be done.
        parent::__construct();
        return $this->insert($productId, $title, $imageName);
    }

    public function deleteImage($imageId)
    {

        if (!preg_match('/^\d{1,7}$/', $imageId)) {

            http_response_code(400);
            echo json_encode([
                "statusCode" => "400",
                "error" => "Id format is bad!",
            ]);
        }

        parent::__construct();
        return $this->delete($imageId);
    }


    public function updateImage($productId, $imageId, $file, $title)
    {

        if (!$this->isValidOthers($imageId, $title)) {

            http_response_code(400);
            echo json_encode([
                "statusCode" => "400",
                "error" => "any input can not be null.",
            ]);
            exit;
        }

        $imageName = false;
        if ($file && $file["prodImg"]["error"] != 4) { //is image exist

            $imageName = $this->isImageValid($file, $productId);
        }

        // sanitizing must be done.
        parent::__construct();
        return $this->update($imageId, $title, $imageName);
    }
}
