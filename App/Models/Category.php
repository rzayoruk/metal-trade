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
        $sql = "SELECT parent_id, title FROM categories;";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    protected function insert($parentId, $title)
    {
        $sql = "INSERT INTO categories (parent_id, title) VALUES (?, ?);";
        $stmt = $this->pdo->prepare($sql);
        $rows = $stmt->execute([$parentId, $title]);
        return $rows;
    }
}
