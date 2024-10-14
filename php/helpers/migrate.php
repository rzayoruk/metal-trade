<?php


require __DIR__ . "/../../autoloader.php";

use App\Helpers\Database;

$migrationName = $argv[1] ?? null;

$pdo = (new Database)->getPdo();
if (!$migrationName) { // if there is no specific migration then migrate all table.
    $dir = __DIR__ . "/../../App/migrations/";
    $files = scandir($dir);
    $files = array_diff($files, array('.', '..'));

    foreach ($sqlFiles as $file) {
        $filePath = $dir . '/' . $file;

        echo "Çalıştırılıyor: $filePath\n";

        try {
            $sql = file_get_contents($filePath);

            $pdo->exec($sql);

            echo "successfully: $filePath\n";
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
    exit();
}

$migrationFile = __DIR__ . "/../../App/migrations/create_" . $migrationName . "_table.sql";


if (!file_exists($migrationFile)) {
    echo "migration file could not be found.";
    exit();
}

try {
    $pdo->exec(file_get_contents($migrationFile));
    echo $migrationName . " is migrated successfully.";
} catch (PDOException $e) {
    echo $migrationName . " migration is failed. $e";
}
