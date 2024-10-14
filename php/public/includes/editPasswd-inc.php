<?php

include __DIR__ . "/../../../autoloader.php";

session_start();

use App\Controllers\UpdateInfos;
use App\Models\UpdateInfo;

if (!isset($_POST["csrf_token"]) || !$_POST["csrf_token"] == $_SESSION["csrf_token"]) {
    header("Location:../signup.php?error=csrf");
    exit();
}


if (!isset($_SESSION["name"])) {
    header("Location:../index.php");
}

$_POST = array_map('trim', $_POST);

$oldPasswd = $_POST["oldPasswd"];
$newPasswd = $_POST["newPasswd"];
$newPasswdConf = $_POST["newPasswdConf"];

$updater = new UpdateInfos($_SESSION["id"]);
$updater->updatePasswdStages($oldPasswd, $newPasswd, $newPasswdConf);
