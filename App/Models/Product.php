<?php

namespace App\Models;

use PDO;
use App\Helpers\Database;

class Product extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database)->getPdo();
    }
    protected function getAll()
    {
        $sql = "SELECT id, category_id,image, title FROM products;";
        $stmt = $this->pdo->query($sql);
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

    protected function insert($categoryId, $userId, $title, $keywords, $description, $imageName, $status, $slug, $detail, $quantity, $minquantity, $price, $tax)
    {
        $sql = "INSERT INTO products (category_id, user_id , title, keywords, description, image, status, slug, detail ,quantity, minquantity, price, tax) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->pdo->prepare($sql);
        $rows = $stmt->execute([$categoryId, $userId, $title, $keywords, $description, $imageName, $status, $slug, $detail, $quantity, $minquantity, $price, $tax]);
        return $rows;
    }

    protected function delete($id)
    {
        //find image name first
        $sql = "SELECT image FROM products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
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
            } else {
                return false;
            }
        }


        $sql = "DELETE from products WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $isOK = $stmt->execute([$id]);
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
