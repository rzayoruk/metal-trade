<?php

require __DIR__ . "/db.php";
global $pdo;

$migrationName = $argv[1] ?? null;

if (!$migrationName) { // if there is no specific migration then migrate all table.
    $dir = __DIR__ . "/../migrations/";
    $files = scandir($dir);
    $files = array_diff($files, array('.', '..'));

    foreach ($sqlFiles as $file) {
        $filePath = $dir . '/' . $file;

        echo "Çalıştırılıyor: $filePath\n";

        try {
            $sql = file_get_contents($filePath);

            // SQL komutlarını çalıştır
            $pdo->exec($sql);

            echo "successfully: $filePath\n";
        } catch (PDOException $e) {
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
    exit();
}

$migrationFile = __DIR__ . "/../migrations/create_" . $migrationName . "_table.sql";


if (!file_exists($migrationFile)) {
    echo "migration file could not be found.";
    exit();
}

try {
    $pdo->exec(file_get_contents($migrationFile));
    echo $migrationName . " is migrated successfully.";
} catch (PDOException $E) {
    echo $migrationName . " migration is failed.";
}

