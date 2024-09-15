<?php
session_start();
include __DIR__ . '/functions-inc.php';


if (!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["email"]) || !isset($_POST["passwd"]) || !isset($_POST["passwdconf"])) {
    $error = "All form fields are required.";
    header("Location:../signup.php?error=emptyfields");
    exit();
}

if (!isset($_POST["csrf_token"]) || !$_POST["csrf_token"] == $_SESSION["csrf_token"]) {
    header("Location:../signup.php?error=csrf");
    exit();
}


$_POST = array_map('trim', $_POST);

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$passwd = $_POST["passwd"];
$passwdconf = $_POST["passwdconf"];

if (isAnySignupInputEmpty($name, $surname, $email, $passwd, $passwdconf)) {
    header("Location:../signup.php?error=emptyfields&name=$name&surname=$surname&email=$email");
    exit();
}


if (isNameOrSurnameInvalid($name, $surname)) {
    header("Location:../signup.php?error=invalidname&name=$name&surname=$surname&email=$email");
    exit();
}

if (isEmailInvalid($email)) {
    header("Location:../signup.php?error=invalidemail&name=$name&surname=$surname&email=$email");
    exit();
}

if (!passwdMatch($passwd, $passwdconf)) {
    header("Location:../signup.php?error=nopasswordmatch&name=$name&surname=$surname&email=$email");
    exit();
}

if (isPasswdInvalid($passwd)) {
    header("Location:../signup.php?error=invalidpasswd&name=$name&surname=$surname&email=$email");
    exit();
}

if (isEmailExist($email)) {
    header("Location:../signup.php?error=existedemail&name=$name&surname=$surname&email=$email");
    exit();
}

$_SESSION["type"] = createUser($name, $surname, $email, $passwd);
$_SESSION["name"] = $name;
header("Location:../index.php");
