<?php
session_start();
include("../helpers/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    public index.php

    <?php if (isset($_SESSION["name"])): ?>
        Welcome <?= $_SESSION["name"] ?>
    <?php else : ?>
        <a href="login.php">Login</a><br>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>


</body>

</html>