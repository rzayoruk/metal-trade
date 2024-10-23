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
    protected function getAll()
    {
        $sql = "SELECT id, parent_id, image, title FROM categories;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
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

    public function getWithTree($parentId, $depth, $arr = [], $editForm = false, $editId = false)
    {

        if ($parentId === null) {
            $sql = "SELECT id, title FROM categories WHERE parent_id is NULL";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "SELECT id, title FROM categories WHERE parent_id = :parentId ;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':parentId' => $parentId]);
        }

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$categories) {

            return;
        }


        foreach ($categories as $category) {

            $currentPath = $arr;
            $currentPath[] = $category["title"];

            // Kategori yolunu ekrana yazdır
            //echo implode(" > ", $currentPath) . "<br>";
            echo ' <option '($editForm !== false && $editId !== false && $editId == $category["id"]) ? "selected" : "";
            ' value="' . $category["id"] . '">' . implode(" > ", $currentPath) . '</option>' . "<br>";

            $this->getWithTree($category["id"], $depth + 1, $currentPath);
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
    protected function delete($id)
    {
        // echo __DIR__;exit; /var/www/html/App/Models
        //find image name first
        $sql = "SELECT image FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        $path = __DIR__ . "/../../php/public/admin/images/";

        $imageFullPath = realpath($path . "/" . $record["image"]);
        if (file_exists($imageFullPath)) {
            if (!unlink($imageFullPath)) {
                return false;
            }
        } else {
            return false;
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
}
