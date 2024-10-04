<?php

namespace App\Models;

use PDO;
use App\Helpers\Database;

class User extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database)->getPdo();
    }

    protected function isEmailExist($email)
    {
        $result = true;
        $sql = "SELECT * FROM users WHERE email = ?;";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($user)) {
            $result = false;
        }
        return $result;
    }

    protected function createUser($name, $surname, $email, $passwd)
    {
        $sql = "INSERT INTO users (name, surname, email, password, status, role_id)
            VALUES (?,?,?,?, true ,1);";
        $stmt = $this->pdo->prepare($sql);
        $hashed = password_hash($passwd, PASSWORD_BCRYPT);
        $stmt->execute([$name, $surname, $email, $hashed]);
        $sql = "SELECT role_id from users WHERE email = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $roleId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $roleId;
    }

    protected function login($email, $passwd)
    {
        $sql = "SELECT name, role_id, password FROM users WHERE email = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwd, $user["password"])) {
                return ['name' => $user["name"], 'roleId' => $user["role_id"]];
        }
        return false;
    }
}
