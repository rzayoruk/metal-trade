<?php
require __DIR__ . "/../../autoloader.php";


use App\Helpers\Database;

$pdo = (new Database)->getPdo();


$seedName = $argv[1] ?? null;

if (!$seedName) {
    echo "declare the seeder name please. like => php seeder.php users";
    exit();
}

$seedFile = __DIR__ . "/../../App/seeder/" . $seedName . "_seed.sql";

if (!file_exists($seedFile)) {
    echo "seeder file could not be found.";
    exit();
}

try {
    $pdo->exec(file_get_contents($seedFile));
    echo $seedName . " seeder is run succesfuly.";
} catch (PDOException $e) {
    echo $seedName . " seeder is failed.";
    echo $e->getMessage();
}
