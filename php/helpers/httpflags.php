<?php
function setCookieFlags()
{
    session_set_cookie_params([
        'lifetime' => 604800,         // 1 week
        'path' => '/',
        'domain' => 'localhost',    // specificdomain
        'secure' => true,        
        'httponly' => true,
        //'samesite' => 'Strict'        // CSRF protection
    ]);
}
