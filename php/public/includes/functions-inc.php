<?php


function userLogin($email, $passwd)
{
    global $pdo;
    $sql = "SELECT name, role_id, password FROM users WHERE email = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($passwd, $user["password"])) {
        return [
            'name' => $user["name"],
            'roleId' => $user["role_id"]
        ];
    }
    return false;
}
