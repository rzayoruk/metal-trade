<?php

namespace App\Models;

use PDO;
use App\Helpers\Database;

class Category extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database)->getPdo();
    }
    protected function getAll() // it should be tree logic
    {
        $sql = "SELECT id, parent_id, image, title FROM categories";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    protected function getSpecificBranch($parentId, $title)
    {

        if ($parentId === null) {

            return $title;
        }

        $sql = "SELECT id, parent_id, title FROM categories WHERE id = :parentId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':parentId' => $parentId]);

        $parentCategory = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($parentCategory);
        // exit;


        $title = $parentCategory["title"] . " > " . $title;


        return $this->getSpecificBranch($parentCategory["parent_id"], $title);
    }

    protected function getPIdWithId($editId)
    {

        $sql = "SELECT parent_id FROM categories WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([(int) $editId]);
        $parentConst = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($parentConst === false) {
            return null; // veya uygun bir varsayılan değer döndürebilirsiniz
        }

        return $parentConst["parent_id"];
    }


    public function getWithTree($rootId, $arr,  $editId, $constParent = false)
    {
        //var_dump($constParent);exit;
        if ($rootId === null) {
            $sql = "SELECT id, parent_id, title FROM categories WHERE parent_id is NULL ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "SELECT id, parent_id, title FROM categories WHERE parent_id = :parentId ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':parentId' => $rootId]);
        }

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$categories) {
            return;
        }



        foreach ($categories as $category) {

            if ($category["id"] == $editId) {
                return;
            }

            $currentPath = is_array($arr) ? $arr : [];
            $currentPath[] = $category["title"];



            if ($constParent !== false && $category["id"] == $constParent) { // for editpage

                echo '<option value="' . $category["id"] . '" selected >' . implode(" > ", $currentPath) . '</option>' . "<br>";
            } else {

                echo '<option value="' . $category["id"] . '"  >' . implode(" > ", $currentPath) . '</option>' . "<br>";
            }



            $this->getWithTree($category["id"], $currentPath, $editId, $constParent);
        }
    }

    protected function insert($parentId, $title, $imageName, $keywords, $description, $status, $slug)
    {
        if ($parentId === "main") {
            $parentId = null;
        }
        $sql = "INSERT INTO categories (parent_id, title, image, keywords, description, status, slug) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->pdo->prepare($sql);
        $rows = $stmt->execute([$parentId, $title, $imageName, $keywords, $description, $status, $slug]);
        return $rows;
    }

    private function bringAllImages($catId, &$images = []) // includes current category img removing
    {
        //firstly delete productimg and  and productimg gallery if exist

        $sql = "SELECT image from categories WHERE id = ? "; //image name of the category
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$catId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        array_push($images, $category["image"]);
        $sql = "SELECT id, image from products WHERE category_id = ? "; //image of product of the category
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$catId]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($products) {

            foreach ($products as $product) {
                array_push($images, $product["image"]);
                $sql = "SELECT image FROM images WHERE product_id = ?;";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$product["id"]]);
                $imageGallery = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($imageGallery) {
                    foreach ($imageGallery as $image) {
                        array_push($images, $image["image"]);
                    }
                }
            }
        }



        //then look for sub category
        $sql = "SELECT id FROM categories WHERE parent_id = :parentId ;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':parentId' => $catId]);
        $subCats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($subCats) { //it has a subcategory

            foreach ($subCats as $subCat) {
                $this->bringAllImages($subCat["id"], $images);
            }
        }
        return $images;
    }

    protected function delete($id)
    {
        $arr = [];
        $images = $this->bringAllImages($id, $arr);

        $path = __DIR__ . "/../../php/public/images/";
        foreach ($images as $image) {
            $imageFullPath = realpath($path . "/" . $image);
            if (file_exists($imageFullPath)) {

                unlink($imageFullPath);
            } else {
                return false;
            } // move up this part later.
        }



        $sql = "DELETE from categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $isOK = $stmt->execute([$id]);
        return $isOK;
    }
    protected function bringData($id)
    {
        $sql = "SELECT * from categories WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category;
    }

    protected function update($id, $parentId, $title, $imageName, $keywords, $description, $status, $slug)
    {
        if ($parentId === "main") {
            $parentId = null;
        }

        if (!$imageName) {

            $sql = "UPDATE categories SET parent_id = ? , title = ? , keywords = ? , description = ?, status = ?, slug = ? WHERE id = ? ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$parentId, $title, $keywords, $description, $status, $slug, $id]);
            return true;
        } else {
            //remove old image first
            $sql = "SELECT image FROM categories WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);
            $path = __DIR__ . "/../../php/public/images/";
            $imageFullPath = realpath($path . "/" . $oldImage["image"]);

            unlink($imageFullPath);


            $sql = "UPDATE categories SET parent_id = ? , title = ?, image = ? , keywords = ? , description = ?, status = ?, slug = ? WHERE id = ? ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$parentId, $title, $imageName, $keywords, $description, $status, $slug, $id]);
            return true;
        }
        return false;
    }
}
