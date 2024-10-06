<?php

namespace App\Controllers;

include __DIR__ . "/../../autoloader.php";

use App\Helpers\envReader;



class CaptchaController
{
    private $token;
    private $url;

    public function __construct($grecaptcha)
    {
        $this->token = $grecaptcha;
        $this->url = 'https://www.google.com/recaptcha/api/siteverify';
    }

    public function captchaStage()
    {
        if ($this->isEmptyToken()) {
            header("Location: ../login.php?error=captcha");
            exit();
        }
        $secret = envReader::getEnvVar('CAPTCHA_SECRET');
        $data = array(
            'secret' => $secret,
            'response' => $this->token,
        );
        $options = array(
            'http' => array(
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($this->url, false, $context);
        $response = json_decode($result);

        if ($response->success && $response->score < 0.5) {
            header("Location:../login.php?error=captcha");
            exit();
        }
        
    }

    private function isEmptyToken()
    {
        if ($this->token === null) {
            return true;
        }
        return false;
    }
}
