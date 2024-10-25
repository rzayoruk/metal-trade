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
        // var_dump($parentAndTitle);exit;
        $branch = $this->getSpecificBranch($parentAndTitle["parent_id"], $parentAndTitle["title"]);
        return $branch;
    }
    private function getParentIdWithId($editId)
    {
        $this->getPIdWithId($editId);
    }
    public function getAllCategoryWithTree($parentId, $depth, $arr, $editId)
    {
        parent::__construct();
        if ($editId !== false) {
            $constParent = $this->getParentIdWithId($editId);
        }
        $this->getWithTree($parentId, $depth, $arr, $editId, $constParent);
    }

    private function isImageValid($file)
    {
        if ($file["catImg"]["error"] == 4) {
            $_SESSION["notification"]["text"] = "Category image should be uploaded.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/category_add.php");
            exit;
        }

        // var_dump($file);
        // exit;
        if (!is_uploaded_file($file["catImg"]["tmp_name"])) {
            $_SESSION["notification"]["text"] = "Category image must be uploaded to the tmp.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/category_add.php");
            exit;
        }

        $validFileExtensions = [
            "image/jpeg",
            "image/png",
        ];

        $fileExtension = $file["catImg"]["type"];

        if (!in_array($fileExtension, $validFileExtensions)) {
            return false;
        }

        $validFileSize = 1024 * 1024 * 5;  // 1024b^2*5 = 5mb

        if ($file["catImg"]["size"] <= $validFileSize) {

            //$name = uniqid("",true); // it can be an option for large-scale app
            $absolutePath = realpath(__DIR__ . "/../../../php/public/admin/images");
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

    private function isValidOthers($parentId, $title, $keywords, $description, $slug, $quantity, $minquantity, $price)
    {
        if (empty($parentId) || empty($title) || empty($keywords) || empty($description)  || empty($slug) || empty($quantity) || empty($minquantity) || empty($price)) { //empty Input check
            return false;
        }
        return true;
    }

    public function insertProduct($parentId, $userId, $title, $file, $keywords, $description, $status, $slug, $quantity, $minquantity, $price)
    {

        if (!$this->isValidOthers($parentId, $title, $keywords, $description, $slug, $quantity, $minquantity, $price)) {
            $_SESSION["notification"]["text"] = "All inputs are necessary. Please fill all fields.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/product_add.php");
            exit;
        }

        // $imageName = $this->isImageValid($file);

        // if (!$imageName) {
        //     $_SESSION["notification"]["text"] = "Something went wrong when the image uploaded.";
        //     $_SESSION["notification"]["icon"] = "error";
        //     $_SESSION["notification"]["title"] = "Error!";
        //     header("Location:../admin/category_add.php");
        //     exit;
        // }


        // sanitizing must be done.
        parent::__construct();
        return $this->insert($parentId, $userId, $title, $keywords, $description, $status, $slug, $quantity, $minquantity, $price);
    }

    public function deleteProduct($id)
    {

        if (!preg_match('/^\d{1,7}$/', $id)) {
            $_SESSION["notification"]["text"] = "wrong id format!";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/category_list.php");
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
            header("Location:../admin/category_list.php");
            exit;
        }

        parent::__construct();
        return $this->bringData($id);
    }

    public function updateCategory($id, $parentId, $title, $file, $keywords, $description, $status, $slug)
    {
        if (!$this->isValidOthers($parentId, $title, $keywords, $description, $slug)) {
            $_SESSION["notification"]["text"] = "All inputs are necessary. Please fill all fields.";
            $_SESSION["notification"]["icon"] = "error";
            $_SESSION["notification"]["title"] = "Error!";
            header("Location:../admin/category_add.php");
            exit;
        }

        $imageName = false;

        if ($file["catImg"]["error"] != 4) { //is image exist

            $imageName = $this->isImageValid($file);
        }

        // sanitizing must be done.
        parent::__construct();
        return $this->update($id, $parentId, $title, $imageName, $keywords, $description, $status, $slug);
    }
}