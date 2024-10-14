<?php

namespace App\Controllers;

use App\Models\UpdateInfo;

class UpdateInfos extends UpdateInfo
{

    private $id;
    private $name;
    private $surname;
    private $email;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function updateStage($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;

        if ($this->isEmptyInfos()) {
            header("Location: ../editProfile.php?error=emptyInput");
            exit;
        }

        if ($this->isNameOrSurnameInvalid()) {
            header("Location: ../editProfile.php?error=invalidNames");
            exit;
        }

        if ($this->isInvalidEmail()) {
            header("Location: ../editProfile.php?error=invalidEmail");
            exit;
        }

        if (!$this->update()) {
            header("Location: ../editProfile.php?error=db");
            exit;
        }
        $_SESSION["name"] = $this->name;
        $_SESSION["surname"] = $this->surname;
        $_SESSION["email"] = $this->email;
        header("Location: ../editProfile.php?error=false");
    }

    private function isEmptyInfos()
    {
        return empty($this->name) || empty($this->surname) || empty($this->email);
    }

    private function isNameOrSurnameInvalid()
    {
        return !preg_match("/^[a-zA-Z ]{1,30}$/", $this->name) || !preg_match("/^[a-zA-Z ]{1,30}$/", $this->surname);
    }

    private function isInvalidEmail()
    {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function update()
    {
        $updater = new UpdateInfo; //necessary for pdo
        return $updater->updateInfo($this->name, $this->surname, $this->email, $this->id);
    }

    public function getInfo()
    {
        $infoGetter = new UpdateInfo;
        $infos = $infoGetter->bringInfo($this->id);
        return $infos;
    }
}
