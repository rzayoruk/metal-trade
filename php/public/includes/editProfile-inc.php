<?php

include __DIR__ . "/../../../autoloader.php";

session_start();

use App\Controllers\UpdateInfos;

if (!isset($_POST["csrf_token"]) || !$_POST["csrf_token"] == $_SESSION["csrf_token"]) {
    header("Location:../signup.php?error=csrf");
    exit();
}


