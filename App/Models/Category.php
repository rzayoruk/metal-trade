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


    public function getWithTree($rootId, $arr, $constParent = false)
    {
        // var_dump($constParent);exit;
        if ($rootId === null) {
            $sql = "SELECT id, parent_id, title FROM categories WHERE parent_id is NULL ORDER BY created_at";
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

            $currentPath = is_array($arr) ? $arr : [];
            $currentPath[] = $category["title"];

            $selected = ""; // for editpage

            if ($constParent !== false && $category["id"] == $constParent) { // for editpage
                $selected = "selected";
                echo '<option value="' . $category["id"] . '" '  . " " . $selected . ' >' . implode(" > ", $currentPath) . '</option>' . "<br>";
                return;
            }



            echo '<option value="' . $category["id"] . '" ' . " " . $selected . ' >' . implode(" > ", $currentPath) . '</option>' . "<br>";

            $this->getWithTree($category["id"], $currentPath, $constParent);
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
        $path = __DIR__ . "/../../php/public/images/";

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
