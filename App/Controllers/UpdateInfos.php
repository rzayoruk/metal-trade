<?php

namespace App\Controllers;

use App\Models\UpdateInfo;

class UpdateInfos extends UpdateInfo
{

    private $id;
    private $name;
    private $surname;
    private $email;
    private $oldPasswd;
    private $newPasswd;
    private $newPasswdConf;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function updateInfoStages($name, $surname, $email)
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

    public function updatePasswdStages($oldPasswd, $newPasswd, $newPasswdConf)
    {
        $this->oldPasswd = $oldPasswd;
        $this->newPasswd = $newPasswd;
        $this->newPasswdConf = $newPasswdConf;

        if ($this->isEmptyPasswd()) {
            header("Location: ../editProfile.php?error=emptyPasswd");
            exit;
        }

        if (!$this->areNewPasswdsMatch()) {
            header("Location: ../editProfile.php?error=noPasswdMatch");
            exit;
        }

        if ($this->arePasswdsInvalid()) {
            header("Location: ../editProfile.php?error=invalidPasswd");
            exit;
        }

        if (!$this->updatePasswd()) {
            header("Location: ../editProfile.php?error=wrongPasswd");
            exit;
        }
        header("Location: ../editProfile.php?error=successUpdatePass");
    }

    private function isEmptyInfos()
    {
        return empty($this->name) || empty($this->surname) || empty($this->email);
    }
    private function isEmptyPasswd()
    {
        return empty($this->oldPasswd) || empty($this->newPasswd) || empty($this->newPasswdConf);
    }


    private function isNameOrSurnameInvalid()
    {
        return !preg_match("/^[a-zA-Z ]{1,30}$/", $this->name) || !preg_match("/^[a-zA-Z ]{1,30}$/", $this->surname);
    }

    private function arePasswdsInvalid()
    {
        return !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,32}$/", $this->oldPasswd) ||
            !preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,32}$/", $this->newPasswd);
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

    private function updatePasswd()
    {
        $updater = new UpdateInfo;
        return $updater->updatePassword($this->oldPasswd, $this->newPasswd);
    }

    public function getInfo()
    {
        $infoGetter = new UpdateInfo;
        $infos = $infoGetter->bringInfo($this->id);
        return $infos;
    }

    private function areNewPasswdsMatch()
    {
        return $this->newPasswd === $this->newPasswdConf;
    }
}
