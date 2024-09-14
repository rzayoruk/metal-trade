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

if (isNameOrSurnameInvalid($name, $surname)) {
    $error = "name and surname must consist of only letters (a-zA-Z).";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

if (isEmailInvalid($email)) {
    $error = "invalid email format";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

if (!passwdMatch($passwd, $passwdconf)) {
    $error = "passwords aren't match.";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

if (isPasswdInvalid($passwd)) {
    $error = "Password must consist of 8 character and also include at least 1 lower, 1 upper, 1 digit and 1 special character.";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

if (isEmailExist($email)) {

    $error = "This email has been recorded already.";
    $_SESSION["errors"] = $error;
    recordFormInputsToSession($_POST);
    header("Location:../signup.php");
    exit();
}

$_SESSION["type"] = createUser($name, $surname, $email, $passwd);
$_SESSION["name"] = $name;
header("Location:../index.php");

