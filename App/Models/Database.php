<?php

namespace App\Models;

use PDO, PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        include __DIR__ . "/../../php/helpers/readEnv.php";


        $host = getEnvVar('DB_HOST');
        $dbname = getEnvVar('DB_NAME');
        $user = getEnvVar('DB_USER');
        $passwd = getEnvVar('DB_PASSWORD');


        try {

            $dsn = "pgsql:host=$host;dbname=$dbname";
            $pdo = new PDO($dsn, $user, $passwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "db connection is successfull<br>";
        } catch (PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
