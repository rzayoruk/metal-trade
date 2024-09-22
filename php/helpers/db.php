<?php

//include("readEnv.php");
include __DIR__ . "/../../autoloader.php";

$env = new \App\Helpers\envReader;

$host = $env::getEnvVar('DB_HOST');
$dbname = $env::getEnvVar('DB_NAME');
$user = $env::getEnvVar('DB_USER');
$passwd = $env::getEnvVar('DB_PASSWORD');


try {

   $dsn = "pgsql:host=$host;dbname=$dbname";
   $pdo = new PDO($dsn, $user, $passwd);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

   echo "Connection failed: " . $e->getMessage();
}
