<?php

namespace App\Csrf;

class CsrfToken
{
    public static function generate()
    {
        if (empty($_SESSION["csrf_token"])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } else {
            return $_SESSION["csrf_token"];
        }
    }

    public static function validate($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
