<?php

include __DIR__ . "/../../../autoloader.php";

session_start();

use App\Controllers\UpdateInfos;

if (!isset($_POST["csrf_token"]) || !$_POST["csrf_token"] == $_SESSION["csrf_token"]) {
    header("Location:../signup.php?error=csrf");
    exit();
}


if (!isset($_SESSION["name"])) {
    header("Location:../index.php");
}
$_POST = array_map('trim', $_POST);

$name = $_POST["name"];
$surname = $_POST["surname"];
$email= $_POST["email"];

$updateAttempt = new UpdateInfos($_SESSION["id"]);
$updateAttempt->updateStage($name, $surname, $email);

$_SESSION["name"] = $name;
$_SESSION["surname"] = $surname;
$_SESSION["email"] = $email;