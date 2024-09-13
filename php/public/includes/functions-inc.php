<?php
function recordFormInputsToSession($post)
{
    $_SESSION["name"] = $post["name"];
    $_SESSION["surname"] = $post["surname"];
    $_SESSION["email"] = $post["email"];
}

function isAnySignupInputEmpty($name, $surname, $email, $passwd, $passwdconf)
{

    if (empty($name) || empty($surname) || empty($email) || empty($passwd) || empty($passwdconf)) {
        return true;
    } else {
        return false;
    }
}

function isInvalidNameOrSurname($name, $surname)
{

    if (!preg_match("/^[a-zA-Z]+$/",$name) || !preg_match("/^[a-zA-Z]+$/",$surname)) {
        return true;
    } else {
        return false;
    }
}
