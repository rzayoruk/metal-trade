<?php

include __DIR__ . "/../../../autoloader.php";

session_start();

use App\Controllers\SignupController;



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

$signup = new SignupController($name, $surname, $email, $passwd, $passwdconf);
$signup->signupUser();


header("Location:../index.php");
