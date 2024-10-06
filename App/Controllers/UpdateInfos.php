<?php

namespace App\Controllers;

use App\Models\UpdateInfo;

class UpdateInfos extends UpdateInfo
{
    private $name;
    private $surname;
    private $email;
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
        parent::__construct();
    }

    public function getInfo()
    {
        return $this->bringInfo($this->id);
    }
}
