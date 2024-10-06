<?php
include __DIR__ . "/../../../autoloader.php";

use App\Security\Csrf\CsrfToken;
use App\Controllers\LoginController;
use App\Controllers\CaptchaController;


session_start();


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.php");
    exit;
}
if (!isset($_POST["csrf_token"]) || !CsrfToken::validate($_POST["csrf_token"])) {
    // echo "helloday";
    // exit;
    header("Location:../login.php?error=csrf");
    exit();
}

$captcha = new CaptchaController($_POST["g-recaptcha-response"]);
$captcha->captchaStage();


if (isset($_SESSION["name"])) {
    header("Location:../index.php");
}
$_POST = array_map('trim', $_POST);

$email = $_POST["email"];
$passwd = $_POST["passwd"];



$loginAttempt = new LoginController($email, $passwd);
$user = $loginAttempt->loginUser();


if ($user) {
    $_SESSION["id"] = $user["id"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["roleId"] = $user["roleId"];
    header("Location:../index.php");
    exit;
} else {
    header("Location:../login.php?error=login");
    exit;
}
