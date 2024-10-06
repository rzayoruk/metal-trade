<?php

namespace App\Models;

use PDO;
use App\Helpers\Database;

class UpdateInfo extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database)->getPdo();
    }

    protected function bringInfo($id)
    {
        $sql = "SELECT id, name, surname, email FROM users WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return ['id' => $user["id"], 'name' => $user["name"], 'email' => $user["email"]];
        }
        return false;
    }
}
