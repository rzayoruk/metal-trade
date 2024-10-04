<?php

namespace App\Controllers;



namespace App\Controllers;

use App\Models\User;


class LoginController extends User
{


    private $email;
    private $passwd;


    public function __construct($email, $passwd)
    {

        $this->email = $email;
        $this->passwd = $passwd;
        parent::__construct();
    }

    public function loginUser()
    {

        if ($this->emptyInput()) {
            header("Location:../login.php?error=emptyfields&email=$this->email");
            exit();
        }


        if ($this->invalidEmail()) {
            header("Location:../login.php?error=invalidemail&email=$this->email");
            exit();
        }

        return $this->login($this->email, $this->passwd);
    }

    private function emptyInput()
    {
        if (empty($this->email) || empty($this->passwd)) {
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
}
