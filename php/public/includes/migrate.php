<?php

require __DIR__ . "/../../helpers/db.php";
global $pdo;
$pathOfSql = __DIR__ . "/../../migrations/migrations.sql";

$sql = file_get_contents($pathOfSql);
$pdo->exec($sql);
echo "SQL file is executed successfuly";

