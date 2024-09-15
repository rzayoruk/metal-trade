<?php

require __DIR__."/../../helpers/db.php";


function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function isAnySignupInputEmpty($name, $surname, $email, $passwd, $passwdconf)
{
    if (empty($name) || empty($surname) || empty($email) || empty($passwd) || empty($passwdconf)) {
        return true;
    } else {
        return false;
    }
}
function isAnyLoginInputEmpty($email, $passwd)
{
    if (empty($email) || empty($passwd)) {
        return true;
    } else {
        return false;
    }
}
function isNameOrSurnameInvalid($name, $surname)
{
    if (!preg_match("/^[a-zA-Z]+$/", $name) || !preg_match("/^[a-zA-Z]+$/", $surname)) {
        return true;
    } else {
        return false;
    }
}

function isEmailInvalid($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // code yourself
        return true;
    } else {
        return false;
    }
}



function passwdMatch($passwd, $passwdconf)
{
    if ($passwd === $passwdconf) {
        return true;
    } else {
        return false;
    }
}

function isPasswdInvalid($passwd)
{
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,32}$/', $passwd)) {
        return true;
    } else {
        return false;
    }
}

function isEmailExist($email)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$email]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}

function createUser($name, $surname, $email, $passwd)
{
    global $pdo;
    $sql = "INSERT INTO users (name, surname, email, password, status, type)
            VALUES (?,?,?,?,1,1);";
    $stmt = $pdo->prepare($sql);
    $hashed = password_hash($passwd, PASSWORD_BCRYPT);
    $stmt->execute([$name, $surname, $email, $hashed]);
    $sql = "SELECT type from users WHERE email = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $type = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $type;
}
function userLogin($email, $passwd)
{
    global $pdo;
    $sql = "SELECT name, type, password FROM users WHERE email = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($passwd, $user["password"])) {
        return [
            'name' => $user["name"],
            'type' => $user["type"]
        ];
    }
    return false;
}

