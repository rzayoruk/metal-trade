<?php

namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Models\Product;

class ProductController extends Product
{

    public function getAllProduct()
    {
        parent::__construct();
        return $this->getAll();
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

    private function isImageValid($file)
    {

        if ($file["prodImg"]["error"] == 4) {
            $_SESSION["notification"]["text"] = "Product image should be uploaded.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_add.php");
            exit;
        }

        // var_dump($file);
        // exit;
        if (!is_uploaded_file($file["prodImg"]["tmp_name"])) {
            $_SESSION["notification"]["text"] = "Product image must be uploaded to the tmp.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_add.php");
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
            header("Location:../admin/product_add.php");
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

    private function isValidOthers($parentId, $title, $keywords, $description, $slug, $detail, $quantity, $minquantity, $price, $tax)
    {
        if (empty($parentId) || empty($title) || empty($keywords) || empty($description)  || empty($slug) || empty($detail) || empty($quantity) || empty($minquantity) || empty($price) || empty($tax)) { //empty Input check
            return false;
        }
        return true;
    }

    public function insertProduct($parentId, $userId, $title, $file, $keywords, $description, $status, $slug, $detail, $quantity, $minquantity, $price, $tax)
    {

        if (!$this->isValidOthers($parentId, $title, $keywords, $description, $slug, $detail, $quantity, $minquantity, $price, $tax)) {
            $_SESSION["notification"]["text"] = "All inputs are necessary. Please fill all fields.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_add.php");
            exit;
        }

        $imageName = $this->isImageValid($file);

        if (!$imageName) {
            $_SESSION["notification"]["text"] = "Something went wrong when the product image uploaded.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/category_add.php");
            exit;
        }


        // sanitizing must be done.
        parent::__construct();
        return $this->insert($parentId, $userId, $title, $keywords, $description, $imageName, $status, $slug, $detail, $quantity, $minquantity, $price, $tax);
    }

    public function deleteProduct($id)
    {

        if (!preg_match('/^\d{1,7}$/', $id)) {
            $_SESSION["notification"]["text"] = "wrong id format!";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_list.php");
            exit;
        }

        parent::__construct();
        return $this->delete($id);
    }

    public function bringDataForEdit($id)
    {
        if (!preg_match('/^\d{1,7}$/', $id)) {
            $_SESSION["notification"]["text"] = "wrong id format!";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_list.php");
            exit;
        }

        parent::__construct();
        return $this->bringData($id);
    }

    public function updateProduct($id, $parentId, $file, $title, $keywords, $description, $status, $slug, $detail, $quantity, $minquantity, $price, $tax)
    {
        if (!$this->isValidOthers($parentId, $title, $keywords, $description, $slug, $detail, $quantity, $minquantity, $price, $tax)) {
            $_SESSION["notification"]["text"] = "All inputs are necessary. Please fill all fields.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_list.php");
            exit;
        }

        $imageName = false;

        if ($file["prodImg"]["error"] != 4) { //is image exist

            $imageName = $this->isImageValid($file);
        }

        // sanitizing must be done.
        parent::__construct();
        return $this->update($id, $parentId, $title, $imageName, $keywords, $description, $status, $slug, $detail, $quantity, $minquantity, $price, $tax);
    }
}
