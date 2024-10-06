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
    $_SESSION["name"] = $user["name"];
    $_SESSION["roleId"] = $user["roleId"];
    header("Location:../index.php");
    exit;
} else {
    header("Location:../login.php?error=login");
    exit;
}
//die(__DIR__);




// if (isset($_POST["g-recaptcha-response"])) {
//     $token = $_POST["g-recaptcha-response"];
// }

// if ($token === null) {
//     header("Location:../login.php?error=csrf");
//     exit();
// }

// $secret = envReader::getEnvVar('CAPTCHA_SECRET');
// $data = array(
//     'secret' => $secret,
//     'response' => $token
// );

// $options = array(
//     'http' => array(
//         'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
//         'method' => 'POST',
//         'content' => http_build_query($data)
//     )
// );

// $context = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// $response = json_decode($result);




// if ($response->success && $response->score >= 0.5) {
//     echo json_encode(array('success' => true, "msg"=>"You are not a robot!", "response"=>$response));die();








// } else {
//     echo json_encode(array('success' => false, "msg" => "You are a robot!", "response" => $response));
//     $isRobot = true;
// }


// if ($isRobot) {
//     header("Location:../login.php?error=captcha");
//     exit();
// }
