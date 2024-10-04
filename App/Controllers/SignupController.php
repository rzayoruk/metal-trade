<?php

namespace App\Controllers;

use App\Models\User;


class SignupController extends User
{

    private $name;
    private $surname;
    private $email;
    private $passwd;
    private $passwdconf;


    public function __construct($name, $surname, $email, $passwd, $passwdconf)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->passwd = $passwd;
        $this->passwdconf = $passwdconf;
        parent::__construct();
    }

    public function signupUser()
    {

        if ($this->emptyInput()) {
            header("Location:../signup.php?error=emptyfields&name=$this->name&surname=$this->surname&email=$this->email");
            exit();
        }

        if ($this->isNameOrSurnameInvalid()) {
            header("Location:../signup.php?error=invalidname&name=$this->name&surname=$this->surname&email=$this->email");
            exit();
        }

        if ($this->invalidEmail()) {
            header("Location:../signup.php?error=invalidemail&name=$this->name&surname=$this->surname&email=$this->email");
            exit();
        }

        if ($this->isEmailExist($this->email)) {
            header("Location:../signup.php?error=existedemail&name=$this->name&surname=$this->surname&email=$this->email");
            exit();
        }

        if (!$this->passwdMatch()) {
            header("Location:../signup.php?error=nopasswordmatch&name=$this->name&surname=$this->surname&email=$this->email");
            exit();
        }

        $_SESSION["roleId"] = $this->createUser($this->name, $this->surname, $this->email, $this->passwd);
        $_SESSION["name"] = $this->name;
        header("Location:../index.php");
    }

    private function emptyInput()
    {
        if (empty($this->name) || empty($this->surname) || empty($this->email) || empty($this->passwd) || empty($this->passwdconf)) {
            return true;
        } else {
            return false;
        }
    }

    private function isNameOrSurnameInvalid()
    {
        if (!preg_match("/^[a-zA-Z]+$/", $this->name) || !preg_match("/^[a-zA-Z]+$/", $this->surname)) {
            return true;
        } else {
            return false;
        }
    }

    private function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) { // code yourself
            return true;
        } else {
            return false;
        }
    }


    private function passwdMatch()
    {
        if ($this->passwd === $this->passwdconf) {
            return true;
        }
        return false;
    }
}
