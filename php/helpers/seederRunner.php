<?php
require "db.php";

global $pdo;


$seedName = $argv[1] ?? null;

if (!$seedName) {
    echo "declare the seeder name please. like php seederRunner.php users => ";
    exit();
}

$seedFile = __DIR__ . "/../seeder/" . $seedName . "_seed.sql";

if (!file_exists($seedFile)) {
    echo "seeder file could not be found.";
    exit();
}

try {
    $pdo->exec(file_get_contents($seedFile));
    echo $seedName . " seeder is run succesfuly.";
} catch (PDOException $e) {
    echo $seedName . " seeder is failed.";
}
