<?php
session_start();
include("../helpers/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>
    public index.php <br>

    <?php if (isset($_SESSION["name"])): ?>
        Welcome <?= $_SESSION["name"] ?>
        <a href="includes/logout.php">logout</a>
    <?php else : ?>
        <a href="login.php">Login</a><br>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>


</body>

</html>