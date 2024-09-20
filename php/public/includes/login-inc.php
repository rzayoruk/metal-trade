<?php
include __DIR__ . "/../../helpers/readEnv.php";
include "functions-inc.php";
include __DIR__ . "/../../../autoloader.php";

use App\Csrf\CsrfToken;


$isRobot = false;

$token = null;
$url = 'https://www.google.com/recaptcha/api/siteverify';

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if (isset($_POST["g-recaptcha-response"])) {
        $token = $_POST["g-recaptcha-response"];
    }

    if ($token === null) {
        header("Location:../login.php?error=csrf");
        exit();
    }

    $secret = getEnvVar('CAPTCHA_SECRET');
    $data = array(
        'secret' => $secret,
        'response' => $token
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);


    if ($response->success && $response->score >= 0.5) {
        //echo json_encode(array('success' => true, "msg"=>"You are not a robot!", "response"=>$response));die();
        session_start();
        if (isset($_SESSION["name"])) {
            header("Location:../index.php");
        }
        //die(__DIR__);


        if (!isset($_POST["csrf_token"]) || !CsrfToken::validate($_POST["csrf_token"])) {
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
            $_SESSION["roleId"] = $user["roleId"];
            return     header("Location:../index.php");
        } else {
            header("Location:../login.php?error=login");
        }
    } else {
        //echo json_encode(array('success' => false, "msg" => "You are a robot!", "response" => $response));
        $isRobot = true;
    }
}

if ($isRobot) {
    header("Location:../login.php?error=captcha");
    exit();
}
