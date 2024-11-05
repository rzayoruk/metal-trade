<?php
require __DIR__ . "/../../autoloader.php";
include "../helpers/httpflags.php";


setCookieFlags();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    public index.php <br>

    <?php if (isset($_SESSION["name"])): ?>
        Welcome <?= $_SESSION["name"] ?>
        <a href="account.php">view my account</a>
        <a href="includes/logout.php">logout</a>
        <?php if ($_SESSION["roleId"] == 2): ?>
            <a href="/admin">Admin Panel</a>
        <?php endif; ?>
    <?php else : ?>
        <a href="login.php">Login</a><br>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>


</body>

</html>