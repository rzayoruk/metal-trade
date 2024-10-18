<?php

namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Models\Category;

class CategoryController extends Category
{

    private $pdo;
    public function __construct()
    {
        $this->pdo = (new Database)->getPdo();
    }

    public function getAllCategory()
    {
        parent::__construct();
        return $this->getAll();
    }
    public function getAllCategoryWithTree($parentId, $depth)
    {
        parent::__construct();
        $this->getWithTree($parentId, $depth);
    }

    private function isImageValid($file)
    {
        if ($file["catImg"]["error"] == 4) {
            echo "category image should be uploaded.";
            exit;
        }
        if (!is_uploaded_file($file["catImg"]["tmp_name"])) {
            echo "category image must be uploaded.";
            exit;
        }

        $validFileExtensions = [
            "image/jpeg",
            "image/png",
        ];

        $fileExtension = $file["catImg"]["type"];

        if (!in_array($fileExtension, $validFileExtensions)) {
            echo "an error occured1.";
            exit;
        }

        $validFileSize = 1024 * 1024 * 5;  // 1024b^2*5 = 5mb

        if ($file["catImg"]["size"] <= $validFileSize) {

            //$name = uniqid("",true); // it can be an option for large-scale app
            echo
            $absolutePath = realpath(__DIR__ . "/../../../php/public/images");
            $upload = move_uploaded_file($file["catImg"]["tmp_name"], $absolutePath . "/" . $file["catImg"]["name"]);
            if ($upload) {
                //echo '<img src= "../images/' . $file["catImg"]["name"] . '" width = "500" height="500">';
                return $file["catImg"]["name"];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function insertCategory($parentId, $title, $file)
    {

        $isImageUpload = $this->isImageValid($file);
        if (!$isImageUpload) {
            echo "image error";
            exit;
        }

        // sanitizing must be done.
        parent::__construct();
        return $this->insert($parentId, $title, $isImageUpload);
    }
}
