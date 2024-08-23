<?php

include("readEnv.php");

$host = getEnvVar('DB_HOST');
$dbname = getEnvVar('DB_NAME');
$user = getEnvVar('DB_USER');
$passwd= getEnvVar('DB_PASSWORD');


 try{

    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $passwd);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection is successful.";

 }catch(PDOException $e){

    echo "Connection failed: ". $e->getMessage();
 }











?>