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
    public function insertCategory($parentId, $title)
    {
        // sanitizing must be done.
        parent::__construct();
        return $this->insert($parentId, $title);
    }
}
