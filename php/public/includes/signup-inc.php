<?php
session_start();
include "functions-inc.php";



if (!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["email"]) || !isset($_POST["passwd"]) || !isset($_POST["passwdconf"])) {
    $error = "All form fields are required.";
    header("Location:../signup.php?error=emptyfields");
    exit();
}

$_POST = array_map('trim', $_POST);

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$passwd = $_POST["passwd"];
$passwdconf = $_POST["passwdconf"];


if (isAnySignupInputEmpty($name, $surname, $email, $passwd, $passwdconf)) {
    recordFormInputsToSession($_POST);
    header("Location:../signup.php?error=emptyfields");
    exit();
}

if (isNameOrSurnameInvalid($name, $surname)) {
    recordFormInputsToSession($_POST);
    header("Location:../signup.php?error=invalidname");
    exit();
}

if (isEmailInvalid($email)) {
    recordFormInputsToSession($_POST);
    header("Location:../signup.php?error=invalidemail");
    exit();
}

if (!passwdMatch($passwd, $passwdconf)) {
    recordFormInputsToSession($_POST);
    header("Location:../signup.php?error=nopasswordmatch");
    exit();
}

if (isPasswdInvalid($passwd)) {
    recordFormInputsToSession($_POST);
    header("Location:../signup.php?error=invalidpasswd");
    exit();
}

if (isEmailExist($email)) {
    recordFormInputsToSession($_POST);
    header("Location:../signup.php?error=existedemail");
    exit();
}

$_SESSION["type"] = createUser($name, $surname, $email, $passwd);
$_SESSION["name"] = $name;
header("Location:../index.php");

