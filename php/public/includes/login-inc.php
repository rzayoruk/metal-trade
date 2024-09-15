<?php

session_start();
if (isset($_SESSION["name"])) {
    header("Location:../index.php");
}
//die(__DIR__);
include "functions-inc.php";


if (!isset($_POST["csrf_token"]) || !$_POST["csrf_token"] == $_SESSION["csrf_token"]) {
    header("Location:../login.php?error=csrf");
    exit();
}


if (!isset($_POST["email"]) || !isset($_POST["passwd"])) {
    header("Location:../login.php?error=emptyfields");
    exit();
}


$_POST = array_map('trim', $_POST);

$email = $_POST["email"];
$passwd = $_POST["passwd"];

if (isAnyLoginInputEmpty($email, $passwd)) {
    header("Location:../login.php?error=emptyfields&email=$email");
    exit();
}
if (isEmailInvalid($email)) {
    header("Location:../login.php?error=invalidemail&email=$email");
    exit();
}

$user = userLogin($email, $passwd);
if ($user) {
    $_SESSION["name"] = $user["name"];
    $_SESSION["type"] = $user["type"];
    return     header("Location:../index.php");
} else {
    header("Location:../login.php?error=login");
}
