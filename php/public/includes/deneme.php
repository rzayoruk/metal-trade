<?php

$name = "";

if (preg_match("/^[a-zA-Z0-9]++$/", $name)) {
    echo "done";
} else {
    echo "neinn";
}
