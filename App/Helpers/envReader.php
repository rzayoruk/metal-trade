<?php

namespace App\Helpers;

class envReader
{
    public static function getEnvVar($key, $default = null)
    {
        if (!file_exists(__DIR__ . '/../../.env')) {
            return $default;
        }

        $lines = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


        //search presence of $key
        foreach ($lines as $line) {
            // pass the comment lines
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($envKey, $envValue) = explode("=", $line, 2);

            if (trim($envKey) === $key) {
                return $envValue;
            }
        }
        return $default;
    }

}
