<?php
echo __DIR__;
include("../helpers/readEnv.php");

$host = 'db';// compose.yaml daki service name
$dbname = 'portakal';
$user = 'sogan';
$passwd = 'sarimsak';

 try{

    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $passwd);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection is successful.";

 }catch(PDOException $e){

    echo "Connection failed: ". $e->getMessage();
 }











?>