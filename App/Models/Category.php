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
        $sql = "SELECT id, parent_id, title FROM categories;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    

    public function getWithTree($parentId, $depth, $arr = [])
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
            echo ' <option value="' . $category["id"] . '">' . implode(" > ", $currentPath) . '</option>' . "<br>";

            $this->getWithTree($category["id"], $depth + 1, $currentPath);
        }
    }
    protected function insert($parentId, $title, $imageName)
    {
        if ($parentId === "main") {
            $parentId = null;
        }
        $sql = "INSERT INTO categories (parent_id, title, image) VALUES (?, ?, ?);";
        $stmt = $this->pdo->prepare($sql);
        $rows = $stmt->execute([$parentId, $title, $imageName]);
        return $rows;
    }
}
