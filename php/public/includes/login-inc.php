<?php

session_start();
if (isset($_SESSION["name"])) {
    header("Location:../index.php");
}
include "functions-inc.php";


if (!isset($_POST["email"]) || !isset($_POST["passwd"])) {
    $error = "All form fields are required.";
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
