<?php

namespace App\Models;
use PDO, PDOException;
use App\Helpers\envReader;

class Database
{
    private $pdo;

    public function __construct()
    {
        $host = envReader::getEnvVar('DB_HOST');
        $dbname = envReader::getEnvVar('DB_NAME');
        $user = envReader::getEnvVar('DB_USER');
        $passwd = envReader::getEnvVar('DB_PASSWORD');


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
