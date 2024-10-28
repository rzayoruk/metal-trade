<?php

namespace App\Models;

use PDO;
use App\Helpers\Database;

class ImageGallery extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database)->getPdo();
    }
    protected function getAll($productId)
    {
        $sql = "SELECT im.id AS image_id, prod.id AS product_id, prod.title AS product_title, im.image, im.title AS image_title FROM products prod INNER JOIN images im ON  im.product_id = prod.id WHERE prod.id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([(int) $productId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    protected function findFirstChildCategory($id)
    {
        $sql = "SELECT parent_id, title FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $parentAndTitle = $stmt->fetch(PDO::FETCH_ASSOC);
        return $parentAndTitle;
    }
    protected function getSpecificBranch($parentId, $title)
    {

        $sql = "SELECT id, parent_id, title FROM categories WHERE id = :parentId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':parentId' => $parentId]);

        $parentCategory = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($parentCategory);
        // exit;
        if ($parentId === null) {

            return $title;
        }

        $title = $parentCategory["title"] . " > " . $title;


        return $this->getSpecificBranch($parentCategory["parent_id"], $title);
    }

    protected function getCategoryId($editId)
    {

        $sql = "SELECT category_id FROM products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$editId]);
        $categoryId = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($categoryId);
        // exit;
        return $categoryId["category_id"];
    }


    public function getWithTree($parentId, $depth, $arr, $editId, $categoryId)
    {

        if ($parentId === null) {
            $sql = "SELECT id,parent_id, title FROM categories WHERE parent_id is NULL";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "SELECT id,parent_id, title FROM categories WHERE parent_id = :parentId ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':parentId' => $parentId]);
        }

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$categories) {
            return;
        }

        foreach ($categories as $category) {

            $currentPath = is_array($arr) ? $arr : [];
            $currentPath[] = $category["title"];



            $selected = $category["id"] == $categoryId ? "selected" : ""; //for edit page

            echo '<option value="' . $category["id"] . '" '  . $selected . ' >' . implode(" > ", $currentPath) . '</option>' . "<br>";

            $this->getWithTree($category["id"], $depth + 1, $currentPath, $editId, $categoryId);
        }
    }

    protected function insert($productId,  $title, $imageName)
    {
        $sql = "INSERT INTO images (product_id, title, image) VALUES (?, ?, ?);";
        $stmt = $this->pdo->prepare($sql);
        $rows = $stmt->execute([$productId, $title, $imageName]);
        return $rows;
    }

    protected function delete($imageId)
    {
        //find image name first
        $sql = "SELECT image FROM images WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$imageId]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($record["image"]) {
            $path = __DIR__ . "/../../php/public/images/";
            $imageFullPath = realpath($path . "/" . $record["image"]);
            if (file_exists($imageFullPath)) {

                if (!unlink($imageFullPath)) {
                    var_dump("selam");
                    exit;

                    return false;
                }
            }
        }


        $sql = "DELETE from images WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $isOK = $stmt->execute([$imageId]);
        return $isOK;
    }

    protected function bringData($id)
    {
        $sql = "SELECT * from products WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;
    }

    protected function update($id, $categoryId, $title, $imageName, $keywords, $description, $status, $slug, $detail, $quantity, $minquantity, $price, $tax)
    {

        if (!$imageName) {

            $sql = "UPDATE products SET category_id = ? , title = ? , keywords = ? , description = ?, status = ?, slug = ?, detail = ?, quantity = ?, minquantity = ?, price = ?, tax = ? WHERE id = ? ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$categoryId, $title, $keywords, $description, $status, $slug, $detail, $quantity, $minquantity, $price, $tax, $id]);
            return true;
        } else {
            //remove old image first
            $sql = "SELECT image FROM products WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);
            $path = __DIR__ . "/../../php/public/images/";
            $imageFullPath = realpath($path . "/" . $oldImage["image"]);

            unlink($imageFullPath);
            $sql = "UPDATE products SET category_id = ? , title = ? , keywords = ? ,image = ?, description = ?, status = ?, slug = ?, detail = ?, quantity = ?, minquantity = ?, price = ?, tax = ? WHERE id = ? ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$categoryId, $title, $keywords, $imageName, $description, $status, $slug, $detail, $quantity, $minquantity, $price, $tax, $id]);
            return true;
        }
    }
}
