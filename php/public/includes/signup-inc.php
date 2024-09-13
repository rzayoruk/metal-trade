<?php
session_start();
include "functions-inc.php";



if (!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["email"]) || !isset($_POST["passwd"]) || !isset($_POST["passwdconf"])) {
    $error = "All form fields are required.";
    $_SESSION["errors"] = $error;
    header("Location:../signup.php");
    exit();
}

$_POST = array_map('trim', $_POST);

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$passwd = $_POST["passwd"];
$passwdconf = $_POST["passwdconf"];


if (isAnySignupInputEmpty($name, $surname, $email, $passwd, $passwdconf)) {
    $error = "All form fields are required.";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

if(isInvalidNameOrSurname($name, $surname)){
    $error = "name and surname must consist of only letters (a-zA-Z).";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

echo "No problem right now.";