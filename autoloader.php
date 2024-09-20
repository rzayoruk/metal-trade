<?php
spl_autoload_register(function ($class) {


    $class = __DIR__ . "/" . str_replace('\\', '/', $class) . ".php";
    //echo $class."<br>";
    if (file_exists($class)) {
        require $class;
    } else {
        echo "No file";
    }
});
